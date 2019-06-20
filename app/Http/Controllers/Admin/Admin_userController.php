<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin_user;
use Hash;
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
            'name' => 'required|regex:/^[a-z,A-Z][\w]{5,15}$/',
            'pwd' => 'required|same:repwd|regex:/^[\w]{6,16}$/',
            'repwd' => 'required',
        ],[
            'name.required'=>'用户名不能为空',    
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
        //通过id获取数据库数据
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
    public function destroy($id)
    {
        // 通过该id进行删除操作
        $res = Admin_user::destroy($id);
        if ($res) {
            return redirect('/admin/admin_user')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }
}
