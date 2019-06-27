<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoingCollection extends Model
{
    // 声明操作的表名
   	public $table = 'doing_collections';

   	// 属于关系
    public function collectiondoing()
    {
    	return $this->belongsTo('App\Models\Doing','gid');
    }
}
