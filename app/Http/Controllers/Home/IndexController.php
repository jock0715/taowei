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
    /**
     * 分类 封装
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPidCateData($pid = 0)
        {
            //获取一级分类
            $data = Cate::where('pid',$pid)->get();

            // 遍历获取该一级分类下的二级分类数据
            foreach($data as $k=>$v){

                // 调用自身获取该二级分类下的三级分类数据
                $v->sub = self::getPidCateData($v->id);
            }
            // 返回数据
            return $data;

        }

    /**
     * 前台 首页
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
        $goods10_data = DB::table('goods')
                            ->where('status','1')
                            ->orderBy('id','asc')
                            ->limit(10)
                            ->get();

        // 获取四条秒杀商品的数据
        $spike4_data = DB::table('spikes')
                           ->where('status','1')
                           ->orderBy('id','asc')
                           ->limit(4)
                           ->get();
        
        // 获取广告数据
        $advertis_data = DB::table('advertis')
                             ->orderBy('id','asc')
                             ->limit(3)
                             ->get(); 

        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 获取四条活动商品的数据
        $doing4_data = DB::table('doings')
                           ->where('status','1')
                           ->orderBy('id','asc')
                           ->limit(4)
                           ->get();
        

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

    
}
