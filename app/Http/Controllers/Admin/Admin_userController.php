<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Admin_user;
use Hash;

class Admin_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 显示登录页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin/admin_user/login');
    }

    /**
     * 执行登录功能.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {
        // 获取数据
        $name = $request->input('name');
        $pwd = $request->input('pwd');

        // 实例化 model类
        $admin_user = new Admin_user;
        $user_data = $admin_user->where('name',$name)->first();

        // 判断用户名
        if(empty($user_data->name)){
            return back()->with('error','用户名或密码错误!');
        }

        // 判断密码
        if (!Hash::check($pwd, $user_data->pwd)) {
           return back()->with('error','用户名或密码错误!!');
        }

        //压入session值
        session(['admin_login'=>true]);
        session(['admin_uinfo'=>$user_data]);

        return redirect('admin/index')->with('success','登录成功');
    }

    /**
     * 执行用户退出功能.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loginout()
    {
        //压入session值
        session(['admin_login'=>false]);
        session(['admin_uinfo'=>false]);

        // 回退到登录页面
        return back();
    }

    /**
     * 显示登录页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doeditfile(Request $request)
    {
        // 获取数据
        $id = $request->input('id');
        // 获取头像
        if($request->hasFile('profile')){
            // 删除原头像
            Storage::delete($request->input('old_file'));
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = $request->input('old_file');
        }

        $data['profile'] = $file_path;

        $admin_user = new Admin_user;
        $res = $admin_user->where('id',$id)->update($data);
        if($res){
            session('admin_uinfo')->profile = $file_path;
            return redirect('admin/index')->with('success','修改头像成功');
        }else{
            return redirect('admin/index')->with('error','修改头像失败');
        }
    }

    /**
     * 显示登录页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doeditpwd(Request $request)
    {
        // 获取数据
        $id = $request->input('id',0);
        $upwd = $request->input('upwd','');
        $repwd1 = Hash::make($request->input('repwd1',''));

        // 实例化model类
        $user_data = new Admin_user;
        $data = $user_data->where('id',$id)->first();

        // 验证密码
        if(!Hash::check($upwd, $data->pwd)){
            echo json_encode(['msg'=>'err','info'=>'旧密码错误!']);
            exit;
        }

        // 更新代码
        $res = $user_data->where('id',$id)->update(['pwd'=>$repwd1]);
        if($res){
            # 压入session值,登录
            session(['admin_login'=>false]);
            # 压入用户信息
            session(['userinfo'=>false]);
            echo json_encode(['msg'=>'ok','info'=>'修改密码成功,正在退出...']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'修改密码失败!']);
        }

    }
}
