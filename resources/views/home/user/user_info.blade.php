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

          <div class="user-info">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
            </div>
            <hr>

            <!--头像 -->
            <div class="user-infoPic">

              <div class="filePic">
                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                <img class="am-circle am-img-thumbnail" src="/home/images/getAvatar.do.jpg" alt="">
              </div>

              <p class="am-form-help">头像</p>

              <div class="info-m">
                <div><b>用户名：<i>{{ $data->uname }}</i></b></div>
                <div class="u-level">
                  <span class="rank r2">
                           <s class="vip1"></s><a class="classes" href="#">
                             @if($data->status == 1)
                              普通会员
                             @else
                              高级会员
                             @endif
                           </a>
                        </span>
                </div>
                <div class="u-safety">
                  <a href="safety.html">
                   账户安全
                  <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
                  </a>
                </div>
              </div>
            </div>

            <!--个人信息 -->
            <div class="info-main">
              <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">昵称</label>
                  <div class="am-form-content">
                    <input type="text" id="user-name2" value="{{ $data->userinfos->nick }}">
                  </div>
                </div>

                <div class="am-form-group">
                  <label for="user-name" class="am-form-label">姓名</label>
                  <div class="am-form-content">
                    <input type="text" id="user-name2" value="{{ $data->userinfos->name }}">
                  </div>
                </div>

                <div class="am-form-group">
                  <label class="am-form-label">性别</label>
                  <div class="am-form-content sex">
                    <label class="am-radio-inline">
                      <input type="radio" name="radio10" value="male" data-am-ucheck="" class="am-ucheck-radio" 
                        @if($data->userinfos->sex == 'm')
                          checked
                        @endif
                      ><span class="am-ucheck-icons"><i class="am-icon-unchecked"></i><i class="am-icon-checked"></i></span> 男
                    </label>
                    <label class="am-radio-inline">
                      <input type="radio" name="radio10" value="female" data-am-ucheck="" class="am-ucheck-radio"
                        @if($data->userinfos->sex == 'w')
                          checked
                        @endif
                      ><span class="am-ucheck-icons"><i class="am-icon-unchecked"></i><i class="am-icon-checked"></i></span> 女
                    </label>
                    <label class="am-radio-inline">
                      <input type="radio" name="radio10" value="secret" data-am-ucheck="" class="am-ucheck-radio"
                        @if($data->userinfos->sex == 'x')
                          checked
                        @endif
                      ><span class="am-ucheck-icons"><i class="am-icon-unchecked"></i><i class="am-icon-checked"></i></span> 保密
                    </label>
                  </div>
                </div>

                <div class="am-form-group">
                  <label for="user-birth" class="am-form-label">年龄</label>
<!--                   <div class="am-form-content birth">
                    <div class="birth-select">
                      <select data-am-selected="" style="display: none;">
                        <option value="a">2015</option>
                        <option value="b">1987</option>
                      </select><div class="am-selected am-dropdown " id="am-selected-51g9p" data-am-dropdown="">  <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">    <span class="am-selected-status am-fl">2015</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li class="am-checked" data-index="0" data-group="0" data-value="a">         <span class="am-selected-text">2015</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="1" data-group="0" data-value="b">         <span class="am-selected-text">1987</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
                      <em>年</em>
                    </div>
                    <div class="birth-select2">
                      <select data-am-selected="" style="display: none;">
                        <option value="a">12</option>
                        <option value="b">8</option>
                      </select><div class="am-selected am-dropdown " id="am-selected-ss4uz" data-am-dropdown="">  <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">    <span class="am-selected-status am-fl">12</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li class="am-checked" data-index="0" data-group="0" data-value="a">         <span class="am-selected-text">12</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="1" data-group="0" data-value="b">         <span class="am-selected-text">8</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
                      <em>月</em></div>
                    <div class="birth-select2">
                      <select data-am-selected="" style="display: none;">
                        <option value="a">21</option>
                        <option value="b">23</option>
                      </select><div class="am-selected am-dropdown " id="am-selected-8t0re" data-am-dropdown="">  <button type="button" class="am-selected-btn am-btn am-dropdown-toggle am-btn-default">    <span class="am-selected-status am-fl">21</span>    <i class="am-selected-icon am-icon-caret-down"></i>  </button>  <div class="am-selected-content am-dropdown-content">    <h2 class="am-selected-header"><span class="am-icon-chevron-left">返回</span></h2>       <ul class="am-selected-list">                     <li class="am-checked" data-index="0" data-group="0" data-value="a">         <span class="am-selected-text">21</span>         <i class="am-icon-check"></i></li>                                 <li class="" data-index="1" data-group="0" data-value="b">         <span class="am-selected-text">23</span>         <i class="am-icon-check"></i></li>            </ul>    <div class="am-selected-hint"></div>  </div></div>
                      <em>日</em></div>
                  </div> -->
                  <div class="am-form-content">
                    <input id="user-phone" value="{{ $data->userinfos->age }}" type="tel">
                  </div>
                </div>
                <div class="am-form-group">
                  <label for="user-phone" class="am-form-label">电话</label>
                  <div class="am-form-content">
                    <input id="user-phone" value="{{ $data->phone }}" type="tel">
                  </div>
                </div>
                <div class="am-form-group">
                  <label for="user-email" class="am-form-label">电子邮件</label>
                  <div class="am-form-content">
                    <input id="user-email" value="{{ $data->email }}" type="email">
                  </div>
                </div>
                <div class="am-form-group address">
                  <label for="user-address" class="am-form-label">收货地址</label>
                  <div class="am-form-content address">
                    <a href="address.html">
                      <p class="new-mu_l2cw">
                        <span class="province">湖北</span>省
                        <span class="city">武汉</span>市
                        <span class="dist">洪山</span>区
                        <span class="street">雄楚大道666号(中南财经政法大学)</span>
                        <span class="am-icon-angle-right"></span>
                      </p>
                    </a>
                  </div>
                </div>
                <div class="am-form-group safety">
                  <label for="user-safety" class="am-form-label">账号安全</label>
                  <div class="am-form-content safety">
                    <a href="safety.html">
                      <span class="am-icon-angle-right"></span>
                    </a>
                  </div>
                </div>
                <div class="info-btn">
                  <div class="am-btn am-btn-danger">保存修改</div>
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
      <aside class="menu">
        @include('home/public/menu')
      </aside>
    </div>
  </body>
</html>