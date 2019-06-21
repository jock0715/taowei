<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Link;
class LinkController extends Controller
{
    /**
     * 友情链接列表显示页面 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收搜索条件
        $search = $request->input('search','');
       //查询数据 并且 分页
        $data = DB::table('links')->where('name','like','%'.$search.'%')->paginate(5);
        //加载页面
        return view('admin.link.index',
            [
                'data'=>$data,
                'search'=>$search
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/link/create');
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
                'name' => 'required',
                'url' => 'required',
            ],[
                 'name.required'=>'链接名称必填',
                'url.required'=>'链接地址必填'
            ]);

         //接收数据
        $data = $request->all();

        // 声明新对象
        $link = new Link;

        $link->name = $data['name'];
        $link->url = $data['url'];

         //执行 添加到数据库
        $res = $link->save();
        if($res){
            return redirect('admin/link')->with('success','添加成功');
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

        $link = Link::find($id);
        // dump($link);
        //加载修改页面
        return view('admin.link.edit',
            [
                'link'=>$link,
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
        $link = Link::find($id);
        $link->name = $request->input('name','');
        $link->url = $request->input('url','');
        $res1 = $link->save();

        
        if($res1){
            return redirect('admin/link')->with('success','修改成功');
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
        //删除头像

        //删除操作
        $res = link::destroy($id);
        if($res){
            return redirect('admin/link')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
     public function status (Request $request)
    {
        // 获取id
        $id = $request->input('id');
        // dd($id);
        // 查询数据库的status值
        $data = DB::table('links')
                    ->where('id',$id)
                    ->value('status');




        // 判断status
        if ($data == 0) {
            $data = 1;
        } else {
            $data = 0;
        }  


        // 进行数据库操作
        $res = DB::update("update links set status = $data where id = $id");


        if ($res) {
            echo 'ok';
        } else {
            echo 'no';
        }


    }
}
