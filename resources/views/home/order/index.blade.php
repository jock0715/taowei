@include('home/public/header')

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/orstyle.css" rel="stylesheet" type="text/css">
		<!-- <link rel="stylesheet" href="/layui/css/layui.css">
		  		<script src="/layui/layui.js"></script> -->
		<style>
			.nav.white .logoBig img {
			    width: 11%;
			}
			.td-item .item-info {
			    margin: -19px 0px -14px 145px;
			}
		</style>
	<!-- 	<script type="text/javascript">//一般直接写在一个js文件中
	  layui.use(['layer', 'form'],
	  function() {
	    var layer = layui.layer
	  });
	</script> -->
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-order">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active"><a href="#tab1">待发货</a></li>
								<li><a href="#tab3">待签收</a></li>
								<li><a href="#tab4">待评价</a></li>
								<li><a href="#tab5">已评价</a></li>
							</ul>

							<div class="am-tabs-bd">
								<!-- 待发货 -->
								<div class="am-tab-panel am-fade am-in am-active" id="tab1">
								
								@foreach($orders as $k=>$v)
									@if($v->status == 0)
									<div class="order-main">
										<div class="order-list">
											
											<!-- 待发货 -->
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $v->number}}</a></div>
													<span>成交时间：{{ $v->created_at }}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic" style="margin-top: 2px;margin-left: -10px">
																	<a href="javascript:;" class="J_MakePoint">
																		<img src="/uploads/{{ $v->file}}" class="itempic J_ItemImg">
																	</a>
																</div>

																<div class="item-info" style="padding-left:10px 20px">
																	<div class="item-basic-info">
																		<a href="#">
																			<p>{{ $v->name }}</p>
																			<p class="info-little"> {{ $v->desc }}</p>
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{ $v->price }}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{ $v->num }}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $v->price }}
																<p>含运费：<span>{{ $v->fare }}</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">交易进行中</p>
																</div>
															</li>
															<li class="td td-change">
															
															</li>
														</div>
													</div>
												</div>
											</div>											
										</div>

									</div>
									@endif
									
								@endforeach
								
								</div>
								
								<!-- 待签收 -->
								<div class="am-tab-panel am-fade" id="tab3">
								
								@foreach($orders as $k=>$v)
									@if($v->status == 1)
									<div class="order-main">
										<div class="order-list">
											
											<!--未评价2-->
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $v->number}}</a></div>
													<span>成交时间：{{ $v->created_at }}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic" style="margin-top: 2px;margin-left: -10px">
																	<a href="javascript:;" class="J_MakePoint">
																		<img src="/uploads/{{ $v->file}}" class="itempic J_ItemImg">
																	</a>
																</div>

																<div class="item-info" style="padding-left:10px 20px">
																	<div class="item-basic-info">
																		<a href="javascript:;">
																			<p>{{ $v->name }}</p>
																			<p class="info-little"> {{ $v->desc }}</p>
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{ $v->price }}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{ $v->num }}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $v->price }}
																<p>含运费：<span>{{ $v->fare }}</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">交易进行中</p>
																</div>
															</li>
															<li class="td td-change">
															<a href="javascript:;" onclick="receipt({{ $v->id }})">
																<div class="am-btn am-btn-danger anniu">
																	确认收货</div>
															</a>
															</li>
														</div>
													</div>
												</div>
											</div>											
										</div>

									</div>
									@endif
								@endforeach
								<script>
									function receipt (id)
									{
										// 提示消息
										if (!window.confirm('是否确定收货！！！')) {
											return false;
										}
										$.get('/home/order/receipt',{id},function(res) {
											if(res == 'ok') {
												// 自动刷新页面
							        			parent.location.reload(); 
											} else {
												alert('收货失败');
											}
										},'html');
									}
								</script>
								</div>
								
								<!-- 待评价 -->
								<div class="am-tab-panel am-fade" id="tab4">
								
								@foreach($orders as $k=>$v)
									@if($v->status == 2)
									<div class="order-main">
										<div class="order-list">
											
											
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $v->number}}</a></div>
													<span>成交时间：{{ $v->created_at }}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic" style="margin-top: 2px;margin-left: -10px">
																	<a href="javascript:;" class="J_MakePoint">
																		<img src="/uploads/{{ $v->file}}" class="itempic J_ItemImg">
																	</a>
																</div>

																<div class="item-info" style="padding-left:10px 20px">
																	<div class="item-basic-info">
																		<a href="#">
																			<p>{{ $v->name }}</p>
																			<p class="info-little"> {{ $v->desc }}</p>
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{ $v->price }}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{ $v->num }}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $v->price }}
																<p>含运费：<span>{{ $v->fare }}</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">交易已完成</p>
																</div>
															</li>
															<li class="td td-change">
															<a href="/home/user/user_replyed/{{ $v->id }}">
																<div class="am-btn am-btn-danger anniu">
																	评价</div>
															</a>
															</li>
														</div>
													</div>
												</div>
											</div>											
										</div>

									</div>
									@endif
								@endforeach
								</div>

								<!-- 待评价 -->
								<div class="am-tab-panel am-fade" id="tab5">
								@foreach($orders as $k=>$v)
								@if($v->status == 3)
									<div class="order-main">
										<div class="order-list">
											
											<!--已评价3-->
											<div class="order-status5">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;">{{ $v->number}}</a></div>
													<span>成交时间：{{ $v->created_at }}</span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">
														<ul class="item-list">
															<li class="td td-item">
																<div class="item-pic" style="margin-top: 2px;margin-left: -10px">
																	<a href="javascript:;" class="J_MakePoint">
																		<img src="/uploads/{{ $v->file}}" class="itempic J_ItemImg">
																	</a>
																</div>

																<div class="item-info" style="padding-left:10px 20px">
																	<div class="item-basic-info">
																		<a href="#">
																			<p>{{ $v->name }}</p>
																			<p class="info-little"> {{ $v->desc }}</p>
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	{{ $v->price }}
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span>{{ $v->num }}
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	
																</div>
															</li>
														</ul>

													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：{{ $v->price }}
																<p>含运费：<span>{{ $v->fare }}</span></p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus">交易成功</p>
																</div>
															</li>
															<li class="td td-change">
															<a href="javascript:;" onclick="del({{ $v->id }})">
																<div class="am-btn am-btn-danger anniu">
																	删除订单</div>
															</a>
															</li>
														</div>
													</div>
												</div>
											</div>											
										</div>

									</div>
									@endif
								@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--底部-->
				@include('home/public/footer')
			</div>
			<aside class="menu">
				@include('home/public/menu')
			</aside>
		</div>

	</body>
	<script>
	// 删除订单
	function del (id) 
	{
		// 提示消息
			if (!window.confirm('是否确定删除！！！')) {
				return false;
			}
		$.get('/home/order/destroy',{id},function(res){
			
				if(res == 'ok') {
					// 自动刷新页面
        			parent.location.reload(); 
				} else {
					alert('删除失败');
				}
		},'html');
	}
/*	function del(id){
    if(!window.confirm('确定删除吗?')){
      return false;
    }
    $.get('/home/order/destroy',{id},function(res){
      if(res.msg == 'ok'){
        layer.msg(res.info);
        setTimeout(function(){
          //关闭当前页面
          window.parent.location.reload();
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          // 跳转
          parent.location.reload();
        },800);
      }else{
        layer.msg(res.info);
      }
    },'json');
  }
*/
	</script>
</html>