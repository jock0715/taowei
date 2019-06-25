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
						<div class="menu-hd MyShangcheng"><a href="/home/user/index" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
					</div>
					<div class="topMessage mini-cart">
						<div class="menu-hd"><a id="mc-menu-hd" href="/home/shopping" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
				</ul>
				</div>
				