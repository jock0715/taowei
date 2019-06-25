<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddrs extends Model
{
    // 设置数据库表名
	public $table = 'user_addrs';
	// 设置主键
	public $primary = 'uid';

    // 配置属于关系
    public function addruser()
	    {
	        return $this->belongsTo('App\Models\User','id');
	    }


}
