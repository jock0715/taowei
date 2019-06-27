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

          <div class="user-collection">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
            </div>
            <hr>

            <div class="you-like">
              <div class="s-bar">
                我的收藏
                <a class="am-badge am-badge-danger am-round">降价</a>
                <a class="am-badge am-badge-danger am-round">下架</a>
              </div>
              <div class="s-content">
                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="#" class="s-pic-link">
                        <img src="/home/images/0-item_pic.jpg_220x220.jpg" alt="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" class="s-pic-img s-guess-item-img">
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title"><a href="#" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰">包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰</a></div>
                      <div class="s-price-box">
                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">42.50</em></span>
                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">68.00</em></span>
                      </div>
                      <div class="s-extra-box">
                        <span class="s-comment">好评: 98.03%</span>
                        <span class="s-sales">月销: 219</span>
                      </div>
                    </div>
                    <div class="s-tp">
                      <span class="ui-btn-loading-before">找相似</span>
                      <i class="am-icon-shopping-cart"></i>
                      <span class="ui-btn-loading-before buy">加入购物车</span>
                      <p>
                        <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="#" class="s-pic-link">
                        <img src="/home/images/1-item_pic.jpg_220x220.jpg" alt="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" class="s-pic-img s-guess-item-img">
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title"><a href="#" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰">s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰</a></div>
                      <div class="s-price-box">
                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">49.90</em></span>
                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">88.00</em></span>
                      </div>
                      <div class="s-extra-box">
                        <span class="s-comment">好评: 99.74%</span>
                        <span class="s-sales">月销: 69</span>
                      </div>
                    </div>
                    <div class="s-tp">
                      <span class="ui-btn-loading-before">找相似</span>
                      <i class="am-icon-shopping-cart"></i>
                      <span class="ui-btn-loading-before buy">加入购物车</span>
                      <p>
                        <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="#" class="s-pic-link">
                        <img src="/home/images/-0-saturn_solar.jpg_220x220.jpg" alt="4折抢购!十二生肖925银女戒指,时尚开口女戒" title="4折抢购!十二生肖925银女戒指,时尚开口女戒" class="s-pic-img s-guess-item-img">
                      <span class="tip-title">已下架</span>
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title"><a href="#" title="4折抢购!十二生肖925银女戒指,时尚开口女戒">4折抢购!十二生肖925银女戒指,时尚开口女戒</a></div>
                      <div class="s-price-box">
                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">378.00</em></span>
                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">1888.00</em></span>
                      </div>
                      <div class="s-extra-box">
                        <span class="s-comment">好评: 99.93%</span>
                        <span class="s-sales">月销: 278</span>
                      </div>
                    </div>
                    <div class="s-tp">
                      <span class="ui-btn-loading-before">找相似</span>
                      <i class="am-icon-trash"></i>
                      <span class="ui-btn-loading-before buy">进入店铺</span>
                      <p>
                        <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="#" class="s-pic-link">
                        <img src="/home/images/0-item_pic.jpg_220x220.jpg" alt="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" class="s-pic-img s-guess-item-img">
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title"><a href="#" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰">包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰</a></div>
                      <div class="s-price-box">
                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">42.50</em></span>
                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">68.00</em></span>
                      </div>
                      <div class="s-extra-box">
                        <span class="s-comment">好评: 98.03%</span>
                        <span class="s-sales">月销: 219</span>
                      </div>
                    </div>
                    <div class="s-tp">
                      <span class="ui-btn-loading-before">找相似</span>
                      <i class="am-icon-shopping-cart"></i>
                      <span class="ui-btn-loading-before buy">加入购物车</span>
                      <p>
                        <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                      </p>
                    </div>                    
                  </div>
                </div>

                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="#" class="s-pic-link">
                        <img src="/home/images/1-item_pic.jpg_220x220.jpg" alt="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰" class="s-pic-img s-guess-item-img">
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title"><a href="#" title="s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰">s925纯银千纸鹤锁骨链短款简约时尚韩版素银项链小清新秋款女配饰</a></div>
                      <div class="s-price-box">
                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">49.90</em></span>
                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">88.00</em></span>
                      </div>
                      <div class="s-extra-box">
                        <span class="s-comment">好评: 99.74%</span>
                        <span class="s-sales">月销: 69</span>
                      </div>
                    </div>
                    <div class="s-tp">
                      <span class="ui-btn-loading-before">找相似</span>
                      <i class="am-icon-shopping-cart"></i>
                      <span class="ui-btn-loading-before buy">加入购物车</span>
                      <p>
                        <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="#" class="s-pic-link">
                        <img src="/home/images/-0-saturn_solar.jpg_220x220.jpg" alt="4折抢购!十二生肖925银女戒指,时尚开口女戒" title="4折抢购!十二生肖925银女戒指,时尚开口女戒" class="s-pic-img s-guess-item-img">
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title"><a href="#" title="4折抢购!十二生肖925银女戒指,时尚开口女戒">4折抢购!十二生肖925银女戒指,时尚开口女戒</a></div>
                      <div class="s-price-box">
                        <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">378.00</em></span>
                        <span class="s-history-price"><em class="s-price-sign">¥</em><em class="s-value">1888.00</em></span>
                      </div>
                      <div class="s-extra-box">
                        <span class="s-comment">好评: 99.93%</span>
                        <span class="s-sales">月销: 278</span>
                      </div>
                    </div>
                    <div class="s-tp">
                      <span class="ui-btn-loading-before">找相似</span>
                      <i class="am-icon-shopping-cart"></i>
                      <span class="ui-btn-loading-before buy">加入购物车</span>
                      <p>
                        <a href="javascript:;" class="c-nodo J_delFav_btn">取消收藏</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div>
            </div>
          </div>
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