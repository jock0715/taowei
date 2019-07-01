<!DOCTYPE html>
<html>
  <head lang="en">
    <meta charset="UTF-8">
    <title>登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/home_login/AmazeUI-2.4.2/assets/css/amazeui.css" />
    <link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="/home_login/css/dlstyle.css" rel="stylesheet" type="text/css"></head>
  <body style="background-color: #fff;">
    <div class="login-boxtitle">
      <a href="home.html">
        <img style="width: 100px" alt="logo" src="/admin/images/logo.png" /></a>
    </div>
    <div class="login-banner">
      <div class="login-main">
        <div class="login-banner-bg">
          <span></span>
          <img src="/home_login/images/big.jpg" /></div>
        <div class="login-box">
          <h3 class="title">登录商城</h3>
          <div class="clear"></div>
          <div class="login-form">
            <form action="/home/login/dologin" method="post">
              {{csrf_field()}}
              <div class="user-name">
                <label for="user">
                  <i class="am-icon-user"></i>
                </label>
                <input type="text" name="all" id="user" placeholder="邮箱/手机/用户名"></div>
              <div class="user-pass">
                <label for="password">
                  <i class="am-icon-lock"></i>
                </label>
                <input type="password" name="upwd" id="password" placeholder="请输入密码" value="123456"></div>
                <div class="am-cf">
                  <input type="submit"  value="登 录" class="am-btn am-btn-primary am-btn-sm">
                </div>
            </form>
          </div>
          <div class="login-links">
            <label for="remember-me">
              <input id="remember-me" type="checkbox">记住密码</label>
            <a href="#" class="am-fr">忘记密码</a>
            <a href="/home/register" class="zcnext am-fr am-btn-default">注册</a>
            <br /></div>

          <div class="partner">
            <h3>合作账号</h3>
            <div class="am-btn-group">
              <li>
                <a href="/">
                  <i class="glyphicon glyphicon-gift"></i>
                  <span>商城首页</span></a>
              </li>
            </div>
          </div>
          <div>@include('home/public/message')</div>
        </div>
      </div>
    </div>
    @include('home/public/footer')
  </body>

</html>