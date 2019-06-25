<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spike;
use App\Models\SpikeInfo;

class SpikelistController extends Controller
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
        $spikes_data = Spike::where('name','like','%'.$search.'%')->paginate(3);

        // 加载页面
        return view('home/spikelist/index', ['spikes_data'=>$spikes_data, 'search'=>$search]);

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
    {        // 通过id获取商品数据
        $spike = Spike::find($id);
        $spikeinfo = $spike->spikeinfo;
        $cid = $spike->cid;
        $cate_spikes = Spike::where('cid',$cid)->orderBy('sale','desc')->get();
        // 加载页面
        return view('home/spikelist/info',['spike'=>$spike,'spikeinfo'=>$spikeinfo,'cate_spikes'=>$cate_spikes]);

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
        $spikes_sale_data = Spike::where('name','like','%'.$search.'%')->orderBy('sale','desc')->paginate(3);

        // 加载页面
        return view('home/spikelist/sale_index', ['spikes_sale_data'=>$spikes_sale_data, 'search'=>$search]);

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
        $spikes_price_data = Spike::where('name','like','%'.$search.'%')->orderBy('money','asc')->paginate(3);

        // 加载页面
        return view('home/list/price_index', ['spikes_price_data'=>$spikes_price_data, 'search'=>$search]);

    }
}