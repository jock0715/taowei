		@include('/home/public/header')

		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/orstyle.css" rel="stylesheet" type="text/css">

		<style>
			.nav.white .logoBig img {
			    width: 11%;
			}
			.td-item .item-info {
			    margin: -27px 0px 0px 150px;
			}
		</style>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-orderinfo">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单详情</strong> / <small>Order&nbsp;details</small></div>
						</div>
						<hr/>
						<!--进度条-->
						<div class="m-progress">
							<div class="m-progress-list">
								<span class="step-1 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                   <p class="stage-name">拍下商品</p>
                                </span>
								<span class="step-2 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                   <p class="stage-name">卖家发货</p>
                                </span>
								<span class="step-3 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                   <p class="stage-name">确认收货</p>
                                </span>
								<span class="step-4 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">4<em class="bg"></em></i>
                                   <p class="stage-name">交易完成</p>
                                </span>
								<span class="u-progress-placeholder"></span>
							</div>
							<div class="u-progress-bar total-steps-2">
								<div class="u-progress-bar-inner"></div>
							</div>
						</div>
						<div class="order-infoaside">
							<div class="order-logistics">
								<a href="logistics.html">
									<div class="icon-log">
										<i><img src="images/receive.png"></i>
									</div>
									<div class="latest-logistics">
										<p class="text">已签收,签收人是青年城签收，感谢使用天天快递，期待再次为您服务</p>
										<div class="time-list">
											<span class="date">2015-12-19</span><span class="week">周六</span><span class="time">15:35:42</span>
										</div>
										<div class="inquire">
											<span class="package-detail">物流：天天快递</span>
											<span class="package-detail">快递单号: </span>
											<span class="package-number">373269427868</span>
											<a href="logistics.html">查看</a>
										</div>
									</div>
									<span class="am-icon-angle-right icon"></span>
								</a>
								<div class="clear"></div>
							</div>
							<div class="order-addresslist">
								<div class="order-address">
									<div class="icon-add">
									</div>
									<p class="new-tit new-p-re">
										<span class="new-txt">小叮当</span>
										<span class="new-txt-rd2">159****1622</span>
									</p>
									<div class="new-mu_l2a new-p-re">
										<p class="new-mu_l2cw">
											<span class="title">收货地址：</span>
											<span class="province">湖北</span>省
											<span class="city">武汉</span>市
											<span class="dist">洪山</span>区
											<span class="street">雄楚大道666号(中南财经政法大学)</span></p>
									</div>
								</div>
							</div>
						</div>
						<div class="order-infomain">

							<div class="order-main">

								<div class="order-status3">
								@foreach($data as $v)
								@if($v->status <=1 )
									<div class="order-title">
										<div class="dd-num">订单编号：<a href="javascript:;">{{ $v->number}}</a></div>
										<span>成交时间：{{ $v->created_at }}</span>
										<!--    <em>店铺：小桔灯</em>-->
									</div>
									<div class="order-content">

										<div class="order-left">


											<ul class="item-list">
												<li class="td td-item">
													<div class="item-pic" style="width:130px;margin-top: 2px;margin-left: -10px">
														<a href="#" class="J_MakePoint">
															<img src="/uploads/{{ $v->file }}" class="itempic J_ItemImg">
														</a>
													</div>
													<div class="item-info" >
														<div class="item-basic-info" >
															<a href="#" >
																<p>{{ $v->name }}</p>
																<p class="info-little">{{ $v->desc }}</p>
															</a>
														</div>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price">
														{{ $v->money }}
													</div>
												</li>
												<li class="td td-number">
													<div class="item-number">
														<span>×</span>{{ $v->num }}
													</div>
												</li>
												<li class="td td-operation">
													<div class="item-operation">
														退款/退货
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
														<p class="Mystatus">卖家已发货</p>
														<!-- <p class="order-info"><a href="logistics.html">查看物流</a></p>
														<p class="order-info"><a href="#">延长收货</a></p> -->
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
									@endif
								@endforeach
								</div>
							</div>
						</div>
					</div>

				</div>
				<!--底部-->
				@include('/home/public/footer')
			</div>
			<aside class="menu">
				@include('home/public/menu')

			</aside>
		</div>

	</body>
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
</html>