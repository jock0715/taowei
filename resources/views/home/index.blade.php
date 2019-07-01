@include('/home/public/header')
			<div class="banner"> 
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" style="background:url('/admin/images/beijing.png') no-repeat 56% 18%" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
								@foreach($banners_data as $v)
								@if($v->status == 1)
								<li class=""><a><img src="/uploads/{{ $v->url }}" title="{{ $v->desc }}" /></a></li>
								@endif
								@endforeach
							</ul> 
						</div>
						<div class="clear"></div>	
			</div>
			<div class="shopNav">
				<div class="slideall">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						</div>					
		        				
						<!--侧边导航 -->
						<div id="nav" class="navfull"> 
							<div class="area clearfix">
								<div class="category-content" id="guide_2">
									@foreach($cate_data as $k=>$v)
									<div class="category">
										<ul class="category-list" id="js_climit_li">
											<li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="/home/images/cake.png"></i><a class="ml-22" title="{{ $v->cname }}">{{ $v->cname }}</a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top" style="height: 450px">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
															@foreach($v->sub as $kk=>$vv)
																<div class="sort-side">
																	<dl class="dl-sort">
																		<dt><span title="{{ $vv->cname}}">{{ $vv->cname}}</span></dt>
																		@foreach($vv->sub as $kkk=>$vvv)
																		<dd><a href="/home/catelist?cid={{ $vvv->id }}"  ><span>{{ $vvv->cname }}</span></a></dd>
																		@endforeach
																	</dl>
																</div>															
															</div>
														@endforeach
														</div>							
													</div>
												</div>
											<b class="arrow"></b>	
											</li>
										</ul>
									@endforeach
									</div>

								</div>

							</div>
						</div>
						
						
						<!--轮播-->
						
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>



					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="/home/images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/home/images/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/home/images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/home/images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg" style="background-color:#F5F5F5">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation" >


						<div class="clock am-u-sm-3">

							<img src="/home/images/2016.png ">
							<p>今日<br>推荐</p>
						</div>
						@foreach($advertis_data as $k=>$v)
						@if($v->status == 1)
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>{{ $v->title }}</h3>
								<h4>{{ $v->desc }}</h4>
							</div>
							<div class="recommendationMain ">
								<a href="https://{{ $v->url }}"><img src="/uploads/{{ $v->file }}" class="img-thumbnail" style="width:100px; "></img></a>
							</div>
						</div>						
						@endif
						@endforeach		
					</div>
					<div class="clear "></div>
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>秒杀商品</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="/home/spikelist">全部秒杀商品<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					  <div class="am-g am-g-fixed ">

						@foreach($spike4_data as $k=>$v)
						<div class="am-u-sm-3 ">
							<a href="/home/spikelist/info/{{ $v->id }}">
							<div class="icon-sale one "></div>	
								<h4>秒杀</h4>							
							<div class="activityMain ">
								<img src="/uploads/{{ $v->file }}"></img>
							</div>
							<div class="info ">
								<h3>{{ $v->name }}</h3>
							</div>
							</a>													
						</div>
						@endforeach

					  </div>
                   	</div>
					<div class="clear "></div>

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动商品</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="/home/doinglist">全部活动商品<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        	</span>
						</div>
					  <div class="am-g am-g-fixed ">
					  	@foreach($doing4_data as $k=>$v)
						<div class="am-u-sm-3 ">
							<a href="/home/doinglist/info/{{ $v->id }}">
							<div class="icon-sale one "></div>	
								<h4>活动</h4>							
							<div class="activityMain ">
								<img src="/uploads/{{ $v->file }}"></img>
							</div>
							<div class="info ">
								<h3>{{ $v->name }}</h3>
							</div>
							</a>												
						</div>
						@endforeach
					  </div>
                   </div>
					<div class="clear "></div>

                    <div id="f1">
					<!-- 商品 -->
					
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>商品</h4>
							<h3>每一种商品都有一个故事</h3>
							<span class="more ">
	                    		<a href="/home/goodslist">更多商品<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
	                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						@foreach($goods10_data as $k=>$v)
						<div class="am-u-sm-7 am-u-md-4 text-two">
								<a href="/home/goodslist/info/{{ $v->id }}">
								<div class="outer-con ">

									<div class="title ">
										【{{ $v->name }}】
									</div>
									<div class="sub-title ">
										¥ {{ $v->money }}
									</div>
									<!-- <i class="am-icon-shopping-basket am-icon-md  seprate"></i> -->
								</div>
								<img src="/uploads/{{ $v->file }}">
								</a>
						</div>
						<!-- <div class="am-u-sm-3 am-u-md-2 text-three big">
							<div class="outer-con " >
								<div class="title ">
									{{ $v->name }}
								</div>
								<div class="sub-title ">
									¥{{ $v->money }}
								</div>
								{{ $v->desc }}

							</div>
							
							<a href="# "><img src="/uploads/{{ $v->file }}" /></a>
						</div> -->
						@endforeach
					</div>
                 <div class="clear "></div>  
                 </div>
                 
				@include('/home/public/footer')

		</div>
		</div>
		<!--引导 -->
		<!-- <div class="navCir">
			<li class="active"><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					

		</div> -->


		<!-- 菜单 -->
		@include('home/public/slidebar')
		<!-- 菜单 -->
		<script>
			window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
		</script>
		<script type="text/javascript " src="/home/basic/js/quick_links.js "></script>
		</div> 
	</body>
</html>