<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Spike;
use DB;
use App\Models\Cate;


class IndexController extends Controller 
{
    /**
     * 封装分类列表redis内存
     *
     * @return \Illuminate\Http\Response
     */
    public static function cates_redis($pid)
    {
        // 判断redis是否压入相关数据
        if(Redis::exists('cates_redis_data')){
          // 将已经在redis中的内存数据转为数组js输出
          $cate_data = json_decode(Redis::get('cates_redis_data'));
        }else{
          // 如果没有就选执行数据操作并压入redis
          $cate_data = self::getPidCateData($pid);
          // 将需要的数据库数据转成字符js并设置时效压入redis中
          Redis::setex('cates_redis_data',600,json_encode($cate_data));
        }
        return $cate_data;
    }

    /**
     * .封装秒杀商品redis内存
     * @param 
     * @return \Illuminate\Http\Response
     */
    public static function spike4_redis()
    {
        # 判断redis是否压入相关数据
        if(Redis::exists('spike4_redis_data')){
            # 将已经在redis中的内存数组转为数据js输出
            $spike4_data = json_decode(Redis::get('spike4_redis_data'));
        }else{
            # 获取轮播图数据
            $spike4_data = DB::table('spikes')
                           ->where('status','1')
                           ->orderBy('id','asc')
                           ->limit(8)
                           ->get();
            # 将需要的数据库数据转成字符js并设置时效压入redis中 键,时间,值
            Redis::setex('spike4_redis_data',600,json_encode($spike4_data));
        }
        return $spike4_data;
    }

    /**
     * .封装活动商品redis内存
     * @param 
     * @return \Illuminate\Http\Response
     */
    public static function doing4_redis()
    {
        # 判断redis是否压入相关数据
        if(Redis::exists('doing4_redis_data')){
            # 将已经在redis中的内存数组转为数据js输出
            $doing4_data = json_decode(Redis::get('doing4_redis_data'));
        }else{
            # 获取轮播图数据
            $doing4_data = DB::table('doings')
                           ->where('status','1')
                           ->orderBy('id','asc')
                           ->limit(8)
                           ->get();
            # 将需要的数据库数据转成字符js并设置时效压入redis中 键,时间,值
            Redis::setex('doing4_redis_data',600,json_encode($doing4_data));
        }
        return $doing4_data;
    }

    /**
     * .封装普通商品redis内存
     * @param 
     * @return \Illuminate\Http\Response
     */
    public static function goods10_redis()
    {
        # 判断redis是否压入相关数据
        if(Redis::exists('goods10_redis_data')){
            # 将已经在redis中的内存数组转为数据js输出
            $goods10_data = json_decode(Redis::get('goods10_redis_data'));
        }else{
            # 获取轮播图数据
            $goods10_data = DB::table('goods')
                            ->where('status','1')
                            ->orderBy('id','asc')
                            ->limit(60)
                            ->get();
            # 将需要的数据库数据转成字符js并设置时效压入redis中 键,时间,值
            Redis::setex('goods10_redis_data',600,json_encode($goods10_data));
        }
        return $goods10_data;
    }

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
    {   
        //获取分类redis
        $cate_data = self::cates_redis(0);
        
        // 获取轮播数据
        $banners = new Banner;
        $banners_data = $banners->get();

        // 获取十条商品的数据
        $goods10_data = self::goods10_redis();

        // 获取四条秒杀商品的数据
        $spike4_data = self::spike4_redis();
        
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
        $doing4_data = self::doing4_redis();
        

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
