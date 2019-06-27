<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spike;
use App\Models\SpikeInfo;
use App\Models\User;

class Spike_listController extends Controller
{
    /**
     * 秒杀商品列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $spikes_data = Spike::where('name','like','%'.$search.'%')->paginate(8);

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
    {   
        // 通过id获取商品数据
        $spike = Spike::find($id);
        $spikeinfo = $spike->spikeinfo;
        $cid = $spike->cid;
        $cate_spikes = Spike::where('cid',$cid)->orderBy('sale','desc')->get();

        // 判断是否登录
        if(session('home_login')){
            // 已登录 获取用户id
            $uid = session('home_data')->id;
            // 查找出该用户所有收藏的秒杀商品
            $user = User::find($uid);
            $spike_collection = $user->userspikecollection;
            if(!empty($spike_collection)){
                // 遍历查找该用户收藏的商品id
                foreach ($spike_collection as $k => $v){
                    
                    // 判断该用户是否已经收藏当前商品
                    if($spike->id == $v->gid){

                        // 该用户已经收藏当前商品
                        $gid = 1;
                        // 结束循环
                        break;
                    }else{
                        // 该用户还没收藏当前商品
                        $gid = 0;
                    }
                }
            }else{
                $gid = 0;
            }

            
        }else{
            $gid = 0;
        }

        $gid = 0;
        // 加载页面
        return view('home/spikelist/info',['spike'=>$spike,'spikeinfo'=>$spikeinfo,'cate_spikes'=>$cate_spikes,'gid'=>$gid]);

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
        $spikes_sale_data = Spike::where('name','like','%'.$search.'%')->orderBy('sale','desc')->paginate(8);

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
        $spikes_price_data = Spike::where('name','like','%'.$search.'%')->orderBy('money','asc')->paginate(8);

        // 加载页面
        return view('home/spikelist/price_index', ['spikes_price_data'=>$spikes_price_data, 'search'=>$search]);

    }
}
