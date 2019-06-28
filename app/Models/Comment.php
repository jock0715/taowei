<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    // 一对多
    public function commentusers()
    {
    	return $this->belongsTo('App\Models\User','uid');
    }

    // 关系
    public function commentgoods()
    {
    	return $this->belongsTo('App\Models\Goods','gid');
    }

    // 关系
    public function commentorders()
    {
    	return $this->belongsTo('App\Models\Order','oid');
    }

    // 关系
    public function commentuinfo()
    {
        return $this->belongsTo('App\Models\UserInfos','uid');
    }

    
}
