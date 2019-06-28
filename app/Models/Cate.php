<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{

    // 声明操作的数据表
    public $table = 'cates';

    // 配置一对多模型关系
    public function categoods()
    {
    	// 外键：一个表中的主键在另一个表中的就是这外键
    	return $this->hasMany('App\Models\Goods','cid');
    }

}
