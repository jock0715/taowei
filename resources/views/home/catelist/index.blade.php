<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>首页</title>

		<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/home/css/hmstyle.css" rel="stylesheet" type="text/css"/>
		<link href="/home/css/skin.css" rel="stylesheet" type="text/css" />
		<script src="/home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

		<link href="/home/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/home/css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/home/js/jquery.js"></script>

		<style type="text/css">
			
			.pagination,.pagination li{
				padding:0;
				margin:0;
				list-style-type:none;
			}
			.pagination a,.pagination span {
				position :relative;
				float:left;
				padding:6px 12px;
				margin-left: :-1px;
				line-height: 1.42857143;
				color:#337ab7;
				text-decoration: none;
				background-color:#fff;
				border:1px solid #ddd;
			}
			.active span{
				background-color:#0FB9DB;
				color:#ddd;
			}
			
			
		</style>

	</head>

	<body >
		<div class="hmtop" >
			<!--顶部导航条 -->
			<div class="am-container header">
				<ul class="message-l">
					<div class="topMessage">
						<div class="menu-hd">
							<a href="/home/login" target="_top" class="h">亲，请登录</a>
							<a href="/home/register" target="_top">免费注册</a>
						</div>
					</div>
				</ul>
				<ul class="message-r">
					<div class="topMessage home">
						<div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
					</div>
					<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
					</div>
					<div class="topMessage mini-cart">
						<div class="menu-hd"><a id="mc-menu-hd" href="/home/shopping" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
				</ul>
				</div>

				<!--悬浮搜索框-->

				<div class="nav white">
					<div class="logo" ><img src="/home/images/logo.png" /></div>
					<div class="logoBig" >
						<li><img src="/admin/images/logo.png" /></li>
					</div>

					<div class="search-bar pr">
						<a name="index_none_header_sysc" href="#"></a>
						<form action="/home/goodslist">
							<input id="searchInput" name="search" type="text" placeholder="搜索" autocomplete="off" value="">
							<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
						</form>
					</div>
				</div>

				<div class="clear"></div>
			</div>

<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />

<link href="/home/css/seastyle.css" rel="stylesheet" type="text/css" />
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
			<div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/">首页</a></li>
                                
							</ul>
						   <!--  <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div> -->
						</div>
			</div>
			
				
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
							<div class="search-content">
								
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
									@foreach($goods_data as $k=>$v)
									<li>
										<div class="i-pic limit">
											<a href="/home/goodslist/info/{{ $v->id }}">
											 <img src="/uploads/{{ $v->file }}" />	
											
											<p class="title fl">【{{ $v->name}}】{{ $v->desc }}</p>
											<p class="price fl">
												<b>¥</b>
												<strong>{{ $v->money }}</strong>
											</p>
											<p class="number fl">
												销量<span>{{ $v->sale }}</span>
											</p>
											</a>
										</div>
									</li>
									@endforeach
								</ul>

							</div>
							<!-- <div class="search-side">

								<div class="side-title">
									经典搭配
								</div>

								<li>
									<div class="i-pic check">
										<img src="/home/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								

							</div> -->
							<div class="clear"></div>
							<!--分页 -->
							<div class="page_page">
							{{ $goods_data->appends(['search'=>$search])->links() }}	
							</div>


						</div>
					</div>
					<!-- 页尾 -->
					@include('/home/public/footer')
				</div>

			</div>

		<!--引导 -->
		<!-- <div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div> -->

		<!--菜单 -->
		@include('/home/public/right')

<div class="theme-popover-mask"></div>

	</body>

</html>