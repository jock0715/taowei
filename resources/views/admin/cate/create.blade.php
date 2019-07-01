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
					<h3 class="title1">分类添加</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						
						<div class="form-body">
						  <form action="/admin/cate" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						    <div class="form-group">
						      <label for="uname">分类名称</label>
						      <input type="text" class="form-control" name="cname" style="width:510px;">
						  	</div>
						    
						    <div class="mws-form-row">
						    	<label class="mws-form-label">所属分类</label>
						    	<div class="mws-frm-item"> 
						    		<select class="form-control" name="pid" style="margin-left: 0px;width:510px;">
						    			<option value="0">-- 请选择--</option>
										@foreach($cates as $k=>$v)
										<option value="{{ $v->id }}" {{ substr_count($v->path,',') >= 2 ? 'disabled' : '' }} {{ $v->id == $id ? 'selected' : '' }}>{{ $v->cname }}</option>
										@endforeach
									</select>
									</div><br>
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