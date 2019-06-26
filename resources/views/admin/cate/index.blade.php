
<!DOCTYPE HTML>
<html>
<head>
<!-- 页头 开始 -->
@include('admin.public.header')
<!-- 页头 结束 -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--侧边栏 开始-->
		@include('admin.public.sidebar')
		<!--侧边栏结束-->
		<!-- 头部 开始 -->
		@include('admin.public.header_userinfo')
		<!-- 头部 结束 -->
		<!-- 内容 开始-->
		<div id="page-wrapper" style="background:url('/admin/images/litiqs.jpg') no-repeat 100% 100%;">
			<div class="main-page"> 
			<!-- 导入 提示信息 开始 -->
			@include('admin.public.message')
			<!-- 导入 提示信息 结束 -->
			<h3 class="title1">分类管理</h3>
			<!-- 搜索 开始 -->
			<div class="form-body" data-example-id="simple-form-inline">
			  <form class="form-inline" action="/admin/cate">
			    <div class="form-group">
			      <label for="exampleInputName2">关键字</label>
			      <input type="text" class="form-control" name="search" value="" id="exampleInputName2" placeholder="用户名"></div>
			    <button type="submit" class="btn btn-success">搜索</button>
			</form>
			</div>
			<!-- 搜索 结束 -->

			
				<table class="table table-bordered">
								<thead>
									<tr>
									  <th>ID</th>
									  <th>分类名称</th>
									  <th>父类ID</th>
									  <th>分类路径</th>
									  <th>添加时间</th>
									  <th>操作</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cates as $k=>$v)
									<tr>
										<td>{{ $v->id }}</td>
										<td>{{ $v->cname }}</td>
										<td>{{ $v->pid }}</td>
										<td>{{ $v->path }}</td>
										<td>{{ $v->created_at}}</td>
										<td>
											
											
											
											<a href="/admin/cate/{{ $v->id }}/edit" class="btn btn-info">修改</a>
											@if(substr_count($v->path,',') < 2)
											<a href="/admin/cate/create?id={{ $v->id }}" class="btn btn-success">添加子分类</a>
											@endif
											
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<!-- 显示页码 -->
					{{ $cates->links() }}
				<div class="main-page" style="display:none;">
					<div class="row calender widget-shadow">
						<h4 class="title">Calender</h4>
						<div class="cal1">
							
						</div>
					</div>
					<div class="clearfix"> </div>
				<div>
					
				</div>
			</div>
		</div>
		<!-- 内容 结束 -->

	</div>
	<!-- 页脚 静态资源 开始 -->
	@include('admin.public.footer_static')
	<!-- 页脚 静态资源 结束 -->
	
</body>
</html>