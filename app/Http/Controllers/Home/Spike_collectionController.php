<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SpikeCollection;
use DB;

class Spike_collectionController extends Controller
{

    /**
     * 执行 秒杀商品 收藏
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // 判断是否登录
        if(!session('home_login')){
            // 未登录
            echo json_encode(['msg'=>'err','info'=>'请先登录!']);
            exit;
        }

        // 得到新对象
        $collection = new SpikeCollection();

        // 接受数据
        $collection->gid = $request->input('id');
        $collection->uid = session('home_data')->id;

        // 执行添加
        $res = $collection->save();

        // 判断是否收藏成功
        if ($res) {
            // 收藏成功
            echo json_encode(['msg'=>'ok','info'=>'收藏成功']);
            exit;
        } else {
            // 收藏失败
            echo json_encode(['msg'=>'err','info'=>'收藏失败']);
            exit;
        }
    }


    /**
     * 取消 收藏 秒杀商品
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

        // 查找要取消收藏的数据
        $data = DB::table('spike_collections')->where('gid',$gid)->where('uid',$uid)->first();

        // 获取要取消的收藏id
        $id = $data->id;

        // 进行删除
        $res = SpikeCollection::destroy($id);

        // 判断是否取消收藏成功
        if ($res) {
            // 取消成功
            echo json_encode(['msg'=>'ok','info'=>'取消成功']);
            exit;
        } else {
            // 取消失败
            echo json_encode(['msg'=>'err','info'=>'取消失败']);
            exit;
        }
    }
}
