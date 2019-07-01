<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DoingCollection;
use DB;

class Doing_collectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
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
     * 活动商品 加入收藏
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //获取友情链接数据
        $links_data = DB::table('links')->orderBy('id','asc')->where('status', 1)->get();

        
        // 判断是否登录
        if(!session('home_login')){
            echo json_encode(['msg'=>'err','info'=>'请先登录!']);
            exit;
        }

        // 得到新对象
        $collection = new DoingCollection();

        // 接受数据
        $collection->gid = $request->input('id');
        $collection->uid = session('home_data')->id;

        // 执行添加
        $res = $collection->save();

        // 判断是否收藏成功
        if ($res) {
            echo json_encode(['msg'=>'ok','info'=>'收藏成功']);
            exit;
        } else {
            echo json_encode(['msg'=>'err','info'=>'收藏失败']);
            exit;
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
     * 取消收藏 活动商品
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        // 接受要取消收藏的商品id
        $gid = $id;
        // 找出用户id
        $uid = session('home_data')->id;

        $data = DB::table('doing_collections')->where('gid',$gid)->where('uid',$uid)->first();
        $id = $data->id;
        // 进行删除
        $res = DoingCollection::destroy($id);
        // 判断是否取消收藏成功
        if ($res) {
            echo json_encode(['msg'=>'ok','info'=>'取消成功']);
            exit;
        } else {
            echo json_encode(['msg'=>'err','info'=>'取消失败']);
            exit;
        }
    }
}
