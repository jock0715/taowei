
<div class="footer ">
	<div class="footer-hd ">
		<p>
		@foreach($links_data as $k=>$v)
			<a href="https://{{ $v->url }}">{{ $v->name }}</a>|	
		</p>
		@endforeach
	</div>
	<div class="footer-bd ">
		<p>
			<a href="# ">关于恒望</a>
			<a href="# ">合作伙伴</a>
			<a href="# ">联系我们</a>
			<a href="# ">网站地图</a>
			<em>© 2015-2025 Hengwang.com 版权所有</em>
		</p>
	</div>
</div>



