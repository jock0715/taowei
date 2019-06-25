<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/home_login/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
    <link href="/home_login/css/dlstyle.css" rel="stylesheet" type="text/css">
    <script src="/home_login/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
    <script src="/home_login/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <div class="login-boxtitle">
      <a href="home/demo.html">
        <img alt="" src="/home_login/images/logobig.png" /></a>
    </div>
    <div class="res-banner">
      <div class="res-main">
        <div class="login-banner-bg">
          <span></span>
          <img src="/home_login/images/big.jpg" /></div>
        <div class="login-box">
          <div class="am-tabs" id="doc-my-tabs">
            <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
              <li class="am-active">
                <a href="">邮箱注册</a></li>
              <li>
                <a href="">手机号注册</a></li>
            </ul>
            <div class="am-tabs-bd">
              <div class="am-tab-panel am-active">
                <form id="form1" action="/home/register/insert" method="post">
                  {{ csrf_field() }}
                  <div class="user-email">
                    <label for="email">
                      <i class="am-icon-envelope-o"></i>
                    </label>
                    <input type="email" name="email" id="email"  placeholder="请输入邮箱账号" value="{{old('email')}}"></div>
                  <div class="user-pass">
                    <label for="password">
                      <i class="am-icon-lock"></i>
                    </label>
                    <input type="password" name="upwd" id="password" placeholder="设置密码"></div>
                  <div class="user-pass">
                    <label for="passwordRepeat">
                      <i class="am-icon-lock"></i>
                    </label>
                    <input type="password" name="reupwd" id="passwordRepeat" placeholder="确认密码"></div>
                  <div class="am-cf">
                    <input type="submit" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                  </div>
                </form>
                  <div class="am-cf">
                    <a href="/home/login" class="am-btn am-btn-primary am-btn-sm am-fl" style="font-size: 16px;">前往登录</a>
                  </div>
                <div class="login-links">
                  <label for="reader-me">
                    @include('home/public/message')
                  </label>
                </div>
              </div>
              <div class="am-tab-panel">
                <form id="form2" action="/home/register/store" method="post">{{csrf_field()}}
                  <div class="user-phone">
                    <label for="phone">
                      <i class="am-icon-mobile-phone am-icon-md"></i></label>
                    <input type="text" name="phone" id="phone" placeholder="请输入手机号"></div>
                  <div class="verification">
                    <label for="code">
                      <i class="am-icon-code-fork"></i>
                    </label>
                    <input type="text" name="code" id="code" placeholder="请输入验证码">
                    <a class="btn" href="javascript:void(0);" onClick="sendMobileCode(this);" id="sendMobileCode">
                      <span id="dyMobileButton">获取</span></a>
                  </div>
                  <div class="user-pass">
                    <label for="password">
                      <i class="am-icon-lock"></i>
                    </label>
                    <input type="password" name="upwd" id="password" value="123456" placeholder="设置密码"></div>
                  <div class="user-pass">
                    <label for="passwordRepeat">
                      <i class="am-icon-lock"></i>
                    </label>
                    <input type="password" name="reupwd" id="passwordRepeat" value="123456" placeholder="确认密码"></div>
                  <div class="am-cf">
                    <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl"></div>
                </form>
                <div class="am-cf">
                    <a href="/home/login" class="am-btn am-btn-primary am-btn-sm am-fl" style="font-size: 16px;">前往登录</a>
                </div>
                <div class="login-links">
                  <label for="reader-me">
                    @if(session('error'))
                      <strong>{{ session('error') }}</strong> 
                    @endif
                  </label>
                </div>
                <hr></div>
              <script>$(function() {
                  $('#doc-my-tabs').tabs();
                })</script>
              <!-- 修改密码模态框 结束 -->
              <link rel="stylesheet" href="/home_login/layui/css/layui.css">
              <script src="/home_login/layui/layui.js"></script>
              <script>//一般直接写在一个js文件中
                layui.use(['layer', 'form'],
                function() {
                  var layer = layui.layer
                });
              </script>
              <script type="text/javascript">function sendMobileCode(obj) {

                  // 获取用户验证码
                  let phone = $('#phone').val();
                  // 验证格式
                  let phone_preg = /^[1]{1}[3-9]{1}\d{9}$/;
                  if (!phone_preg.test(phone)) {
                    layer.msg('手机格式不正确');
                    return false;
                  }

                  $(obj).attr('disabled', true);
                  $(obj).css('cursor', 'no-drop');
                  $('#dyMobileButton').css('color', '#ccc');
                  if ($('#dyMobileButton').html() == '获取') {
                    let i = 60;
                    let time = null;
                    time = setInterval(function() {
                      i--;
                      $('#dyMobileButton').html('' + i + 's');
                      if (i < 1) {
                        $(obj).attr('disabled', false);
                        $(obj).css('color', '#333');
                        $(obj).css('cursor', 'pointer');
                        $('#dyMobileButton').css('color', '#333');
                        $('#dyMobileButton').html('获取');
                        clearInterval(time);
                      }
                    },
                    1000);

                    // 发送ajax
                    $.get('/home/register/sendPhone', {
                      phone
                    },
                    function(res) {
                      if (res.error_code == 0) {
                        layer.msg('验证码发送成功,验证码十分钟内有效!');
                      } else {
                        layer.msg('验证码发送失败!');
                      }
                      // if(res.msg == 'ok'){
                      // 	layer.msg(res.info);
                      // }else{
                      // 	layer.msg('验证码发送失败!');
                      // }
                    },
                    'json');
                  }
                }</script>

                <script type="text/javascript">
                    $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });

                  // 手机注册
                  $('#form2').submit(function(){
                    // 获取用户邮箱
                    let phone = $('#form2 input[name=phone]').val();
                    let upwd = $('#form2 input[name=upwd]').val();
                    let reupwd = $('#form2 input[name=reupwd]').val();
                    let code = $('#form2 input[name=code]').val();
                    $.post('/home/register/store',{phone,upwd,reupwd,code},function(res){
                      if(res.msg == 'ok'){
                        layer.msg(res.info);
                        setTimeout(function(){
                          //关闭当前页面
                          window.parent.location.reload();
                          var index = parent.layer.getFrameIndex(window.name);
                          parent.layer.close(index);
                          // 跳转
                          window.location.href = '/home/login';
                        },800);
                      }else{
                        layer.msg(res.info);
                      }
                    },'json');
                    return false;
                  });

                // 邮箱注册
                  $('#form1').submit(function(){
                    // 获取用户邮箱
                    let email = $('#email').val();
                    let upwd = $('#form1 input[name=upwd]').val();
                    let reupwd = $('#form1 input[name=reupwd]').val();
                    let email_preg = /^[\w]{3,12}@[\w]+\.[\w]+$/;
                    if(!email_preg.test(email)){
                      layer.msg('邮箱格式不正确');
                      return false;
                    }

                  // post  Ajax提交  
                    $.post('/home/register/insert',{email,upwd,reupwd},function(res){
                      if(res.msg == 'ok'){
                        layer.msg(res.info);
                        setTimeout(function(){
                          //关闭当前页面
                          window.parent.location.reload();
                          var index = parent.layer.getFrameIndex(window.name);
                          parent.layer.close(index);
                          // 跳转
                          window.location.href = '/home/login';
                        },800);
                      }else{
                        layer.msg(res.info);
                      }
                    },'json');
                    return false;
                  });
                </script>

            </div>
          </div>
        </div>
      </div>
      <div class="footer ">
        <div class="footer-hd ">
          <p>
            <a href="# ">恒望科技</a>
            <b>|</b>
            <a href="# ">商城首页</a>
            <b>|</b>
            <a href="# ">支付宝</a>
            <b>|</b>
            <a href="# ">物流</a></p>
        </div>
        <div class="footer-bd ">
          <p>
            <a href="# ">关于恒望</a>
            <a href="# ">合作伙伴</a>
            <a href="# ">联系我们</a>
            <a href="# ">网站地图</a>
            <em>© 2015-2025 Hengwang.com 版权所有</em></p>
        </div>
      </div>
  </body>

</html>