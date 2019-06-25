<!DOCTYPE html>
<html>@include('home/public/userindex')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/layui/css/layui.css">
<script src="/layui/layui.js"></script>
  <body>
    <!--头 -->
    <header>
      <article>
        <div class="mt-logo">
          <!--顶部导航条 -->
          <div class="am-container header">
            <ul class="message-l">
              <div class="topMessage">
                <div class="menu-hd">
                  <a href="#" target="_top" class="h">亲，请登录</a>
                  <a href="#" target="_top">免费注册</a></div>
              </div>
            </ul>
            <ul class="message-r">
              <div class="topMessage home">
                <div class="menu-hd">
                  <a href="#" target="_top" class="h">商城首页</a></div>
              </div>
              <div class="topMessage my-shangcheng">
                <div class="menu-hd MyShangcheng">
                  <a href="#" target="_top">
                    <i class="am-icon-user am-icon-fw"></i>个人中心</a>
                </div>
              </div>
              <div class="topMessage mini-cart">
                <div class="menu-hd">
                  <a id="mc-menu-hd" href="#" target="_top">
                    <i class="am-icon-shopping-cart  am-icon-fw"></i>
                    <span>购物车</span>
                    <strong id="J_MiniCartNum" class="h">0</strong></a>
                </div>
              </div>
              <div class="topMessage favorite">
                <div class="menu-hd">
                  <a href="#" target="_top">
                    <i class="am-icon-heart am-icon-fw"></i>
                    <span>收藏夹</span></a>
                </div>
            </ul>
            </div>
            <!--悬浮搜索框-->
            <div class="nav white">
              <div class="logoBig">
                <li>
                  <img src="/home/images/logobig.png" /></li>
              </div>
              <div class="search-bar pr">
                <a name="index_none_header_sysc" href="#"></a>
                <form>
                  <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                  <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit"></form>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </article>
    </header>
    <div class="nav-table">
      <div class="long-title">
        <span class="all-goods">全部分类</span></div>
      <div class="nav-cont">
        <ul>
          <li class="index">
            <a href="#">首页</a></li>
          <li class="qc">
            <a href="#">闪购</a></li>
          <li class="qc">
            <a href="#">限时抢</a></li>
          <li class="qc">
            <a href="#">团购</a></li>
          <li class="qc last">
            <a href="#">大包装</a></li>
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
        <div class="main-wrap container">
          <div class="am-cf am-padding">
            <div class="am-fl am-cf">
              <strong class="am-text-danger am-text-lg">修改密码</strong>/
              <small>Password</small></div>
          </div>
          <hr>
          <!--进度条-->
          <div class="m-progress">
            <div class="m-progress-list">
              <span class="step-1 step">
                <em class="u-progress-stage-bg"></em>
                <i class="u-stage-icon-inner">1
                  <em class="bg"></em></i>
                <p class="stage-name">重置密码</p></span>
              <span class="step-2 step">
                <em class="u-progress-stage-bg"></em>
                <i class="u-stage-icon-inner">2
                  <em class="bg"></em></i>
                <p class="stage-name">完成</p></span>
              <span class="u-progress-placeholder"></span>
            </div>
            <div class="u-progress-bar total-steps-2">
              <div class="u-progress-bar-inner"></div>
            </div>
          </div>
          <form id="form1" class="am-form am-form-horizontal">
            <div class="am-form-group">
              <label for="user-old-password" class="am-form-label">原密码</label>
              <div class="am-form-content">
                <input type="password" id="user-old-password" name="upwd" style="width: 600px;"></div>
                <input type="hidden" name="id" value="{{ session('home_data')->id }}">
            </div>
            <div class="am-form-group">
              <label for="user-new-password" class="am-form-label">新密码</label>
              <div class="am-form-content">
                <input type="password" id="user-new-password" name="reupwd1" style="width: 600px;"></div>
            </div>
            <div class="am-form-group">
              <label for="user-confirm-password" class="am-form-label">确认密码</label>
              <div class="am-form-content">
                <input type="password" id="user-confirm-password" name="reupwd2" style="width: 600px;"></div>
            </div>
            <div class="info-btn">
              <button class="am-btn am-btn-danger" type="submit" style="display: inline-block;margin-left: -450px;">保存修改</button></div>
          </form>
        </div>
        <!--底部-->
        <div class="footer">
          <div class="footer-hd">
            <p>
              <a href="#">恒望科技</a>
              <b>|</b>
              <a href="#">商城首页</a>
              <b>|</b>
              <a href="#">支付宝</a>
              <b>|</b>
              <a href="#">物流</a></p>
          </div>
          <div class="footer-bd">
            <p>
              <a href="#">关于恒望</a>
              <a href="#">合作伙伴</a>
              <a href="#">联系我们</a>
              <a href="#">网站地图</a>
              <em>© 2015-2025 Hengwang.com 版权所有</em></p>
          </div>
        </div>
      </div>
      <aside class="menu">@include('home/public/menu')</aside></div>
  </body>
</html>
<script type="text/javascript">
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
    let upwd = $('#form1 input[name=upwd]').val();
    let reupwd1 = $('#form1 input[name=reupwd1]').val();
    let reupwd2 = $('#form1 input[name=reupwd2]').val();

    // 数据验证
    if(upwd.length == 0){
            layer.msg("密码不能为空");
            return false;
    }
    if(reupwd1.length<6 && reupwd1.length<6){
      layer.msg('新密码不能少于6位');
      return false;
    }
    
    //验证密码
    if(reupwd1 != reupwd2){
      layer.msg('密码不一致');
      return false
    }

    $.post('/home/user/user_upwds',{id,upwd,reupwd1},function(res){
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