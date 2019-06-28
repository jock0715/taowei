    @include('home/public/header')
    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/bilstyle.css" rel="stylesheet" type="text/css">

    <style type="text/css">
      .nav.white .logoBig img {
        width: 11%;
    }
    </style>
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
      @include('home/public/footer')
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