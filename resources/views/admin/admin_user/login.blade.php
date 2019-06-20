<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="zxx">


<head>
	<title>Particles Login Form Form Responsive Widget Template :: w3layouts</title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Particles Login Form Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);


		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->
	<!-- Stylesheets -->
	<link href="/admin_login/css/style.css" rel='stylesheet' type='text/css' />
	<!-- online fonts-->
	<link href="https://fonts.googleapis.com/css?family=Amiri:400,400i,700,700i" rel="stylesheet">
	<style>
		.text input{
			    width: 100%;
			    color: #fff;
			    outline: none;
			    font-size: 17px;
			    letter-spacing: 0.5px;
			    padding: 15px;
			    margin: 10px;
			    box-sizing: border-box;
			    border: none;
			    -webkit-appearance: none;
			    font-family: 'Amiri', serif;
			    background: rgba(0, 0, 0, 0.53);


			}


	</style>
</head>


<body>
	
	<!--  particles  -->
	<div id="particles-js"></div>
	<!-- //particles -->
	<div class="w3ls-pos">
		<h1>Welcome AdminiStrator Login</h1>
		<div class="w3ls-login box">
			<!-- form starts here -->
			<form action="/admin/dologin" method="post">
			{{ csrf_field() }}
				<div class="text" >
				@if( session('error'))
				<input type="text" value="{{ session('error') }}" disabled>
				@endif 
					<input type="text" autocomplete="off" name="name"  placeholder="admin" id="myInput" value="zhengyu1" />
				
				</div>
				<div class="text">
					<input type="password" name="pwd" placeholder="******" required="" value="123456" />
					<div class="agile_label">
					</div>
				</div>
				<div class="w3ls-bot text">
					<input type="submit" value="LOGIN">
				</div>
			</form>
		</div>
		<!-- //form ends here -->
		<!--copyright-->
		<div class="copy-wthree">
			<p>© 2018 Particles Login Form. All Rights Reserved | Design by
				<a href="http://w3layouts.com/" target="_blank">W3layouts</a>
			</p>
		</div>
		<!--//copyright-->
	</div>
	<!-- scripts required  for particle effect -->
	<script src='/admin_login/js/particles.min.js'></script>
	<script src="/admin_login/js/index.js"></script>
	<!-- //scripts required for particle effect -->
</body>


</html>