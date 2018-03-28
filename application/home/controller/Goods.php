<?php

namespace app\home\controller;

use app\home\model\Attribute;
use app\home\model\GoodsAttr;
use app\home\model\Goodspics;
use think\Controller;
use think\Request;

class Goods extends Controller
{
  public function detail($id)
  {
      $goods = \app\home\model\Goods::find($id);
      $goodspics = Goodspics::where('goods_id',$id)->select();
      $attribute =Attribute::where('type_id',$goods->type_id)->select();
      $goodsattr = GoodsAttr::where('goods_id',$id)->select();
      return view('detail',['goods'=>$goods,'goodspics'=>$goodspics,'attribute'=>$attribute,'goodsattr'=>$goodsattr]);
  }
}
