<!DOCTYPE html>
<html>
@include('home/public/userindex')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/layui/css/layui.css">
<script src="/layui/layui.js"></script>
  <body>
    <!--头 -->
    <header>
      <article>
        <div class="mt-logo">
          <!--顶部导航条 -->@include('home/public/userinfo')
          <!--悬浮搜索框-->
          <div class="nav white">
            <div class="logoBig">
              <li>
                <img src="/home/images/logobig.png"></li></div>
            <div class="search-bar pr">
              <a name="index_none_header_sysc" href="#"></a>
              <form>
                <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit"></form>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </article>
    </header>
    <!--头 -->
    <div class="nav-table">
      <div class="long-title">
        <span class="all-goods">全部分类</span></div>
      <div class="nav-cont">
        <ul>
          <li class="index">
            <a href="/home/#">首页</a></li>
          <li class="qc">
            <a href="/home/#">闪购</a></li>
          <li class="qc">
            <a href="/home/#">限时抢</a></li>
          <li class="qc">
            <a href="/home/#">团购</a></li>
          <li class="qc last">
            <a href="/home/#">大包装</a></li>
        </ul>
        <div class="nav-extra">
          <i class="am-icon-user-secret am-icon-md nav-user"></i>
          <b>
          </b>我的福利
          <i class="am-icon-angle-right" style="padding-left: 10px;"></i></div>
      </div>
    </div>
    <b class="line"></b>
    <div class="center">
      <div class="col-main">
        <!-- 内容 -->
        <div class="main-wrap">
          <div class="user-info">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf">
                <strong class="am-text-danger am-text-lg">个人资料</strong>/
                <small>Personal&nbsp;information</small></div>
            </div>
            <hr>
            <!--头像 -->
            <div class="user-infoPic">
              <form action="/home/user/user_file/{{ $data->userinfos->id }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="filePic">
                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp"  name="profile">
                <input type="hidden" name="old_file" value="{{ $data->userinfos->profile }}">
                <img class="am-circle am-img-thumbnail" src="/uploads/" alt="">
              </div>
                  <input class="am-btn am-btn-danger" type="submit" value="保存" style="display: inline-block; margin: 97px 0px 0px 15px;">
              </form>
              <p class="am-form-help">头像</p>
              <div class="info-m">
                <div>
                  <b>用户名：
                    <i>{{ $data->uname }}</i>
                  </b>
                </div>
                <div class="u-level">
                  <span class="rank r2">
                    <s class="vip1"></s>等&nbsp;&nbsp;&nbsp;&nbsp;级：
                    <a class="classes" href="javascript:;">@if($data->status == 1) 普通会员 @else 高级会员 @endif</a></span>
                </div>
                <div class="u-safety">
                  <a href="javascript:;">账户安全
                    <span class="u-profile">
                      <i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
                  </a>
                </div>
              </div>
            </div>
            <!--个人信息 -->
            <div class="info-main">
              <form id="form1" class="am-form am-form-horizontal" method="post">
                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">昵称</label>
                  <div class="am-form-content">
                    <input type="hidden" name="id" value="{{ $data->id }}" >
                    <input type="text" id="user-name2" value="{{ $data->userinfos->nick }}" name="nick"></div>
                </div>
                <div class="am-form-group">
                  <label for="user-name" class="am-form-label">姓名</label>
                  <div class="am-form-content">
                    <input type="text" id="user-name2" value="{{ $data->userinfos->name }}" name="name"></div>
                </div>
                <div class="am-form-group">
                  <label class="am-form-label">性别</label>
                  <select name="sex" style="width: 65px;margin-left: 14px;display: inline-block;">
                    <option value="n"
                      @if($data->userinfos->sex == 'm')
                        selected
                      @endif>男</option>
                    <option value="w"
                      @if($data->userinfos->sex == 'w')
                        selected
                      @endif>女</option>
                    <option value="x"
                      @if($data->userinfos->sex == 'x')
                        selected
                      @endif>保密</option>
                  </select>
                </div>
                <div class="am-form-group">
                  <label for="user-birth" class="am-form-label">年龄</label>
                  <div class="am-form-content">
                    <input id="user-phone" value="{{ $data->userinfos->age }}" type="tel" name="age"></div>
                </div>
                <div class="am-form-group">
                  <label for="user-phone" class="am-form-label">电话</label>
                  <div class="am-form-content">
                    <input id="user-phone" value="{{ $data->phone }}" type="tel" name="phone"></div>
                </div>
                <div class="am-form-group">
                  <label for="user-email" class="am-form-label">电子邮件</label>
                  <div class="am-form-content">
                    <input id="user-email" value="{{ $data->email }}" type="email" name="email"></div>
                </div>
                <div class="info-btn">
                  <input class="am-btn am-btn-danger" type="submit" value="保存修改">
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- 内容 -->
        <div class="footer">
          <div class="footer-hd">
            <p>
              <a href="/home/#">恒望科技</a>
              <b>|</b>
              <a href="/home/#">商城首页</a>
              <b>|</b>
              <a href="/home/#">支付宝</a>
              <b>|</b>
              <a href="/home/#">物流</a></p>
          </div>
          <div class="footer-bd">
            <p>
              <a href="/home/#">关于恒望</a>
              <a href="/home/#">合作伙伴</a>
              <a href="/home/#">联系我们</a>
              <a href="/home/#">网站地图</a>
              <em>© 2015-2025 Hengwang.com 版权所有</em></p>
          </div>
        </div>
      </div>
      <aside class="menu">@include('home/public/menu')</aside></div>
  </body>
</html>


<script>
//一般直接写在一个js文件中
  layui.use(['layer', 'form'], function(){
    var layer = layui.layer
  });
</script>

<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#form1').submit(function(){
    let id = $('#form1 input[name=id]').val();
    let nick = $('#form1 input[name=nick]').val();
    let name = $('#form1 input[name=name]').val();
    let sex = $('#form1 select').val();
    let age = $('#form1 input[name=age]').val();
    let phone = $('#form1 input[name=phone]').val();
    let phone_preg = /^[1]{1}[3-9]{1}\d{9}$/;
    let email = $('#form1 input[name=email]').val();
    let email_preg = /^[\w]{3,12}@[\w]+\.[\w]+$/;
    // 验证昵称
    if (nick.length < 3 || nick.length > 12 || name.length < 2 || name.length > 16) {
      layer.msg('昵称或姓名长度不符合');
      return false;
    }
    // 验证年龄
    if(age < 1 || age > 120){
      layer.msg('年龄不符合规范');
      return false;
    }
    // 验证年龄
    if(age < 1 || age > 120){
      layer.msg('年龄不符合规范');
      return false;
    }
    // 验证手机
    if (!phone_preg.test(phone)) {
      layer.msg('手机格式不正确');
      return false;
    }
    // 验证邮箱
    if(!email_preg.test(email)){
      layer.msg('邮箱格式不正确!');
      return false;
    }

    $.post('/home/user/user_infos',{id,nick,name,sex,age,phone,email},function(res){
      if(res.msg == 'ok'){
        layer.msg(res.info);
        setTimeout(function(){
          //关闭当前页面
          window.parent.location.reload();
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          // 跳转
          window.location.href = '/home/user/user_info';
        },800);
      }else{
        layer.msg(res.info);
      }
    },'json');
    return false;
  });
</script>