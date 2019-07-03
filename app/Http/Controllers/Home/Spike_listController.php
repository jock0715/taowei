<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spike;
use App\Models\SpikeInfo;
use App\Models\User;
use App\Models\Comment_doing;
use App\Models\Comment_spike;
use App\Models\Order;
use DB;

class Spike_listController extends Controller
{
    /**
     * 秒杀商品列表页面
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
        $spikes_data = Spike::where('name','like','%'.$search.'%')
                              ->where('status','1')
                              ->paginate(8);

        // 加载页面
        return view('home/spikelist/index',
            [
                'spikes_data'=>$spikes_data,
                'search'=>$search,
                'links_data'=>$links_data
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
        $spike = Spike::find($id);

        // 获取商品详情图片
        $spikeinfo = $spike->spikeinfo;

        // 获取该商品所在分类的id
        $cid = $spike->cid;

        // 获取该商品同分类的三条商品数据（以销售量从大到小获取）
        $cate_spikes3 = Spike::where('cid',$cid)
                               ->where('status','1')
                               ->orderBy('sale','desc')
                               ->limit(3)
                               ->get();

        // 获取该商品同分类的所有商品数据（以销售量从大到小获取）
        $cate_spikes = Spike::where('cid',$cid)
                              ->where('status','1')
                              ->orderBy('sale','desc')
                              ->get();

        // 查看评价
        $comment = Comment_spike::where('sid',$id);
        $comment_data = $comment->paginate(5);


        // 判断是否登录
        if(session('home_login')){
            // 已登录 获取用户id
            $uid = session('home_data')->id;

            // 商品id
            $gid = $spike->id;

            // 验证是否已经收藏该商品
            $data = DB::table('spike_collections')
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
        return view('home/spikelist/info',
            [
                'spike'=>$spike,
                'spikeinfo'=>$spikeinfo,
                'cate_spikes'=>$cate_spikes,
                'cate_spikes3'=>$cate_spikes3,
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
        $spikes_sale_data = Spike::where('name','like','%'.$search.'%')
                                   ->where('status','1')
                                   ->orderBy('sale','desc')
                                   ->paginate(8);

        // 加载页面
        return view('home/spikelist/sale_index',
            [
                'spikes_sale_data'=>$spikes_sale_data,
                'search'=>$search,
                'links_data'=>$links_data
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
        $spikes_price_data = Spike::where('name','like','%'.$search.'%')
                                    ->where('status','1')
                                    ->orderBy('money','asc')
                                    ->paginate(8);

        // 加载页面
        return view('home/spikelist/price_index',
            [
                'spikes_price_data'=>$spikes_price_data,
                'search'=>$search,
                'links_data'=>$links_data
            ]);

    }
}
