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
          <div class="user-address">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf">
                <strong class="am-text-danger am-text-lg">地址管理</strong>/
                <small>Address&nbsp;list</small></div>
            </div>
            <hr>
            <ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
              <li class="user-addresslist defaultAddr">
                <span class="new-option-r">
                  <i class="am-icon-check-circle"></i>默认地址</span>
                <p class="new-tit new-p-re">
                  <span class="new-txt">小叮当</span>
                  <span class="new-txt-rd2">159****1622</span></p>
                <div class="new-mu_l2a new-p-re">
                  <p class="new-mu_l2cw">
                    <span class="title">地址：</span>
                    <span class="province">湖北</span>省
                    <span class="city">武汉</span>市
                    <span class="dist">洪山</span>区
                    <span class="street">雄楚大道666号(中南财经政法大学)</span></p>
                </div>
                <div class="new-addr-btn">
                  <a href="#">
                    <i class="am-icon-edit"></i>编辑</a>
                  <span class="new-addr-bar">|</span>
                  <a href="javascript:void(0);" onclick="delClick(this);">
                    <i class="am-icon-trash"></i>删除</a>
                </div>
              </li>
              <li class="user-addresslist">
                <span class="new-option-r">
                  <i class="am-icon-check-circle"></i>设为默认</span>
                <p class="new-tit new-p-re">
                  <span class="new-txt">小叮当</span>
                  <span class="new-txt-rd2">159****1622</span></p>
                <div class="new-mu_l2a new-p-re">
                  <p class="new-mu_l2cw">
                    <span class="title">地址：</span>
                    <span class="province">湖北</span>省
                    <span class="city">武汉</span>市
                    <span class="dist">洪山</span>区
                    <span class="street">雄楚大道666号(中南财经政法大学)</span></p>
                </div>
                <div class="new-addr-btn">
                  <a href="#">
                    <i class="am-icon-edit"></i>编辑</a>
                  <span class="new-addr-bar">|</span>
                  <a href="javascript:void(0);" onclick="delClick(this);">
                    <i class="am-icon-trash"></i>删除</a>
                </div>
              </li>
              <li class="user-addresslist">
                <span class="new-option-r">
                  <i class="am-icon-check-circle"></i>设为默认</span>
                <p class="new-tit new-p-re">
                  <span class="new-txt">小叮当</span>
                  <span class="new-txt-rd2">159****1622</span></p>
                <div class="new-mu_l2a new-p-re">
                  <p class="new-mu_l2cw">
                    <span class="title">地址：</span>
                    <span class="province">湖北</span>省
                    <span class="city">武汉</span>市
                    <span class="dist">洪山</span>区
                    <span class="street">雄楚大道666号(中南财经政法大学)</span></p>
                </div>
                <div class="new-addr-btn">
                  <a href="#">
                    <i class="am-icon-edit"></i>编辑</a>
                  <span class="new-addr-bar">|</span>
                  <a href="javascript:void(0);" onclick="delClick(this);">
                    <i class="am-icon-trash"></i>删除</a>
                </div>
              </li>
            </ul>
            <div class="clear"></div>
            <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
            <!--例子-->
            <div class="" id="doc-modal-1">
              <div class="add-dress">
                <!--标题 -->
                <div class="am-cf am-padding">
                  <div class="am-fl am-cf">
                    <strong class="am-text-danger am-text-lg">新增地址</strong>/
                    <small>Add&nbsp;address</small></div>
                </div>
                <hr>
                <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                  <form class="am-form am-form-horizontal">
                    <div class="am-form-group">
                      <label for="user-name" class="am-form-label">收货人</label>
                      <div class="am-form-content">
                        <input type="text" id="user-name" placeholder="收货人"></div>
                    </div>
                    <div class="am-form-group">
                      <label for="user-phone" class="am-form-label">手机号码</label>
                      <div class="am-form-content">
                        <input id="user-phone" placeholder="手机号必填" type="email"></div>
                    </div>
                    <div class="am-form-group">
                      <label for="user-address" class="am-form-label">所在地</label>
                      <div class="am-form-content address">
                        <select data-am-selected="" style="display: none;">
                          <option value="a">浙江省</option>
                          <option value="b" selected="">湖北省</option></select>
                        <div class="am-selected am-dropdown " id="am-selected-00a9n" data-am-dropdown="">
                          <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">
                            <span class="am-selected-status am-fl">湖北省</span>
                            <i class="am-selected-icon am-icon-caret-down"></i>
                          </button>
                          <div class="am-selected-content am-dropdown-content">
                            <h2 class="am-selected-header">
                              <span class="am-icon-chevron-left">返回</span></h2>
                            <ul class="am-selected-list">
                              <li class="" data-index="0" data-group="0" data-value="a">
                                <span class="am-selected-text">浙江省</span>
                                <i class="am-icon-check"></i>
                              </li>
                              <li class="am-checked" data-index="1" data-group="0" data-value="b">
                                <span class="am-selected-text">湖北省</span>
                                <i class="am-icon-check"></i>
                              </li>
                            </ul>
                            <div class="am-selected-hint"></div>
                          </div>
                        </div>
                        <select data-am-selected="" style="display: none;">
                          <option value="a">温州市</option>
                          <option value="b" selected="">武汉市</option></select>
                        <div class="am-selected am-dropdown " id="am-selected-c6svr" data-am-dropdown="">
                          <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">
                            <span class="am-selected-status am-fl">武汉市</span>
                            <i class="am-selected-icon am-icon-caret-down"></i>
                          </button>
                          <div class="am-selected-content am-dropdown-content">
                            <h2 class="am-selected-header">
                              <span class="am-icon-chevron-left">返回</span></h2>
                            <ul class="am-selected-list">
                              <li class="" data-index="0" data-group="0" data-value="a">
                                <span class="am-selected-text">温州市</span>
                                <i class="am-icon-check"></i>
                              </li>
                              <li class="am-checked" data-index="1" data-group="0" data-value="b">
                                <span class="am-selected-text">武汉市</span>
                                <i class="am-icon-check"></i>
                              </li>
                            </ul>
                            <div class="am-selected-hint"></div>
                          </div>
                        </div>
                        <select data-am-selected="" style="display: none;">
                          <option value="a">瑞安区</option>
                          <option value="b" selected="">洪山区</option></select>
                        <div class="am-selected am-dropdown " id="am-selected-b50yn" data-am-dropdown="">
                          <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">
                            <span class="am-selected-status am-fl">洪山区</span>
                            <i class="am-selected-icon am-icon-caret-down"></i>
                          </button>
                          <div class="am-selected-content am-dropdown-content">
                            <h2 class="am-selected-header">
                              <span class="am-icon-chevron-left">返回</span></h2>
                            <ul class="am-selected-list">
                              <li class="" data-index="0" data-group="0" data-value="a">
                                <span class="am-selected-text">瑞安区</span>
                                <i class="am-icon-check"></i>
                              </li>
                              <li class="am-checked" data-index="1" data-group="0" data-value="b">
                                <span class="am-selected-text">洪山区</span>
                                <i class="am-icon-check"></i>
                              </li>
                            </ul>
                            <div class="am-selected-hint"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="user-intro" class="am-form-label">详细地址</label>
                      <div class="am-form-content">
                        <textarea class="" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
                        <small>100字以内写出你的详细地址...</small></div>
                    </div>
                    <div class="am-form-group">
                      <div class="am-u-sm-9 am-u-sm-push-3">
                        <a class="am-btn am-btn-danger">保存</a>
                        <a href="javascript: void(0)" class="am-close am-btn am-btn-danger" data-am-modal-close="">取消</a></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">$(document).ready(function() {
              $(".new-option-r").click(function() {
                $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
              });

              var $ww = $(window).width();
              if ($ww > 640) {
                $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
              }

            })</script>
          <div class="clear"></div>
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