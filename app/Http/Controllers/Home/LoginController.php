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
         //获取友情链接数据
        $links_data = DB::table('links')->where('status', 1)->get();
        return view('home/login/login',['links_data'=>$links_data]);
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
        $user_data = $user->orWhere('uname',$all)->orWhere('phone',$all)->orWhere('email',$all)->first();

        if(!empty($user_data) && $user_data->status != 0){
           // 实例化model
            if($all == $user_data->uname){
                // 判断用户名
                if(empty($user_data->uname)){
                    return back()->with('error','账号或密码错误!');
                }
                //判断密码
                if (!Hash::check($upwd, $user_data->upwd)) {
                   return back()->with('error','账号或密码错误!!');
                }
                $uid = $user_data->id;
                $userinfo = new UserInfos;
                $user_info = $userinfo->where('uid',$uid)->first();
                // 压入session
                session(['home_login'=>true]);
                session(['home_data'=>$user_data]);
                session(['home_info'=>$user_info]);
                return redirect('/')->with('success','登录成功');
            }elseif($all == $user_data->phone){
                // 判断用户名
                if(empty($user_data->phone)){
                    return back()->with('error','账号或密码错误!');
                }
                //判断密码
                if (!Hash::check($upwd, $user_data->upwd)) {
                   return back()->with('error','账号或密码错误!!');
                }
                $uid = $user_data->id;
                $userinfo = new UserInfos;
                $user_info = $userinfo->where('uid',$uid)->first();
                // 压入session
                session(['home_login'=>true]);
                session(['home_data'=>$user_data]);
                session(['home_info'=>$user_info]);
                return redirect('/')->with('success','登录成功');
            }elseif($all == $user_data->email){
                // 判断用户名
                if(empty($user_data->email)){
                    return back()->with('error','账号或密码错误!');
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
                session(['home_data'=>$user_data]);
                session(['home_info'=>$user_info]);
                return redirect('/')->with('success','登录成功');
            } 
        }else{
            return back()->with('error','用户未完成激活或登录失败!!');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        // 清空 session值
        session(['home_login'=>false]);
        session(['home_data'=>false]);
        session(['home_info'=>false]);

        return redirect('/home/login')->with('success','欢迎回来!');
    }



}
