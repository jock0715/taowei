@include('home/public/header')

    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/appstyle.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/home/js/jquery-1.7.2.min.js"></script>
    <style>
      .nav.white .logoBig img {
          width: 11%;
      }
    </style>
    <div class="center">
      <div class="col-main">
        <div class="main-wrap">

          <div class="user-comment">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
            </div>
            <hr/>

            <div class="comment-main">
              <div class="comment-list">
                <div class="item-pic">
                  <a href="#" class="J_MakePoint">
                    <img src="/home/images/comment.jpg_400x400.jpg" class="itempic">
                  </a>
                </div>

                <div class="item-title">

                  <div class="item-name">
                    <a href="#">
                      <p class="item-basic-info">美康粉黛醉美唇膏 持久保湿滋润防水不掉色</p>
                    </a>
                  </div>
                  <div class="item-info">
                    <div class="info-little">
                      <span>颜色：洛阳牡丹</span>
                      <span>包装：裸装</span>
                    </div>
                    <div class="item-price">
                      价格：<strong>19.88元</strong>
                    </div>                    
                  </div>
                </div>
                <div class="clear"></div>
                <div class="item-comment">
                  <textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！"></textarea>
                </div>
                <div class="filePic">
                  <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" >
                  <span>晒照片(0/5)</span>
                  <img src="/home/images/image.jpg" alt="">
                </div>
                <div class="item-opinion">
                  <li><i class="op1"></i>好评</li>
                  <li><i class="op2"></i>中评</li>
                  <li><i class="op3"></i>差评</li>
                </div>
              </div>           
                <div class="info-btn">
                  <div class="am-btn am-btn-danger">发表评论</div>
                </div>              
          <script type="text/javascript">
            $(document).ready(function() {
              $(".comment-list .item-opinion li").click(function() {  
                $(this).prevAll().children('i').removeClass("active");
                $(this).nextAll().children('i').removeClass("active");
                $(this).children('i').addClass("active");
                
              });
             })
          </script>         
          
                        
              
            </div>

          </div>

        </div>
        <!--底部-->
        @include('home/public/footer')
      </div>

      <aside class="menu">
        @include('home/public/menu')

      </aside>
    </div>

  </body>

</html>