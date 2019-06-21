<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\User;
use App\Models\UserInfos;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home/login/register');
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

        // 验证手机验证码 用户输入
        $phone = $request->input('phone',0);
        $code = $request->input('code',0);

        // 获取发送到手机的验证码
        $k = $phone.'_code';
        // session值赋对应手机的值
        $phone_code = session($k);
        //dd($code,$phone_code);
        if($code != $phone_code){
            echo "<script>alert('验证码错误!');location.href='/home/register'</script>";
            exit;
        }

        // 表单验证
        $this->validate($request, [
            'upwd' => 'required|regex:/^[\w]{6,18}$/',
            'reupwd' => 'required|same:upwd',
            
        ],[
            'upwd.regex'=>'密码格式为6~18位!',
            'upwd.required'=>'密码不能为空!',
            'reupwd.required'=>'确认密码不能为空!',
            'reupwd.same'=>'两次密码不一致!',
        ]);
        // 开启事务
        DB::beginTransaction();

        //接收数据 1692
        $data = $request->all();

        // 实例化User,Model类
        $user = new User;
        $user->uname = 'TaoWei用户'.rand(1234,4321);
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
        $userinfos->phone = '15217345681';
        $res2 = $userinfos->save();
        if($res1 && $res2){
            // 成功提交事务
            DB::commit();
            // 成功返回用户显示列表路由,并提示信息
            return redirect('/home/login')->with('success','添加成功');
        }else{
            // 失败回滚事务
            DB::rollBack();
            // 失败,回滚当前页面,并提示信息
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendPhone(Request $request)
    {
        // 接收手机号
        $phone = $request->input('phone',0);
        $code = rand(12345,54321);

        // redis 键名
        $k = $phone.'_code';
        session([$k=>$code]); // 这个将验证码存入session
        // echo json_encode(['msg'=>'ok','info'=>$code]);
        //     exit; 

        // 短信api接口
        $url = "http://v.juhe.cn/sms/send";
        $params = array(
            'key'   => '59e110fc1384fd4d0b46da8c4cbe25ba', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '166938', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
            'dtyle'=>'json'
        );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
        // $result = json_decode($content, true); 将json转为数组
        // if ($result) {
        //     var_dump($result);
        // } else {
        //     //请求异常
        // }
        // echo $content;


    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public static function juheCurl($url, $params = false, $ispost = 0)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    } 
}







