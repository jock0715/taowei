<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\GoodsInfo;
use App\Models\comment;
use App\Models\Order;

class Goods_listController extends Controller
{
    /**
     * 商品列表页面 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $goods_data = Goods::where('name','like','%'.$search.'%')->paginate(8);

        // 加载页面
        return view('home/goodslist/index', ['goods_data'=>$goods_data, 'search'=>$search]);
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
    public function destroy($id)
    {
        //
    }

    /**
     * 商品详情页面
     *
     * @return \Illuminate\Http\Response
     */
    public function info($id)
    {

        // 通过id获取商品数据
        $goods = Goods::find($id);
        $goodsinfo = $goods->goodsinfo;
        $cid = $goods->cid;
        $cate_goods = Goods::where('cid',$cid)->orderBy('sale','desc')->get();

        // 查看评价
        $comment = Comment::where('gid',$id);
        $comment_data = $comment->paginate(2);

        return view('home/goodslist/info',['goods'=>$goods,'goodsinfo'=>$goodsinfo,'cate_goods'=>$cate_goods,'comment_data'=>$comment_data]);

    }


    /**
     * 商品列表页面（按销售量从大到小排）
     *
     * @return \Illuminate\Http\Response
     */
    public function saleindex(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $goods_sale_data = Goods::where('name','like','%'.$search.'%')->orderBy('sale','desc')->paginate(8);

        // 加载页面
        return view('home/goodslist/sale_index', ['goods_sale_data'=>$goods_sale_data, 'search'=>$search]);

    }

    /**
     * 商品列表页面（按价格从小到大排）
     *
     * @return \Illuminate\Http\Response
     */
    public function priceindex(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $goods_price_data = Goods::where('name','like','%'.$search.'%')->orderBy('money','asc')->paginate(8);

        // 加载页面
        return view('home/goodslist/price_index', ['goods_price_data'=>$goods_price_data, 'search'=>$search]);

    }
}
