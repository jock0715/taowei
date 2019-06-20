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

    // 配置一对多
    // public function userorder()
    // {
    // 	// users表关联userinfos表中的uid
    // 	return $this->hasOne('App\Models\Order','uid');
    // }
}
