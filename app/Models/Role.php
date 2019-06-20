<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //链接数据表
    public $table = 'roles';

    public function role_node ()
    {
    	return $this->hasOne('App\Models\Role_node','rid');
    }
}
