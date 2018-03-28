<?php

namespace app\admin\model;

use think\Model;

class Auth extends Model
{
    public function getIsNavAttr($value)
    {
        return $value ? 'yes' : 'no';
    }

}
