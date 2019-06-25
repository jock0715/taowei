<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Storage;
use App\Models\SpikeInfo;

class SpikeinfoController extends Controller
{
    /**
     * 秒杀商品详情页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接受搜索条件
        $search = $request->input('search','');

        // 查询数据 并且 分页
        $spikes_info = SpikeInfo::where('gname','like','%'.$search.'%')->paginate(3);

        // 加载页面
        return view('admin/spike/info_index', ['spikes_info'=>$spikes_info, 'search'=>$search]);
    }

    /**
     * 秒杀商品 添加 详情 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // 获取要添加图片的商品id和名称
        $id = $request->input('id',0);
        $name = $request->input('name','');

        // 加载页面
        return view('admin/spike/info_create',['id'=>$id,'name'=>$name]);
    }

    /**
     * 秒杀商品详情 执行 添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证表单
        $this->validate($request, [
            'file' => 'required',
           
        ],[
            'file.required'=>'图片必选',
            
        ]);

        // 执行文件上传
        if($request->hasFile('file')){
            $path = $request->file('file')->store(date('Ymd'));
        }else{
            $path = '';
        }

        // 接收表单所有值
        $data = $request->all();
        
        // 声明对象
        $spikeinfo = new SpikeInfo;

        // 重新赋值
        $spikeinfo->gid = $data['gid'];
        $spikeinfo->gname = $data['gname'];
        $spikeinfo->file = $path;

        // 执行添加
        $res = $spikeinfo->save();

        // 判断是否成功
        if ($res) {
            // 添加成功
            return redirect('admin/spike')->with('success','添加成功! 可在秒杀商品详情查看！');
        } else {
            // 添加失败
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
     * 删除 秒杀商品 详情 图片
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // 进行删除
        $res = SpikeInfo::destroy($id);

        // 判断是否删除成功
        if($res){
            // 删除图片
            Storage::delete($request->input('file',''));
            echo "ok";
        }else{
            echo "err";
        }
    }
}
