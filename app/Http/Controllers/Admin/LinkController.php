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
     * 显示友情链接添加页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/link/create');
    }

    /**
     * 执行添加链接功能.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
                'name' => 'required',
                'url' => 'required|max:64|regex:/^[\w]+\.[\w]+\.[\w]+$/',
            ],[
                 'name.required'=>'链接名称必填',
                'url.required'=>'链接地址必填',
                'url.max'=>'链接地址过长',
                'url.regex'=>'链接地址格式不对'
            ]);

        // 接收数据
        $data = $request->all();

        // 声明新对象
        $link = new Link;
        // 赋值
        $link->name = $data['name'];
        $link->url = $data['url'];

        // 执行 添加到数据库
        $res = $link->save();
        if($res){
            return redirect('admin/link')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * 显示友情链接修改页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $link = Link::find($id);
        
        //加载修改页面
        return view('admin.link.edit',
            [
                'link'=>$link,
            ]);
    }

    /**
     * 处理 友情链接 修改
     *
     * @param  \Illuminate\Http\Request  $request     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 通过ID查找要修改的友情链接数据
        $link = Link::find($id);
        // 接收数据 
        $link->name = $request->input('name','');
        $link->url = $request->input('url','');
        // 进行修改
        $res1 = $link->save();

        // 判断
        if($res1){
            // 修改成功
            return redirect('admin/link')->with('success','修改成功');
        }else{
            // 修改失败
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除友情链接.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //删除操作
        $res = link::destroy($id);
        if($res){
            return redirect('admin/link')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    /**
     * 友情链接状态切换
     *
     * @param  int 
     * @return \Illuminate\Http\Response
     */
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

        // 判断是否切换成功
        if ($res) {
            // 切换成功
            echo 'ok';
        } else {
            // 切换失败
            echo 'no';
        }
    }
}
