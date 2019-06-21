<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\StoreBanner;
use App\Models\Banner;
use Storage;
class BannerController extends Controller
{ 
   /* public function fordata()
    {
        
        // 循环数据 进行测试
        for ($i=0; $i < 30; $i++) { 
            $data = [
            'title' => 'admin'.rand(1234,4321),
            'desc'  => 'admin'.rand(1234,4321),
            'url' => '20190617/zGy6U2mQDcTpMNLlzVQxTm9NnsETjWnjTMJ0szzt.jpeg',
        ];

        $user = new Banner;
        $user->title = $data['title'];
        $user->desc = $data['desc'];
        $user->url = $data['url'];
        $res1 = $user->save();
        }
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->fordata(); 
        // 获取数据库数据
        // $banners = new Banners;
        // $banners_data = $banners->get();
        $search_uname = $request->input('search_uname','');

        $banners_data = Banner::where('title','like','%'.$search_uname.'%')
                                ->orderBy('id','asc')
                                ->paginate(5);
        // 引入页面
        return view('/admin/banner/index',
                [
                    'params'=>$request->all(),
                    'banners_data'=>$banners_data, 
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 引入页面
        return view('/admin/banner/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // 表单验证
        $this->validate($request, [
            'title' => 'required|max:32',
            'desc' => 'required|max:60',
            'url' => 'required',
        ],[
            'title.required' => '标题不能为空',
            'title.max' => '超过了最大长度',
            'desc.required' => '描述不能为空',
            'desc.max' => '超过了最大长度',
            'url.required' => '图片不能为空',
        ]);

        // 判断是否有文件上传
        if ($request->hasFile('url')) {
            // 上传到哪个文件
            $file_url = $request->file('url')->store(date('Ymd'));
        } else {
            $file_url = '';
        }

        // 接收数据
        $data = $request->all();
        // dump($data);
        $banner = new Banner;
        $banner->title = $data['title'];
        $banner->desc = $data['desc'];
        $banner->url = $file_url;
        
        // 进行数据库添加操作
        $res = $banner->save();
        if ($res) {
            return redirect('/admin/banner')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 通过id获取单条数据
        $banners_edit = Banner::find($id);

        // 引入页面
        return view('/admin/banner/edit',
            [
                'banners_edit' => $banners_edit,
            ]);
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
        // dd($request->all());
        // 表单验证
        $this->validate($request, [
            'title' => 'required|max:32',
            'desc' => 'required|max:60',
        ],[
            'title.required' => '标题不能为空',
            'title.max' => '超过了最大长度',
            'desc.required' => '描述不能为空',
            'desc.max' => '超过了最大长度',
        ]);

        // 判断是否有文件上传
        if ($request->hasFile('url')) {
            // 删除旧的图片
            Storage::delete($request->input('old_url'));
            // 存储到哪个文件
            $url_path = $request->file('url')->store(date('Ymd'));
        } else {
            $url_path = $request->input('old_url');
        }

        // 接收数据
        $banners_data = Banner::find($id);
        $banners_data->title = $request->input('title');
        $banners_data->desc = $request->input('desc');
        $banners_data->url = $url_path;

        $res = $banners_data->save();
        if ($res) {
            return redirect('/admin/banner')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        // 通过该id进行删除操作
        $res = Banner::destroy($id);

        if ($res) {
            Storage::delete($request->input('url',''));
            return redirect('/admin/banner')->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }

    // 状态
    public function status (Request $request)
    {
        // 获取id
        $id = $request->input('id');
        // dd($id);
        // 查询数据库的status值
        $data = DB::table('banners')
                    ->where('id',$id)
                    ->value('status');


        // 判断status
        if ($data == 0) {
            $data = 1;
        } else {
            $data = 0;
        }  

        // 进行数据库操作
        $res = DB::update("update banners set status = $data where id = $id");

        if ($res) {
            echo 'ok';
        } else {
            echo 'no';
        }

    }
}
