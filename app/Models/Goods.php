<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 声明操作的表名
   	public $table = 'goods';

   	// 设置模型主键
    protected $primaryKey = 'id';

    // 属于关系
    public function goodscate()
    {
    	return $this->belongsTo('App\Models\Cate','cid');
    }

     // 配置一对多模型关系
    public function goodsinfo()
    {
        // 外键：一个表中的主键在另一个表中的冗余就是这外键
        return $this->hasMany('App\Models\GoodsInfo','gid');
    }
}
