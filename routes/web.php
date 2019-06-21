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

// 后台 轮播
Route::resource('/admin/banner','Admin\BannerController');

// 后台 商品
Route::resource('/admin/goods','Admin\GoodsController');

// 后台 秒杀商品
Route::resource('/admin/spike','Admin\SpikeController');

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


/*---------------------------------后台结束-------------------------------------*/


/*---------------------------------前台开始-------------------------------------*/


/*---------------------------------前台结束-------------------------------------*/
