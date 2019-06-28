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
							<form action="/admin/comment/{{ $data->id }}" method="post">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
							    <div class="form-group">
							      <label for="uid">用户名</label>
							      <input type="text" class="form-control" value="{{ $data->commentusers->uname }}" name="uid" readonly id="uname" placeholder="用户名" style="width: 510px;">
							  	</div>
							    <div class="form-group">
							      <label for="gid">购买的商品</label>
							      <input type="text" class="form-control" name="gid" id="phone" value="{{ $data->commentgoods->name }}" readonly style="width: 510px;">
							  	</div>
							  	<div class="form-group">
							      <label for="oid">订单号</label>
							      <input type="text" class="form-control" name="oid" id="addr" readonly value="{{ $data->commentorders->number }}" style="width: 510px;">
							  	</div>
							  	<div class="form-group">
							      <label for="content">评论</label>
							      <textarea type="text" class="form-control" name="content" id="gid"style="width: 510px;">{{ $data->content }}</textarea> 
							  	</div>
							  	<div class="form-group" >
							  		<label for="comment">评价</label>
							  		<select name="comment" style="width: 510px;margin-left: 10px;" class="form-control">
						      		<option disabled>----请选择----</option>
									<option value="0" 
								      	@if($data->comment == 0)
								      		selected
								      	@endif
								      	>好评</option>
								    <option value="1" 
								      	@if($data->comment == 1)
								      		selected
								      	@endif
								      	>中评</option>
								    <option value="2" 
								      	@if($data->comment == 2)
								      		selected
								      	@endif
								      	>差评</option>
						      	</select>
							  	</div>
						      	<br>
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