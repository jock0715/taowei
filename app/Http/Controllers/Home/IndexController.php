<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cate;
use DB;
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
    {
        $cate_data = self::getPidCateData(0);

        
        
        // 获取轮播数据
        $banners = new Banner;
        $banners_data = $banners->get();

         // 获取广告数据
        
        $advertis_data = DB::table('advertis')->get(); 


        //获取友情链接数据
        $links_data = DB::table('links')->get();

        // 引入页面
        return view('home/index',
            [
                'banners_data'=>$banners_data,
                'cate_data'=>$cate_data,
                'links_data'=>$links_data,
                'advertis_data'=>$advertis_data,
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
