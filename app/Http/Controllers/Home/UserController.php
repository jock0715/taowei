<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\User;
use App\Models\UserInfos;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_index()
    {
        if(!empty(session('home_data'))){
            return view('home/user/user_index');
        }else{
            return view('home/login/login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_info()
    {
        $id = session('home_data')->id;
        $user = new User;
        $data = $user->where('id',$id)->first();
        return view('home/user/user_info',['data'=>$data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_addr()
    {
        return view('home/user/user_addr');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_security()
    {
        return view('home/user/user_security');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_upwd()
    {
        return view('home/user/user_upwd');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_order()
    {
        return view('home/user/user_order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_after()
    {
        return view('home/user/user_after');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_bill()
    {
        return view('home/user/user_bill');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_collection()
    {
        return view('home/user/user_collection');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_foot()
    {
        return view('home/user/user_foot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_reply()
    {
        return view('home/user/user_reply');
    }

    
}
