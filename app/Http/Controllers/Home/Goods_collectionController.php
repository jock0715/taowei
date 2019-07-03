<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GoodsCollection;
use DB;

class Goods_collectionController extends Controller
{

    /**
     * 商品 加入收藏
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
        $collection = new GoodsCollection();

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
     * 取消收藏商品
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // 接受要取消收藏的商品id
        $gid = $id;
        
        // 找出用户id
        $uid = session('home_data')->id;

        // 找出要取消的收藏
        $data = DB::table('goods_collections')
                    ->where('gid',$gid)
                    ->where('uid',$uid)
                    ->first();

        // 获取商品收藏表的id
        $id = $data->id;

        // 进行删除
        $res = GoodsCollection::destroy($id);
        
        // 判断是否取消收藏成功
        if ($res) {
            // 取消收藏成功
            echo json_encode(['msg'=>'ok','info'=>'取消成功']);
            exit;
        } else {
            // 取消收藏失败
            echo json_encode(['msg'=>'err','info'=>'取消失败']);
            exit;
        }
    }
}
