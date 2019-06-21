<!DOCTYPE HTML>
<html>
<head>
 @include('admin.public.header')
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content" >
		<!--  侧边栏 开始-->
		@include('admin.public.sidebar')
		<!-- 侧边栏 结束-->
		<!--  头部 开始-->
		@include('admin.public.header_userinfo')
		<!-- 头部 结束 -->
		
		<!-- 内容 开始 -->
		<div id="page-wrapper" >
			<div class="main-page" >
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
				
				<div class="forms" >
					<h3 class="title1">轮播管理</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"  > 
						<div class="form-title">
							<h4>轮播修改 :</h4>
						</div>
						<div class="form-body">
						  <form action="/admin/banner/{{ $banners_edit->id }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
						    <div class="form-group">
						      <label for="uname">标题</label>
						      <input type="text" style="width:510px"  class="form-control" value="{{ $banners_edit->title }}" name="title" id="uname" placeholder="title">
						  	</div>
						    <div class="form-group">
						      <label for="upass">描述</label><br>
						      <textarea name="desc"  id="" cols="68" rows="5">{{ $banners_edit->desc }}</textarea>
						  	</div>

						    <div class="form-group">
								<img src="/uploads/{{ $banners_edit->url }}" width="150px" class="img-thumbnail" alt="">
								<input type="hidden" name="old_url" value="{{ $banners_edit->url }}">
						    	<label for="exampleInputFile">图片</label>
						    	<input type="file" name="url" id="exampleInputFile">
						  </div>
						   <button type="submit" class="btn btn-default">提交</button>
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