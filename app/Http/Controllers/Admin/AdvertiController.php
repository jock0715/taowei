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
        // 接收搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $data = DB::table('advertis')->where('title','like','%'.$search.'%')->paginate(5);
        // 加载页面
        return view('admin/adverti/index',
            [
                'data'=>$data,
                'search'=>$search,
                'params'=>$request->all()
            ]);
        
    }

    /**
     * 广告添加列表
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载页面
        return view('admin/adverti/create');
    }

    /**
     * 处理广告添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 表单验证
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

         // 检查文件上传
        if($request->hasFile('file')){
            // 建立问文件对象并执行文件上传
            $file = $request->file('file')->store(date('Ymd'));
        }else{
            return back()->with('error','请选择图片');
          
        }
        // 接收数据
        $data['title'] = $request->input('title','');
        $data['auth'] = $request->input('auth','');
        $data['desc'] = $request->input('desc','');
        $data['url'] = $request->input('url','');
        $data['file'] = $file;
      

        // 执行 添加到数据库
        $res = DB::table('advertis')->insert($data);
        if($res){
            // 添加成功
            return redirect('admin/adverti')->with('success','添加成功');
        }else{
            //添加失败
            return back()->with('error','添加失败');
        }
    }

    /**
     * 广告修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取对应id的信息
        $adverti = adverti::find($id);
     
       // 加载修改页面
        return view('admin/adverti/edit',
            [
                'adverti'=>$adverti,
            ]);
    }

    /**
     *广告修改页面
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
            'url' => 'required|max:64|regex:/^[\w]+\.[\w]+\.[\w]+$/'
        ],[
            'title.required' => '标题不能为空',
            'title.max' => '超过了最大长度',
            'desc.required' => '描述不能为空',
            'desc.max' => '超过了最大长度',           
            'url.regex' => '地址格式不对',
            'url.max' => '超过了最大长度'
        ]);

        // 判断是否有文件上传
        if ($request->hasFile('file')) {
            // 删除旧的图片
            Storage::delete($request->input('old_file'));
            // 建立文件对象,并执行上传
            $file_path = $request->file('file')->store(date('Ymd'));
        } else {
            $file_path = $request->input('old_file');
        }

        // 接收数据
        $advertis_data = Adverti::find($id);
        $advertis_data->title = $request->input('title');
        $advertis_data->desc = $request->input('desc');
        $advertis_data->url = $request->input('url');
        $advertis_data->file = $file_path;

        // 执行修改
        $res = $advertis_data->save();
        if ($res) {
            // 修改成功
            return redirect('/admin/adverti')->with('success','修改成功');
        } else {
            // 修改失败
            return back()->with('error','修改失败');
        }
    }
    /**
     * 广告删除页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除操作
        $res = adverti::destroy($id);
        // 判断删除
        if($res){
            Storage::delete($id);
            // 删除成功
            return redirect('admin/adverti')->with('success','删除成功');
        }else{
            // 删除失败
            return back()->with('error','删除失败');
        }

      
     }
     /**
     * 广告列表状态切换
     *
     * @param  int 
     * @return \Illuminate\Http\Response
     */
      public function status (Request $request)
    {
        // 获取id
        $id = $request->input('id');

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

        // 判断是否切换成功
        if ($res) {
            // 切换成功
            echo 'ok';
        } else {
            // 切换失败
            echo 'no';
        }
    }
        
}
