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
					<h3 class="title1">活动商品管理</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>添加活动商品 :</h4>
						</div>
						<div class="form-body">
						  <form action="/admin/doing" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						    <div class="form-group">
						      <label for="name">商品名称</label>
						      <input type="text" class="form-control" style="width:510px;" value="{{ old('name') }}" name="name" id="name" placeholder="商品名称">
						  	</div>
						  	<div class="form-group">
						      <label for="cid">所属分类</label>
						      <select name="cid" id="" class="form-control" style="width:510px;">
									<option value=""> -- 请选择 -- </option>

									@foreach($cates as $k=>$v)
									<option value="{{ $v->id }}" {{ substr_count($v->path,',') < 2 ? 'disabled' : ''}}>{{ $v->cname }}</option>
									@endforeach

						      </select>
						  	</div>
						  	<div class="form-group">
						      <label for="desc">商品描述</label>
						      <input type="text" class="form-control" style="width:510px;" value="{{ old('desc') }}" name="desc" id="desc" placeholder="商品描述">
						  	</div>
						  	<div class="form-group">
						      <label for="money">商品价格</label>
						      <input type="text" class="form-control" style="width:510px;" value="{{ old('money') }}" name="money" id="money" placeholder="商品价格(保留到小数点后两位)">
						  	</div>
						  	<div class="form-group">
						      <label for="over">商品库存</label>
						      <input type="text" class="form-control" style="width:510px;" value="{{ old('over') }}" name="over" id="over" placeholder="商品库存">
						  	</div>

						    <div class="form-group">
						      <label for="exampleInputFile">商品图片</label>
						      <input type="file" name="file" id="exampleInputFile">
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

	</div>
	<!-- 页脚 静态资源 开始 -->
	@include('admin.public.footer_static')
	<!-- 页脚 静态资源 结束 -->
</body>
</html>