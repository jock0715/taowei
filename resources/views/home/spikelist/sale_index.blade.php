@include('/home/public/goodstop')
				<!--悬浮搜索框-->

				<div class="nav white">
					<div class="logo" ><img src="/home/images/logo.png" /></div>
					<div class="logoBig" >
						<li><img src="/admin/images/logo.png" /></li>
					</div>

					<div class="search-bar pr">
						<a name="index_none_header_sysc" href="#"></a>
						<form action="/home/spikelist">
							<input id="searchInput" name="search" type="text" placeholder="搜索" autocomplete="off" value="{{ $search }}">
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
								<div class="sort">
									<li><a href="/home/spikelist?search={{ $search }}" title="综合">综合排序</a></li>
									<li class="first"><a href="javascript:;" title="销量">销量排序</a></li>
									<li><a href="/home/spikelist/priceindex?search={{ $search }}" title="价格">价格优先</a></li>
									<!-- <li class="big"><a title="评价" href="#">评价为主</a></li> -->
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
									@foreach($spikes_sale_data as $k=>$v)
									<li>
										<div class="i-pic limit">
											<a href="/home/spikelist/info/{{ $v->id }}">
											 <img src="/uploads/{{ $v->file }}" />	
											
											
											<p class="title fl"><span style="font-size: 16px; font-weight: bold;">【{{ $v->name }}】</span> {{ $v->desc }}</p>
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
							</div>
							<div class="clear"></div> -->
							<!--分页 -->
							<div class="page_page">
								{{ $spikes_sale_data->appends(['search'=>$search])->links() }}
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