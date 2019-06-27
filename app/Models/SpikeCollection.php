<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpikeCollection extends Model
{
    // 声明操作的表名
   	public $table = 'spike_collections';

   	// 属于关系
    public function collectionspike()
    {
    	return $this->belongsTo('App\Models\Spike','gid');
    }
}
