<?php

namespace app\home\controller;

use app\home\model\Address;
use app\home\model\Goods;
use app\home\model\GoodsAttr;
use app\home\model\Order;
use app\home\model\OrderGoods;
use think\Controller;
use think\Request;

class Cart extends Controller
{

   public function addcart()
   {
       $data = request()->param();
       //dump($data);die;
       \app\home\model\Cart::addCart($data['goods_id'],$data['number'],$data['goods_attr_ids']);
       $goods = Goods::find($data['goods_id']);
       return view('addcart',['goods'=>$goods]);
   }

   public function index()
   {
       //查询购物车数据
       $list = \app\home\model\Cart::getAllCart();
       //查询每条数据商品信息
       foreach ($list as &$v){
           //商品基本信息
           $v['goods'] = Goods::find($v['goods_id']);
           //连表查询 tpshop_goodsattr
           $v['goodsattr'] = GoodsAttr::alias('t1')
               ->join('tpshop_attribute t2','t1.attr_id = t2.id','left')
               ->field('t1.*,t2.attr_name')
               ->where('t1.id','in',$v['goods_attr_ids'])
               ->select();
       }
       return view('cart',['list'=>$list]);
   }

   public function flow2()
   {
       //登录判断
       if (!session('?user_info')){
           //没有登录,跳转到登录
           //设置 登录成功后的跳转地址
           session('back_url','home/cart/index');
           $this->redirect('home/login/login');
       }
       //接受参数
       $cart_ids = request()->param('cart_ids');

       //查询收货地址信息
       $user_id = session('user_info.id');
       $address = Address::where('user_id',$user_id)->select();
       $cart_data = \app\home\model\Cart::where('id','in',$cart_ids)->select();
       //
       $total_price = 0;
       foreach ($cart_data as &$v){
           //商品基本信息
           $v['goods'] = Goods::find($v['goods_id']);
           //连表查询 tpshop_goodsattr
           $v['goodsattr'] = GoodsAttr::alias('t1')
               ->join('tpshop_attribute t2','t1.attr_id = t2.id','left')
               ->field('t1.*,t2.attr_name')
               ->where('t1.id','in',$v['goods_attr_ids'])
               ->select();
           $total_price = $v['goods']['goods_price'] * $v['number'];
       }
       return view('flow2',['address' => $address , 'cart_data' => $cart_data , 'total_price' => $total_price]);
   }

   public function jieguo()
   {
       return view('flow3');
   }

   //ajax请求修改购买数量
    public function changenum()
    {
        //接收参数
        $data = request()->param();
        //参数验证 (略)
        //处理数据
        \app\home\model\Cart::changeNum($data['goods_id'],$data['number'],$data['goods_attr_ids']);
        //返回数据
        return ['code'=>10000,'msg'=>'success'];
    }

    //ajax请求删除购买数量
    public function delcart()
    {
        $data = request()->param();
        \app\home\model\Cart::delCart($data['goods_id'],$data['goods_attr_ids']);
        return ['code' => 10000 , 'msg' => 'success'];
    }

    //创建订单
    public function createorder()
    {
        //接收参数
        $data = request()->param();
        
        //订单表数据添加
        //
        $order_sn = time() . mt_rand(100000,999999);
        $user_id = session('user_info.id');
        //
        $cart_data = \app\home\model\Cart::alias('t1')
            ->join('tpshop_goods t2','t1.goods_id','left')
            ->field('t1.*,t2.goods_name,t2.goods_logo,t2.goods_price')
            ->where('t1.id','in',$data['cart_ids'])
            ->select();
        $order_amount = 0;
        foreach ($cart_data as $v) {
            $order_amount += $v['number'] * $v['goods_price'];
        }
        //
        $address = Address::find($data['address_id']);
        //
        $order_data = [
            'order_sn' => $order_sn,
            'user_id' => $user_id,
            'order_amount' => $order_amount,
            'consignee_name' => $address['consignee'],
            'consignee_phone' => $address['phone'],
            'consignee_address' => $address['address'],
            'shipping_type' => $data['shipping_type'],
            'pay_type' => $data['pay_type']
        ];
        //
        $order = Order::create($order_data);
        //
        $goods_data =[];
        foreach ($cart_data as $v) {
            $row = [
                'order_id' => $order->id,
                'goods_id' => $v['goods_id'],
                'goods_name' => $v['goods_name'],
                'goods_logo' => $v['goods_logo'],
                'goods_price' => $v['goods_price'],
                'number' => $v['number'],
                'goods_attr_ids' => $v['goods_attr_ids']
            ];
            $goods_data[] = $row;
        }
        //
        $ordergoods = new OrderGoods();
        $ordergoods->saveAll($goods_data);
        //删除购物车中对应的记录
        \app\home\model\Cart::destroy($data['cart_ids']);
        //进行支付
        switch ($data['pay_type']) {
            case '0':
                //银行卡
                break;
            case '1':
                //微信
                break;
            case '2':
                //支付宝
                $html = "<form name='alipayment' action='/plugins/alipay/pagepay/pagepay.php' method='post' style='display: none' id='alipayment'>
<input id='WIDout_trade_no' name='WIDout_trade_no' value='{$order_sn}' />
<input id='WIDSUBJECT' name='WIDsubject' value='TP电商' />
<input id='WIDtotal_amount' name='WIDtotal_amount' value='{$order_amount}' />
<input id='WIDbody' name='WIDbody' value='缺货' />
</form><script >document.getElementById('alipayment').submit();</script>";
                echo $html;
                break;
        }
    }

    public function flow3()
    {
        //接受参数
        $data = request()->param();
        //参数验证
        require_once "./plugins/alipay/config.php";
        require_once "./plugins/alipay/service/Alipay/TradeService.php";
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($data);
        if (!$result) {
            $this->error('参数验证失败');
        }
        return view('flow3',['data' => $data]);
    }
}
