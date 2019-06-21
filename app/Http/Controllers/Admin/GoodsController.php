<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Storage;
use App\Models\Goods;
use App\Models\Cate;

class GoodsController extends Controller
{
    /**
     * 商品列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $goods = Goods::where('name','like','%'.$search.'%')->paginate(3);

        // 加载页面
        return view('admin/goods/index', ['goods'=>$goods, 'search'=>$search]);
    }

    /**
     * 商品添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // 获取所有分类数据
        $cates = Cate::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->get();

        // 处理分类 阶层显示
        foreach ($cates as $key=>$value) {
            // 统计每个分类中path出现逗号的次数
            $n = substr_count($value->path,',');
            // 重新赋值 拼接上阶位符 |---
            $cates[$key]->cname = str_repeat('|---',$n).$value->cname;
        }

        // 加载页面
        return view('admin/goods/create', ['cates'=>$cates]);
    }

    /**
     * 处理 商品添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // 验证表单
        $this->validate($request, [
            'name' => 'required|max:16',
            'desc' => 'required|max:64',
            'money' => 'required|regex:/^[\d]{1,9}(\.\d{2})$/',
            'over' => 'required|regex:/^(\d{0,9})$/',
            'cid' => 'required',
            'file' => 'required',
            
        ],[
            'name.required'=>'商品名称必填',
            'name.max'=>'商品名称过长',
            'desc.required'=>'商品描述必填',
            'desc.max'=>'商品描述过长',
            'money.required'=>'商品价格必填',
            'money.regex'=>'商品价格格式不对',
            'over.required'=>'商品库存必填',
            'over.regex'=>'商品库存格式不对',
            'cid.required'=>'所属分类必选',
            'file.required'=>'商品图片必填',

        ]);
   
        // 执行文件上传
        if($request->hasFile('file')){
            $path = $request->file('file')->store(date('Ymd'));
        }else{
            $path = '';
        }

        // 接收表单所有值
        $data = $request->all();

        // 声明对象
        $goods = new Goods;

        // 重新赋值
        $goods->cid = $data['cid'];
        $goods->name = $data['name'];
        $goods->desc = $data['desc'];
        $goods->money = $data['money'];
        $goods->over = $data['over'];
        $goods->file = $path;
        $goods->status = 1;
        $goods->sale = 0;

        // 执行添加
        $res = $goods->save();

        // 判断是否成功
        if ($res) {
            // 添加成功
            return redirect('admin/goods')->with('success','添加成功');
        } else {
            // 添加失败
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * 商品 状态 切换
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        // 接受要切换的商品id
        $id = $request->input('id');

        // 查询要切换的商品状态值
        $goods = Goods::find($id);
        $status = $goods->status;

        // 切换status值
        if ($status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }  

        // 更新数据库数据
        $res = DB::update("update goods set status = $status where id = $id");

        // 判断是否切换成功
        if($res){
            echo "ok";
        }else{
            echo "err";
        }
    }



    /**
     * 商品修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 通过id获取要修改的商品数据
        $goods = Goods::find($id);

        // 获取所有分类数据
        $cates = Cate::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->get();

        // 处理分类 阶层显示
        foreach ($cates as $key=>$value) {
            // 统计每个分类中path出现逗号的次数
            $n = substr_count($value->path,',');
            // 重新赋值 拼接上阶位符 |---
            $cates[$key]->cname = str_repeat('|---',$n).$value->cname;
        }

        // 加载页面
        return view('admin/goods/edit', ['goods'=>$goods, 'cates'=>$cates]);
    }

    /**
     * 处理 商品修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // 验证表单
        $this->validate($request, [
            'name' => 'required|max:16',
            'desc' => 'required|max:64',
            'money' => 'required|regex:/^[\d]{1,9}(\.\d{2})$/',
            'over' => 'required|regex:/^(\d{0,9})$/',
            'cid' => 'required', 
        ],[
            'name.required'=>'商品名称必填',
            'name.max'=>'商品名称过长',
            'desc.required'=>'商品描述必填',
            'desc.max'=>'商品描述过长',
            'money.required'=>'商品价格必填',
            'money.regex'=>'商品价格格式不对',
            'over.required'=>'商品库存必填',
            'over.regex'=>'商品库存格式不对',
            'cid.required'=>'所属分类必选',

        ]);
   
        // 执行文件上传
        if($request->hasFile('file')){
            $path = $request->file('file')->store(date('Ymd'));
            // 删除旧图片
            Storage::delete($request->input('oldfile',''));
        }else{
            $path = $request->input('oldfile');
        }

        // 接收表单所有值
        $data = $request->all();

        // 声明对象
        $goods = Goods::find($id);
        // 重新赋值
        $goods->cid = $data['cid'];
        $goods->name = $data['name'];
        $goods->desc = $data['desc'];
        $goods->money = $data['money'];
        $goods->over = $data['over'];
        $goods->status = $data['status'];
        $goods->sale = $data['sale'];
        $goods->file = $path;

        // 执行修改
        $res = $goods->save();

        // 判断是否成功
        if ($res) {
            // 添加成功
            return redirect('admin/goods')->with('success','修改成功');
        } else {
            // 添加失败
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除 商品
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {  
        
        // 进行删除
        $res = Goods::destroy($id);

        // 判断是否删除成功
        if($res){
            // 删除图片
            Storage::delete($request->input('file',''));
            echo "ok";
        }else{
            echo "err";
        }
        
    }
}
