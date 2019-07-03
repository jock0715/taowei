<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Goods;
use DB;

class Cate_listController extends Controller
{
    /**
     * 分类下的 商品列表
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

        // 接收分类ID
        $cid = $request->input('cid');

        // 查询数据 并且 分页       
        $goods_data = Goods::where('name','like','%'.$search.'%')
                            ->where('cid',$cid)
                            ->paginate(8);

        // 加载页面
        return view('home/catelist/index',
            [
                'links_data'=>$links_data,
                'goods_data'=>$goods_data,
                'search'=>$search]
            );
    }

   
}
