<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Shopping_infoController extends Controller
{
    /**
     * 显示购物车页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取友情链接数据
        $links_data = DB::table('links')->where('status', 1)->get();

        if (empty(session('home_data')->id)) {
            // 引入页面
            return view('/home/login/login',['links_data'=>$links_data]);
        } else {
            // 通过id获取数据库数据
            $uid = session('home_data')->id;
            $data = DB::table('shopping_infos')
                    ->where('uid',$uid)
                    ->get();
            // dd($data);

            // 获取全部购物车的总价格 跟条数
            $demp = [];
            $count = 0;
            foreach ($data as $k => $v) {
                $count = $k+1;
                $demp [] = $v->price;
            }

            $number = array_sum($demp);
            // dd($data,$demp,$a);
            // 引入页面
            return view('/home/shopping/index',
                [
                    'links_data'=>$links_data,
                    'data'=>$data,
                    'number'=>$number,
                    'count'=>$count,
                ]);
        }


    } 

    /**
     * 秒杀商品加入购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request,$id)
    {   
        if (empty(session('home_data'))) {
            return view('home/login/login');
        }
        // 通过id获取商品数据
        $data = DB::table('spikes')
                    ->select('name','desc','file','money')
                    ->where('id',$id)
                    ->first();

        // 获取数据
        $sid = $id;
        $data->num = $request->input('num');
        $data->sid = $sid;
        $data->price = $data->money*$data->num;
        $data->created_at = date('Y-m-d H:i:s');
        
        // 判断用户是否登录
        if (empty(session('home_data')->id)) {
            return back();
        } else {
            $data->uid = session('home_data')->id;
        }
        
        // 把对象转换成数组格式
        $shopping = [];
        foreach ($data as $k => $v) {
            $shopping[$k]=$v;
        }

        
        // 对数据库进行查询操作
        $gid_data = DB::table('shopping_infos')
                    ->where('sid',$sid)
                    ->where('uid',$data->uid)
                    ->first();
         // dd($data,$shopping,$gid_data);           
        // 判断购物车是否存在同一商品
        if (empty($gid_data)) {
            // 不存在则添加
            $data->num = $request->input('num');
            $res = DB::table('shopping_infos')->insert($shopping);
            if ($res) {
                return back();
            } else {
                echo '添加失败';
            }
        } else {
            // 存在则数量增加
            $data->num = $data->num + $gid_data->num;
            $price = $gid_data->money * $data->num;
            // 对数据库进行修改
            $res = DB::table('shopping_infos')
                       ->where('sid',$sid)
                       ->update(['num'=>$data->num ,'price'=>$price]);
            if ($res) {
            return back();
            } else {
                echo '添加失败';
            }
        }
    }

        /**
     * 活动商品加入购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function doingadd(Request $request,$id)
    {   
        if (empty(session('home_data'))) {
            return view('home/login/login');
        }
        // 通过id获取商品数据
        $data = DB::table('doings')
                    ->select('name','desc','file','money')
                    ->where('id',$id)
                    ->first();
        // dd($data);
        // 获取数据
        $did = $id;
        $data->num = $request->input('num');
        $data->did = $did;
        $data->price = $data->money*$data->num;
        $data->created_at = date('Y-m-d H:i:s');
        // dd($data->num);
        // 判断用户是否登录
        if (empty(session('home_data')->id)) {
            return back();
        } else {
            $data->uid = session('home_data')->id;
        }
        // dd($data->uid);
        // 把对象转换成数组格式
        $shopping = [];
        foreach ($data as $k => $v) {
            $shopping[$k]=$v;
        }
        
        // 对数据库进行查询操作
        $gid_data = DB::table('shopping_infos')
                    ->where('did',$did)
                    ->where('uid',$data->uid)
                    ->first();
                    
        // 判断购物车是否存在同一商品
        if (empty($gid_data)) {
            // 不存在则添加
            $data->num = $request->input('num');
            $res = DB::table('shopping_infos')->insert($shopping);
            if($res){
                return back();
            }else{
                echo '添加失败';
            }
        } else {
            // 存在则数量增加
            $data->num = $data->num + $gid_data->num;
            $price = $gid_data->money * $data->num;
            // 对数据库进行修改操作
            $res = DB::table('shopping_infos')
                       ->where('did',$did)
                       ->update(['num'=>$data->num ,'price'=>$price]);
            if ($res) {
            return back();
            } else {
                echo '添加失败';
            }
        }
    }

    /**
     * 商品加入购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function goodsadd(Request $request,$id)
    {   
        if (empty(session('home_data'))) {
            return view('home/login/login');
        }
        // 通过id获取商品数据
        $data = DB::table('goods')
                    ->select('name','desc','file','money')
                    ->where('id',$id)
                    ->first();
        // dd($data);
        // 获取数据
        $gid = $id;
        $data->num = $request->input('num');
        $data->gid = $gid;
        $data->price = $data->money*$data->num;
        $data->created_at = date('Y-m-d H:i:s');
        // dd($data->num);
        // 判断用户是否登录
        if (empty(session('home_data')->id)) {
            return back();
        } else {
            $data->uid = session('home_data')->id;
        }
        // dd($data->uid);
        // 把对象转换成数组格式
        $shopping = [];
        foreach ($data as $k => $v) {
            $shopping[$k]=$v;
        }
        
        // 对数据库进行查询操作
        $gid_data = DB::table('shopping_infos')
                    ->where('gid',$gid)
                    ->where('uid',$data->uid)
                    ->first();
                    
        // 判断购物车是否存在同一商品
        if (empty($gid_data)) {
            // 不存在则添加
            $data->num = $request->input('num');
            $res = DB::table('shopping_infos')->insert($shopping);
            if ($res) {
                return back();
            } else {
                echo '添加失败';
            }
        } else {
            // 存在则数量增加
            $data->num = $data->num + $gid_data->num;
            $price = $gid_data->money * $data->num;
            
            $res = DB::table('shopping_infos')
                       ->where('gid',$gid)
                       ->update(['num'=>$data->num ,'price'=>$price]);
            if ($res) {
                return back();
            } else {
                echo '添加失败';
            }
        }
    }


    /**
     * 增加数量
     *
     * @return \Illuminate\Http\Response
     */
    public function addnum (Request $request)
    {
        // 接收id
        $id = $request->input('id');
        // 通过id获取数据
        $data = DB::table('shopping_infos')
                    ->select('num','money')
                    ->where('id',$id)
                    ->get();

        // 把获取到的数据放到数组里面
        $datas = [];
        foreach($data as $k => $v) {
            foreach ($v as $kk => $vv) {
                $datas[$kk] = $vv;
             } 
        }

        // 进行数量添加
        $num = $datas['num']+1;
        $price = $datas['money']*$num;

        // 对数据库进行修改操作
        // $res = DB::update("update shopping_infos set num = $num,price=$price where id = $id");
        $res = DB::table('shopping_infos')
                    ->where('id',$id)
                    ->update(['num'=>$num,'price'=>$price]);
        if ($res) {
            return back();
        } else {
            echo '失败';exit;
        }
    }

        /**
     * 减少数量
     *
     * @return \Illuminate\Http\Response
     */
    public function delnum (Request $request)
    {
        // 接收id
        $id = $request->input('id');
        // 通过id获取数据
        $data = DB::table('shopping_infos')
                    ->select('num','money')
                    ->where('id',$id)
                    ->get();

        // 把获取到的数据放到数组里面
        $datas = [];
        foreach($data as $k => $v) {
            foreach ($v as $kk => $vv) {
                $datas[$kk] = $vv;
             } 
        }
        
        // 进行数量减少
        if($datas['num'] <= 1) {
            return back();
        } else {
            $num = $datas['num']-1;
        }
        $price = $datas['money']*$num;

        // 对数据库进行修改操作
        // $res = DB::update("update shopping_infos set num = $num,price=$price where id = $id");
        $res = DB::table('shopping_infos')
                    ->where('id',$id)
                    ->update(['num'=>$num,'price'=>$price]);
                    
        if ($res) {
            return back();
        } else {
            echo '失败';exit;
        }
        
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
        echo $id;
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
     * 删除购物车数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 接收数据
        $id = $request->input('id',0);

        // 进行数据库操作
        $res = DB::table('shopping_infos')
                    ->where('id',$id)
                    ->delete();
        if ($res) {
            echo 'ok';
        } else {
            echo 'no';
        }

        
    }
}
