<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //链接数据表
    public $table = 'nodes';

    // 设置一对一
    public function node_role ()
    {
    	return $this->hasOne('App\Models\Role_node','nid');
    }
}
