<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';

    //order属于user
    public function orderuser()
    {
    	// 本表的uid属于user的id
    	return $this->belongsTo('App\Models\User','uid');
    }
}
