<div class="tip">
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login " style="display: none;">
							@if(!empty(session('home_info')))
							<div class="avatar_box ">
								<a href="#" class="avatar_imgbox "><img src="/uploads/{{ session('home_info')->profile }}"></a>
								<ul class="user_info ">
								@if(!empty(session('home_data')))
									<li>{{ session('home_data')->uname }}</li>
									<li>
										级别&nbsp;:&nbsp;
										@if(session('home_data')->status == 1)
											普通会员
										@elseif(session('home_data')->status == 2)
											高级会员
									</li>
										@endif
								@else
									<li>游客</li>
									<li>级别&nbsp;:&nbsp;无</li>
								@endif
									
								</ul>
							</div>
							@else
							<div class="avatar_box ">
							  <a href="#" class="avatar_imgbox ">
							    <img src="/home/images/getAvatar.do.jpg"></a>
							  <ul class="user_info ">
							    <li class="">TaoWei用户_xxx</li>
							    <li class="">级别&nbsp;:&nbsp; 游客</li></ul>
							</div>
							@endif
							<div class="login_btnbox ">
								<a href="/home/order/order_infos" class="login_order ">我的订单</a>
								<a href="/home/user/user_collection" class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>
					
					<a href="/home/shopping">
						<div id="shopCart " class="item ">
							<p><span class="message "></span></p><br><br>
							<p style="color: white">
								购物车
							</p>
						</div>
					</a>

					<div id="foot " class="item ">
						<a href="/home/user/user_foot">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="/home/user/user_collection">
							<span class="wdsc "><img src="/home/images/wdsc.png "></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>
					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="/home/images/weixin_code_145.png "><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>