<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo">
					<a href="javascript:;">
						<h1>淘味</h1>
						<span>AdminPanel</span>
					</a>
				</div>
				<!--//logo-->
				<!--search-box-->
				<div class="search-box">
				
					<form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>
				</div><!--//end-search-box-->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
			
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="" alt="" style="width: 50px; height: 50px; border-radius: 50%;"> </span> 
									<div class="user-name">
										<p>admin</p>
										<span>Administrator</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="javascript:;" onclick="pass()"><i class="fa fa-cog"></i> 修改密码</a> </li> 
								<li> <a href="javascript:;" onclick="profile()"><i class="fa fa-user"></i> 头像</a> </li> 
								<li> <a href="/admin/logout"><i class="fa fa-sign-out"></i> 退出</a> </li>
							</ul>
						</li>
					</ul>
				</div>

				<script type="text/javascript">
					//模态框
					function pass(){
						// 修改密码 模态框
						$('#mypass').modal('show');
					}
					//修改头像 模态框
					function profile(){
						// 显示模态框
						$('#myprofile').modal('show');
					}
				</script>
				<!-- 修改密码模态框 开始 -->
				<div class="modal fade" tabindex="-1" role="dialog" id="mypass" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        	<h1 class="modal-title" align="center">修改密码</h1>
				        	<form action="/admin/user/updateUpass" method="post" >
				        		{{ csrf_field() }}
				        		<div class="form-group">
							      <label for="upass">旧密码</label>
							      <input type="password" class="form-control" name="oldupass" id="oldupass" placeholder="密码">
							  	</div>

								<div class="form-group">
							      <label for="upass">新密码</label>
							      <input type="password" class="form-control" name="upass" id="upass" placeholder="密码">
							  	</div>

							  	<div class="form-group">
							      <label for="repass">确认新密码</label>
							      <input type="password" class="form-control" name="repass" id="repass" placeholder="确认密码">
							  	</div>
							  	<button type="submit" class="btn btn-default">Submit</button>
				        	</form>
				      </div>
				      
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- 修改密码模态框 结束 -->

				<!-- 修改头像模态框 开始 -->
				<div class="modal fade" tabindex="-1" role="dialog" id="myprofile" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        	<h1 class="modal-title" align="center">修改头像</h1>
				        	<form action="/admin/user/updateProfile" method="post" enctype="multipart/form-data">
				        		{{ csrf_field() }}
				        		<img src="" alt="" style="width: 200px; ">
				        		<div class="form-group">
							      <label for="exampleInputFile">头像</label>
							      <input type="file" name="profile" id="exampleInputFile">
						  		</div>
						  		<input type="hidden" name="oldprofile" value="">
							  	<button type="submit" class="btn btn-default">Submit</button>
				        	</form>
				      </div>
				      
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- 修改头像 模态框 结束 -->
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>