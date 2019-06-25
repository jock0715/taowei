<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;
use App\Models\UserInfos;
use App\Models\UserAddrs;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_index()
    {
        if(!empty(session('home_data'))){
            return view('home/user/user_index');
        }else{
            return view('home/login/login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_info()
    {
        $id = session('home_data')->id;
        $user = new User;
        $data = $user->where('id',$id)->first();
        return view('home/user/user_info',['data'=>$data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_infos(Request $request)
    {
        // 开启事务
        DB::beginTransaction();

        // 接收数据
        $data = $request->all();
        $id = $data['id'];
        // 实例化 用户表
        $user = User::find($id);
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $res1 = $user->save();
        if($res1){
            // 执行成功,将user表id赋值给$uid
            $uid = $user->id;
        }

        //实例化 用户信息表
        $userinfos = UserInfos::where('uid',$uid)->first();
        $userinfos->nick = $data['nick'];
        $userinfos->name = $data['name'];
        $userinfos->sex = $data['sex'];
        $userinfos->age = $data['age'];
        $res2 = $userinfos->save();
        if($res1 && $res2){
            // 成功提交事务
            DB::commit();
            echo json_encode(['msg'=>'ok','info'=>'修改成功 !']);
        }else{
            // 失败回滚事务
            DB::rollBack();
            echo json_encode(['msg'=>'err','info'=>'修改失败 !']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_file(Request $request,$id)
    {
        if($request->hasFile('profile')){
            // 删除原头像
            Storage::delete($request->input('old_file'));
            // 创建文件并上传
            $file = $request->file('profile')->store(date('Ymd'));
        }else{
            $file = $request->input('old_file');
        }
        $userinfos = UserInfos::find($id);
        $userinfos->profile = $file;
        $res = $userinfos->save();
        if($res){
            session('home_info')->profile = $file;
            echo "<script>alert('修改成功!');location.href='/home/user/user_info'</script>";
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_upwd()
    {
        return view('home/user/user_upwd');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_upwds(Request $request)
    {
        $upwd = $request->input('upwd','');
        $reupwd1 = Hash::make($request->input('reupwd1',''));
        $id = $request->input('id','');
        $user = new User;
        $data = $user->where('id',$id)->first();

        // 验证旧密码
        if(!Hash::check($upwd,$data->upwd)){
            echo json_encode(['msg'=>'err','info'=>'旧密码错误!']);
            exit;
        }

        // 更改新密码
        $res = $user->where('id',$id)->update(['upwd'=>$reupwd1]);

        if($res){
            // 压入session
            session(['home_login'=>false]);
            session(['home_data'=>false]);
            session(['home_info'=>false]);
            echo json_encode(['msg'=>'ok','info'=>'密码修改成功,正在退出...']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'密码修改失败 !!']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_addr()
    {   
        $id = session('home_data')->id;
        $useraddrs = new UserAddrs;
        $data = $useraddrs->where('uid',$id)->get();
        return view('home/user/user_addr',['data'=>$data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_addrs(Request $request)
    {
        $data = $request->all();

        $useraddrs = new UserAddrs;
        $useraddrs->uid = $data['id'];
        $useraddrs->aname = $data['aname'];
        $useraddrs->uaddr = $data['uaddr'];
        $useraddrs->province = $data['province'];
        $useraddrs->aphone = $data['aphone'];
        $res = $useraddrs->save();
        if($res){
            echo json_encode(['msg'=>'ok','info'=>'添加成功 !']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'添加失败 !']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deladdr(Request $request)
    {
        $id = $request->input('id',0);
        $useraddrs = UserAddrs::find($id);
        $res = $useraddrs->delete();
        if($res){
            echo json_encode(['msg'=>'ok','info'=>'删除成功 !']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'删除失败 !']);
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_security()
    {
        return view('home/user/user_security');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_order()
    {
        return view('home/user/user_order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_after()
    {
        return view('home/user/user_after');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_bill()
    {
        return view('home/user/user_bill');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_collection()
    {
        return view('home/user/user_collection');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_foot()
    {
        return view('home/user/user_foot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_reply()
    {
        return view('home/user/user_reply');
    }

    
}
