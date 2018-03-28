<?php

namespace app\admin\model;

use think\Model;

class Attribute extends Model
{
    //对attr_type和attr_input_type值进行转换
    public function getAttrTypeAttr($value)
    {
        return $value ? '单选属性' : '唯一属性';
    }

    public function getAttrInputTypeAttr($value)
    {
        return $value == 0 ? 'input输入框' : ($value == 1 ? '下拉列表' : '多选框');
    }
}
