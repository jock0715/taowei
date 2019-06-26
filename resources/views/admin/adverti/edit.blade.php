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
					<h3 class="title1">修改广告</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						
						<div class="form-body">
						  <form action="/admin/adverti/{{ $adverti->id }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
						    <div class="form-group">
						      <label for="title">广告标题</label>
						      <input type="text" class="form-control" name="title" value="{{ $adverti->title }}">
						  	</div>

						  	<div class="form-group">
						      <label for="auth">赞助商</label>
						      <input type="text" class="form-control" name="auth" value="{{ $adverti->auth }}">
						  	</div>

						  	<div class="form-group">
						      <label for="desc">广告描述</label>
						      <input type="text" class="form-control" name="desc" value="{{ $adverti->desc }}">
						  	</div>
						    
						    <div class="form-group">
						      <label for="url">链接地址</label>
						      <input type="text" class="form-control" name="url" value="{{ $adverti->url }}">
						  	</div>
							
						  <img src="/uploads/{{ $adverti->file }}" style="width:100px;">	

						  <input type="hidden" name="old_file" value="{{ $adverti->file }}">

						  <div class="form-group">
						      <label for="file"></label>
						      <input type="file" name="file" class="form-control">
						  </div>

						   
						   
							 <div class="mws-form-row">

						   <button type="submit" class="btn btn-default">Submit</button>
						   </div>
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

	</div>
	<!-- 页脚 静态资源 开始 -->
	@include('admin.public.footer_static')
	<!-- 页脚 静态资源 结束 -->
</body>
</html>