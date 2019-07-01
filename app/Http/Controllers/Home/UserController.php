<?php

namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;
use App\Models\UserInfos;
use App\Models\UserAddrs;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Comment_doing;
use App\Models\Comment_spike;
use App\Models\SpikeCollection;
use App\Models\DoingCollection;
use App\Models\GoodsCollection;
use Hash;

class UserController extends Controller
{
    /**
     * 显示个人中心主页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_index()
    {
        // 判断用户是否登录
        if(!empty(session('home_data'))){
            // 是,进入个人页面
            return view('home/user/user_index');
        }else{
            // 否 前往登录
            return view('home/login/login');
        }
    }

    /**
     * 显示个人资料.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_info()
    {
        // 获取用户id
        $id = session('home_data')->id;
        // 实例化 用户表 users
        $user = new User;
        $data = $user->where('id',$id)->first();
        return view('home/user/user_info',['data'=>$data]);
    }

    /**
     * 执行修改个人资料.
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
        // 实例化 用户表 users
        $user = User::find($id);
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $res1 = $user->save();
        if($res1){
            // 执行成功,将user表id赋值给$uid
            $uid = $user->id;
        }

        //实例化 用户信息表 user_infos
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
     * 执行用户修改头像.
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
            // 返回原头像
            $file = $request->input('old_file');
        }

        // 实例化 用户信息表 user_infos
        $userinfos = UserInfos::find($id);
        $userinfos->profile = $file;
        $res = $userinfos->save();
        // 判断是否修改成功
        if($res){
            session('home_info')->profile = $file;
            echo "<script>alert('修改成功!');location.href='/home/user/user_info'</script>";
        }else{
            echo "<script>alert('修改失败!');location.href='/home/user/user_info'</script>";
        }
    }

    /**
     * 显示用户修改密码页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_upwd()
    {
        return view('home/user/user_upwd');
    }

    /**
     * 执行用户修改密码.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_upwds(Request $request)
    {
        // 获取数据
        $upwd = $request->input('upwd','');
        $reupwd1 = Hash::make($request->input('reupwd1',''));
        $id = $request->input('id','');

        // 实例化 用户表users
        $user = new User;
        $data = $user->where('id',$id)->first();

        // 验证旧密码
        if(!Hash::check($upwd,$data->upwd)){
            echo json_encode(['msg'=>'err','info'=>'旧密码错误!']);
            exit;
        }

        // 更改新密码
        $res = $user->where('id',$id)->update(['upwd'=>$reupwd1]);

        // 判断是否修改成功
        if($res){
            // 消除session
            session(['home_login'=>false]);
            session(['home_data'=>false]);
            session(['home_info'=>false]);
            echo json_encode(['msg'=>'ok','info'=>'密码修改成功,正在退出...']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'密码修改失败 !!']);
        }
    }

    /**
     * 显示用户地址页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_addr()
    {   
        // 获取用户id
        $id = session('home_data')->id;

        // 实例化 用户地址表user_addrs
        $useraddrs = new UserAddrs;
        $data = $useraddrs->where('uid',$id)->get();
        return view('home/user/user_addr',['data'=>$data]);
    }

    /**
     * 执行用户添加地址.
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
     * 显示用户修改地址页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_editaddr(Request $request,$id)
    {
        // 获取数据
        $data = UserAddrs::find($id);

        return view('home/user/user_editaddr',['data'=>$data]); 
    }

    /**
     * 执行用户修改地址.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_editaddrs(Request $request)
    {
        // 获取数据
        $data = $request->all();
        $id = $data['id'];
        
        // 实例化地址表 user_addrs
        $useraddrs = UserAddrs::find($id);
        $useraddrs->aname = $data['aname'];
        $useraddrs->aphone = $data['aphone'];
        $useraddrs->province = $data['province'];
        $useraddrs->uaddr = $data['uaddr'];
        $res = $useraddrs->save();

        // 判断是否修改成功
        if($res){
            echo json_encode(['msg'=>'ok','info'=>'修改成功 !']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'修改失败 !']);
        }
        
    }

    /**
     * 执行用户删除地址.
     *
     * @return \Illuminate\Http\Response
     */
    public function deladdr(Request $request)
    {
        // 获取数据
        $id = $request->input('id',0);

        // 实例化 用户地址表 user_addrs
        $useraddrs = UserAddrs::find($id);

        // 判断是否删除成功
        $res = $useraddrs->delete();
        if($res){
            echo json_encode(['msg'=>'ok','info'=>'删除成功 !']);
        }else{
            echo json_encode(['msg'=>'err','info'=>'删除失败 !']);
        }
        
    }

    /**
     * 显示用户安全设置.
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
     * 用户收藏列表
     *
     * @return \Illuminate\Http\Response
     */
    public function user_collection()
    {

        // 判断用户是否登录
        // if(!empty(session('home_data'))){
        //     // 是,进入个人页面
        //     return view('home/user/user_collection');
        // }else{
        //     // 否 前往登录
        //     return view('home/login/login');
        // }

        // 判断是否登录
        if(!empty(session('home_data'))){
            // 接收用户id 
            $uid = session('home_data')->id;


            // 查找该用户收藏的商品
            $goodscollection = Goodscollection::where('uid',$uid);
            $goods_collection = $goodscollection->get();

            // 查找该用户收藏的活动商品
            $doingcollection = Doingcollection::where('uid',$uid);
            $doing_collection = $doingcollection->get();

            // 查找该用户收藏的秒杀商品
            $spikecollection = Spikecollection::where('uid',$uid);
            $spike_collection = $spikecollection->get();
            
            return view('home/user/user_collection',
                [
                'goods_collection'=>$goods_collection,
                'doing_collection'=>$doing_collection,
                'spike_collection'=>$spike_collection
                ]);
        }else{
            return view('home/login/login');
        }
        // return view('home/user/user_collection');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_foot()
    {
        // 判断用户是否登录
        if(!empty(session('home_data'))){
            // 是,进入个人页面
            return view('home/user/user_foot');
        }else{
            // 否 前往登录
            return view('home/login/login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_reply()
    {
        $uid = session('home_data')->id;

        // 普通商品评论
        $data = Comment::where('uid',$uid)->get(); 
        // 秒杀商品评论
        $data_doing = Comment_doing::where('uid',$uid)->get();
        // 活动商品评论
        $data_spike = Comment_spike::where('uid',$uid)->get();

        return view('home/user/user_reply',['data'=>$data,'data_doing'=>$data_doing,'data_spike'=>$data_spike]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_replyed($id)
    {
        $data = Order::find($id);

        return view('home/user/user_replyed',['data'=>$data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_replyeds(Request $request)
    {
        // 开启事务
        DB::beginTransaction();
        $data = $request->all();
        if($data['gid']){
            $comments = new Comment;
            $comments->uid = $data['uid'];
            $comments->gid = $data['gid'];
            $comments->oid = $data['oid'];
            $comments->comment = $data['comment'];
            $comments->content = $data['content']?$data['content']:'该用户未评价,默认好评';
            $res1 = $comments->save();
            if($res1){
                $oid = $comments->oid;
            }
            
            $orders = Order::find($oid);
            $orders->status = 3;
            $res2 = $orders->save();

            if($res1 && $res2){
                // 成功提交事务
                DB::commit();
                // 成功返回用户显示列表路由,并提示信息
                echo json_encode(['msg'=>'ok','info'=>'发表评论成功 !']);
            }else{
                // 失败回滚事务
                DB::rollBack();
                // 失败,回滚当前页面,并提示信息
                echo json_encode(['msg'=>'err','info'=>'发表评论失败 !']);
            }
        }elseif($data['did']){
            $comments = new Comment_doing;
            $comments->uid = $data['uid'];
            $comments->did = $data['did'];
            $comments->oid = $data['oid'];
            $comments->comment = $data['comment'];
            $comments->content = $data['content']?$data['content']:'该用户未评价,默认好评';
            $res1 = $comments->save();
            if($res1){
                $oid = $comments->oid;
            }
            
            $orders = Order::find($oid);
            $orders->status = 3;
            $res2 = $orders->save();

            if($res1 && $res2){
                // 成功提交事务
                DB::commit();
                // 成功返回用户显示列表路由,并提示信息
                echo json_encode(['msg'=>'ok','info'=>'发表评论成功 !']);
            }else{
                // 失败回滚事务
                DB::rollBack();
                // 失败,回滚当前页面,并提示信息
                echo json_encode(['msg'=>'err','info'=>'发表评论失败 !']);
            }
        }else{
            $comments = new Comment_spike;
            $comments->uid = $data['uid'];
            $comments->sid = $data['sid'];
            $comments->oid = $data['oid'];
            $comments->comment = $data['comment'];
            $comments->content = $data['content']?$data['content']:'该用户未评价,默认好评';
            $res1 = $comments->save();
            if($res1){
                $oid = $comments->oid;
            }
            
            $orders = Order::find($oid);
            $orders->status = 3;
            $res2 = $orders->save();

            if($res1 && $res2){
                // 成功提交事务
                DB::commit();
                // 成功返回用户显示列表路由,并提示信息
                echo json_encode(['msg'=>'ok','info'=>'发表评论成功 !']);
            }else{
                // 失败回滚事务
                DB::rollBack();
                // 失败,回滚当前页面,并提示信息
                echo json_encode(['msg'=>'err','info'=>'发表评论失败 !']);
            }
        }
        
    }

    
}
