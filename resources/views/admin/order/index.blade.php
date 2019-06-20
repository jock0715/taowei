
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
		<div id="page-wrapper">
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
						  <th>手机</th>
						  <th>地址</th>
						  <th>商品</th>
						  <th>总价</th>
						  <th>商品状态</th>
						  <th>下单时间时间</th>
						  <th>操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach($order_data as $k=>$v)
						<tr>
							<td>{{$v->id}}</td>
							<td>{{$v->orderuser->uname}}</td>
							<td>{{$v->phone}}</td>
							<td>{{$v->addr}}</td>
							<td>{{$v->gid}}</td>
							<td>{{$v->money}}</td>
							<td>						
						      	@if($v->status == 0)
						      		待发货
						      	@elseif($v->status == 1)
						      		已发货
						      	@elseif($v->status == 2)
						      		已签收
						      	@endif
							</td>
							<td>{{$v->created_at}}</td>
							<td>
								<a href="/admin/order/{{ $v->id }}/edit" class="btn btn-info">修改</a>
					            <form action="/admin/order/{{ $v->id }}" method="post" style="display: inline-block;">
					              {{ csrf_field() }}
					              {{ method_field('DELETE') }}
					            <input type="submit" value="删除" class="btn btn-danger" onclick="return confirm('确定删除?')">
					          </form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $order_data->links() }}
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