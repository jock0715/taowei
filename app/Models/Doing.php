<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doing extends Model
{
    // 声明操作的表名
   	public $table = 'doings';

   	// 属于关系
    public function doingcate()
    {
    	return $this->belongsTo('App\Models\Cate','cid');
    }
}
