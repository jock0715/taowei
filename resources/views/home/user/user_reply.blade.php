<!DOCTYPE html>
<html>
@include('home/public/userindex')
<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
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
                  <a href="#" target="_top">免费注册</a>
                </div>
              </div>
            </ul>
            <ul class="message-r">
              <div class="topMessage home">
                <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
              </div>
              <div class="topMessage my-shangcheng">
                <div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
              </div>
              <div class="topMessage mini-cart">
                <div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
              </div>
              <div class="topMessage favorite">
                <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
            </ul>
            </div>
            <!--悬浮搜索框-->
            <div class="nav white">
              <div class="logoBig">
                <li><img src="/home/images/logobig.png" /></li>
              </div>
              <div class="search-bar pr">
                <a name="index_none_header_sysc" href="#"></a>
                <form>
                  <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                  <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                </form>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </article>
    </header>
    <div class="nav-table">
      <div class="long-title"><span class="all-goods">全部分类</span></div>
      <div class="nav-cont">
        <ul>
          <li class="index"><a href="#">首页</a></li>
          <li class="qc"><a href="#">闪购</a></li>
          <li class="qc"><a href="#">限时抢</a></li>
          <li class="qc"><a href="#">团购</a></li>
          <li class="qc last"><a href="#">大包装</a></li>
        </ul>
        <div class="nav-extra">
          <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
          <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
        </div>
      </div>
    </div>
    <b class="line"></b>
    <div class="center">
      <div class="col-main">
        <div class="main-wrap">
          <div class="user-comment">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">评价管理</strong> / <small>Manage&nbsp;Comment</small></div>
            </div>
            <hr/>
            <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>
              <ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1">所有评价</a></li>
                <li><a href="#tab2">有图评价</a></li>
              </ul>

            </div>
            <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>
              <table class="table">
                <tr>
                  <th>评论</th>
                  <th>商品</th>
                </tr>
            @foreach($data as $k=>$v)
                <tr>
                    @if($v->comment == 0)
                      <td style="height: 100px;width: 100px;">
                        <span style="color: red;font-weight: bold;display: inline-block;"><img style="width: 15px;" src="/home/images/iconfont-good.png">&nbsp;好评</span>
                        <p style="display: block;margin: -19px 0px 0px 75px;width: 300px;height: 80px;line-height: 60px;">{{ $v->content }}</p>
                        <p style="display: block;margin: -19px 0px 0px 400px;width: 150px;color: #999;line-height: 55px;">[ {{ $v->created_at }} ]</p>
                      </td>
                    @endif
                    @if($v->comment == 1)
                      <td style="height: 100px;width: 100px;">
                        <span style="color: red;font-weight: bold;display: inline-block;"><img style="width: 15px;" src="/home/images/iconfont-middle.png">&nbsp;中评</span>
                        <p style="display: block;margin: -19px 0px 0px 75px;width: 300px;height: 80px;line-height: 60px;">{{ $v->content }}</p>
                        <p style="display: block;margin: -19px 0px 0px 400px;width: 150px;color: #999;line-height: 55px;">[ {{ $v->created_at }} ]</p>
                      </td>
                    @endif
                    @if($v->comment == 2)
                      <td style="height: 100px;width: 100px;">
                        <span style="color: red;font-weight: bold;display: inline-block;"><img style="width: 15px;" src="/home/images/iconfont-badon.png">&nbsp;差评</span>
                        <p style="display: block;margin: -19px 0px 0px 75px;width: 300px;height: 80px;line-height: 60px;">{{ $v->content }}</p>
                        <p style="display: block;margin: -19px 0px 0px 400px;width: 150px;color: #999;line-height: 55px;">[ {{ $v->created_at }} ]</p>
                      </td>
                    @endif
                    <td>
                      <span style="color: red;font-weight: bold;">&nbsp;商品信息</span>
                        <p style="display: block;margin: -19px 0px 0px 75px;width: 300px;height: 80px;line-height: 60px;">{{ $v->commentorders->message }}</p>
                        <p style="display: block;margin: 0px 0px 0px 75px;width: 300px;color: #ff6600">{{ $v->commentorders->price }}&nbsp;<span style="color: #222">元</span></p>
                    </td>
                </tr>
                <tr>
                </tr>
              </table>
              @endforeach
            </div>
          </div>
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
              <a href="#">物流</a>
            </p>
          </div>
          <div class="footer-bd">
            <p>
              <a href="#">关于恒望</a>
              <a href="#">合作伙伴</a>
              <a href="#">联系我们</a>
              <a href="#">网站地图</a>
              <em>© 2015-2025 Hengwang.com 版权所有</em>
            </p>
          </div>
        </div>
      </div>
      <aside class="menu">
        @include('home/public/menu')
      </aside>
    </div>
  </body>
</html>