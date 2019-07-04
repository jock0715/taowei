<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use DB;

class CateController extends Controller
{
    /**
     * 遍历分类级别
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCateData($a)
    {
        // 查询并排序对应分类
        $cates = Cate::select('*',DB::raw("concat(path,',',id) as paths"))->where('cname','like','%'.$a.'%')->orderBy('paths','asc')->paginate(5);
        
        // 遍历分类
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path,',');

            $cates[$key]->cname = str_repeat('|---',$n).$value->cname;
        }
        return $cates; 
    }

    /**
     * 分类管理页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    { 
        // 接收搜索条件
        $search = $request->input('search','');
 
        // 显示模板
        return view('admin.cate.index',['cates'=>self::getCateData($search)]);
    
    }

    /**
     * 添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // 获取所有分类数据
        $cates = Cate::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->get();
        
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path,',');

            $cates[$key]->cname = str_repeat('|---',$n).$value->cname;
        }

        // 获取父级ID
        $id = $request->input('id',0);
       
        // 显示模板
        return view('admin.cate.create',['id'=>$id,'cates'=>$cates]);
    }

    /**
     * 处理分类添加页面
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 检查redis缓存是否存在,查询键
        if(Redis::exists('cates_redis_data')){
            // 存在便删除
            Redis::del('cates_redis_data');
        }
        // 表单验证
        $this->validate($request, [
                'cname' => 'required',
            ],[
                'cname.required'=>'分类名称必填'
            ]);

        // 获取pid
        $pid = $request->input('pid',0);

        if($pid == 0){
            $path = 0;
        }else{
            // 获取父级数据
            $parent_data = Cate::find($pid);
            $path = $parent_data->path.','.$parent_data->id;
        }

        // 将数据压人数据库
        $cate = new Cate;
        $cate->cname = $request->input('cname','');
        $cate->pid = $pid;
        $cate->path = $path;
        $res1 = $cate->save();

        // 判断是否添加成功
        if($res1){
            // 添加成功
            return redirect('admin/cate/create')->with('success','添加成功');
        }else{
            // 添加失败   
            return back()->with('error','添加失败');
        }
       
    }

    /**
     * 分类修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取对应id的信息
         $cate = cate::find($id);

        // 加载修改页面
        return view('admin/cate/edit',
            [
                'cate'=>$cate,
            ]);
    }

    /**
     * 处理分类修改页面
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 检查redis缓存是否存在,查询键
        if(Redis::exists('cates_redis_data')){
            // 存在便删除
            Redis::del('cates_redis_data');
        }
        
        // 声明对象
        $cate = cate::find($id);
        $cate->cname = $request->input('cname','');
       
        $res1 = $cate->save();

        // 判断是否修改成功
        if($res1){
            // 修改成功
            return redirect('admin/cate')->with('success','修改成功');
        }else{
            // 修改失败
            return back()->with('error','修改失败');
        }
    }
}
