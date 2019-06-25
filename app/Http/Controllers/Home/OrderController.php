<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
    /**
     * 全部订单
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 引入页面
        return view('/home/order/index'); 
    }

    /**
     * 购物车订单
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {

        $uid = session('home_data')->id; 
        // 获取数据库数据
        $shopping = DB::table('shopping_infos')
                    ->where('uid',$uid)
                    ->get();

        // 总价钱
        $demp = [];
        // $gid = [];
        foreach ($shopping as $k => $v) {
            $demp [] = $v->price;
            // $gid [] = $v->gid;
        }

        $number = array_sum($demp);
        // $gid = implode(',', $gid);
        // dd($gid);
        // 引入页面
        return view('/home/order/add',
            [
                'shopping'=>$shopping,
                'number'=>$number,
            ]);
    }

    /**
     * 处理购物车订单
     *
     * @return \Illuminate\Http\Response
     */
    public function doadd(Request $request)
    {
        // 获取数据
        $data['uid'] = $request->input('uid');
        $data['gid'] = implode(',',$request->input('gid'));
        $data['addr'] = $request->input('addr');
        $data['phone'] = $request->input('phone');
        $data['money'] = implode(',',$request->input('money'));
        $data['num'] = implode(',',$request->input('num'));
        $data['price'] = $request->input('zmoney');
        $data['message'] = $request->input('message');
        $data['number'] = date('YmdHis').rand(1000,9999);
        $data['created_at'] = date('Y-m-d H:i:s');
        // dd($data);
        
        // 对数据库进行添加操作
        $res = DB::table('orders')
                    ->insert($data);
        if ($res) {
            // 提交订单成功 
            // 清空购物车
            $uid = $data['uid'];
            $shopping = DB::table('shopping_infos')
                        ->where('uid',$uid)
                        ->delete();
            return view('/home/order/success',['data'=>$data,]);
        } else {
            echo '失败';
        }
    }

    /**
     * 立即购买订单
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dump(session('home_data'),session('home_info'));
        // 获取数据
        $id = $request->input('id');
        $num = $request->input('num');

        // 通过id获取商品数据
        $spike = DB::table('spikes')
                    ->where('id',$id)
                    ->first();
        
        // 总价钱            
        $money = $spike->money;
        $price = $num * $money;
        // dd($spike,$money,$price);
        // 引入页面
        return view('/home/order/create',
            [
                'spike'=>$spike,
                'num'=>$num,
                'price'=>$price,
            ]);
    }

    /**
     * 处理立即购买订单
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // 获取数据
        $data['uid'] = $request->input('uid');
        $data['gid'] = $request->input('gid');
        $data['addr'] = $request->input('addr');
        $data['phone'] = $request->input('phone');
        $data['money'] = $request->input('money');
        $data['num'] = $request->input('num');
        $data['price'] = $request->input('price');
        $data['message'] = $request->input('message');
        $data['number'] = date('YmdHis').rand(1000,9999);
        $data['created_at'] = date('Y-m-d H:i:s');
        
        // 对数据库进行添加操作
        $res = DB::table('orders')
                    ->insert($data);
        if ($res) {
            // 提交订单成功 
            return view('/home/order/success',['data'=>$data,]);
        } else {
            echo '失败';
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

    /*// 提交订单成功
    public function success () 
    {
        // 引入页面
        return view('/home/order/success');
    }*/

    // 查看订单详情
    public function order_infos ()
    {
        // 引入页面
        return view('/home/order/order_infos');
    }
}
