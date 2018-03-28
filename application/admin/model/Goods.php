<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Goods extends Model
{
    //设置完整的数据表名称 这样就是让model直接找这个表，而不需要去model.php的predix属性配置其前缀
    protected $table='tpshop_goods';
    //tpshop数据库中的tpshop_goods的数据表

    use SoftDelete;
    protected $deleteTime='delete_time';
}
