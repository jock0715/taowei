@include('home/public/header')

    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/addstyle.css" rel="stylesheet" type="text/css">
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
      .nav.white .logoBig img {
        width: 11%;
    }
    </style>
    <div class="center">
      <div class="col-main">
        <!-- 内容 -->
        <div class="main-wrap container">
          <div class="user-address">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf">
                <strong class="am-text-danger am-text-lg">地址管理</strong>/
                <small>Address&nbsp;list</small></div>
            </div>
            <hr>
            <div class="clear"></div>
            <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
            <!--例子-->
            <div class="" id="doc-modal-1">
              <div class="add-dress">
                <!--标题 -->
                <div class="am-cf am-padding">
                  <div class="am-fl am-cf">
                    <strong class="am-text-danger am-text-lg">修改地址</strong>/
                    <small>Add&nbsp;address</small></div>
                </div>
                <hr>
                <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                  <form id="form1" class="am-form am-form-horizontal">
                    <div class="am-form-group">
                      <label for="user-name" class="am-form-label">收货人</label>
                      <div class="am-form-content">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="text" id="user-name" name="aname" value="{{ $data->aname }}"></div>
                    </div>
                    <div class="am-form-group">
                      <label for="user-phone" class="am-form-label">手机号码</label>
                      <div class="am-form-content">
                        <input id="user-phone" placeholder="手机号必填" type="text" value="{{ $data->aphone }}"></div>
                    </div>
                    <div class="am-form-group">
                      <label for="user-address" class="am-form-label">所在地</label>
                      <div class="am-form-content">
                        <select name="province" style="display: inline-block;margin-left: 10px;" id="select">
                          <option value="广东省"
                          @if($data->province == '广东省')
                            selected
                          @endif
                          >广东省</option>
                          <option value="上海市"
                          @if($data->province == '上海市')
                            selected
                          @endif
                          >上海市</option>
                          <option value="北京市"
                          @if($data->province == '北京市')
                            selected
                          @endif
                          >北京市</option>
                          <option value="杭州市"
                          @if($data->province =='杭州市')
                            selected
                          @endif
                          >杭州市</option>
                        </select>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <label for="user-intro" class="am-form-label">详细地址</label>
                      <div class="am-form-content">
                        <textarea name="uaddr" rows="3" id="user-intro" placeholder="100字以内写出你的详细地址...">{{ $data->uaddr }}</textarea>
                      </div>
                    </div>
                    <div class="am-form-group">
                      <div class="am-u-sm-9 am-u-sm-push-3">
                        <input class="am-btn am-btn-danger" type="submit" value="保存">
                    </div>
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
        @include('home/public/footer')
      </div>
      <aside class="menu">@include('home/public/menu')</aside></div>
  </body>
</html>
<!-- 修改密码模态框 结束 -->
<link rel="stylesheet" href="/home_login/layui/css/layui.css">
<script src="/home_login/layui/layui.js"></script>
<script type="text/javascript">//一般直接写在一个js文件中
  layui.use(['layer', 'form'],
  function() {
    var layer = layui.layer
  });
</script>
<script type="text/javascript">$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#form1').submit(function(){
    let id = $('#form1 input[name=id]').val();
    let aname = $('#user-name').val();
    let aphone = $('#user-phone').val();
    let phone_preg = /^[1]{1}[3-9]{1}\d{9}$/;
    let province = $('#select').val();
    let uaddr = $('#user-intro').val();
    // 验证姓名长度
    if (aname.length < 2 || aname.length > 16) {
      layer.msg('姓名长度不符合 !');
      return false;
    }
    // 验证手机格式
    if(!phone_preg.test(aphone)){
      layer.msg('手机号格式不正确 !');
      return false;
    }
    // 地址长度
    if (uaddr.length < 6 || uaddr.length > 30) {
      layer.msg('地址输入不规范 !');
      return false;
    }
    $.post('/home/user/user_editaddrs',{id,aname,aphone,province,uaddr},function(res){
      if(res.msg == 'ok'){
        layer.msg(res.info);
        setTimeout(function(){
          //关闭当前页面
          window.parent.location.reload();
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          // 跳转
          window.location.href = '/home/user/user_addr';
        },800);
      }else{
        layer.msg(res.info);
      }
    },'json');
    return false;
  });

  // function delClick(id){
  //   if(!window.confirm('确定删除吗?')){
  //     return false;
  //   }
  //   $.get('/home/user/deladdr',{id},function(res){
  //     if(res.msg == 'ok'){
  //       layer.msg(res.info);
  //       setTimeout(function(){
  //         //关闭当前页面
  //         window.parent.location.reload();
  //         var index = parent.layer.getFrameIndex(window.name);
  //         parent.layer.close(index);
  //         // 跳转
  //         window.location.href = '/home/user/user_addr';
  //       },800);
  //     }else{
  //       layer.msg(res.info);
  //     }
  //   },'json');
  // }

</script>