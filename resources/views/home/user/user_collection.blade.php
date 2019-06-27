@include('home/public/header')

<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
<link href="/home/css/colstyle.css" rel="stylesheet" type="text/css">
<style>
  .nav.white .logoBig img {
    width: 11%;
}
</style>
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
                <!-- <div class="nav-extra">
                  <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                  <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                </div> -->
            </div>
      </div>
      <b class="line"></b>
    <div class="center">
      <div class="col-main">
        <div class="main-wrap">

          <div class="user-collection">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
            </div>
            <hr/>

            <div class="you-like">
              <div class="s-bar">
                我收藏的秒杀商品
              </div>
              <div class="s-content">
                @foreach($spike_collection as $k=>$v)
                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="@if($v->collectionspike->status == 1)
                                /home/spikelist/info/{{ $v->collectionspike->id }}
                                @else
                                javascript:;
                                @endif
                                " class="s-pic-link">
                        <img src="/uploads/{{ $v->collectionspike->file }}" title="" class="s-pic-img s-guess-item-img">
                      <span class="tip-title" style="display:{{ $v->collectionspike->status == 1 ? 'none' : 'block'  }}">已下架</span>
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title">¥: {{ $v->collectionspike->money }} &nbsp;<a href="#" title="{{ $v->collectionspike->desc }}">{{ $v->collectionspike->name }}</a></div>
                      <div class="s-title" title="{{ $v->collectionspike->desc }}">{{ $v->collectionspike->desc }}</div>
                      <div class="s-extra-box">
                        <span class="s-comment" style="float: left; background-color: #bbb;"><a href="javascript:;" onclick="spikedel({{$v->collectionspike->id}},this)">取消收藏</a></span> &nbsp; &nbsp;
                        <span class="s-sales">销售量:{{ $v->collectionspike->sale }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <hr />
              <div class="s-bar">
                我收藏的活动商品 
              </div>
              <div class="s-content">
                @foreach($doing_collection as $k=>$v)
                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="@if($v->collectiondoing->status == 1)
                                /home/doinglist/info/{{ $v->collectiondoing->id }}
                                @else
                                javascript:;
                                @endif" class="s-pic-link">
                        <img src="/uploads/{{ $v->collectiondoing->file }}" title="{{ $v->collectiondoing->desc }}" class="s-pic-img s-guess-item-img">
                      <span class="tip-title" style="display:{{ $v->collectiondoing->status == 1 ? 'none' : 'block'  }}">已下架</span>
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title">¥: {{ $v->collectiondoing->money }} &nbsp;<a href="#" title="{{ $v->collectiondoing->desc }}">{{ $v->collectiondoing->name }}</a></div>
                      <div class="s-title" title="{{ $v->collectiondoing->desc }}">{{ $v->collectiondoing->desc }}</div>
                      <div class="s-extra-box">
                        <span class="s-comment" style="float: left; background-color: #bbb;"><a href="javascript:;" onclick="doingdel({{$v->collectiondoing->id}},this)">取消收藏</a></span> &nbsp; &nbsp;
                        <span class="s-sales">销售量:{{ $v->collectiondoing->sale }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <hr />
              <div class="s-bar">
                我收藏的商品
              </div>
              <div class="s-content">
                @foreach($goods_collection as $k=>$v)
                <div class="s-item-wrap">
                  <div class="s-item">

                    <div class="s-pic">
                      <a href="@if($v->collectiongoods->status == 1)
                                /home/goodslist/info/{{ $v->collectiongoods->id }}
                                @else
                                javascript:;
                                @endif" class="s-pic-link">
                        <img src="/uploads/{{ $v->collectiongoods->file }}" title="{{ $v->collectiongoods->desc }}" class="s-pic-img s-guess-item-img">
                      <span class="tip-title" style="display:{{ $v->collectiongoods->status == 1 ? 'none' : 'block'  }}">已下架</span>
                      </a>
                    </div>
                    <div class="s-info">
                      <div class="s-title">¥: {{ $v->collectiongoods->money }} &nbsp;<a href="#" title="{{ $v->collectiongoods->desc }}">{{ $v->collectiongoods->name }}</a></div>1
                      <div class="s-title" title="{{ $v->collectiongoods->desc }}">{{ $v->collectiongoods->desc }}</div>1
                      <div class="s-extra-box">
                        <span class="s-comment" style="float: left; background-color: #bbb;"><a href="javascript:;" onclick="goodsdel({{$v->collectiongoods->id}},this)">取消收藏</a></span> &nbsp; &nbsp;
                        <span class="s-sales">销售量:{{ $v->collectiongoods->sale }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <link rel="stylesheet" href="/home_login/layui/css/layui.css">
              <script src="/home_login/layui/layui.js"></script>
              <script>//一般直接写在一个js文件中
                layui.use(['layer', 'form'],
                function() {
                  var layer = layui.layer
                });
              </script>
              <script type="text/javascript">
                    // 取消收藏商品
                    function goodsdel(id,obj) {
                      $.post('/home/goodscollection/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'}, function(res){
                        if(res.msg == 'ok'){
                          layer.msg(res.info);
                          // 删除div节点
                          $(obj).parent().parent().parent().parent().parent().remove();
                        } else {
                          layer.msg(res.info);
                        }
                      },'json');
                    }

                    // 取消收藏秒杀商品
                    function spikedel(id,obj) {
                      $.post('/home/spikecollection/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'}, function(res){
                        if(res.msg == 'ok'){
                          layer.msg(res.info);
                          // 删除div节点
                          $(obj).parent().parent().parent().parent().parent().remove();
                        } else {
                          layer.msg(res.info);
                        }
                      },'json');
                    }

                    // 取消收藏活动商品
                    function doingdel(id,obj) {
                      $.post('/home/doingcollection/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'}, function(res){
                        if(res.msg == 'ok'){
                          layer.msg(res.info);
                          // 删除div节点
                          $(obj).parent().parent().parent().parent().parent().remove();
                        } else {
                          layer.msg(res.info);
                        }
                      },'json');
                    }

              </script>
              <!-- <div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div> -->

            </div>

          </div>

        </div>

        <!-- 内容 -->
        @include('home/public/footer')
        <!--底部-->
      </div>

      <aside class="menu">
        @include('home/public/menu')

      </aside>
    </div>

  </body>

</html>