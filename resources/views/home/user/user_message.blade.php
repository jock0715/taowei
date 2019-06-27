<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    <title>个人中心</title>
    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/systyle.css" rel="stylesheet" type="text/css"></head>
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

        <!-- 内容 -->
        @include('home/public/footer')
      </div>
      <aside class="menu">
        <ul>
          <li class="person active">
            <a href="/home/user/user_index">个人中心</a></li>
          <li class="person">
            <a href="javascript:;">个人资料</a>
            <ul>
              <li>
                <a href="/home/user/user_info">个人信息</a></li>
              <li>
                <a href="/home/user/user_security">安全设置</a></li>
              <li>
                <a href="/home/user/user_addr">收货地址</a></li>
            </ul>
          </li>
          <li class="person">
            <a href="javascript:;">我的交易</a>
            <ul>
              <li>
                <a href="/home/user/user_orders">订单管理</a></li>
              <li>
                <a href="/home/user/user_after">退款售后</a></li>
            </ul>
          </li>
          <li class="person">
            <a href="javascript:;">我的资产</a>
            <ul>
              <li>
                <a href="/home/user/user_bill">账单明细</a></li>
            </ul>
          </li>
          <li class="person">
            <a href="javascript:;">我的小窝</a>
            <ul>
              <li>
                <a href="/home/user/user_collection">收藏</a></li>
              <li>
                <a href="/home/user/user_foot">足迹</a></li>
              <li>
                <a href="/home/user/user_reply">评价</a></li>
              <li>
                <a href="javascript:;">消息</a></li>
            </ul>
          </li>
        </ul>
      </aside>
    </div>
    <!--引导 -->
<!--     <div class="navCir">
      <li>
        <a href="/home/home/home.html">
          <i class="am-icon-home "></i>首页</a>
      </li>
      <li>
        <a href="/home/home/sort.html">
          <i class="am-icon-list"></i>分类</a>
      </li>
      <li>
        <a href="/home/home/shopcart.html">
          <i class="am-icon-shopping-basket"></i>购物车</a>
      </li>
      <li class="active">
        <a href="/home/index.html">
          <i class="am-icon-user"></i>我的</a>
      </li>
    </div> -->
  </body>

</html>