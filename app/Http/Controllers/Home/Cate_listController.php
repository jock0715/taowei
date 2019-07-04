<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\Cate;
use App\Models\Goods;
use DB;

class Cate_listController extends Controller
{

    /**
     * 封装分类下各类商品redis内存
     *
     * @return \Illuminate\Http\Response
     */
    public static function glist_redis($search,$cid)
    {
        // 判断redis是否压入相关数据
        if(Redis::exists('goods_redis_data')){
          // 将已经在redis中的内存数据转为数组js输出
          $goods_data = json_decode(Redis::get('goods_redis_data'));
        }else{
          // 如果没有就选执行数据操作并压入redis
          $goods_data = Goods::where('name','like','%'.$search.'%')
                            ->where('cid',$cid)
                            ->paginate(20);
          // 将需要的数据库数据转成字符js并设置时效压入redis中
          Redis::setex('goods_redis_data',600,json_encode($goods_data));
        }
        return $goods_data;
    }

    /**
     * 分类下的 商品列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->where('status', 1)
                          ->get();

        // 接受搜索条件
        $search = $request->input('search','');

        // 接收分类ID
        $cid = $request->input('cid');

        // 查询数据 并且 分页 分类列表中的各类普通商品      
        //$goods_data = self::glist_redis($search,$cid);
        $goods_data = Goods::where('name','like','%'.$search.'%')
                            ->where('cid',$cid)
                            ->paginate(20);

        // foreach ($goods_data as $k => $v) {
        //   dump($v);
        // }

        // 加载页面
        return view('home/catelist/index',
            [
                'links_data'=>$links_data,
                'goods_data'=>$goods_data,
                'search'=>$search]
            );
    }

   
}
