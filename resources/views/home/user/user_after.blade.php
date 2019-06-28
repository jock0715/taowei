@include('home/public/header')  
    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/refstyle.css" rel="stylesheet" type="text/css">
        <style type="text/css">
      .nav.white .logoBig img {
        width: 11%;
    }
    </style> 
    <div class="center">
      <div class="col-main">
        <!-- 内容 -->
          <div class="main-wrap">
          <!--标题 -->
          <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退换货申请</strong> / <small>Apply&nbsp;for&nbsp;returns</small></div>
          </div>
          <hr>
          <div class="comment-list">
          <!--进度条-->
          <div class="m-progress">
            <div class="m-progress-list">
              <span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">买家申请退款</p>
                            </span>
              <span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">商家处理退款申请</p>
                            </span>
              <span class="step-3 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                <p class="stage-name">款项成功退回</p>
                            </span>                            
              <span class="u-progress-placeholder"></span>
            </div>
            <div class="u-progress-bar total-steps-2">
              <div class="u-progress-bar-inner"></div>
            </div>
          </div>
          
          
            <div class="refund-aside">
              <div class="item-pic">
                <a href="#" class="J_MakePoint">
                  <img src="images/comment.jpg_400x400.jpg" class="itempic">
                </a>
              </div>

              <div class="item-title">

                <div class="item-name">
                  <a href="#">
                    <p class="item-basic-info">美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
                  </a>
                </div>
                <div class="info-little">
                  <span>颜色：洛阳牡丹</span>
                  <span>包装：裸装</span>
                </div>
              </div>
              <div class="item-info">
                <div class="item-ordernumber">
                  <span class="info-title">订单编号：</span><a>1474784641639947</a>
                </div>
                <div class="item-price">
                  <span class="info-title">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</span><span class="price">19.88元</span>
                  <span class="number">×1</span><span class="item-title">(数量)</span>
                </div>
                <div class="item-amount">
                  <span class="info-title">小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</span><span class="amount">19.88元</span>
                </div>
                <div class="item-pay-logis">
                  <span class="info-title">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</span><span class="price">10.00元</span>
                </div>
                <div class="item-amountall">
                  <span class="info-title">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</span><span class="amountall">29.88元</span>
                </div>
                <div class="item-time">
                  <span class="info-title">成交时间：</span><span class="time">2015-12-12&nbsp;17:07</span>
                </div>

              </div>
              <div class="clear"></div>
            </div>

            <div class="refund-main">
              <div class="item-comment">
                <div class="am-form-group">
                  <label for="refund-type" class="am-form-label">退款类型</label>
                  <div class="am-form-content">
                    <select data-am-selected="" style="display: none;">
                      <option value="a" selected="">仅退款</option>
                      <option value="b">退款/退货</option>
                    </select><div class="am-selected am-dropdown " id="am-selected-86xky" data-am-dropdown="">  <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">    <span class="am-selected-status am-fl">仅退款</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li class="am-checked" data-index="0" data-group="0" data-value="a">         <span class="am-selected-text">仅退款</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="1" data-group="0" data-value="b">         <span class="am-selected-text">退款/退货</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
                  </div>
                </div>
                
                <div class="am-form-group">
                  <label for="refund-reason" class="am-form-label">退款原因</label>
                  <div class="am-form-content">
                    <select data-am-selected="" style="display: none;">
                      <option value="a" selected="">请选择退款原因</option>
                      <option value="b">不想要了</option>
                      <option value="c">买错了</option>
                      <option value="d">没收到货</option>                     
                      <option value="e">与说明不符</option>
                    </select><div class="am-selected am-dropdown " id="am-selected-uuyk4" data-am-dropdown="">  <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">    <span class="am-selected-status am-fl">请选择退款原因</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li class="am-checked" data-index="0" data-group="0" data-value="a">         <span class="am-selected-text">请选择退款原因</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="1" data-group="0" data-value="b">         <span class="am-selected-text">不想要了</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="2" data-group="0" data-value="c">         <span class="am-selected-text">买错了</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="3" data-group="0" data-value="d">         <span class="am-selected-text">没收到货</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="4" data-group="0" data-value="e">         <span class="am-selected-text">与说明不符</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
                  </div>
                </div>

                <div class="am-form-group">
                  <label for="refund-money" class="am-form-label">退款金额<span>（不可修改）</span></label>
                  <div class="am-form-content">
                    <input type="text" id="refund-money" readonly="readonly" placeholder="19.88">
                  </div>
                </div>
                <div class="am-form-group">
                  <label for="refund-info" class="am-form-label">退款说明<span>（可不填）</span></label>
                  <div class="am-form-content">
                    <textarea placeholder="请输入退款说明"></textarea>
                  </div>
                </div>

              </div>
              <div class="refund-tip">
                <div class="filePic">
                  <input type="file" class="inputPic" value="选择凭证图片" name="file" max="5" maxsize="5120" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                  <img src="images/image.jpg" alt="">
                </div>
                <span class="desc">上传凭证&nbsp;最多三张</span>
              </div>
              <div class="info-btn">
                <div class="am-btn am-btn-danger">提交申请</div>
              </div>
            </div>
          </div>
          <div class="clear"></div>
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