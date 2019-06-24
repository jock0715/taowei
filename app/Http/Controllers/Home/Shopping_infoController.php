<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Shopping_infoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 引入页面
        return view('/home/shopping/index');
    } 

    /**
     * 加入购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request,$id)
    {   
        // 通过id获取商品数据
        $data = DB::table('spikes')
                    ->select('name','desc','file','money')
                    ->where('id',$id)
                    ->first();

        // 获取数据
        $gid = $id;
        $data->num = $request->input('num');
        $data->gid = $gid;
        $data->price = $data->money*$data->num;
        $data->created_at = date('Y-m-d H:i:s');

        // 判断用户是否登录
        if (empty(session('home_data')->id)) {
            return back();
        } else {
            $data->uid = session('home_data')->id;
        }
        
        // dd(session('home_data'));
        // 把对象转换成数组格式
        $shopping = [];
        foreach ($data as $k => $v) {
            $shopping[$k]=$v;
        }
        
        

       // 对数据库进行添加操作
        $res = DB::table('shopping_infos')->insert($shopping);
        if ($res) {
            return back();
        } else {
            return back();
        }
        
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
