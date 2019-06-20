<!DOCTYPE HTML>
<html>
<head>
 @include('admin.public.header')
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--  侧边栏 开始-->
		@include('admin.public.sidebar')
		<!-- 侧边栏 结束-->
		<!--  头部 开始-->
		@include('admin.public.header_userinfo')
		<!-- 头部 结束 -->
		
		<!-- 内容 开始 -->
		<div id="page-wrapper">
			<div class="main-page">
				<!-- 导入 提示消息 开始 -->
				@include('admin.public.message')
				<!-- 导入 提示消息 结束 -->

				<!-- 显示 错误 -->
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

				<div class="forms">
					<h3 class="title1">用户管理</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>用户添加 :</h4>
						</div>
						<div class="form-body">
							<form action="/admin/user/{{ $user_data->id }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
							    <div class="form-group">
								    <label for="exampleInputEmail1" >用户名</label>
								    <input type="text" class="form-control" name="uname" style="width:600px" value="{{$user_data->uname}}" readonly>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">权限</label><br>
									<select name="status" class="form-group">
							      		<option disabled>----请选择----</option>
								      	<option value="0" 
								      	@if($user_data->status == 0)
								      		selected
								      	@endif
								      	>超级管理员</option>
								      	<option value="1" 
								      	@if($user_data->status == 1)
								      		selected
								      	@endif
								      	>普通管理员</option>
								      	<option value="2" 
								      	@if($user_data->status == 2)
								      		selected
								      	@endif
								      	>普通用户</option>
							      	</select>
						      	</div>
								<div class="form-group">
								    <label for="exampleInputEmail1" >性别</label>
								    <input type="text" class="form-control" name="sex" style="width:600px" value="{{$user_data->userinfos->sex}}">
								</div>
								<div class="form-group">
								    <label for="exampleInputEmail1" >年龄</label>
								    <input type="text" class="form-control" name="age" style="width:600px" value="{{$user_data->userinfos->age}}">
								</div>
								<div class="form-group">
								    <label for="exampleInputEmail1" >地址</label>
								    <input type="text" class="form-control" name="addr" style="width:600px" value="{{$user_data->userinfos->addr}}">
								</div>
								<div class="form-group">
								    <label for="exampleInputEmail1" >邮箱</label>
								    <input type="text" class="form-control" name="email" style="width:600px" value="{{$user_data->userinfos->email}}">
								</div>
								<div class="form-group">
								    <label for="exampleInputPassword1">手机号</label>
								    <input type="text" class="form-control" name="phone" style="width:600px" value="{{$user_data->userinfos->phone}}">
								</div>
							    <div class="form-group">
							    	<input type="hidden" name="old_file" value="{{$user_data->userinfos->profile}}">
							      	<input type="file" id="exampleInputFile" name="profile" style="float: left;">
							      	<img src="/uploads/{{ $user_data->userinfos->profile }}" style="width: 60px;" class="img-thumbnail"><br>
								</div>
							   <button type="submit" class="btn btn-default">Submit</button>
							</form>
					    </div>
					</div>
				</div>
			</div>
			<div class="main-page" style="display: none;">
				<div class="row calender widget-shadow">
					<h4 class="title">Calender</h4>
					<div class="cal1">
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- 内容结束 -->

		<!-- 页脚 开始 -->

        <!-- 页脚 结束 -->
	</div>
	<!-- 页脚 静态资源 开始 -->
	@include('admin.public.footer_static')
	<!-- 页脚 静态资源 结束 -->
</body>
</html>