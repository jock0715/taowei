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
    public function index(Request $request)
    {
        //获取友情链接数据
        $links_data = DB::table('links')->orderBy('id','asc')->where('status', 1)->get();

        // 获取数据库数据
        $uid = session('home_data')->id;
        // 通过uid获取该用户的所有订单
        $orders = DB::table('orders')
                      ->where('uid',$uid)
                      ->get();
        
        // dd($orders,$status,$tamp);
        // 引入页面
        return view('/home/order/index',
            [
                'links_data'=>$links_data,
                'orders'=>$orders,
            ]);  
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
        // dd($shopping);
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
        $gids = $request->input('gid','');
        $sid = $request->input('sid','');
        $did = $request->input('did','');
        // dd($gids,$sid,$did);
        $moneys =$request->input('money');
        $nums = $request->input('num');
        $files = $request->input('file');
        $names = $request->input('name');
        $descs = $request->input('desc');
        $data['uid'] = $request->input('uid');
        $data['addr'] = $request->input('addr');
        $data['phone'] = $request->input('phone');
        $data['message'] = $request->input('message');
        $data['number'] = date('YmdHis').rand(1000,9999);
        $data['created_at'] = date('Y-m-d H:i:s');

        foreach($gids as $k=>$v){
            $data['gid'] = $v; 
            $data['sid'] = $sid[$k]; 
            $data['did'] = $did[$k]; 
            $data['num'] = $nums[$k]; 
            $data['money'] = $moneys[$k];
            $data['file'] = $files[$k];
            $data['name'] = $names[$k];
            $data['desc'] = $descs[$k];
            $data['price'] = $data['num'] * $data['money']; 
            // 对数据库进行添加操作
            $res = DB::table('orders')
                    ->insert($data);
        }

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
     * 立即购买秒杀商品订单
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dump(session('home_data'),session('home_info'));
        // 获取数据
        $id = $request->input('id');
        $snum = $request->input('num');

        // 通过id获取商品数据
        $spike = DB::table('spikes')
                    ->where('id',$id)
                    ->first();
        
        // 总价钱            
        $money = $spike->money;
        $sprice = $snum * $money;

        // 引入页面
        return view('/home/order/create',
            [
                'spike'=>$spike,
                'snum'=>$snum,
                'sprice'=>$sprice,
            ]);
    }


    /**
     * 立即购买活动订单
     *
     * @return \Illuminate\Http\Response
     */
    public function docreate(Request $request)
    {
        // dump(session('home_data'),session('home_info'));
        // 获取数据
        $id = $request->input('id');
        $donum = $request->input('num');
        // dd($donum);
        // 通过id获取商品数据
        $doing = DB::table('doings')
                    ->where('id',$id)
                    ->first();
        // dd($doing->file);
        // 总价钱            
        $money = $doing->money;
        $doprice = $donum * $money;
        // dd($spike,$money,$price);
        // 引入页面
        return view('/home/order/create',
            [
                'doing'=>$doing,
                'donum'=>$donum,
                'doprice'=>$doprice,
            ]);
    }

  

    /**
     * 立即购买商品订单
     *
     * @return \Illuminate\Http\Response
     */
    public function gocreate(Request $request)
    {
        //获取友情链接数据
        $links_data = DB::table('links')->orderBy('id','asc')->where('status', 1)->get();

        // dump(session('home_data'),session('home_info'));
        // 获取数据
        $id = $request->input('id');
        $gonum = $request->input('num');

        // 通过id获取商品数据
        $goods = DB::table('goods')
                    ->where('id',$id)
                    ->first();
        // dd($goods->file);
        // 总价钱            
        $money = $goods->money;
        $goprice = $gonum * $money;
        // dd($gonum);
        // 引入页面
        return view('/home/order/create',
            [
                'links_data'=>$links_data,
                'goods'=>$goods,
                'gonum'=>$gonum,
                'goprice'=>$goprice,
            ]);
    }

    /**
     * 处理立即购买秒杀商品订单
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取友情链接数据
        $links_data = DB::table('links')->orderBy('id','asc')->where('status', 1)->get();

       
        // 获取数据
        $data['uid'] = $request->input('uid');
        $data['gid'] = $request->input('gid');
        $data['sid'] = $request->input('sid');
        $data['did'] = $request->input('did');
        $data['addr'] = $request->input('addr');
        $data['phone'] = $request->input('phone');
        $data['money'] = $request->input('money');
        $data['num'] = $request->input('num');
        $data['price'] = $request->input('price');
        $data['file'] = $request->input('file');
        $data['name'] = $request->input('name');
        $data['desc'] = $request->input('desc');
        $data['message'] = $request->input('message');
        $data['number'] = date('YmdHis').rand(1000,9999);
        $data['created_at'] = date('Y-m-d H:i:s');
        // dd($data);
        // 对数据库进行添加操作
        $res = DB::table('orders')
                    ->insert($data);
        if ($res) {
            // 提交订单成功 
            return view('/home/order/success',['links_data'=>$links_data,'data'=>$data,]);
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
    public function destroy(Request $request)
    {
        // dd($request->all());
        $id = $request->input('id',0);
        // 通过id获取数据
        $res = DB::table('orders')
                    ->where('id',$id)
                    ->delete();
        if($res){
            echo 'ok';
            // echo json_encode(['msg'=>'ok','info'=>'删除成功 !']);
        }else{
            echo 'no';
            // echo json_encode(['msg'=>'err','info'=>'删除失败 !']);
        }
    }

    /*// 提交订单成功
    public function success () 
    {
        // 引入页面
        return view('/home/order/success');
    }*/

    // 查看订单详情
    public function order_infos (Request $request)
    {
        //获取友情链接数据
        $links_data = DB::table('links')->orderBy('id','asc')->where('status', 1)->get();

        // 通过id获取数据
        $uid = session('home_data')->id;
        $data = DB::table('orders')
                    ->where('uid',$uid)
                    ->get();

        // 引入页面
        return view('/home/order/order_infos',
            [
                'links_data'=>$links_data,
                'data'=>$data,
            ]);
    }

    // 确认收货
    public function receipt (Request $request)
    {
        // 获取id
        $id = $request->input('id',0);

        // 通过id对数据库进行修改
        $status = DB::table('orders')
                      ->select('status')
                      ->where('id',$id)
                      ->first();

        if ($status->status == '1' || $status->status == '0') {
            $status_data = 2;
        }
        // dd($status_data);
        $res = DB::table('orders')
                    ->where('id',$id)
                    ->update(['status'=>$status_data]);
        if ($res) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }


}
