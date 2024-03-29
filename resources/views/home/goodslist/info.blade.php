@include('/home/public/header')

		<style type="text/css">
			.tb-btn input{
					width: 98px;
    				border: 1px solid #F03726;
    				margin-right: 0px;
				    float: left;
				    overflow: hidden;
				    position: relative;
				    
				    height: 30px;
				    line-height: 30px;
				    background-color: #FFEDED;
				    color: #F03726;
				    font-size: 14px;
				    text-align: center;
				}     	
		</style>
		<link type="text/css" href="/home/css/optstyle.css" rel="stylesheet" />
		<link type="text/css" href="/home/css/style.css" rel="stylesheet" />

		<script type="text/javascript" src="/home/basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/home/basic/js/quick_links.js"></script>

		<script type="text/javascript" src="/home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<script type="text/javascript" src="/home/js/jquery.imagezoom.min.js"></script>
		<script type="text/javascript" src="/home/js/jquery.flexslider.js"></script>
		<script type="text/javascript" src="/home/js/list.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/layui/css/layui.css">
  		<script src="/layui/layui.js"></script>
  		<script type="text/javascript">//一般直接写在一个js文件中
		  layui.use(['layer', 'form'],
		  function() {
		    var layer = layui.layer
		  });
		</script>
        @include('home/public/message')
          
			<div class="listMain">

				<!--分类-->
			
				<ol class="am-breadcrumb am-breadcrumb-slash">
					<li><a href="/">首页</a></li>
					<li><a href="/home/goodslist">商品列表</a></li>
					<li class="am-active">商品详情</li>
				</ol>
				<script type="text/javascript">
					$(function() {});
					$(window).load(function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<!-- <div class="scoll">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<img src="/home/images/01.jpg" title="pic" />
								</li>
								<li>
									<img src="/home/images/02.jpg" />
								</li>
								<li>
									<img src="/home/images/03.jpg" />
								</li>
							</ul>
						</div>
					</section>
				</div> -->

				<!--放大镜-->

				<div class="item-inform">
					<div class="clearfixLeft" id="clearcontent">

						<div class="box">
							<script type="text/javascript">
								$(document).ready(function() {
									$(".jqzoom").imagezoom();
									$("#thumblist li a").click(function() {
										$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
										$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
										$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
									});
								});
							</script>

							<div class="tb-booth tb-pic tb-s310">
								<a href="/uploads/{{ $goods->file }}"><img src="/uploads/{{ $goods->file }}" alt="细节展示放大镜特效" rel="/uploads/{{ $goods->file }}" class="jqzoom" /></a>
							</div>
							<ul class="tb-thumb" id="thumblist">
								<li class="tb-selected">
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/uploads/{{ $goods->file }}" mid="/uploads/{{ $goods->file }}" big="/uploads/{{ $goods->file }}"></a>
									</div>
								</li>
								@foreach($goodsinfo as $k=>$v)
								<li>
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/uploads/{{ $v->file }}" mid="/uploads/{{ $v->file }}" big="/uploads/{{ $v->file }}" ></a>
									</div>
								</li>
								@endforeach
								<!-- <li>
									<div class="tb-pic tb-s40">
										<a href="#"><img src="/home/images/03_small.jpg" mid="/home/images/03_mid.jpg" big="/home/images/03.jpg"></a>
									</div>
								</li> -->
							</ul>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clearfixRight">

						<!--规格属性-->
						<!--名称-->
						<div class="tb-detail-hd">
							<h1>	
				 				【{{ $goods->name }}】{{ $goods->desc }}
				 					
									<a id="a1" href="javascript:;" onclick="del({{ $goods->id }})" style="float: right; display: {{ $collection == 1 ? 'block' : 'none' }};"><span class="am-icon-heart am-icon-fw"></span> 取消收藏</a>
									
					 				<a id="a2" href="javascript:;" onclick="collection({{ $goods->id }})" style="float: right; display: {{ $collection == 1 ? 'none' : 'block' }};"><span class="am-icon-heart am-icon-fw" style="color: red;"></span> 加入收藏</a>
					 			
	          				</h1>
						</div>
						<link rel="stylesheet" href="/home_login/layui/css/layui.css">
			              <script src="/home_login/layui/layui.js"></script>
			              <script>//一般直接写在一个js文件中
			                layui.use(['layer', 'form'],
			                function() {
			                  var layer = layui.layer
			                });
			              </script>
						<script type="text/javascript">
							// 加入收藏
							function collection(id) {

								$.post('/home/goodscollection', {id:id,'_token':'{{ csrf_token() }}'}, function(res){
									if(res.msg == 'ok'){
										layer.msg(res.info);
										$('#a2').css('display','none');
										$('#a1').css('display','block');
									} else {
										layer.msg(res.info);
									}
								},'json');
							}

							// 取消收藏
							function del(id) {
								
								$.post('/home/goodscollection/'+id,{'_method':'DELETE','_token':'{{ csrf_token() }}'}, function(res){
									if(res.msg == 'ok'){
										layer.msg(res.info);
										$('#a1').css('display','none');
										$('#a2').css('display','block');
									} else {
										layer.msg(res.info);
									}
								},'json');
							}
						</script>
						<div class="tb-detail-list">
							<!--价格-->
							<div class="tb-detail-price">
								<li class="price iteminfo_price">
									<dt>价格</dt>
									<dd><em>¥</em><b class="sys_item_price">{{ $goods->money }}</b>  </dd>                                 
								</li>
								<li class="price iteminfo_mktprice">
									<!-- <dt>原价</dt> -->
									<!-- <dd><em>¥</em><b class="sys_item_mktprice">98.00</b></dd>									 -->
								</li>
								<div class="clear"></div>
							</div>

							<div class="clear"></div>

							<!--销量-->
							<ul class="tm-ind-panel">
								<li class="tm-ind-item tm-ind-sellCount canClick">
									<div class="tm-indcon"><span class="tm-label">销售量</span><span class="tm-count">{{ $goods->sale }}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-sumCount canClick">
									<div class="tm-indcon"><span class="tm-label">库存</span><span class="tm-count">{{ $goods->over }}</span></div>
								</li>
								<li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
									<div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count">{{ count($comment_data) }}</span></div>
								</li>
							</ul>
							<div class="clear"></div>

							<!--各种规格-->
							<dl class="iteminfo_parameter sys_item_specpara">
								<dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
								<dd>
									<!--操作页面-->

									<div class="theme-popover-mask"></div>

									<div class="theme-popover">
										<div class="theme-span"></div>
										<div class="theme-poptit">
											<a href="javascript:;" title="关闭" class="close">×</a>
										</div>
										<div class="theme-popbod dform">
                    <form action="/home/shopping/goodsadd/{{ $goods->id }}" method="post" >
                        {{ csrf_field() }} 
                        						<input type="hidden" name="gid" value="{{ $goods->id }}">
												<div class="theme-signin-left">

													<!-- <div class="theme-options">
														<div class="cart-title">口味</div>
														<ul>
															<li class="sku-line selected">原味<i></i></li>
															<li class="sku-line">奶油<i></i></li>
															<li class="sku-line">炭烧<i></i></li>
															<li class="sku-line">咸香<i></i></li>
														</ul>
													</div>
													<div class="theme-options">
														<div class="cart-title">包装</div>
														<ul>
															<li class="sku-line selected">手袋单人份<i></i></li>
															<li class="sku-line">礼盒双人份<i></i></li>
															<li class="sku-line">全家福礼包<i></i></li>
														</ul>
													</div> -->
                    
													<div class="theme-options">
														<div class="cart-title number">数量</div>
														<dd>
															<input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
															<input id="text_box" name="num" type="text" value="1" oninput = "value=value.replace(/[^\d]/g,'')" style="width:30px;" />
															<input id="add" class="am-btn am-btn-default" name="" type="button" value="+" />
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
														<img src="/home/images/songzi.jpg" />
													</div>
													<div class="text-info">
														<span class="J_Price price-now">¥39.00</span>
														<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
													</div>
												</div>

											
										</div>
									</div>

								</dd>
							</dl>
							<div class="clear"></div>
						
						</div>

						<div class="pay">
							<div class="pay-opt">
							<a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
							<a><span class="am-icon-heart am-icon-fw">收藏</span></a>
							
							</div>
                            <li>
                                <div class="clearfix tb-btn tb-btn-buy theme-login">
                                
                                    <a href="javascript:;" onclick="abc({{ $goods->id }})">
                                    立即购买</a>

                                    <!-- <input id="LikBuy" title="点此按钮到下一步确认购买信息" value="立即购买"> -->
                                </div>
                            </li>
							<li>
								<div class="clearfix tb-btn tb-btn-basket theme-login" >
								<!-- <a id="LikBasket" href="">加入购物车</a> -->
                                <input type="submit" id="LikBasket" value="加入购物车" style="color: white; background-color: red">
								</div>
							</li>
                    </form>
                            
						</div>
                        
					</div>
					<div class="clear"></div>

				</div>
                
                <script>
                    function abc(id){
                        let num = $('#text_box').val();
                        location.href='/home/order/gocreate?id='+id+'&num='+num;
                    }
                </script> 
				
				<div class="clear"></div>
				
							
				<!-- introduce-->

				<div class="introduce">
					<div class="browse">
					    <div class="mc"> 
						     <ul>					    
						     	<div class="mt">            
						            <h2>推荐商品	</h2>        
					            </div>
						     	@foreach($cate_goods3 as $k=>$v)
							      <li>
							      	<div class="p-img">                    
							      		<a  href="/home/goodslist/info/{{ $v->id }}"> <img class="" src="/uploads/{{ $v->file }}"> </a>               
							      	</div>
							      	<div class="p-name"><a href="/home/goodslist/info/{{ $v->id }}">
							      		【{{ $v->name }}】{{ $v->desc }}
							      	</a>
							      	</div>
							      	<div class="p-price"><strong>{{ $v->money }}</strong></div>
							      </li>
							    @endforeach			      
					      
						     </ul>					
					    </div>
					</div>
					<div class="introduceMain">
						<div class="am-tabs" data-am-tabs>
							<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
								<li class="am-active">
									<a href="#">

										<span class="index-needs-dt-txt">宝贝详情</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">全部评价</span></a>

								</li>

								<li>
									<a href="#">

										<span class="index-needs-dt-txt">猜你喜欢</span></a>
								</li>
							</ul>

							<div class="am-tabs-bd">

								<div class="am-tab-panel am-fade am-in am-active">
									<div class="J_Brand">

										<div class="attr-list-hd tm-clear">
											<h4>产品类型:&nbsp;</h4></div>
										<!-- <div class="clear"></div> -->
										<!-- <ul id="J_AttrUL"> -->
											<!-- <li title="">产品类型:&nbsp;</li> -->
											<!-- <li title="">原料产地:&nbsp;巴基斯坦</li>
											<li title="">产地:&nbsp;湖北省武汉市</li>
											<li title="">配料表:&nbsp;进口松子、食用盐</li>
											<li title="">产品规格:&nbsp;210g</li>
											<li title="">保质期:&nbsp;180天</li>
											<li title="">产品标准号:&nbsp;GB/T 22165</li>
											<li title="">生产许可证编号：&nbsp;QS4201 1801 0226</li>
											<li title="">储存方法：&nbsp;请放置于常温、阴凉、通风、干燥处保存 </li>
											<li title="">食用方法：&nbsp;开袋去壳即食</li> -->
										<!-- </ul> -->
										<div class="clear"></div>
									</div>

									<div class="details">
										<div class="attr-list-hd after-market-hd">
											<h4>商品细节</h4>
										</div>
										<div class="twlistNews">
										@foreach($goodsinfo as $k=>$v)
											<img src="/uploads/{{ $v->file }}" />
										@endforeach
										</div>
									</div>
									<div class="clear"></div>

								</div>

								<div class="am-tab-panel am-fade">
									
                                    <div class="actor-new">
                                    	<div class="rate">                
                                    		<strong>100<span>%</span></strong><br> <span>好评度</span>            
                                    	</div>
                                        <dl>                    
                                            <dt>买家印象</dt>                    
                                            <dd class="p-bfc">
                                            			<q class="comm-tags"><span>味道不错</span><em>(2177)</em></q>
                                            			<q class="comm-tags"><span>颗粒饱满</span><em>(1860)</em></q>
                                            			<q class="comm-tags"><span>口感好</span><em>(1823)</em></q>
                                            			<q class="comm-tags"><span>商品不错</span><em>(1689)</em></q>
                                            			<q class="comm-tags"><span>香脆可口</span><em>(1488)</em></q>
                                            			<q class="comm-tags"><span>个个开口</span><em>(1392)</em></q>
                                            			<q class="comm-tags"><span>价格便宜</span><em>(1119)</em></q>
                                            			<q class="comm-tags"><span>特价买的</span><em>(865)</em></q>
                                            			<q class="comm-tags"><span>皮很薄</span><em>(831)</em></q> 
                                            </dd>                                           
                                         </dl> 
                                    </div>	
                                    <div class="clear"></div>
									<div class="tb-r-filter-bar">
										<ul class=" tb-taglist am-avg-sm-4">
											<li class="tb-taglist-li tb-taglist-li-current">
												<div class="comment-info">
													<span>全部评价</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-1">
												<div class="comment-info">
													<span>好评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li-0">
												<div class="comment-info">
													<span>中评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>

											<li class="tb-taglist-li tb-taglist-li--1">
												<div class="comment-info">
													<span>差评</span>
													<span class="tb-tbcr-num">(32)</span>
												</div>
											</li>
										</ul>
									</div>
									<div class="clear"></div>

									<ul class="am-comments-list am-comments-list-flip">
										@foreach($comment_data as $k=>$v)
										<li class="am-comment">
											<!-- 评论容器 -->
											<a href="javascript:;">
												<img class="am-comment-avatar" src="/home/images/getAvatar.do.jpg" />
												<!-- 评论者头像 -->
											</a>

											<div class="am-comment-main">
												<!-- 评论内容容器 -->
												<header class="am-comment-hd">
													<!--<h3 class="am-comment-title">评论标题</h3>-->
													<div class="am-comment-meta">
														<!-- 评论元数据 -->
														<a href="#link-to-user" class="am-comment-author">{{ $v->commentusers->uname }}</a>
														<!-- 评论者 -->
														评论于：
														<time datetime="">{{ $v->created_at }}</time>
													</div>
												</header>

												<div class="am-comment-bd">
													<div class="tb-rev-item " data-id="255776406962">
														<div class="J_TbcRate_ReviewContent tb-tbcr-content ">
															{{ $v->content }}
														</div>
														<div class="tb-r-act-bar">
															商品规格：<span style="color: red">{{ $v->commentgoods->desc }}</span>
														</div>
													</div>

												</div>
												<!-- 评论内容 -->
											</div>
										</li>
										@endforeach

									</ul>

									<div class="clear"></div>

									<!--分页 -->
									<!-- <ul class="am-pagination am-pagination-right">
										<li class="am-disabled"><a href="#">&laquo;</a></li>
										<li class="am-active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">&raquo;</a></li>
										
									</ul> -->{{ $comment_data->links() }}
									<div class="clear"></div>

									<div class="tb-reviewsft">
										<div class="tb-rate-alert type-attention">购买前请查看该商品的 <a href="#" target="_blank">购物保障</a>，明确您的售后保障权益。</div>
									</div>

								</div>

								<div class="am-tab-panel am-fade">
									<div class="like">
										<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
										@foreach($cate_goods as $k=>$v)
											<li>
											<a  href="/home/goodslist/info/{{ $v->id }}">
												<div class="i-pic limit">
													<img src="/uploads/{{ $v->file }}" />
													<p>【{{ $v->name }}】{{ $v->desc }}</p>
													<p class="price fl">
														<b>¥</b>
														<strong>{{ $v->money }}</strong>
													</p>
												</div>
												</a>
											</li>
											@endforeach
										</ul>
									</div>
									<div class="clear"></div>

									<!--分页 -->
									<!-- <ul class="am-pagination am-pagination-right">
										<li class="am-disabled"><a href="#">&laquo;</a></li>
										<li class="am-active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#">&raquo;</a></li>
									</ul> -->
									<div class="clear"></div>

								</div>

							</div>

						</div>

						<div class="clear"></div>

					<!-- 页尾 -->
					@include('/home/public/footer')
					</div>

				</div>
			</div>
			<!--菜单 -->
			@include('/home/public/slidebar')

	</body>
	<script>
		function shopping (id)
		{
			$.get('/home/shopping/index',{id:id},function (res) {
				console.log(res)
			},'html');
		}
	</script>
</html>