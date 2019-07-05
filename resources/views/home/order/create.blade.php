@include('/home/public/header')

			<link href="/home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

			<link href="/home/basic/css/demo.css" rel="stylesheet" type="text/css" />
			<link href="/home/css/cartstyle.css" rel="stylesheet" type="text/css" />

			<link href="/home/css/jsstyle.css" rel="stylesheet" type="text/css" />

			<script type="/home/text/javascript" src="js/address.js"></script>
			<form action="/home/order" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="concent">
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div class="control">
							<a href="/home/user/user_addr">
							<div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
							</a>
						</div>
						<div class="clear"></div>
						<ul>
							<div class="per-border"></div>

							<li class="user-addresslist defaultAddr">

								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">
										@if(!empty(session('home_data')))
										@if(!empty($addr_data))
										<input type="hidden" name="uid" value="{{ session('home_data')->id }}">

										<input type="hidden" name="addr" value="{{ $addr_data->uaddr }}">
										<input type="hidden" name="phone" value="{{ $addr_data->aphone }}">


										<input type="hidden" name="gid" value="{{ empty($goods->id)?'':$goods->id }}">
										<input type="hidden" name="did" value="{{ empty($doing->id)?'':$doing->id }}">
										<input type="hidden" name="sid" value="{{ empty($spike->id)?'':$spike->id }}">

                    					<span class="buy-user">{{ $addr_data->aname }} </span><br>
										<span class="buy-phone">{{ $addr_data->aphone }}</span>
										</span>
										
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<!-- <span class="buy--address-detail">
								   <span class="province">湖北</span>省
										<span class="city">武汉</span>市
										<span class="dist">洪山</span>区 -->
										<span class="street">{{ $addr_data->uaddr }} </span>
										</span>
									@endif
										</span>
										@else
											"<script>location.href='/home/login';</script>"
										@endif
									</div>
									<ins class="deftip">默认地址</ins>
								</div>
								<div class="address-right">
									<a href="person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<a href="#" class="hidden">设为默认</a>
									<span class="new-addr-bar hidden">|</span>
									<a href="/home/user/user_addr">编辑</a>
									<!--<span class="new-addr-bar">|</span>
									 <a href="javascript:void(0);" onclick="delClick(this);">删除</a> -->
								</div>

							</li>

							

						</ul>

						<div class="clear"></div>
					</div>
					<!--物流 -->
					<div class="logistics">
						<h3>合作物流</h3>
						<ul class="op_express_delivery_hot">
							<li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
							<li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
							<li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
							<li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
							<li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

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
									<div class="th th-oplist">
										<div class="td-inner">运费</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>

							<tr class="item-list">
								<div class="bundle  bundle-last">

									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic" style="width:130px;">
													
													<input type="hidden" name="file" value="					@if(!empty($spike->file))
																	{{$spike->file}}
																@elseif(!empty($doing->file))
																	{{$doing->file}}
																@elseif(!empty($goods->file))
																	{{$goods->file}}
																@endif">


														<a href="#" class="J_MakePoint" name="file">
															<img src="/uploads/
																@if(!empty($spike->file))
																	{{$spike->file}}
																@elseif(!empty($doing->file))
																	{{$doing->file}}
																@elseif(!empty($goods->file))
																	{{$goods->file}}
																@endif"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
														<input type="hidden" name="name" value="			@if(!empty($spike->name))
																	{{$spike->name}}
																@elseif(!empty($doing->name))
																	{{$doing->name}}
																@elseif(!empty($goods->name))
																	{{$goods->name}}
																@endif">
															&nbsp; &nbsp; &nbsp; &nbsp; <a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11" name="name">
																@if(!empty($spike->name))
																	{{$spike->name}}
																@elseif(!empty($doing->name))
																	{{$doing->name}}
																@elseif(!empty($goods->name))
																	{{$goods->name}}
																@endif
																</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
													<input type="hidden" name="desc" value="
														@if(!empty($spike->desc))
																	{{$spike->desc}}
														@elseif(!empty($doing->desc))
															{{$doing->desc}}
														@elseif(!empty($goods->desc))
															{{$goods->desc}}
														@endif
													">
												&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; <span class="sku-line" style="width: 300px;display: block;margin-left: 72px;">
																@if(!empty($spike->desc))
																	{{$spike->desc}}
																@elseif(!empty($doing->desc))
																	{{$doing->desc}}
																@elseif(!empty($goods->desc))
																	{{$goods->desc}}
																@endif
														</span>
													</div>
												</li>·
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
														<input type="hidden" name="money" value="
																@if(!empty($spike->money))
																	{{$spike->money}}
																@elseif(!empty($doing->money))
																	{{$doing->money}}
																@elseif(!empty($goods->money))
																	{{$goods->money}}
																@endif
														">
															<em class="J_Price price-now">
																@if(!empty($spike->money))
																	{{$spike->money}}
																@elseif(!empty($doing->money))
																	{{$doing->money}}
																@elseif(!empty($goods->money))
																	{{$goods->money}}
																@endif
															</em>
														</div>
													</div>
												</li>
											</div>
											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">
															<input class="text_box" name="num" type="text" value="@if(!empty($snum)){{$snum}}@elseif(!empty($donum)){{$donum}}@elseif(!empty($gonum)){{$gonum}}@endif
															" oninput = "value=value.replace(/[^\d]/g,'')"  style="width:30px;" readonly/>
														</div>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<div class="td-inner">
												<input type="hidden" name="price" value="@if(!empty($sprice))
														{{$sprice}}
													@elseif(!empty($doprice))
														{{$doprice}}
													@elseif(!empty($goprice))
														{{$goprice}}
													@endif">
													<em tabindex="0" class="J_ItemSum number">@if(!empty($sprice))
														{{$sprice}}
													@elseif(!empty($doprice))
														{{$doprice}}
													@elseif(!empty($goprice))
														{{$goprice}}
													@endif
													</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														快递<b class="sys_item_freprice">0</b>元
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							<div class="clear"></div>
							</div>
							<div class="pay-total">
						<!--留言-->
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<h3>买家留言：</h3>
										<textarea name="message" id="" style="font-size:15px" cols="100" rows="5" placeholder="最多输入100个字符"></textarea>
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>
							
							</div>
							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum">
																@if(!empty($sprice))
																	{{$sprice}}
																@elseif(!empty($doprice))
																	{{$doprice}}
																@elseif(!empty($goprice))
																	{{$goprice}}
																@endif
																</em>
								</p>
							</div>

							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">
											@if(!empty($sprice))
												{{$sprice}}
											@elseif(!empty($doprice))
												{{$doprice}}
											@elseif(!empty($goprice))
												{{$goprice}}
											@endif
                                    	</em>
											</span>
										</div>
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<!-- <a href="/home/order/success" tabindex="0" title="点击此按钮，提交订单">提交订单</a> -->
											<input type="submit" id="J_Go" style="display: inline-block;"  class="btn-go"  value="提交订单">
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				</form>
			</div>
			@include('/home/public/footer')
			<div class="theme-popover-mask"></div>
			<div class="theme-popover">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
				</div>
				<hr/>

				<div class="am-u-md-12">
					<form class="am-form am-form-horizontal">

						<div class="am-form-group">
							<label for="user-name" class="am-form-label">收货人</label>
							<div class="am-form-content">
								<input type="text" id="user-name" placeholder="收货人">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">手机号码</label>
							<div class="am-form-content">
								<input id="user-phone" placeholder="手机号必填" type="email">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">所在地</label>
							<div class="am-form-content address">
								<select data-am-selected>
									<option value="a">浙江省</option>
									<option value="b">湖北省</option>
								</select>
								<select data-am-selected>
									<option value="a">温州市</option>
									<option value="b">武汉市</option>
								</select>
								<select data-am-selected>
									<option value="a">瑞安区</option>
									<option value="b">洪山区</option>
								</select>
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-intro" class="am-form-label">详细地址</label>
							<div class="am-form-content">
								<textarea class="" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
								<small>100字以内写出你的详细地址...</small>
							</div>
						</div>

						<div class="am-form-group theme-poptit">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<div class="am-btn am-btn-danger">保存</div>
								<div class="am-btn am-btn-danger close">取消</div>
							</div>
						</div>
					</form>
				</div>

			</div>

			<div class="clear"></div>
	</body>

</html>