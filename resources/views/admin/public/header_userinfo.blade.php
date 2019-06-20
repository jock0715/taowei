<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="sticky-header header-section ">
	<div class="header-left">
		<!--toggle button start-->
		<button id="showLeftPush"><i class="fa fa-bars"></i></button>
		<!--toggle button end-->
		<!--logo -->
		<div class="logo">
			<a href="javascript:;">
				<h1>淘味</h1>
				<span>AdminPanel</span>
			</a>
		</div>
		<!--//logo-->
		<!--search-box-->
		<div class="search-box">
		
			<form class="input">
				<input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
				<label class="input__label" for="input-31">
					<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
						<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
					</svg>
				</label>
			</form>
		</div><!--//end-search-box-->
		<div class="clearfix"> </div>
	</div>
	<div class="header-right">
	
		<div class="profile_details">		
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<div class="profile_img">	
							<span class="prfil-img"><img src="/uploads/{{ session('admin_uinfo')->profile }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;"> </span> 
							<div class="user-name">
								<p>{{ session('admin_uinfo')->name }}</p>
								<span>Administrator</span>
							</div>
							<i class="fa fa-angle-down lnr"></i>
							<i class="fa fa-angle-up lnr"></i>
							<div class="clearfix"></div>	
						</div>	
					</a>
					<ul class="dropdown-menu drp-mnu">
						<li> <a href="javascript:;" onclick="show()"><i class="fa fa-cog"></i> 修改密码</a> </li> 
						<li> <a href="javascript:;" onclick="shows()"><i class="fa fa-user"></i> 头像</a> </li> 
						<li> <a href="/admin/loginout"><i class="fa fa-sign-out"></i> 退出</a> </li>
					</ul>
				</li>
			</ul>
		</div>
				<!-- 修改头像模态框 开始 -->
				<!-- 修改头像 模态框 结束 -->
		<div class="clearfix"> </div>				
	</div>
	<div class="clearfix"> </div>	
</div>
<!-- 修改密码模态框 开始 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改密码</h4>
      </div>
      <div class="modal-body">
		<form>
			{{ csrf_field() }}
		  	  <div class="form-group">
			    <label for="upwd">旧密码</label><span class="span1"></span>
			    <input type="password" class="form-control" name="upwd" id="exampleInputEmail1" placeholder="输入旧密码">
			    <input type="hidden" name="id" value="{{ session('admin_uinfo')->id }}">
			  </div>
			  <div class="form-group">
			    <label for="repwd1">新密码</label><span class="span2"></span>
			    <input type="password" class="form-control" name="repwd1" id="exampleInputPassword1" placeholder="输入新密码">
			  </div>
			  <div class="form-group">
			    <label for="repwd2">确认密码</label><span class="span3"></span>
			    <input type="password" class="form-control" name="repwd2" id="exampleInputPassword1" placeholder="再次输入新密码">
			  </div>
			  <button type="submit" class="btn btn-info form-control">Submit</button>
		</form>
	   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- 修改密码模态框 结束 -->
<link rel="stylesheet" href="/layui/css/layui.css">
<script src="/layui/layui.js"></script>

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

	$('form').submit(function(){
		let id = $('form input[name=id]').val();
		let upwd = $('form input[name=upwd]').val();
		let repwd1 = $('form input[name=repwd1]').val();
		let repwd2 = $('form input[name=repwd2]').val();

		// 数据验证
		if(upwd.length == 0){
            $('.span1').html('<span style="color: red">:密码不能为空</span>');
            return false;
		}else{
			$('.span1').html('<span"></span>');
		}

		// 验证密码长度
		if(repwd1.length<6 || repwd2.length<6){
			$('.span2').html('<span style="color: red">:密码不能小于6位</span>');
			return false;
		}else{
			$('.span2').html('<span"></span>');
		}
		
		//验证密码
		if(repwd1 != repwd2){
			$('.span3').html('<span style="color: red">:密码不一致!</span>');
			return false
		}else{
			$('.span3').html('<span"></span>');
		}

		$.post('/admin/doeditpwd',{id,upwd,repwd1},function(res){
			if(res.msg == 'ok'){
				layer.msg(res.info);
				setTimeout(function(){
					//关闭当前页面
					window.parent.location.reload();
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
					// 跳转
					window.location.href = '/admin/login';
				
				},800);
			}else{
				layer.msg(res.info);
				
			}
		},'json');

		return false;
	});
</script>




<!-- 修改密码模态框 开始 -->
<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改头像</h4>
      </div>
      <div class="modal-body">
		<form action="/admin/doeditfile/{{ session('admin_uinfo')->id }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
		  <div class="form-group">
		    <label for="files">原头像:</label>
		    <br>
		    <img style="width: 60px;margin-left: 60px;margin-top: -20px; border-radius: 5px;" src="/uploads/{{ session('admin_uinfo')->profile }}">
		  </div>
		  <input type="hidden" name="old_file" value="{{ session('admin_uinfo')->profile }}">
		  <input type="hidden" name="id" value="{{ session('admin_uinfo')->id }}">
		  <div class="form-group">
		    <label for="profiles">选择新头像</label>
		    <br>
		    <input type="file" name="profile">
		    <br>
		  </div>
		  <button type="submit" class="btn btn-success">Submit</button>
		</form>
	   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- 修改密码模态框 结束 -->

<script type="text/javascript">
	function show(obj){
		$('#myModal').modal('show');
	}

	function shows(obj){
		$('#myModals').modal('show');
	}
</script>





