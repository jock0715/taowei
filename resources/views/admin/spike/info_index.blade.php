
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

		<div id="page-wrapper" style="background:url('/admin/images/litiqs.jpg') no-repeat 100% 100%;">
			<div class="main-page">
			<!-- 导入 提示信息 开始 -->
			@include('admin.public.message')
			<!-- 导入 提示信息 结束 -->
			<h3 class="title1">秒杀商品管理</h3>
				<!-- 搜索 开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
				  <form class="form-inline" action="/admin/spikeinfo">
				    <div class="form-group">
				      <label for="exampleInputName2">关键字</label>
				      <input type="text" class="form-control" name="search" value="{{ $search }}" id="exampleInputName2" placeholder="商品名称"></div>
				    <button type="submit" class="btn btn-success">搜索</button>
				</form>
				</div>
				<!-- 搜索 结束 -->
			<h5>秒杀商品列表</h5>
			<table class="table table-bordered tableaa" >
				<thead>
					<tr>
					  <th>编号</th>
					  <th>商品ID</th>
					  <th>商品名称</th>
					  <th>商品图片</th>
					  <th>操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($spikes_info as $k=>$v)

					<tr>
						<td>{{ $v->id }}</td>
						<td>{{ $v->gid }}</td>
						<td>{{ $v->gname }}</td>
						<td>
						<img src="/uploads/{{ $v->file }}" alt="" width="60px" class="img-thumbnail" title="">
						</td>
						<td>
							
							<!-- <a href="/admin/spike/{{ $v->id }}/edit" class="btn btn-info">修改</a> -->
							<!-- <form action="/admin/spike/{{ $v->id }}" method="post" style="display: inline-block;" >
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
				{{ $spikes_info->appends(['search'=>$search])->links() }}
			</div>
			<script type="text/javascript">
				
				//删除
				function del(id,obj){
					
					let file = $(obj).attr('file');
					if(!window.confirm('确定要删除吗?')){
						return false;
					}
					$.post('/admin/spikeinfo/'+id,{'_method':'DELETE',file:file,'_token':'{{ csrf_token() }}'},function(res){
						if(res == 'ok'){
							// 删除tr节点
							$(obj).parent().parent().remove();
						} else {
							alert('删除失败');
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