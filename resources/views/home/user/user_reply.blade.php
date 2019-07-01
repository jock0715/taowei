@include('home/public/header')



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
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">商品评论</strong> / <small>Make&nbsp;Comments</small></div>
            </div>
            <hr/>

            <div class="comment-main">
            @foreach($data as $k=>$v)
              <div class="comment-list" style="height: 150px;">
                <div class="item-pic">
                  <a href="#" class="J_MakePoint">
                    <img src="/uploads/{{ $v->file }}" class="itempic">
                  </a>
                </div>
                <div class="item-title" >
                  <div class="item-name">
                    <a href="#">
                      <p title="{{$v->commentorders->message}}" class="item-basic-info" style="color: #666">{{$v->commentorders->message}}</p>
                    </a>
                  </div>
                  <div class="item-info">
                    <div class="info-little">
                      颜色：<span style="color: red">{{$v->commentorders->desc}}</span>
                    </div>
                    <div class="item-price">
                      价格：<strong style="color: red">{{ $v->commentorders->price }}&nbsp;</strong>元
                    </div>                    
                  </div>
                </div>
                <div class="clear"></div>
                <div class="item-comment" style="border: 1px solid #999;">
                  <textarea readonly>{{ $v->content }}</textarea>
                </div>
                <div class="item-opinion">
                  <li><i class="op1 
                    @if($v->comment == 0)
                      active
                    @endif
                    "></i>好评</li>
                  <li><i class="op2 
                    @if($v->comment == 1)
                      active
                    @endif
                    "></i>中评</li>
                  <li><i class="op3 
                    @if($v->comment == 2)
                      active
                    @endif
                    "></i>差评</li>
                </div>
              </div>
            @endforeach
              <!--多个商品评论-->             
            @foreach($data_doing as $k=>$v)
              <div class="comment-list" style="height: 150px;">
                <div class="item-pic">
                  <a href="#" class="J_MakePoint">
                    <img src="/uploads/{{ $v->file }}" class="itempic">
                  </a>
                </div>
                <div class="item-title" >
                  <div class="item-name">
                    <a href="#">
                      <p title="{{$v->commentdorders->message}}" class="item-basic-info" style="color: #666">{{$v->commentdorders->message}}</p>
                    </a>
                  </div>
                  <div class="item-info">
                    <div class="info-little">
                      颜色：<span style="color: red">{{$v->commentdorders->desc}}</span>
                    </div>
                    <div class="item-price">
                      价格：<strong style="color: red">{{ $v->commentdorders->price }}&nbsp;</strong>元
                    </div>                    
                  </div>
                </div>
                <div class="clear"></div>
                <div class="item-comment" style="border: 1px solid #999;">
                  <textarea readonly>{{ $v->content }}</textarea>
                </div>
                <div class="item-opinion">
                  <li><i class="op1 
                    @if($v->comment == 0)
                      active
                    @endif
                    "></i>好评</li>
                  <li><i class="op2 
                    @if($v->comment == 1)
                      active
                    @endif
                    "></i>中评</li>
                  <li><i class="op3 
                    @if($v->comment == 2)
                      active
                    @endif
                    "></i>差评</li>
                </div>
              </div>
            @endforeach
            @foreach($data_spike as $k=>$v)
              <div class="comment-list" style="height: 150px;">
                <div class="item-pic">
                  <a href="#" class="J_MakePoint">
                    <img src="/uploads/{{ $v->file }}" class="itempic">
                  </a>
                </div>
                <div class="item-title" >
                  <div class="item-name">
                    <a href="#">
                      <p title="{{$v->commentsorders->message}}" class="item-basic-info" style="color: #666">{{$v->commentsorders->message}}</p>
                    </a>
                  </div>
                  <div class="item-info">
                    <div class="info-little">
                      颜色：<span style="color: red">{{$v->commentsorders->desc}}</span>
                    </div>
                    <div class="item-price">
                      价格：<strong style="color: red">{{ $v->commentsorders->price }}&nbsp;</strong>元
                    </div>                    
                  </div>
                </div>
                <div class="clear"></div>
                <div class="item-comment" style="border: 1px solid #999;">
                  <textarea readonly>{{ $v->content }}</textarea>
                </div>
                <div class="item-opinion">
                  <li><i class="op1 
                    @if($v->comment == 0)
                      active
                    @endif
                    "></i>好评</li>
                  <li><i class="op2 
                    @if($v->comment == 1)
                      active
                    @endif
                    "></i>中评</li>
                  <li><i class="op3 
                    @if($v->comment == 2)
                      active
                    @endif
                    "></i>差评</li>
                </div>
              </div>
            @endforeach
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