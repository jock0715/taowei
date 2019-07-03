
<div class="footer ">
	<div class="footer-hd ">
		<p>
		@foreach($links_data as $k=>$v)
			<a href="https://{{ $v->url }}">{{ $v->name }}</a>|
		@endforeach	
		</p>
		
	</div>
	<div class="footer-bd ">
		<p>
			<a href="# ">PHP&nbsp;47期</a>
			<em>© 2019-2019 TaoWei.com 版权所有</em>
		</p>
	</div>
</div>

