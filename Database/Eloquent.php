<?php

namespace Gg\Database;

use Illuminate\Database\Eloquent\Model;

class Eloquent extends Model
{
    /**
     * 定义默认使用的库
     * @var string
     */
    protected $connection = 'default';

    /**
     * 格式化 数据
     * @var string[]
     */
    protected $casts = [
        'created_at'   => 'date:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
    ];

}
