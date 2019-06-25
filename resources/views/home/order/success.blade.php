@include('/home/public/header')

<link href="/home/css/sustyle.css" rel="stylesheet" type="text/css" />
<script type="/home/text/javascript" src="basic/js/jquery-1.7.min.js"></script>


<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>{{ $data['price'] }}</em></li>
       <div class="user-info">
         <p>收货人：{{ session('home_data')->uname }} </p>
         <p>联系电话：{{ session('home_data')->phone }}</p>
         <p>收货地址：{{ session('home_info')->addr }}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="/home/order" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
        <a href="/home/order/order_infos" class="J_MakePoint">查看<span>交易详情</span></a>
     </div>
    </div>
  </div>
</div>

@include('/home/public/footer')
</body>
</html>
