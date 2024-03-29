<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;
use Storage;
use App\Models\Doing;
use App\Models\Cate;

class DoingController extends Controller
{
    /**
     * 活动商品列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $doings = Doing::where('name','like','%'.$search.'%')->paginate(3);

        // 加载页面
        return view('admin/doing/index', ['doings'=>$doings, 'search'=>$search]);
    }

    /**
     * 活动商品添加页面
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
        return view('admin/doing/create', ['cates'=>$cates]);
    }

    /**
     * 处理 添加活动商品
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 检查redis缓存是否存在,查询键
        if(Redis::exists('doing4_redis_data')){
            // 存在便删除
            Redis::del('doing4_redis_data');
        }
        // 验证表单
        $this->validate($request, [
            'name' => 'required|max:16',
            'desc' => 'required|max:64',
            'price' => 'required|regex:/^[\d]{1,9}(\.\d{2})$/',
            'money' => 'required|regex:/^[\d]{1,9}(\.\d{2})$/',
            'over' => 'required|regex:/^(\d{0,9})$/',
            'cid' => 'required',
            'file' => 'required',
            
        ],[
            'name.required'=>'商品名称必填',
            'name.max'=>'商品名称过长',
            'desc.required'=>'商品描述必填',
            'desc.max'=>'商品描述过长',
            'money.required'=>'活动价格必填',
            'money.regex'=>'活动价格格式不对',
            'price.required'=>'商品原价必填',
            'price.regex'=>'商品原价格式不对',
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
        $doing = new doing;

        // 重新赋值
        $doing->cid = $data['cid'];
        $doing->name = $data['name'];
        $doing->desc = $data['desc'];
        $doing->price = $data['price'];
        $doing->money = $data['money'];
        $doing->over = $data['over'];
        $doing->file = $path;
        $doing->status = 1;
        $doing->sale = 0;

        // 执行添加
        $res = $doing->save();

        // 判断是否成功
        if ($res) {
            // 添加成功
            return redirect('admin/doing')->with('success','添加成功');
        } else {
            // 添加失败
            return back()->with('error','添加失败');
        }
    }

    /**
     * 活动商品 状态 切换
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        // 检查redis缓存是否存在,查询键
        if(Redis::exists('doing4_redis_data')){
            // 存在便删除
            Redis::del('doing4_redis_data');
        }
        // 接受要切换的活动商品id
        $id = $request->input('id');

        // 查询要切换的活动商品状态值
        $doings = doing::find($id);
        $status = $doings->status;

        // 切换status值
        if ($status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }  

        // 更新数据库数据
        $res = DB::update("update doings set status = $status where id = $id");

        // 判断是否切换成功
        if($res){
            echo "ok";
        }else{
            echo "err";
        }
    }

    /**
     * 活动商品修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 通过id获取要修改的活动商品数据
        $doing = doing::find($id);

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
        return view('admin/doing/edit', ['doing'=>$doing, 'cates'=>$cates]);
    }

    /**
     * 处理 修改活动商品
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 检查redis缓存是否存在,查询键
        if(Redis::exists('doing4_redis_data')){
            // 存在便删除
            Redis::del('doing4_redis_data');
        }
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
        $doing = doing::find($id);
        // 重新赋值
        $doing->cid = $data['cid'];
        $doing->name = $data['name'];
        $doing->desc = $data['desc'];
        $doing->money = $data['money'];
        $doing->over = $data['over'];
        $doing->status = $data['status'];
        $doing->sale = $data['sale'];
        $doing->file = $path;

        // 执行修改
        $res = $doing->save();

        // 判断是否成功
        if ($res) {
            // 添加成功
            return redirect('admin/doing')->with('success','修改成功');
        } else {
            // 添加失败
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除 活动商品
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // 检查redis缓存是否存在,查询键
        if(Redis::exists('doing4_redis_data')){
            // 存在便删除
            Redis::del('doing4_redis_data');
        }
        // 通过商品id去删除对应的详情图片
        $data = DB::table('doing_infos')->where('gid',$id)->get();
        
        // 遍历删除图片
        foreach($data as $k=>$v){
            // 删除图片
            Storage::delete($v->file);
        }

        // 删除数据
        $res1 = DB::table('doing_infos')->where('gid',$id)->delete();

        // 进行删除
        $res = Doing::destroy($id);

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
