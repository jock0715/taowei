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

// 后台 秒杀商品 状态 切换
Route::get('/admin/spike/status','Admin\SpikeController@status');
// 后台 秒杀商品
Route::resource('/admin/spike','Admin\SpikeController');

// 后台 活动商品 状态 切换
Route::get('/admin/doing/status','Admin\DoingController@status');
// 后台 活动商品
Route::resource('/admin/doing','Admin\DoingController');

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

// 前台 购物车
Route::resource('/home/shopping','Home\Shopping_infoController');

// 前台 订单 提交成功
Route::get('/home/order/success','Home\OrderController@success');
// 前台 订单 详情
Route::get('/home/order/order_infos','Home\OrderController@order_infos');
// 前台 订单 添加 查看
Route::resource('/home/order','Home\OrderController');

/*---------------------------前台结束-------------------------------------*/
