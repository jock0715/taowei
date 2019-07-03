<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\User;
use App\Models\UserInfos;

class UserController extends Controller
{
    /**
     * 显示用户信息列表.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_uname = $request->input('search','');
        // $search_email = $request->input('email','');

        // ->where('email','like','%'.$search_email.'%')
        $user_data = User::where('uname','like','%'.$search_uname.'%')->paginate(5);
        // 显示视图
        return view('admin/user/index',['params'=>$request->all(),'user_data'=>$user_data]);
        
    }

    /**
     * 显示用户添加页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/user/create');
    }

    /**
     * 执行用户添加功能.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 表单验证
        $this->validate($request, [
            'uname' => 'required|unique:users|regex:/^[a-z,A-Z][\w]{5,17}$/',
            'upwd' => 'required|regex:/^[\w]{6,18}$/',
            'reupwd' => 'required|same:upwd',
            
        ],[
            'uname.required'=>'用户名不能为空!',
            'uname.unique'=>'用户名已存在!',
            'uname.regex'=>'用户名格式为首字母加数字,字母,下划线!',
            'upwd.regex'=>'密码格式为6~18位!',
            'upwd.required'=>'密码不能为空!',
            'reupwd.required'=>'确认密码不能为空!',
            'reupwd.same'=>'两次密码不一致!',
        ]);

        // 上传头像
        /*if($resquest->hasFile('profile')){
            // 创建文件上传对象,并执行上传
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = '';
        }*/

        // 开启事务
        DB::beginTransaction();

        // 获取user/create post过来的值
        $data = $request->all();

        // 实例化User,Model类
        $user = new User;
        $user->uname = $data['uname'];
        $user->upwd = Hash::make($data['upwd']);
        $res1 = $user->save();
        if($res1){
            // 执行成功,将user表id赋值给$uid
            $uid = $user->id;
        }

        // 压入用户id给用户详情的uid
        $userinfos = new UserInfos;
        $userinfos->uid = $uid;
        $userinfos->sex = '保密';
        $userinfos->age = rand(19,29);
        $userinfos->profile = 'xxx';
        $userinfos->addr = '该用户很神秘';
        $userinfos->email = 'xxx@xx.com';
        $userinfos->phone = '15217345'.rand(123,321);
        $res2 = $userinfos->save();
        if($res1 && $res2){
            // 成功提交事务
            DB::commit();
            // 成功返回用户显示列表路由,并提示信息
            return redirect('/admin/user')->with('success','添加成功');
        }else{
            // 失败回滚事务
            DB::rollBack();
            // 失败,回滚当前页面,并提示信息
            return back()->with('error','添加失败');
        }
    }

    /**
     * 显示用户修改页面.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = new User;
        $user_data = $user->find($id);
        return view('admin/user/edit',['user_data'=>$user_data]);
    }

    /**
     * 执行用户修改功能.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 开启事务
        DB::beginTransaction();
        // 表单验证
         $this->validate($request, [
            'email' => 'required|regex:/^[\w]{3,12}@[\w]+\.[\w]+$/',
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',

        ],[
            'email.required'=>'邮箱不能为空!',
            'email.regex'=>'邮箱格式错误,需包含@,com或cn...!',
            'phone.regex'=>'手机格式不对!',
        ]);
        // 获取头像
        if($request->hasFile('profile')){
            // 删除原头像
            Storage::delete($request->input('old_file'));
            $file_path = $request->file('profile')->store(date('Ymd'));
        }else{
            $file_path = $request->input('old_file');
        }

        // 获取数据
        $data = $request->all();

        // 实例user表 model类
        $user = User::find($id);
        $user->uname = $data['uname'];
        $user->status = $data['status'];
        $res1 = $user->save();

        // 实例化user_infos表 model类
        // 查找一条数据
        $userinfos = UserInfos::where('uid',$id)->first();
        $userinfos->sex = $data['sex'];
        $userinfos->age = $data['age'];
        $userinfos->profile = $file_path;
        $userinfos->addr = $data['addr'];
        $userinfos->email = $data['email'];
        $userinfos->phone = $data['phone'];
        $res2 = $userinfos->save();
        if($res1 && $res2){
            // 成功提交事务
            DB::commit();
            // 成功返回用户显示列表路由,并提示信息
            return redirect('/admin/user')->with('success','修改成功');
        }else{
            // 失败回滚事务
            DB::rollBack();
            // 失败,回滚当前页面,并提示信息
            return back()->with('error','修改失败');
        }
    }

    /**
     * 执行用户删除功能.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 开启事务
        DB::beginTransaction();

        $res1 = User::destroy($id);
        $res2 = UserInfos::where('uid',$id)->delete();
        // 删除用户头像
        /*
            use Illuminate\Support\Facades\Storage;
            Storage::delete('file2.jpg');
            Storage::delete(['file1.jpg', 'file2.jpg']);
        */
        if($res1 && $res2){
            // 成功提交事务
            DB::commit();
            // 成功返回用户显示列表路由,并提示信息
            return redirect('/admin/user')->with('success','删除成功');
        }else{
            // 失败回滚事务
            DB::rollBack();
            // 失败,回滚当前页面,并提示信息
            return back()->with('error','删除失败');
        }
    }
}
