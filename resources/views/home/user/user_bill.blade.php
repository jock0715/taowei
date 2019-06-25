<!DOCTYPE html>
<html>
@include('home/public/userindex')
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
          <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">账单明细</strong> / <small>Electronic&nbsp;bill</small></div>
          </div>
          <hr>

          <!--交易时间  -->

          <div class="order-time">
            <label class="form-label">交易时间：</label>
            <div class="show-input">
              <select class="am-selected" data-am-selected="" style="display: none;">
                <option value="today">今天</option>
                <option value="sevenDays" selected="">最近一周</option>
                <option value="oneMonth">最近一个月</option>
                <option value="threeMonths">最近三个月</option>
                <option class="date-trigger">自定义时间</option>
              </select><div class="am-selected am-dropdown" id="am-selected-kgker" data-am-dropdown="">  <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">    <span class="am-selected-status am-fl">最近一周</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content" style="min-width: 200px;">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li class="" data-index="0" data-group="0" data-value="today">         <span class="am-selected-text">今天</span>         <i class="am-icon-check"></i></li>                                 <li class="am-checked" data-index="1" data-group="0" data-value="sevenDays">         <span class="am-selected-text">最近一周</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="2" data-group="0" data-value="oneMonth">         <span class="am-selected-text">最近一个月</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="3" data-group="0" data-value="threeMonths">         <span class="am-selected-text">最近三个月</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="4" data-group="0" data-value="自定义时间">         <span class="am-selected-text">自定义时间</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
            </div>
                          <div class="clear"></div>
          </div>

          <table width="100%">

            <thead>
              <tr>
                <th class="memo"></th>
                <th class="time">创建时间</th>
                <th class="name">名称</th>
                <th class="amount">金额</th>
                <th class="action">操作</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td class="img">
                  <i><img src="images/songzi.jpg"></i>
                </td>
                <td class="time">
                  <p> 2016-01-28
                  </p>
                  <p class="text-muted"> 10:58
                  </p>
                </td>
                <td class="title name">
                  <p class="content">
                    良品铺子精选松子，即开即食全国包邮
                  </p>
                </td>

                <td class="amount">
                  <span class="amount-pay">- 11.90</span>
                </td>
                <td class="operation">
                  删除
                </td>
              </tr>

              <tr>

                <td class="img">
                  <i><img src="images/songzi.jpg"></i>
                </td>
                <td class="time">
                  <p> 2016-01-28
                  </p>
                  <p class="text-muted"> 10:58
                  </p>
                </td>
                <td class="title name">
                  <p class="content">
                    良品铺子精选松子，即开即食全国包邮
                  </p>
                </td>

                <td class="amount">
                  <span class="amount-pay">- 11.90</span>
                </td>
                <td class="operation">
                  删除
                </td>
              </tr>
            </tbody>
          </table>
        
          <script type="text/javascript">
            $(document).ready(function() {
              $(".date-trigger").click(function() {
                $(".show-input").css("display", "none");
              });
              
             })
          </script>         
          
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
      <aside class="menu">
        @include('home/public/menu')
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