<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsCollection extends Model
{
    // 声明操作的表名
   	public $table = 'goods_collections';

   	// 属于关系
    public function collectiongoods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }
}
