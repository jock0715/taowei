
<!DOCTYPE HTML>
<html>
<head>
<!-- 页头 开始 -->
@include('admin.public.header')
<!-- 页头 结束 -->
<style type="text/css">
	.tableaa td{
		text-align: center;
	}
	.tableaa th{
		text-align: center;
	}
</style>
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
			<h3 class="title1">活动商品管理</h3>
				<!-- 搜索 开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
				  <form class="form-inline" action="/admin/doing">
				    <div class="form-group">
				      <label for="exampleInputName2">关键字</label>
				      <input type="text" class="form-control" name="search" value="{{ $search }}" id="exampleInputName2" placeholder="商品名称"></div>
				    <button type="submit" class="btn btn-success">搜索</button>
				</form>
				</div>
				<!-- 搜索 结束 -->
			<h5>活动商品列表</h5>
			<table class="table table-bordered tableaa" >
				<thead>
					<tr>
					  <th>编号</th>
					  <th>商品名称</th>
					  <th>商品图片</th>
					  <th>所属分类</th>
					  <th>商品价格</th>
					  <th>商品库存</th>
					  <th>商品销量</th>
					  <th>状态</th>
					  <th>操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($doings as $k=>$v)

					<tr>
						<td>{{ $v->id }}</td>
						<td>{{ $v->name }}</td>
						<td>
						<img src="/uploads/{{ $v->file }}" alt="" width="60px" class="img-thumbnail" title="{{ $v->desc }}">
						</td>
						
						<td>{{ $v->doingcate->cname }}</td>
						<td>{{ $v->money }}</td>
						<td>{{ $v->over }}</td>
						<td>{{ $v->sale }}</td>
						<td>
						  	@if($v->status == 0)
					            <a href="javascript:;"><kbd style="background-color:red; " onclick="kai({{ $v->id }},this)">下架</kbd></a>
					            @else($v->status == 1)
					            <a href="javascript:;"><kbd style="background-color:green" onclick="guan({{ $v->id }},this)">上架</kbd></a>
					        @endif
						</td>
						<td>
							<a href="/admin/doing/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<!-- <form action="/admin/doing/{{ $v->id }}" method="post" style="display: inline-block;" >
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
								<input type="submit" value="删除" class="btn btn-danger" onclick="return confirm('确定要删除吗?')">
							</form> -->
							<a href="javascript:;" class="btn btn-danger" file="{{ $v->file }}"  onclick="del({{$v->id}},this)">删除</a>
							
						</td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
			<div>
				<!-- 显示页码 -->
				{{ $doings->appends(['search'=>$search])->links() }}
			</div>
			<script type="text/javascript">
				//删除
				function del(id,obj){
		
					let file = $(obj).attr('file');
					if(!window.confirm('确定要删除吗?')){
						return false;
					}
					$.post('/admin/doing/'+id,{'_method':'DELETE',file:file,'_token':'{{ csrf_token() }}'},function(res){
						if(res == 'ok'){
							// 删除tr节点
							$(obj).parent().parent().remove();
						} else {
							alert('删除失败');
						}
					},'html');
				}


				// 上架
				function kai(id,obj)
				{
					$.get('/admin/doing/status',{id:id}, function(res){
						if (res == 'ok') {
							if ($(obj).text() == '下架') {
								$(obj).css('background-color','green');
								$(obj).text('上架');
							} else {
								$(obj).css('background-color','red');
								$(obj).text('下架');
							}
						} else {
							alert('切换失败');
						}
					},'html');
				}

				// 下架
				function guan(id,obj)
				{
					$.get('/admin/doing/status',{id:id}, function(res){
						if (res == 'ok') {
							if ($(obj).text() == '上架') {
								$(obj).css('background-color','red');
								$(obj).text('下架');
							} else {
								$(obj).css('background-color','green');
								$(obj).text('上架');
							}
						} else {
							alert('切换失败');
						}
					},'html');
				}
			</script>
			<div class="main-page" style="display:none;">
				<div class="row calender widget-shadow">
					<h4 class="title">Calender</h4>
					<div class="cal1">
						
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- 内容 结束 -->

	</div>
	<!-- 页脚 静态资源 开始 -->
	@include('admin.public.footer_static')
	<!-- 页脚 静态资源 结束 -->
	
</body>
</html>