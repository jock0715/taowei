<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Spike;
use DB;
use App\Models\Cate;


class IndexController extends Controller 
{
    public static function getPidCateData($pid = 0)
        {
            //获取一级分类
            $data = Cate::where('pid',$pid)->get();
            foreach($data as $k=>$v){
                $v->sub = self::getPidCateData($v->id);
            }
            return $data;

        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //获取分类
        $cate_data = self::getPidCateData(0);
        
        // 获取轮播数据
        $banners = new Banner;
        $banners_data = $banners->get();

        // 获取十条商品的数据
        $goods10_data =DB::table('goods')->where('status','1')->orderBy('id','asc')->limit(10)->get();

        // 获取四条秒杀商品的数据
        $spike4_data =DB::table('spikes')->where('status','1')->orderBy('id','asc')->limit(4)->get();
        

         // 获取广告数据
        
        $advertis_data = DB::table('advertis')->orderBy('id','asc')->limit(3)->get(); 

        //获取友情链接数据
        $links_data = DB::table('links')->get();


        // 获取四条活动商品的数据
        $doing4_data =DB::table('doings')->where('status','1')->orderBy('id','asc')->limit(4)->get();
        

        // 引入页面
        return view('home/index',
            [
                'banners_data'=>$banners_data,
                'spike4_data'=>$spike4_data,
                'cate_data'=>$cate_data,
                'links_data'=>$links_data,
                'advertis_data'=>$advertis_data,
                'goods10_data'=>$goods10_data,
                'doing4_data'=>$doing4_data,

            ]);
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
}
