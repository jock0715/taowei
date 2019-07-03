<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\GoodsInfo;
use App\Models\Comment;
use App\Models\Order;
use DB;


class Goods_listController extends Controller
{
    
    /**
     * 商品列表页面 
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

        // 查询数据 并且 分页
        $goods_data = Goods::where('name','like','%'.$search.'%')
                             ->where('status','1')
                             ->paginate(8);

        // 加载页面

        return view('home/goodslist/index',
            [
                'links_data'=>$links_data,
                'goods_data'=>$goods_data,
                'search'=>$search
            ]);

    }

    /**
     * 商品详情页面
     *
     * @return \Illuminate\Http\Response
     */
    public function info($id)
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->where('status', 1)
                          ->get();

        // 通过id获取商品数据 
        $goods = Goods::find($id);

        // 获取该商品的详情图
        $goodsinfo = $goods->goodsinfo;
        // 获取该商品所在的分类id
        $cid = $goods->cid;

        // 查看评价
        $comment = Comment::where('gid',$id);
        $comment_data = $comment->paginate(2);

        // 获取该商品同分类的三条商品数据（以销售量从大到小获取）
        $cate_goods3 = Goods::where('cid',$cid)
                              ->where('status','1')
                              ->orderBy('sale','desc')
                              ->limit(3)
                              ->get();

        // 获取该商品同分类的所有商品数据（以销售量从大到小获取）
        $cate_goods = Goods::where('cid',$cid)
                             ->where('status','1')
                             ->orderBy('sale','desc')
                             ->get();

        // 判断是否登录
        if(session('home_login')){

            // 已登录 获取用户id
            $uid = session('home_data')->id;

            // 商品id
            $gid = $goods->id;

            // 验证是否已经收藏该商品
            $data = DB::table('goods_collections')
                        ->where('gid',$gid)
                        ->where('uid',$uid)
                        ->first();

            // 收藏返回1 没收藏返回0
            if(!empty($data)){
                // 已收藏
                $collection = 1;
            } else {
                // 未收藏
                $collection = 0;
            }
        }else{
            // 没登录 返回0
            $collection = 0;
        }

        // 加载页面
        return view('home/goodslist/info',
            [
                'goods'=>$goods,
                'goodsinfo'=>$goodsinfo,
                'cate_goods'=>$cate_goods,
                'cate_goods3'=>$cate_goods3,
                'collection'=>$collection,
                'comment_data'=>$comment_data,
                'links_data'=>$links_data
            ]);


    }


    /**
     * 商品列表页面（按销售量从大到小排）
     *
     * @return \Illuminate\Http\Response
     */
    public function saleindex(Request $request)
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->where('status', 1)
                          ->get();

        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $goods_sale_data = Goods::where('name','like','%'.$search.'%')
                                  ->where('status','1')
                                  ->orderBy('sale','desc')
                                  ->paginate(8);

        // 加载页面
        return view('home/goodslist/sale_index',
            [
                'links_data'=>$links_data,
                'goods_sale_data'=>$goods_sale_data,
                'search'=>$search
            ]);

    }

    /**
     * 商品列表页面（按价格从小到大排）
     *
     * @return \Illuminate\Http\Response
     */
    public function priceindex(Request $request) 
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->where('status', 1)
                          ->get();


        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $goods_price_data = Goods::where('name','like','%'.$search.'%')
                                   ->where('status','1')
                                   ->orderBy('money','asc')
                                   ->paginate(8);

        // 加载页面
        return view('home/goodslist/price_index',
            [
                'links_data'=>$links_data,
                'goods_price_data'=>$goods_price_data,
                'search'=>$search
            ]);

    }
}
