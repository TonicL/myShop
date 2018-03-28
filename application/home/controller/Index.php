<?php
namespace app\home\controller;

use app\home\model\Category;
use app\home\model\Goods;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        //查询显示的分类
        $category = Category::where('is_show',1)->select();
        //分类ID 1, 查询指定分类名称和旗下的商品
        $cate_info = Category::find(1);
        $goods = Goods::where('cate_id',1)->limit(12)->select();
        //模板赋值与渲染
       return view('index',['category'=>$category,'cate_info'=>$cate_info,'goods'=>$goods]);
    }
}
