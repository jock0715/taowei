
<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doing;
use App\Models\DoingInfo;
use App\Models\Comment;
use App\Models\Comment_doing;
use App\Models\Comment_spike;
use App\Models\Order;
use DB;

class Doing_listController extends Controller
{
    /**
     * 活动商品列表页面 
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
        $doings_data = Doing::where('name','like','%'.$search.'%')
                              ->where('status','1')
                              ->paginate(8);

        // 加载页面
        return view('home/doinglist/index',
            [
                'doings_data'=>$doings_data,
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
        $doing = Doing::find($id);

        // 获取商品详情图片数据
        $doinginfo = $doing->doinginfo;

        // 获取该商品所在的分类id
        $cid = $doing->cid;

        // 获取该商品同分类的三条商品数据（以销售量从大到小获取）
        $cate_doings3 = Doing::where('cid',$cid)
                               ->where('status','1')
                               ->orderBy('sale','desc')
                               ->limit(3)
                               ->get();
        
        // 获取该商品同分类的所有商品数据（以销售量从大到小获取）
        $cate_doings = Doing::where('cid',$cid)
                              ->where('status','1')
                              ->orderBy('sale','desc')
                              ->get();

        // 查看评价
        $comment = Comment_doing::where('did',$id);
        $comment_data = $comment->paginate(5);
        
        if(session('home_login')){
            // 已登录 获取用户id
            $uid = session('home_data')->id;
            // 商品id
            $gid = $doing->id;
            // 验证是否已经收藏该商品
            $data = DB::table('doing_collections')
                        ->where('gid',$gid)
                        ->where('uid',$uid)
                        ->first();

            // 收藏返回1 没收藏返回0
            if(!empty($data)){
                // 已收藏
                $collection = 1;
            } else {
                // 没收藏
                $collection = 0;
            }
        }else{
            // 没登录 返回0
            $collection = 0;
        }

        // 加载页面
        return view('home/doinglist/info',
            [
                'doing'=>$doing,
                'doinginfo'=>$doinginfo,
                'cate_doings'=>$cate_doings,
                'cate_doings3'=>$cate_doings3,
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
        $doings_sale_data = Doing::where('name','like','%'.$search.'%')
                                   ->where('status','1')
                                   ->orderBy('sale','desc')
                                   ->paginate(8);

        // 加载页面
        return view('home/doinglist/sale_index',
            [
                'doings_sale_data'=>$doings_sale_data,
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
        $doings_price_data = Doing::where('name','like','%'.$search.'%')
                                    ->where('status','1')
                                    ->orderBy('money','asc')
                                    ->paginate(8);

        // 加载页面
        return view('home/doinglist/price_index',
            [
                'doings_price_data'=>$doings_price_data,
                'search'=>$search,
                'links_data'=>$links_data
            ]);

    }

}
