
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
			<div class="main-page"></div>
			<!-- 导入 提示信息 开始 -->
			@include('admin.public.message')
			<!-- 导入 提示信息 结束 -->
			<h3 class="title1">用户管理</h3>
			<!-- 搜索 开始 -->
			<div class="form-body" data-example-id="simple-form-inline">
			  <form class="form-inline" action="/admin/user">
			    <div class="form-group">
			      <label for="exampleInputName2">关键字</label>
			      <input type="text" class="form-control" name="search" value="{{$params['search'] or ''}}" id="exampleInputName2" placeholder="用户名"></div>
			    <button type="submit" class="btn btn-success">搜索</button>
			</form>
			</div>
			<!-- 搜索 结束 -->
			<div class="panel-body widget-shadow">
				<h4 style="color: deeppink">用户列表</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
						  <th>ID</th>
						  <th>头像</th>
						  <th>用户名</th>
						  <th>性别</th>
						  <th>邮箱</th>
						  <th>号码</th>
						  <th>地址</th>
						  <th>状态</th>
						  <th>注册时间</th>
						  <th>操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach($user_data as $k=>$v)
						<tr>
							<td>{{ $v->id }}</td>
							<td>
								<img class="img-thumbnail" style="width: 50px;" src="/uploads/{{ $v->userinfos->profile }}">
							</td>
							<td>{{ $v->uname }}</td>
							<td>{{ $v->userinfos->sex }}</td>
							<td>{{ $v->userinfos->email }}</td>
							<td>{{ $v->userinfos->phone }}</td>
							<td>{{ $v->userinfos->addr }}</td>
							<td>
								@if($v->status == 0)
									<kbd>未激活</kbd>
								@elseif($v->status == 1)
									<kbd style="background: skyblue">普通用户</kbd>
								@elseif($v->status == 2)
									<kbd style="background:deeppink;">普通会员</kbd>
								@else
									<kbd style="background: red">高级会员</kbd>
								@endif
							</td>
							<td>{{ $v->created_at }}</td>
							<td>
								<a href="/admin/user/{{ $v->id }}/edit" class="btn btn-info">修改</a>
					            <form action="/admin/user/{{ $v->id }}" method="post" style="display: inline-block;">
					              {{ csrf_field() }}
					              {{ method_field('DELETE') }}
					            <input type="submit" value="删除" class="btn btn-danger" onclick="return confirm('确定删除?')">
					          </form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $user_data->appends($params)->links() }}
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