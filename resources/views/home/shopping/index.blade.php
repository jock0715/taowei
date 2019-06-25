@include('/home/public/header')
			
			<!--购物车 -->
			<div class="concent">
				<div id="cartTable"> 
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<form action="" method="post">
					@foreach($data as $v)
					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<!-- <div class="bd-has-promo">已享优惠:<span class="bd-has-promo-content">省￥19.50</span>&nbsp;&nbsp;</div>
									<div class="act-promo">
										<a href="#" target="_blank">第二支半价，第三支免费<span class="gt">&gt;&gt;</span></a>
									</div> -->
									<span class="list-change theme-login">编辑</span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
								<ul class="item-content clearfix">
									<!-- <li class="td td-chk">
										<div class="cart-checkbox ">
											<input class="check" id="J_CheckBox_170769542747" name="items[]" value="170769542747" type="checkbox">
											<label for="J_CheckBox_170769542747"></label>
										</div>
									</li> -->
									<li class="td td-item">
										<div class="item-pic" style="width:130px;height:auto;">
											<!-- <a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12"> -->
												<img src="/uploads/{{ $v->file }}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												&nbsp; &nbsp; &nbsp; <a href="javascript:;" title="" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $v->name }}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
											<span class="sku-line">{{ $v->desc }}</span>
										<!-- 	<span tabindex="0" class="btn-edit-sku theme-login">修改</span> -->
											<i class="theme-login am-icon-sort-desc"></i>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<!-- <div class="price-line">
													<em class="price-original">78.00</em>
												</div> -->
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0">{{ $v->money }}</em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<!-- <input class="min am-btn" name="" type="button" value="-" /> -->
													<a href="/home/shopping/delnum?id={{ $v->id }}" class="min am-btn">-</a>
													<input class="text_box" name="num" type="text" value="{{ $v->num }}" oninput = "value=value.replace(/[^\d]/g,'')" style="width:30px;" />
													<a href="/home/shopping/addnum?id={{ $v->id }}" class="add am-btn">+</a>
													<!-- <input class="add am-btn" name="" type="button" value="+" /> -->
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number">{{ $v->price }}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a href="javascript:;" onclick="del({{ $v->id }},this)" data-point-url="#" class="delete">
                  							删除</a>
										</div>
									</li>
									
								</ul>
							</div>
						</div>
					</tr>
					@endforeach
				</div>

				<div class="clear"></div>
		
				<div class="float-bar-wrapper">
					<!-- <div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<a href="#" hidefocus="true" class="deleteAll">删除</a>
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div> -->
					<div class="float-bar-right">
						<!-- <div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div> -->
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">{{ $number }}</em></strong>
						</div>
						<div class="btn-area">
							<a href="/home/order/add" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
					</div>

				</div>
				</form>
				@include('/home/public/footer')

			</div>

			<!--操作页面-->

			<div class="theme-popover-mask"></div>

			<div class="theme-popover">
				<div class="theme-span"></div>
				<div class="theme-poptit h-title">
					<a href="javascript:;" title="关闭" class="close">×</a>
				</div>
				<div class="theme-popbod dform">
					<form class="theme-signin" name="loginform" action="" method="post">

						<div class="theme-signin-left">

							<li class="theme-options">
								<div class="cart-title">颜色：</div>
								<ul>
									<li class="sku-line selected">12#川南玛瑙<i></i></li>
									<li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
								</ul>
							</li>
							<li class="theme-options">
								<div class="cart-title">包装：</div>
								<ul>
									<li class="sku-line selected">包装：裸装<i></i></li>
									<li class="sku-line">两支手袋装（送彩带）<i></i></li>
								</ul>
							</li>
							<div class="theme-options">
								<div class="cart-title number">数量</div>
								<dd>
									<input class="min am-btn am-btn-default" name="" type="button" value="-" />
									<input class="text_box" name="" type="text" value="1" style="width:30px;" />
									<input class="add am-btn am-btn-default" name="" type="button" value="+" />
									<span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
								</dd>

							</div>
							<div class="clear"></div>
							<div class="btn-op">
								<div class="btn am-btn am-btn-warning">确认</div>
								<div class="btn close am-btn am-btn-warning">取消</div>
							</div>

						</div>
						<div class="theme-signin-right">
							<div class="img-info">
								<img src="images/kouhong.jpg_80x80.jpg" />
							</div>
							<div class="text-info">
								<span class="J_Price price-now">¥39.00</span>
								<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
							</div>
						</div>

					</form>
				</div>
			</div>
		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>
	<script>
	// 删除
		function del (id,obj) 
		{
			// 提示消息
			if (!window.confirm('是否确定删除！！！')) {
				return false;
			}
			$.get('/home/shopping/destroy',{id:id},function(res){
				if(res == 'ok') {
					// 删除节点
					$(obj).parent().parent().parent().remove();
					// 自动刷新页面
        			parent.location.reload(); 
				} else {
					alert('删除失败');
				}
			},'html');
		}
	</script>
</html>