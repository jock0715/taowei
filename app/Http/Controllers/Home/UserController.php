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
use App\Models\Goods;
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
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 获取商品同的两条商品数据（以销售量从大到小获取）
        $goods2_data = Goods::where('status','1')
                              ->orderBy('sale','desc')
                              ->limit(2)
                              ->get();

        // 判断用户是否登录
        if(!empty(session('home_data'))){
            // 是,进入个人页面
            return view('home/user/user_index',
                [
                    'links_data'=>$links_data,
                    'goods2_data'=>$goods2_data
                ]);
        }else{
            // 否 前往登录
            return view('home/login/login',
                [
                    'links_data'=>$links_data
                ]);
        }
    }

    /**
     * 显示个人资料.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_info()
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 获取用户id
        $id = session('home_data')->id;

        // 实例化 用户表 users
        $user = new User;
        
        // 通过id获取用户数据
        $data = $user->where('id',$id)->first();

        // 加载页面
        return view('home/user/user_info',
            [
                'links_data'=>$links_data,
                'data'=>$data
            ]);
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

        // 赋值
        $user->phone = $data['phone'];
        $user->email = $data['email'];

        // 执行修改
        $res1 = $user->save();

        // 判断是否修改成功
        if($res1){
          // 实例化 用户信息表 user_infos
          $user_data = User::find($id);
          session(['home_data'=>$user_data]);

          // 执行成功,将user表id赋值给$uid
          $uid = $user->id;
        }

        //实例化 用户信息表 user_infos
        $userinfos = UserInfos::where('uid',$uid)
                                ->first();

        // 赋值
        $userinfos->nick = $data['nick'];
        $userinfos->name = $data['name'];
        $userinfos->sex = $data['sex'];
        $userinfos->age = $data['age'];

        // 执行修改
        $res2 = $userinfos->save();

        // 判断是否修改成功
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
        // 判断是否有新的头像上传
        if($request->hasFile('profile')){

            // 有新头像上传 删除原头像
            Storage::delete($request->input('old_file'));

            // 创建文件并上传
            $file = $request->file('profile')->store(date('Ymd'));

        }else{

            // 没有新头像上传 返回原头像
            $file = $request->input('old_file');
        }

        // 实例化 用户信息表 user_infos
        $userinfos = UserInfos::find($id);

        // 赋值
        $userinfos->profile = $file;

        // 执行修改
        $res = $userinfos->save();

        // 判断是否修改成功
        if($res){
            // 修改成功 同时修改session值
            session('home_info')->profile = $file;
            echo "<script>alert('修改成功!');location.href='/home/user/user_info'</script>";
        }else{
            // 修改失败
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
      // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
        return view('home/user/user_upwd',['links_data'=>$links_data]);
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
            // 修改成功 消除session
            session(['home_login'=>false]);
            session(['home_data'=>false]);
            session(['home_info'=>false]);

            // 重新登录
            echo json_encode(['msg'=>'ok','info'=>'密码修改成功,正在退出...']);
        }else{
            // 修改失败
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
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 获取用户id
        $id = session('home_data')->id;

        // 实例化 用户地址表user_addrs
        $useraddrs = new UserAddrs;
        $data = $useraddrs->where('uid',$id)->get();

        // 加载页面
        return view('home/user/user_addr',
            [
                'links_data'=>$links_data,
                'data'=>$data
            ]);
    }

    /**
     * 执行用户添加地址.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_addrs(Request $request)
    {
        // 接受数据
        $data = $request->all();

        // 实例化对象
        $useraddrs = new UserAddrs;

        // 赋值
        $useraddrs->uid = $data['id'];
        $useraddrs->aname = $data['aname'];
        $useraddrs->uaddr = $data['uaddr'];
        $useraddrs->province = $data['province'];
        $useraddrs->aphone = $data['aphone'];

        // 执行添加
        $res = $useraddrs->save();

        // 判断是否添加成功
        if($res){
            // 添加成功
            echo json_encode(['msg'=>'ok','info'=>'添加成功 !']);
        }else{
            // 添加失败
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
      // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();
        // 获取数据
        $data = UserAddrs::find($id);

        return view('home/user/user_editaddr',
            [
                'data'=>$data,
                'links_data'=>$links_data
            ]); 
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

        // 赋值
        $useraddrs->aname = $data['aname'];
        $useraddrs->aphone = $data['aphone'];
        $useraddrs->province = $data['province'];
        $useraddrs->uaddr = $data['uaddr'];

        // 执行修改
        $res = $useraddrs->save();

        // 判断是否修改成功
        if($res){
            // 修改成功
            echo json_encode(['msg'=>'ok','info'=>'修改成功 !']);
        }else{
            // 修改失败
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
            // 删除成功
            echo json_encode(['msg'=>'ok','info'=>'删除成功 !']);
        }else{
            // 删除失败
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
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        return view('home/user/user_security',
            [
                'links_data'=>$links_data
            ]);
    }

    /**
     * 用户 订单
     *
     * @return \Illuminate\Http\Response
     */
    public function user_order()
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 加载页面
        return view('home/user/user_order',
            [
                'links_data'=>$links_data
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_after()
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 加载页面
        return view('home/user/user_after',
            [
                'links_data'=>$links_data
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_bill()
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 加载页面
        return view('home/user/user_bill',
            [
                'links_data'=>$links_data
            ]);
    }

    /**
     * 用户收藏列表
     *
     * @return \Illuminate\Http\Response
     */
    public function user_collection()
    {

        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 判断是否登录
        if(!empty(session('home_data'))){
            // 已登录 接收用户id 
            $uid = session('home_data')->id;

            // 实例化对象
            $goodscollection = Goodscollection::where('uid',$uid);
            // 查找该用户收藏的商品
            $goods_collection = $goodscollection->get();

            // 实例化对象
            $doingcollection = Doingcollection::where('uid',$uid);
            // 查找该用户收藏的活动商品
            $doing_collection = $doingcollection->get();

            // 实例化对象
            $spikecollection = Spikecollection::where('uid',$uid);
            // 查找该用户收藏的秒杀商品
            $spike_collection = $spikecollection->get();
            
            // 加载页面
            return view('home/user/user_collection',
                [
                    'links_data'=>$links_data,
                    'goods_collection'=>$goods_collection,
                    'doing_collection'=>$doing_collection,
                    'spike_collection'=>$spike_collection
                ]);
        }else{
            // 未登录 加载登录页面
            return view('home/login/login',
                [
                    'links_data'=>$links_data
                ]);
        }

    }

    /**
     * 个人 足迹
     *
     * @return \Illuminate\Http\Response
     */
    public function user_foot()
    {
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 判断用户是否登录
        if(!empty(session('home_data'))){
            // 是,进入个人页面
            return view('home/user/user_foot',['links_data'=>$links_data]);
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
        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 通过session获取用户id
        $uid = session('home_data')->id;

        // 普通商品评论
        $data = Comment::where('uid',$uid)->get();

        // 秒杀商品评论
        $data_doing = Comment_doing::where('uid',$uid)->get();

        // 活动商品评论
        $data_spike = Comment_spike::where('uid',$uid)->get();

        // 加载页面
        return view('home/user/user_reply',
            [
                'links_data'=>$links_data,
                'data'=>$data,
                'data_doing'=>$data_doing,
                'data_spike'=>$data_spike
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_replyed($id)
    {
        // 实例化对象
        $data = Order::find($id);

        // 获取友情链接数据
        $links_data = DB::table('links')
                          ->orderBy('id','asc')
                          ->where('status', 1)
                          ->get();

        // 加载页面
        return view('home/user/user_replyed',
            [
                'links_data'=>$links_data,
                'data'=>$data
            ]);
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

        // 接受数据
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function defaults(Request $request)
    {
      $id = $request->input('id',0);
      // 实例化 用户地址表 user_addrs
      $daddr = DB::table('user_addrs');
      $res1 = $daddr->update(['status'=>0]);
      $res2 = $daddr->where('id',$id)->update(['status'=>1]);

      if($res2){
        echo json_encode(['msg'=>'ok','info'=>'已设置为默认地址 !']);
      }else{
        echo json_encode(['msg'=>'err','info'=>'设置失败 !']);
      }
    }
}
