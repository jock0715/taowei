<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment_spike extends Model
{
    public $table = 'comments_spikes';

    // 一对多
    public function commentsusers()
    {
    	return $this->belongsTo('App\Models\User','uid');
    }

    // 关系
    public function commentsgoods()
    {
    	return $this->belongsTo('App\Models\Goods','sid');
    }

    // 关系
    public function commentsorders()
    {
    	return $this->belongsTo('App\Models\Order','oid');
    }
}
