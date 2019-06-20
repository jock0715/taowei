<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin_user extends Model
{
    //链接数据表
    public $table = 'admin_users';

    // 设置一对一关系
    public function Admin_user ()
    {
    	return $this->hasOne('App\Models\Admin_user_role','aid');
    }
}
