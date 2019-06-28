
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
		<div id="page-wrapper"  style="background:url('/admin/images/litiqs.jpg') no-repeat 100% 100%;">
			<div class="main-page">
			<!-- 导入 提示信息 开始 -->
			@include('admin.public.message')
			<!-- 导入 提示信息 结束 -->
			<h3 class="title1">订单管理</h3>
			<!-- 搜索 开始 -->
			<div class="form-body" data-example-id="simple-form-inline">
			  <form class="form-inline" action="/admin/user">
			    <div class="form-group">
			      <label for="exampleInputName2">关键字</label>
			      <input type="text" class="form-control" name="search" value="" id="exampleInputName2" placeholder="用户名"></div>
			    <button type="submit" class="btn btn-success">搜索</button>
			</form>
			</div>
			<!-- 搜索 结束 -->
			<div class="panel-body widget-shadow">
				<h4 style="color: deeppink">订单列表</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
						  <th>ID</th>
						  <th>用户名</th>
						  <th>购买的商品</th>
						  <th>订单号</th>
						  <th>评论</th>
						  <th>评价</th>
						  <th>发表时间</th>
						  <th>操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach($data as $k=>$v)
						<tr>
							<td>{{ $v->id }}</td>
							<td>{{ $v->commentusers->uname }}</td>
							<td>{{ $v->commentgoods->name }}</td>
							<td>{{ $v->commentorders->number }}</td>
							<td>{{ $v->content }}</td>
							<td>
								@if($v->comment == 0)
									好评
								@elseif($v->comment == 1)
									中评
								@else
									差评
								@endif
							</td>
							<td>{{ $v->created_at }}</td>
							<td>
								<a href="/admin/comment/{{ $v->id }}/edit" class="btn btn-info">修改</a>
					            <form action="/admin/comment/{{ $v->id }}" method="post" style="display: inline-block;">
					              {{ csrf_field() }}
					              {{ method_field('DELETE') }}
					            <input type="submit" value="删除" class="btn btn-danger" onclick="return confirm('确定删除?')">
					          </form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $data->links() }}
			</div>
		</div>
		<!-- 内容 结束 -->
		<!-- 页尾 开始 -->
			<div class="main-page" style="display: none;">
				<div class="row calender widget-shadow">
					<h4 class="title">Calender</h4>
					<div class="cal1">
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		<!-- 页尾结束 -->
	</div>
	<!-- 页脚 静态资源 开始 -->
	@include('admin.public.footer_static')
	<!-- 页脚 静态资源 结束 -->
	
</body>
</html>