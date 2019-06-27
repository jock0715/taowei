@include('home/public/header')

    <link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/layui/layui.js"></script>
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
                    <img src="/uploads/{{ $data->file }}" class="itempic">
                  </a>
                </div>

                <div class="item-title">

                  <div class="item-name">
                    <a href="#">
                      <p class="item-basic-info">{{ $data->message }}</p>
                    </a>
                  </div>
                  <div class="item-info">
                    <div class="info-little">
                      <span>颜色：{{$data->desc}}</span>
                    </div>
                    <div class="item-price">
                      价格：<strong>{{ $data->money }}元</strong>
                    </div>                    
                  </div>
                </div>
                <div class="clear"></div>
                <form id="form1">
                <div class="item-comment">
                  <textarea id="text1" placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！" name="content"></textarea>
                  <input type="hidden" name="uid" value="{{ $data->uid }}">
                  <input type="hidden" name="gid" value="{{ $data->gid }}">
                  <input type="hidden" name="oid" value="{{ $data->id }}">
                </div>
                <div class="item-opinion">
                  <select id="select1" name="comment" style="width: 60px;height: 25px;margin-left: 535px;">
                    <option value="0">好评</option>
                    <option value="1">中评</option>
                    <option value="2">查评</option>
                  </select> 
                </div>     
                <div class="info-btn">
                  <input class="am-btn am-btn-danger" type="submit" value="发表评论">
                </div>
                </form>
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


<!-- 修改密码模态框 结束 -->
<link rel="stylesheet" href="/home_login/layui/css/layui.css">
<script src="/home_login/layui/layui.js"></script>
<script>
//一般直接写在一个js文件中
  layui.use(['layer', 'form'], function(){
    var layer = layui.layer
  });
</script>

<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    let uid = $('#form1 input[name=uid]').val();
    let gid = $('#form1 input[name=gid]').val();
    let oid = $('#form1 input[name=oid]').val();
    let comment = $('#select1').val();
    let content = $('#text1').val();
    // let phone = $('#form1 input[name=phone]').val();
    // let phone_preg = /^[1]{1}[3-9]{1}\d{9}$/;
    // let email = $('#form1 input[name=email]').val();
    // let email_preg = /^[\w]{3,12}@[\w]+\.[\w]+$/;

  $('#form1').submit(function(){

    $.post('/home/user/user_replyeds',{uid,gid,oid,comment,content},function(res){
      if(res.msg == 'ok'){
        layer.msg(res.info);
        setTimeout(function(){
          //关闭当前页面
          window.parent.location.reload();
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          // 跳转
          window.location.href = '/home/user/user_reply';
        },800);
      }else{
        layer.msg(res.info);
      }
    },'json');
    return false;
  })
</script>