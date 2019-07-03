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
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->where('status', 1)
                          ->get();

        // 加载页面
        return view('home/login/login',
            [
                'links_data'=>$links_data
            ]);
    }

    /**
     * 执行登录功能.
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {
        // 接受用户填写的登录数据
        $all = $request->input('all','');
        $upwd = $request->input('upwd','');
        
        // 获取新对象
        $user = new User;

        // 查找数据库是否有该用户
        $user_data = $user->orWhere('uname',$all)
                          ->orWhere('phone',$all)
                          ->orWhere('email',$all)
                          ->first();

        // 判断是否有该用户并且不是禁用状态
        if(!empty($user_data) && $user_data->status != 0){
           // 有该用户并且不是禁用状态 实例化model
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

                // 登录成功
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

                // 获取用户id
                $uid = $user_data->id;

                // 得到新对象
                $userinfo = new UserInfos;

                // 通过用户id获取用户的详情数据
                $user_info = $userinfo->where('uid',$uid)->first();
                // 压入session
                session(['home_login'=>true]);
                session(['home_data'=>$user_data]);
                session(['home_info'=>$user_info]);

                // 登录成功
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

                // 获取用户id
                $uid = $user_data->id;

                // 得到新对象
                $userinfo = new UserInfos;

                // 通过用户id获取用户的详情数据
                $user_info = $userinfo->where('uid',$uid)->first();
                // 压入session
                session(['home_login'=>true]);
                session(['home_data'=>$user_data]);
                session(['home_info'=>$user_info]);

                // 登录成功
                return redirect('/')->with('success','登录成功');
            } 
        }else{
            return back()->with('error','用户未完成激活或登录失败!!');
        }
        
    }

    /**
     * 处理 退出 登录
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

        // 退出登录成功
        return redirect('/home/login')->with('success','欢迎回来!');
    }



}
