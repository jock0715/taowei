<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // 设置数据库表名
	public $table = 'users';

    // 配置一对一
    public function userinfos()
    {
    	// users表关联userinfos表中的uid
    	return $this->hasOne('App\Models\UserInfos','uid');
    }

    // 配置一对一
    public function useraddrs()
    {
        // users表关联userinfos表中的uid
        return $this->hasOne('App\Models\UserAddrs','uid');
    }

    // 配置一对多
    public function userorder()
    {
    	// users表关联userinfos表中的uid
    	return $this->hasMany('App\Models\UserAddrs','uid');
    }

    // 配置一对多 （用户和商品收藏）
    public function usergoodscollection()
    {
        // users表关联goods_collections表中的uid
        return $this->hasMany('App\Models\GoodsCollection','uid');
    }

    // 配置一对多 （用户和秒杀商品收藏）
    public function userspikecollection()
    {
        // users表关联spike_collections表中的uid
        return $this->hasMany('App\Models\SpikeCollection','uid');
    }

    // 配置一对多 （用户和活动商品收藏）
    public function userdoingcollection()
    {
        // users表关联doing_collections表中的uid
        return $this->hasMany('App\Models\DoingCollection','uid');
    }
}
