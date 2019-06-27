    @include('home/public/header')
    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/stepstyle.css" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
      .nav.white .logoBig img {
        width: 11%;
    }
    </style>
    <div class="center">
      <div class="col-main">
        <div class="main-wrap container">
          <div class="am-cf am-padding">
            <div class="am-fl am-cf">
              <strong class="am-text-danger am-text-lg">修改密码</strong>/
              <small>Password</small></div>
          </div>
          <hr>
          <!--进度条-->
          <div class="m-progress">
            <div class="m-progress-list">
              <span class="step-1 step">
                <em class="u-progress-stage-bg"></em>
                <i class="u-stage-icon-inner">1
                  <em class="bg"></em></i>
                <p class="stage-name">重置密码</p></span>
              <span class="step-2 step">
                <em class="u-progress-stage-bg"></em>
                <i class="u-stage-icon-inner">2
                  <em class="bg"></em></i>
                <p class="stage-name">完成</p></span>
              <span class="u-progress-placeholder"></span>
            </div>
            <div class="u-progress-bar total-steps-2">
              <div class="u-progress-bar-inner"></div>
            </div>
          </div>
          <form id="form1" class="am-form am-form-horizontal">
            <div class="am-form-group">
              <label for="user-old-password" class="am-form-label">原密码</label>
              <div class="am-form-content">
                <input type="password" id="user-old-password" name="upwd" style="width: 600px;"></div>
                <input type="hidden" name="id" value="{{ session('home_data')->id }}">
            </div>
            <div class="am-form-group">
              <label for="user-new-password" class="am-form-label">新密码</label>
              <div class="am-form-content">
                <input type="password" id="user-new-password" name="reupwd1" style="width: 600px;"></div>
            </div>
            <div class="am-form-group">
              <label for="user-confirm-password" class="am-form-label">确认密码</label>
              <div class="am-form-content">
                <input type="password" id="user-confirm-password" name="reupwd2" style="width: 600px;"></div>
            </div>
            <div class="info-btn">
              <button class="am-btn am-btn-danger" type="submit" style="display: inline-block;margin-left: -450px;">保存修改</button></div>
          </form>
        </div>
        <!--底部-->
        @include('home/public/footer')
      </div>
      <aside class="menu">@include('home/public/menu')</aside></div>
  </body>
</html>
<!-- 修改密码模态框 结束 -->
<link rel="stylesheet" href="/home_login/layui/css/layui.css">
<script src="/home_login/layui/layui.js"></script>
<script type="text/javascript">
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

  $('#form1').submit(function(){
    
    let id = $('#form1 input[name=id]').val();
    let upwd = $('#form1 input[name=upwd]').val();
    let reupwd1 = $('#form1 input[name=reupwd1]').val();
    let reupwd2 = $('#form1 input[name=reupwd2]').val();

    // 数据验证
    if(upwd.length == 0){
            layer.msg("密码不能为空");
            return false;
    }
    if(reupwd1.length<6 && reupwd1.length<6){
      layer.msg('新密码不能少于6位');
      return false;
    }
    
    //验证密码
    if(reupwd1 != reupwd2){
      layer.msg('密码不一致');
      return false
    }

    $.post('/home/user/user_upwds',{id,upwd,reupwd1},function(res){
      if(res.msg == 'ok'){
         layer.msg(res.info);
        setTimeout(function(){
          //关闭当前页面
          window.parent.location.reload();
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          // 跳转
          window.location.href = '/home/login';
        },800);
      }else{
        layer.msg(res.info);
      }
    },'json');
    return false;
  });
</script>