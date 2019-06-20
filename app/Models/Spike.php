<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spike extends Model
{
    // 声明操作的表名
   	public $table = 'spikes';

   	// 属于关系
    public function spikescate()
    {
    	return $this->belongsTo('App\Models\Cate','cid');
    }
}
