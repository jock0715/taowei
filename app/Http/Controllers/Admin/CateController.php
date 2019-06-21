<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use DB;
class CateController extends Controller
{
    public static function getCateData($a)
    {
        $cates = Cate::select('*',DB::raw("concat(path,',',id) as paths"))->where('cname','like','%'.$a.'%')->orderBy('paths','asc')->paginate(5);
        
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
        //接收搜索条件
        $search = $request->input('search','');
        // $cates = Cate::all();

       // $data = DB::table('cates')->where('cname','like','%'.$search.'%')->paginate(5);
        //显示模板
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
       
        //显示模板
        return view('admin.cate.create',['id'=>$id,'cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
                'cname' => 'required',
            ],[
                'cname.required'=>'分类名称必填'
            ]);

        //获取pid
        $pid = $request->input('pid',0);

        if($pid == 0){
            $path = 0;
        }else{
            //获取父级数据
            $parent_data = Cate::find($pid);
            $path = $parent_data->path.','.$parent_data->id;
        }
        //dd($path,$request->all());
        //将数据压人数据库
        $cate = new Cate;
        $cate->cname = $request->input('cname','');
        $cate->pid = $pid;
        $cate->path = $path;
        $res1 = $cate->save();

        if($res1){
            return redirect('admin/cate/create')->with('success','添加成功');
        }else{   
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $cate = cate::find($id);
        // dump($link);
        //加载修改页面
        return view('admin/cate/edit',
            [
                'cate'=>$cate,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //修改
        $cate = cate::find($id);
        $cate->cname = $request->input('cname','');
       
        $res1 = $cate->save();

        
        if($res1){
            return redirect('admin/cate')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //删除操作
        $res = cate::destroy($id);
        if($res){
            return redirect('admin/cate')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
