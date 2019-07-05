<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\UserAddrs;
use App\Models\Goods;
use App\Models\Spike;
use App\Models\Doing;


class OrderController extends Controller
{
    /**
     * 全部订单
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
        // 获取用户id
        $uid = session('home_data')->id;

        // 通过uid获取该用户的所有订单
        $orders = DB::table('orders')
                      ->where('uid',$uid)
                      ->get();
        

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
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 实例化 用户地址表user_addrs
        $useraddrs = new UserAddrs;
        $addr_data = $useraddrs->where('status','1')
                               ->where('uid',$uid)
                               ->first();
        // 获取用户id
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

        // 总价格
        $number = array_sum($demp);

        // 引入页面
        return view('/home/order/add',
            [
                'shopping'=>$shopping,
                'number'=>$number,
                'links_data'=>$links_data,
                'addr_data'=>$addr_data,

            ]);
    }

    /**
     * 处理购物车订单
     *
     * @return \Illuminate\Http\Response
     */
    public function doadd(Request $request)
    {
      // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
        if (empty($request->input('phone')) || empty($request->input('addr'))) {
          echo "<script>alert('请填写好个人信息和地址并默认');location.href='/home/user/user_info'</script>";
          exit;
        } else {
          $data['phone'] = $request->input('phone');
          $data['addr'] = $request->input('addr');
        }

        // 获取数据
        $gids = $request->input('gid','');
        $sid = $request->input('sid','');
        $did = $request->input('did','');
        $moneys =$request->input('money');
        $nums = $request->input('num');
        $files = $request->input('file');
        $names = $request->input('name');
        $descs = $request->input('desc');
        $data['uid'] = $request->input('uid');
        // $data['addr'] = $request->input('addr');
        // $data['phone'] = $request->input('phone');
        $data['message'] = $request->input('message');
        $data['number'] = date('YmdHis').rand(1000,9999);
        $data['created_at'] = date('Y-m-d H:i:s');

        // 同时添加多条数据 进行遍历获取
        foreach($gids as $k=>$v){
            // 获取数据
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

            // 判断立即购买的是否是商品
            if ($data['gid']) {
                // 是商品 让商品的销售量加一
                $goods =  Goods::find($data['gid']);

                // 重新赋值
                $goods->sale = $goods->sale + $data['num'];

                // 进行修改
                $goods->save();
            }

            // 判断立即购买的是否是秒杀商品
            if ($data['sid']) {
                // 是秒杀商品 让秒杀商品的销售量加一
                $spike =  Spike::find($data['sid']);

                // 重新赋值
                $spike->sale = $spike->sale + $data['num'];

                // 进行修改
                $spike->save();
            }

            // 判断立即购买的是否是活动商品
            if ($data['did']) {
                // 是活动商品 让活动商品的销售量加一
                $doing =  Doing::find($data['did']);

                // 重新赋值
                $doing->sale = $doing->sale + $data['num'];

                // 进行修改
                $doing->save();
            }
        }

        // 判断是否添加订单成功 
        if ($res) {
            // 提交订单成功 
            // 清空购物车
            $uid = $data['uid'];
            $shopping = DB::table('shopping_infos')
                        ->where('uid',$uid)
                        ->delete();

            // 获取友情链接数据
            $links_data = DB::table('links')
                              ->where('status', 1)
                              ->get();

            return view('/home/order/success',
                [
                    'data'=>$data,
                    'links_data'=>$links_data
                ]);

        } else {
            // 添加订单失败
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
      // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
        if(!session('home_data')){
          return view('home/login/login',['links_data'=>$links_data]);
        }
        $uid = session('home_data')->id;
        

        // 实例化 用户地址表user_addrs
        $useraddrs = new UserAddrs;
        $addr_data = $useraddrs->where('status','1')
                               ->where('uid',$uid)
                               ->first();

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
                'links_data'=>$links_data,
                'spike'=>$spike,
                'snum'=>$snum,
                'sprice'=>$sprice,
                'addr_data'=>$addr_data,
            ]);
    }


    /**
     * 立即购买活动订单
     *
     * @return \Illuminate\Http\Response
     */
    public function docreate(Request $request)
    {
      // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
      if(!session('home_data')){
          return view('home/login/login',['links_data'=>$links_data]);
        }
        $uid = session('home_data')->id;

        // 实例化 用户地址表user_addrs
        $useraddrs = new UserAddrs;
        $addr_data = $useraddrs->where('status','1')
                               ->where('uid',$uid)
                               ->first();

        // 获取数据
        $id = $request->input('id');
        $donum = $request->input('num');

        // 通过id获取商品数据
        $doing = DB::table('doings')
                    ->where('id',$id)
                    ->first();

        // 总价钱            
        $money = $doing->money;
        $doprice = $donum * $money;

        // 引入页面
        return view('/home/order/create',
            [
                'links_data'=>$links_data,
                'doing'=>$doing,
                'donum'=>$donum,
                'doprice'=>$doprice,
                'addr_data'=>$addr_data,
            ]);
    }

  

    /**
     * 立即购买商品订单
     *
     * @return \Illuminate\Http\Response
     */
    public function gocreate(Request $request)
    {
      // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
      if(!session('home_data')){
          return view('home/login/login',['links_data'=>$links_data]);
        }
        $uid = session('home_data')->id;

        // 实例化 用户地址表user_addrs
        $useraddrs = new UserAddrs;
        $addr_data = $useraddrs->where('status','1')
                               ->where('uid',$uid)
                               ->first();
        
        // 获取数据
        $id = $request->input('id');
        $gonum = $request->input('num');

        // 通过id获取商品数据
        $goods = DB::table('goods')
                    ->where('id',$id)
                    ->first();

        // 总价钱            
        $money = $goods->money;
        $goprice = $gonum * $money;

        // 引入页面
        return view('/home/order/create',
            [
                'links_data'=>$links_data,
                'goods'=>$goods,
                'gonum'=>$gonum,
                'goprice'=>$goprice,
                'addr_data'=>$addr_data,
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
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
        if (empty($request->input('phone')) || empty($request->input('addr'))) {
          echo "<script>alert('请填写好个人信息和地址并默认');location.href='/home/user/user_info'</script>";
          exit;
        } else {
          $data['phone'] = $request->input('phone');
          $data['addr'] = $request->input('addr');
        }
  
        // 获取数据
        $data['uid'] = $request->input('uid');
        $data['gid'] = $request->input('gid');
        $data['sid'] = $request->input('sid');
        $data['did'] = $request->input('did');
        // $data['addr'] = $request->input('addr');
        // $data['phone'] = $request->input('phone');
        $data['money'] = $request->input('money');
        $data['num'] = $request->input('num');
        $data['price'] = $request->input('price');
        $data['file'] = $request->input('file');
        $data['name'] = $request->input('name');
        $data['desc'] = $request->input('desc');
        $data['message'] = $request->input('message');
        $data['number'] = date('YmdHis').rand(1000,9999);
        $data['created_at'] = date('Y-m-d H:i:s');

        

        // 对数据库进行添加操作
        $res = DB::table('orders')
                   ->insert($data);

        // 判断立即购买的是否是商品
        if ($data['gid']) {
            // 是商品 让商品的销售量加一
            $goods =  Goods::find($data['gid']);

            // 重新赋值
            $goods->sale = $goods->sale + $data['num'];

            // 进行修改
            $goods->save();
        }

        // 判断立即购买的是否是秒杀商品
        if ($data['sid']) {
            // 是秒杀商品 让秒杀商品的销售量加一
            $spike =  Spike::find($data['sid']);

            // 重新赋值
            $spike->sale = $spike->sale + $data['num'];

            // 进行修改
            $spike->save();
        }

        // 判断立即购买的是否是活动商品
        if ($data['did']) {
            // 是活动商品 让活动商品的销售量加一
            $doing =  Doing::find($data['did']);

            // 重新赋值
            $doing->sale = $doing->sale + $data['num'];

            // 进行修改
            $doing->save();
        }

        if ($res) {
            // 提交订单成功 
            return view('/home/order/success',
                [
                    'links_data'=>$links_data,
                    'data'=>$data
                ]);

        } else {
            // 提交订单失败
            echo '失败';
        }

    }

    /**
     * 删除订单
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 获取订单id
        $id = $request->input('id',0);
        // 通过id获取数据
        $res = DB::table('orders')
                   ->where('id',$id)
                   ->delete();
        // 判断是否删除成功
        if($res){
            // 删除成功
            echo 'ok';
        }else{
            // 删除失败
            echo 'no';
        }
    }

    /**
     * 查看订单详情
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function order_infos (Request $request)
    {
      // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
                          
      if(empty(session('home_data'))){
        return view('home/login/login',['links_data'=>$links_data]);
      }
        // 获取用户id
        $uid = session('home_data')->id;

        // 实例化 用户地址表user_addrs
        $useraddrs = new UserAddrs;
        $data_addr = $useraddrs->where('uid',$uid)->where('status','1')->first();

        // 通过用户id获取数据
        $data = DB::table('orders')
                    ->where('uid',$uid)
                    ->get();

        // 引入页面
        return view('/home/order/order_infos',
            [
                'links_data'=>$links_data,
                'data'=>$data,
                'data_addr'=>$data_addr,
            ]);
    }

    /**
     * 确认收货
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function receipt (Request $request)
    {
        // 获取id
        $id = $request->input('id',0);

        // 通过id对数据库进行修改
        $status = DB::table('orders')
                      ->select('status')
                      ->where('id',$id)
                      ->first();
        // 判断订单状态
        if ($status->status == '1' || $status->status == '0') {
            $status_data = 2;
        }
        
        // 执行修改订单状态数据 
        $res = DB::table('orders')
                    ->where('id',$id)
                    ->update(['status'=>$status_data]);

        // 判断是否修改成功
        if ($res) {
            // 修改成功
            echo 'ok';
        } else {
            // 修改失败
            echo 'no';
        }
    }


}
