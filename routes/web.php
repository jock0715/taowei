<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
   
/*---------------------------------后台开始-------------------------------------*/


// 后台 登录
Route::get('/admin/login','Admin\Admin_userController@login')->name('admin_login');

// 后台 执行登录
Route::post('/admin/dologin','Admin\Admin_userController@dologin');

// 后台 执行退出登录
Route::get('/admin/loginout','Admin\Admin_userController@loginout');

// 后台 执行修改头像
Route::post('/admin/doeditfile/{id}','Admin\Admin_userController@doeditfile');

// 后台 执行修改密码
Route::post('/admin/doeditpwd','Admin\Admin_userController@doeditpwd');

// 登录验证
Route::group(['middleware'=>'login'],function(){

// 后台 首页
Route::get('/admin/index','Admin\IndexController@index');

// 后台 管理员
Route::resource('/admin/admin_user','Admin\Admin_userController');

// 后台 职位
Route::resource('/admin/role','Admin\RoleController');
 
// 后台 权限
Route::resource('/admin/node','Admin\NodeController');

// 后台 用户
Route::resource('/admin/user','Admin\UserController');

// 后台 分类
Route::resource('/admin/cate','Admin\CateController');

// 后台 轮播 状态
Route::get('/admin/banner/status','Admin\BannerController@status');
// 后台 轮播
Route::resource('/admin/banner','Admin\BannerController');

// 后台 商品 状态 切换
Route::get('/admin/goods/status','Admin\GoodsController@status');
// 后台 商品
Route::resource('/admin/goods','Admin\GoodsController');
// 后台 商品详情
Route::resource('/admin/goodsinfo','Admin\GoodsinfoController');

// 后台 秒杀商品 状态 切换
Route::get('/admin/spike/status','Admin\SpikeController@status');
// 后台 秒杀商品
Route::resource('/admin/spike','Admin\SpikeController');
// 后台 秒杀商品详情
Route::resource('/admin/spikeinfo','Admin\SpikeinfoController');

// 后台 活动商品 状态 切换
Route::get('/admin/doing/status','Admin\DoingController@status');
// 后台 活动商品
Route::resource('/admin/doing','Admin\DoingController');
// 后台 活动商品详情
Route::resource('/admin/doinginfo','Admin\DoinginfoController');

// 后台 评价
Route::resource('/admin/comment','Admin\CommentController');

// 后台 广告
Route::get('/admin/adverti/status','Admin\AdvertiController@status');
Route::resource('/admin/adverti','Admin\AdvertiController');


// 后台 订单
Route::resource('/admin/order','Admin\OrderController');

// 后台 友情链接
Route::get('/admin/link/status','Admin\LinkController@status');
Route::resource('/admin/link','Admin\LinkController');

});


/*---------------------------------后台结束-------------------------------*/



/*---------------------------前台开始-------------------------------------*/

// 前台 首页
Route::get('/','Home\IndexController@index');

// 前台注册
Route::get('/home/register','Home\RegisterController@index');

// 获取手机号
Route::get('/home/register/sendPhone','Home\RegisterController@sendPhone');

// 执行手机注册
Route::post('/home/register/store','Home\RegisterController@store');

// 执行邮箱注册
Route::post('/home/register/insert','Home\RegisterController@insert');
// 执行激活
Route::get('/home/register/status/{id}/{token}','Home\RegisterController@status');

//显示登录页面
Route::get('/home/login','Home\LoginController@index');

// 前台执行登录功能
Route::post('/home/login/dologin','Home\LoginController@dologin');


// 前台执行退出登录功能
Route::get('/home/login/logout','Home\LoginController@logout');

// 前台 商品列表页面
Route::get('/home/list/info/{id}','Home\ListController@info');
Route::resource('/home/list','Home\ListController');

// 前台 秒杀商品 详情页
Route::get('/home/spikelist/info/{id}','Home\SpikelistController@info');
// 前台 秒杀商品 列表页 按销售量从多到少排序
Route::get('/home/spikelist/saleindex','Home\SpikelistController@saleindex');
// 前台 秒杀商品 列表页 按商品价格从低到高排序
Route::get('/home/spikelist/priceindex','Home\SpikelistController@priceindex');
// 前台 秒杀商品
Route::resource('/home/spikelist','Home\SpikelistController');


// 前台 购物车 添加
Route::post('/home/shopping/add/{id}','Home\Shopping_infoController@add');
// 前台 购物车 添加数量
Route::get('/home/shopping/addnum','Home\Shopping_infoController@addnum');
// 前台 购物车 减少数量
Route::get('/home/shopping/delnum','Home\Shopping_infoController@delnum');
// 前台 购物车 删除
Route::get('/home/shopping/destroy','Home\Shopping_infoController@destroy');
// 前台 购物车 显示
Route::resource('/home/shopping','Home\Shopping_infoController');

// 前台 订单 提交成功
Route::get('/home/order/success','Home\OrderController@success');
// 前台 订单 详情
Route::get('/home/order/order_infos','Home\OrderController@order_infos');
// 前台 立即购买订单 添加
Route::get('/home/order/create','Home\OrderController@create');
// 前台 购物车订单 添加 显示
Route::get('/home/order/add','Home\OrderController@add');
// 前台 购物车订单 添加 处理
Route::post('/home/order/doadd','Home\OrderController@doadd');
// 前台 订单 查看
Route::resource('/home/order','Home\OrderController');

// 前台用户中心
Route::get('/home/user/user_index','Home\UserController@user_index');
// 前台用户信息
Route::get('/home/user/user_info','Home\UserController@user_info');
// 前台用户信息执行修改
Route::post('/home/user/user_infos','Home\UserController@user_infos');
// 前台用户头像执行修改
Route::post('/home/user/user_file/{id}','Home\UserController@user_file');
// 前台用户地址
Route::get('/home/user/user_addr','Home\UserController@user_addr');
// 前台用户执行添加地址
Route::post('/home/user/user_addrs','Home\UserController@user_addrs');
// 前台用户执行删除地址
Route::get('/home/user/deladdr','Home\UserController@deladdr');
// 前台用户安全
Route::get('/home/user/user_security','Home\UserController@user_security');
// 前台用户安全显示修改密码
Route::get('/home/user/user_upwd','Home\UserController@user_upwd');
// 前台用户安全执行修改密码
Route::post('/home/user/user_upwds','Home\UserController@user_upwds');
// 前台用户订单
// Route::get('/home/user/user_order','Home\UserController@user_order');
// 前台用户售后
Route::get('/home/user/user_after','Home\UserController@user_after');
// 前台用户账单
Route::get('/home/user/user_bill','Home\UserController@user_bill');
// 前台用户收藏
Route::get('/home/user/user_collection','Home\UserController@user_collection');
// 前台用户足迹
Route::get('/home/user/user_foot','Home\UserController@user_foot');
// 前台用户评论
Route::get('/home/user/user_reply','Home\UserController@user_reply');

/*---------------------------前台结束-------------------------------------*/
