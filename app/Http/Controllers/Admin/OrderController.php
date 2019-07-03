<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Goods;

class OrderController extends Controller
{
    /**
     * 显示订单页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search =  $request->input('search','');
        $order = new Order;
        $order_data = $order->where('name','like','%'.$search.'%')->paginate(5);
        

        return view('admin/order/index',['order_data'=>$order_data,'search'=>$search]);
    }

    /**
     * 显示修改订单页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = new Order;
        $order_data = $order->find($id);    
        return view('admin/order/edit',['order_data'=>$order_data]);
    }

    /**
     * 执行修改订单功能.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // 表单验证
         $this->validate($request, [
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',

        ],[
            'email.regex'=>'邮箱格式错误,需包含@,com或cn...!',
            'phone.regex'=>'手机格式不对!',
        ]);

        // 获取数据
        $data = $request->all();

        $order = Order::find($id);
        $order->phone = $data['phone'];
        $order->addr = $data['addr'];
        $order->gid = $data['gid'];
        $order->money = $data['money'];
        $order->status = $data['status'];
        $res = $order->save();
        if($res){
            return redirect('/admin/order')->with('success','修改成功');
        }else{
            return back();
        }

    }

    /**
     * 执行删除订单.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 实例化model类order
        $order = new Order;
        $res = $order->destroy($id);
        if($res){
            // 成功返回用户显示列表路由,并提示信息
            return redirect('/admin/order')->with('success','删除成功');
        }else{
            // 失败,回滚当前页面,并提示信息
            return back()->with('error','删除失败');
        }
    }
}
