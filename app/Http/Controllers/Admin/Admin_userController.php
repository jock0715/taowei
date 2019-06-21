<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Admin_user;
use Hash;
use DB;

class Admin_userController extends Controller
{
    /*public function fordata()
    {
        
        // 循环数据 进行测试
        for ($i=0; $i < 30; $i++) { 
            $data = [
            'name' => 'admin'.rand(1234,4321),
            'pwd'=>'$10$eZXAmVb7pNIv4sFGVVfP.O91Hg.6O1jqSBWnnRbJo/FZt9UwK4c7W',
            'profile' => '20190619/RAj13rJGDG0bei4MM2HduS358VVLnSU1EPjBGAEe.jpeg',
        ];

        $user = new Admin_user;
        $user->name = $data['name'];
        $user->pwd = $data['pwd'];
        $user->profile = $data['profile'];
        $res1 = $user->save();
        }
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->fordata(); 
        // 获取数据库数据
        /*$admin = new Admin_user;
        $admin_data = $admin->get();*/
        // 搜索
        $search_uname = $request->input('search_uname','');
        $admin_data = Admin_user::where('name','like','%'.$search_uname.'%')
                                ->orderBy('id','asc')
                                ->paginate(5);
        //引入页面
        return view('/admin/admin_user/index',
            [
                'params'=>$request->all(),
                'admin_data' => $admin_data,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //引入页面
        return view('/admin/admin_user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 表单验证
        $this->validate($request, [
            'name' => 'required|unique:admin_users|regex:/^[a-z,A-Z][\w]{5,15}$/',
            'pwd' => 'required|same:repwd|regex:/^[\w]{6,16}$/',
            'repwd' => 'required',
        ],[
            'name.required'=>'用户名不能为空',
            'name.unique'=>'用户名已存在!',    
            'name.regex'=>'用户名格式不正确,由字母数字组成,5~15',    
            'pwd.regex'=>'密码格式不正确,由字母,下划线,数字组成,6~16',    
            'pwd.required'=>'密码不能为空',    
            'repwd.required'=>'确认密码不能为空',
            'pwd.same'=>'两次密码不一致',    
        ]);

        // 判断是否有文件上传
        if ($request->hasFile('profile')) {
            // 存储到哪个文件
            $admin_path = $request->file('profile')->store(date('Ymd'));
        } else {
            $admin_path = '';
        }

        //接收数据
        $data = $request->all();
        $admin_user = new Admin_user;
        $admin_user->name = $data['name'];
        $admin_user->pwd = Hash::make($data['pwd']);
        $admin_user->profile = $admin_path;

        $res = $admin_user->save();
        if ($res) {
            return redirect('/admin/admin_user')->with('success','添加成功');
        } else {
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
        $admins = Admin_user::find($id);
        // 引入页面
        return view('/admin/admin_user/edit',
            [
                'admins'=>$admins,
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
        // 通过id获取数据库数据
        $admin_update = Admin_user::find($id);
        // 接收数据
        $admin_update->status = $request->input('status');
        // 进行数据库修改操作
        $res = $admin_update->save();
        if ($res) {
            return redirect('/admin/admin_user')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        // 通过该id进行删除操作
        $res = Admin_user::destroy($id);
        if ($res) {
            Storage::delete($request->input('old_profile',''));
            return redirect('/admin/admin_user')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
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
