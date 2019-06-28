<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment_doing extends Model
{
    public $table = 'comments_doings';

    // 一对多
    public function commentdusers()
    {
    	return $this->belongsTo('App\Models\User','uid');
    }

    // 关系
    public function commentdgoods()
    {
    	return $this->belongsTo('App\Models\Goods','did');
    }

    // 关系
    public function commentdorders()
    {
    	return $this->belongsTo('App\Models\Order','oid');
    }
}
