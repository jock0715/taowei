@include('/home/public/header')

		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
		<link href="/home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/home/css/systyle.css" rel="stylesheet" type="text/css">
		<style>
			.nav.white .logoBig img {
			    width: 11%;
			}
			.me{
				height: 615px;
			}
		</style>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					<div class="wrap-left">
						<div class="wrap-list">
							<div class="m-user">
								<!--个人信息 -->
								<div class="m-bg"></div>
								<div class="m-userinfo">
									<div class="m-baseinfo">
										<a href="/home/information.html">
											<img src="/home/images/getAvatar.do.jpg">
										</a>
										<em class="s-name">{{ session('home_data')->uname }}<span class="vip1"></em>
										<div class="s-prestige am-btn am-round">
											</span>会员福利</div>
									</div>
									<div class="m-right">
										<div class="m-new">
											<a href="/home/news.html"><i class="am-icon-bell-o"></i>消息</a>
										</div>
										<div class="m-address">
											<a href="/home/user/user_addr" class="i-trigger">我的收货地址</a>
										</div>
									</div>
								</div>

								<!--个人资产-->
							</div>
							<div class="box-container-bottom"></div>

							<!--订单 -->
							<div class="m-order">
								<div class="s-bar">
									<i class="s-icon"></i>我的订单
									<a class="i-load-more-item-shadow" href="/home/order">全部订单</a>
								</div>
								<ul>
									<li><a href="javas:;"><i><img src="/home/images/pay.png"/></i><span>待付款</span></a></li>
									<li><a href="/home/order"><i><img src="/home/images/send.png"/></i><span>待发货<em class="m-num">1</em></span></a></li>
									<li><a href="/home/order"><i><img src="/home/images/receive.png"/></i><span>待收货</span></a></li>
									<li><a href="/home/order"><i><img src="/home/images/comment.png"/></i><span>待评价<em class="m-num">3</em></span></a></li>
									<li><a href="/home/user/user_after"><i><img src="/home/images/refund.png"/></i><span>退换货</span></a></li>
								</ul>
							</div>
							<!--九宫格-->
							<div class="user-patternIcon">
								<div class="s-bar">
									<i class="s-icon"></i>我的常用
								</div>
								<ul>
									<a href="/home/home/shopcart.html"><li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img src="/home/images/iconbig.png"/><p>购物车</p></li></a>
									<a href="/home/collection.html"><li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img src="/home/images/iconsmall1.png"/><p>我的收藏</p></li></a>
									<a href="/home/home/home.html"><li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img src="/home/images/iconsmall0.png"/><p>为你推荐</p></li></a>
									<a href="/home/comment.html"><li class="am-u-sm-4"><i class="am-icon-pencil am-icon-md"></i><img src="/home/images/iconsmall3.png"/><p>好评宝贝</p></li></a>
									<a href="/home/foot.html"><li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img src="/home/images/iconsmall2.png"/><p>我的足迹</p></li></a>                                                                        
								</ul>
							</div>
							<!--物流 -->

							<!--收藏夹 -->
							<div class="you-like">
								<img src="/home/images/timg.jpg" alt="" style="height:350px;">

							</div>

						</div>
					</div>
					<div class="wrap-right">

						<!-- 日历-->
						<div class="day-list">
							<div class="s-bar">
								<a class="i-history-trigger s-icon" href="javascript:;"></a>我的日历
								<a class="i-setting-trigger s-icon" href="javascript:;"></a>
							</div>
							<div class="s-care s-care-noweather">
								<div class="s-date">
									<em>{{ date('d') }}</em>
									<span>
										@switch( date('w') )
											@case(1)
												星期一
												@break
											@case(2)
												星期二
												@break
											@case(3)
												星期三
												@break
											@case(4)
												星期四
												@break
											@case(5)
												星期五
												@break
											@case(6)
												星期六
												@break
											@case(0)
												星期日
												@break
										@endswitch
									 </span>
									<span>{{ date('Y-m') }}</span>
								</div>
							</div>
						</div>
				

						<!--热卖推荐 -->
						<div class="new-goods">
							<div class="s-bar">
								<i class="s-icon"></i>热卖推荐
							</div>
							@foreach($goods2_data as $k=>$v)
							<div class="new-goods-info">
								<a class="shop-info" href="/home/goodslist/info/{{ $v->id }}" >
									<div >
										<img src="/uploads/{{ $v->file }}" alt="">
									</div>
                                    <span class="one-hot-goods">￥{{ $v->money }} | 已售： {{ $v->sale }}</span>
								</a>
							</div>
							@endforeach
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
		<!--引导 -->
		<div class="navCir">
			<li><a href="/home/home/home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="/home/home/sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="/home/home/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li class="active"><a href="/home/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>

</html>