<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Adverti;
use Storage;
class AdvertiController extends Controller
{
    /**
     * 广告管理列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收搜索条件
        $search = $request->input('search','');

        //查询数据 并且 分页
        $data = DB::table('advertis')->where('title','like','%'.$search.'%')->paginate(5);
        //加载页面
        return view('admin/adverti/index',
            [
                'data'=>$data,
                'search'=>$search
            ]);
        
    }

    /**
     * 添加列表
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/adverti/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
                'title' => 'required',
                'auth' => 'required',
                'desc' => 'required',
                'url' => 'required|max:64|regex:/^[\w]+\.[\w]+\.[\w]+$/',
                'file' => 'required',
            ],[
                'title.required'=>'广告标题必填',
                'auth.required'=>'赞助商必填',
                'desc.required'=>'广告描述必填',
                'url.required'=>'链接地址必填',
                'url.max'=>'链接地址过长',
                'url.regex'=>'链接地址格式不对',
                'file.required'=>'图片必填'
            ]);

        // //检查文件上传
        if($request->hasFile('file')){
            $file = $request->file('file')->store(date('Ymd'));
        }else{
            return back()->with('error','请选择图片');
          
        }
        //接收数据
        $data['title'] = $request->input('title','');
        $data['auth'] = $request->input('auth','');
        $data['desc'] = $request->input('desc','');
        $data['url'] = $request->input('url','');
        $data['file'] = $file;
        // $data['status'] = $request->input('status','');

        //执行 添加到数据库
        $res = DB::table('advertis')->insert($data);
        if($res){
            return redirect('admin/adverti')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
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
        $adverti = adverti::find($id);
        // dump($adverti);
       //加载修改页面
        return view('admin/adverti/edit',
            [
                'adverti'=>$adverti,
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
        if ($request->hasFile('file')) {
            // 删除旧的图片
            Storage::delete($request->input('old_file'));
            // 存储到哪个文件
            $file_path = $request->file('file')->store(date('Ymd'));
        } else {
            $file_path = $request->input('old_file');
        }

        // 接收数据
        $advertis_data = Adverti::find($id);
        $advertis_data->title = $request->input('title');
        $advertis_data->desc = $request->input('desc');
        $advertis_data->file = $file_path;

        $res = $advertis_data->save();
        if ($res) {
            return redirect('/admin/adverti')->with('success','修改成功');
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
    public function destroy($id)
    {
         //删除操作
        $res = adverti::destroy($id);
        if($res){
            Storage::delete();
            return redirect('admin/adverti')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }

      
     }
      public function status (Request $request)
    {
        // 获取id
        $id = $request->input('id');
        // dd($id);
        // 查询数据库的status值
        $data = DB::table('advertis')
                    ->where('id',$id)
                    ->value('status');




        // 判断status
        if ($data == 0) {
            $data = 1;
        } else {
            $data = 0;
        }  


        // 进行数据库操作
        $res = DB::update("update advertis set status = $data where id = $id");


        if ($res) {
            echo 'ok';
        } else {
            echo 'no';
        }


    }
        
}
