@include('home/public/header')

    <link href="/home/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/home/css/infstyle.css" rel="stylesheet" type="text/css">
    <script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
      .nav.white .logoBig img {
        width: 11%;
    }
    </style>
    <div class="center">
      <div class="col-main">
        <!-- 内容 -->
        <div class="main-wrap">
          <div class="user-info">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf">
                <strong class="am-text-danger am-text-lg">个人资料</strong>/
                <small>Personal&nbsp;information</small></div>
            </div>
            <hr>
            <!--头像 -->
            <div class="user-infoPic">
              <form action="/home/user/user_file/{{ $data->userinfos->id }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="filePic">
                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp"  name="profile">
                <input type="hidden" name="old_file" value="{{ $data->userinfos->profile }}">
                <img style="width: 100px;" class="am-circle am-img-thumbnail" src="/uploads/{{ $data->userinfos->profile }}" alt="">
              </div>
                  <input class="am-btn am-btn-danger" type="submit" value="保存" style="display: inline-block; margin: 97px 0px 0px 15px;">
              </form>
              <p class="am-form-help">头像</p>
              <div class="info-m">
                <div>
                  <b>用户名：
                    <i>{{ $data->uname }}</i>
                  </b>
                </div>
                <div class="u-level">
                  <span class="rank r2">
                    <s class="vip1"></s>等&nbsp;&nbsp;&nbsp;&nbsp;级：
                    <a class="classes" href="javascript:;">@if($data->status == 1) 普通会员 @else 高级会员 @endif</a></span>
                </div>
                <div class="u-safety">
                  <a href="javascript:;">账户安全
                    <span class="u-profile">
                      <i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
                  </a>
                </div>
              </div>
            </div>
            <!--个人信息 -->
            <div class="info-main">
              <form id="form1" class="am-form am-form-horizontal" method="post">
                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">昵称</label>
                  <div class="am-form-content">
                    <input type="hidden" name="id" value="{{ $data->id }}" >
                    <input type="text" id="user-name2" value="{{ $data->userinfos->nick }}" name="nick"></div>
                </div>
                <div class="am-form-group">
                  <label for="user-name" class="am-form-label">姓名</label>
                  <div class="am-form-content">
                    <input type="text" id="user-name2" value="{{ $data->userinfos->name }}" name="name"></div>
                </div>
                <div class="am-form-group">
                  <label class="am-form-label">性别</label>
                  <select name="sex" style="width: 65px;margin-left: 57px;display: inline-block;">
                    <option value="n"
                      @if($data->userinfos->sex == 'm')
                        selected
                      @endif>男</option>
                    <option value="w"
                      @if($data->userinfos->sex == 'w')
                        selected
                      @endif>女</option>
                    <option value="x"
                      @if($data->userinfos->sex == 'x')
                        selected
                      @endif>保密</option>
                  </select>
                </div>
                <div class="am-form-group">
                  <label for="user-birth" class="am-form-label">年龄</label>
                  <div class="am-form-content">
                    <input id="user-phone" value="{{ $data->userinfos->age }}" type="tel" name="age"></div>
                </div>
                <div class="am-form-group">
                  <label class="am-form-label">生日</label>
                  <select style="width: 60px;float: left;margin-left: 57px;">
                    <option>1997</option>
                    <option>1999</option>
                  </select>
                  <select style="width: 50px;float: left;margin-left: 10px;">
                    <option>07</option>
                    <option>09</option>
                  </select>
                  <select style="width: 50px;float: left;margin-left: 10px;">
                    <option>15</option>
                    <option>17</option>
                  </select>
                </div>
                <div class="am-form-group">
                  <label for="user-phone" class="am-form-label">电话</label>
                  <div class="am-form-content">
                    <input id="user-phone" value="{{ $data->phone }}" type="tel" name="phone"></div>
                </div>
                <div class="am-form-group">
                  <label for="user-email" class="am-form-label">电子邮件</label>
                  <div class="am-form-content">
                    <input id="user-email" value="{{ $data->email }}" type="email" name="email"></div>
                </div>
                <div class="info-btn">
                  <input class="am-btn am-btn-danger" type="submit" value="保存修改">
                </div>
              </form>
            </div>
          </div>
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

  $('#form1').submit(function(){
    let id = $('#form1 input[name=id]').val();
    let nick = $('#form1 input[name=nick]').val();
    let name = $('#form1 input[name=name]').val();
    let sex = $('#form1 select').val();
    let age = $('#form1 input[name=age]').val();
    let phone = $('#form1 input[name=phone]').val();
    let phone_preg = /^[1]{1}[3-9]{1}\d{9}$/;
    let email = $('#form1 input[name=email]').val();
    let email_preg = /^[\w]{3,12}@[\w]+\.[\w]+$/;
    // 验证昵称
    if (nick.length < 3 || nick.length > 12 || name.length < 2 || name.length > 16) {
      layer.msg('昵称或姓名长度不符合');
      return false;
    }
    // 验证年龄
    if(age < 1 || age > 120){
      layer.msg('年龄不符合规范');
      return false;
    }
    // 验证年龄
    if(age < 1 || age > 120){
      layer.msg('年龄不符合规范');
      return false;
    }
    // 验证手机
    if (!phone_preg.test(phone)) {
      layer.msg('手机格式不正确');
      return false;
    }
    // 验证邮箱
    if(!email_preg.test(email)){
      layer.msg('邮箱格式不正确!');
      return false;
    }

    $.post('/home/user/user_infos',{id,nick,name,sex,age,phone,email},function(res){
      if(res.msg == 'ok'){
        layer.msg(res.info);
        setTimeout(function(){
          //关闭当前页面
          window.parent.location.reload();
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          // 跳转
          window.location.href = '/home/user/user_info';
        },800);
      }else{
        layer.msg(res.info);
      }
    },'json');
    return false;
  });
</script>