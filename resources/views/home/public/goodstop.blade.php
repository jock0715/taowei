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
							@if(!empty(session('home_data')))
								<ul class="message-l">
									<div class="topMessage">
										<div class="menu-hd">
											<a href="/home/login" target="_top" class="h">欢迎，{{ session('home_data')->uname }}</a>&nbsp;
											|<a href="/home/login/logout" target="_top" class="h" style="color: red">&nbsp;退出登录</a>
										</div>
									</div>
								</ul>
							@else
								<ul class="message-l">
									<div class="topMessage">
										<div class="menu-hd">
											<a href="/home/login" target="_top" class="h">亲，请登录</a>&nbsp;|
											<a href="/home/register" target="_top">免费注册</a>
										</div>
									</div>
								</ul>
							@endif
							<ul class="message-r">
								<div class="topMessage home">
									<div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
								</div>
								<div class="topMessage my-shangcheng">
									<div class="menu-hd MyShangcheng"><a href="/home/user/user_index" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
								</div>
								<div class="topMessage mini-cart">
									<div class="menu-hd"><a id="mc-menu-hd" href="/home/shopping" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
								</div>
								<div class="topMessage favorite">
									<div class="menu-hd"><a href="/home/user/user_collection" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
							</ul>
							</div>