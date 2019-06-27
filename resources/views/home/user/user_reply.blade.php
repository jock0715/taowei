   @include('home/public/header')

    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/appstyle.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/home/js/jquery-1.7.2.min.js"></script>
    <style type="text/css">
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
        @include('home/public/footer')
      </div>
      <aside class="menu">
        @include('home/public/menu')
      </aside>
    </div>
  </body>
</html>