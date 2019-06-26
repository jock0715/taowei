
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
			<h3 class="title1">链接管理</h3>
			<!-- 搜索 开始 -->
			<div class="form-body" data-example-id="simple-form-inline">
			  <form class="form-inline" action="/admin/link">
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
									  <th>链接名称</th>
									  <th>链接地址</th>
									  <th>状态</th>							  
									  <th>操作</th>
									</tr>
								</thead>
								<tbody>
								@foreach($data as $k=>$v)
									<tr>
										<th>{{ $v->id }}</th>
										<td>{{ $v->name }}</td>
										<td>{{ $v->url }}</td>
										<td>
										@if($v->status == 0)
								            <a href="javascript:;"><kbd style="background-color:red; " onclick="guan({{ $v->id }},this)">未激活</kbd></a>
								            @else($v->status == 1)
								            <a href="javascript:;"><kbd style="background-color:green" onclick="kai({{ $v->id }},this)">已激活</kbd></a>
								        @endif
										</td>

										<td>

											<a href="/admin/link/{{ $v->id }}/edit" class="btn btn-info">修改</a>

											<form action="/admin/link/{{ $v->id }}" method="post" style="display: inline-block;">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
												<input type="submit" value="删除" class="btn btn-danger">
											</form>
											
										</td>
									</tr>

								@endforeach
								</tbody>
							</table>
								<!-- 显示页码 -->
							{{ $data->links() }}
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
<script>
// ajax跳转
	function guan (id,obj)
	{
		$.get('/admin/link/status',{id:id},function (res) {
			if (res == 'ok') {
				if ($(obj).text() == '未激活') {
					$(obj).css('background-color','green');
					$(obj).text('已激活');
				} else {
					$(obj).css('background-color','red');
					$(obj).text('未激活');
				}
			} else {
				alert('激活失败');
			}
		},'html');
	}


	function kai (id,obj)
	{
		$.get('/admin/link/status',{id:id},function (res) {
			if (res == 'ok') {
				if ($(obj).text() == '已激活') {
					$(obj).css('background-color','red');
					$(obj).text('未激活');
				} else {
					$(obj).css('background-color','green');
					$(obj).text('已激活');
				}
			} else {
				alert('激活失败');
			}
		},'html');
	}
</script>
</html>