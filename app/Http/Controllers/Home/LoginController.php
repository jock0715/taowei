<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\User;
use App\Models\UserInfos;
class LoginController extends Controller
{
    /**
     * 显示登录页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home/login/login');
    }

    /**
     * 执行登录功能.
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {

        $all = $request->input('all','');
        $upwd = $request->input('upwd','');
        
        $user = new User;
        $user_data = $user
                        ->where('uname',$all)
                        ->Orwhere('phone',$all)
                        ->Orwhere('email',$all)
                        ->first();

        // 实例化model
        if(empty($user_data->uname)){

            // 判断用户名
            if(empty($user_data->uname)){
                return back()->with('error','用户名或密码错误!');
            }
            //判断密码
            if (!Hash::check($upwd, $user_data->upwd)) {
               return back()->with('error','用户名或密码错误!!');
            }
            $uid = $user_data->id;
            $userinfo = new UserInfos;
            $user_info = $userinfo->where('uid',$uid)->first();
            // 压入session
            session(['home_login'=>true]);
            session(['home_user'=>$user_data]);
            session(['home_info'=>$user_info]);

        }elseif(empty($user_data->phone)){
            $user_info = new UserInfos;
            $user_data = $user_info->where('phone',$phone)->first();
            dd($user_data);
            // 判断用户名
            if(empty($user_data->phone)){
                return back()->with('error','手机号不正确!');
            }
            //判断密码
            if (!Hash::check($upwd, $user_data->upwd)) {
               return back()->with('error','手机号或密码错误!!');
            }
            $uid = $user_data->id;
            $userinfo = new UserInfos;
            $user_info = $userinfo->where('uid',$uid)->first();
            // 压入session
            session(['home_login'=>true]);
            session(['home_user'=>$user_data]);
            session(['home_info'=>$user_info]);

        }elseif(empty($user_data->email)){
            // 判断用户名
            if(empty($user_data->uname)){
                return back()->with('error','用户名或密码错误!');
            }

            //判断密码
            if (!Hash::check($upwd, $user_data->upwd)) {
               return back()->with('error','用户名或密码错误!!');
            }
            $uid = $user_data->id;
            $userinfo = new UserInfos;
            $user_info = $userinfo->where('uid',$uid)->first();

            // 压入session
            session(['home_login'=>true]);
            session(['home_user'=>$user_data]);
            session(['home_info'=>$user_info]);
        }
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



}
