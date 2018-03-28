<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"/Users/apple/Sites/workspace/tpshop/public/../application/home/view/cart/addcart.html";i:1521861390;s:69:"/Users/apple/Sites/workspace/tpshop/application/home/view/layout.html";i:1522031245;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">



    <link href="/static/home/css/amazeui.css" rel="stylesheet" type="text/css" />

    <link href="/static/home/css/demo.css" rel="stylesheet" type="text/css" />


    <script src="/static/home/js/jquery.min.js"></script>


</head>

<body>
<!--顶部导航条 -->
<div class="am-container header">
    <ul class="message-l">
        <div class="topMessage">
            <div class="menu-hd">
                <?php if(\think\Session::get('user_info')==null): ?>
                <a href="<?php echo url('home/login/login'); ?>" target="_top" class="h">亲，请登录</a>
                <a href="<?php echo url('home/login/register'); ?>" target="_top">免费注册</a>
                <?php elseif(\think\Session::get('user_info.email')): ?>
                <a href="javascript:" target="_top" class="h">Hi,<?php echo \think\Session::get('user_info.email'); ?></a>
                <a href="<?php echo url('home/login/logout'); ?>" target="_top">退出</a>
                <?php elseif(\think\Session::get('user_info.phone')): ?>
                <a href="javascript:" target="_top" class="h">Hi,<?php echo encrypt_phone(\think\Session::get('user_info.phone')); ?></a>
                <a href="<?php echo url('home/login/logout'); ?>" target="_top">退出</a>
                <?php else: ?>
                <a href="javascript:" target="_top" class="h">Hi,<?php echo \think\Session::get('user_info.username'); ?></a>
                <a href="<?php echo url('home/login/logout'); ?>" target="_top">退出</a>
                <?php endif; ?>
            </div>
        </div>
    </ul>
    <ul class="message-r">
        <div class="topMessage home">
            <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="<?php echo url('home/cart/cart'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
        </div>
        <div class="topMessage favorite">
            <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
        </div>
    </ul>
</div>
<!--悬浮搜索框-->
<div class="nav white">
    <div class="logo"><img src="/static/home/images/logo.png" /></div>
    <div class="logoBig">
        <li><img src="/static/home/images/logobig.png" /></li>
    </div>

    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>
        <form>
            <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
        </form>
    </div>
</div>
<div class="clear"></div>



		<title>加入购物车</title>
		

		<link href="/static/home/css/admin.css" rel="stylesheet" type="text/css" />
		<link href="/static/home/css/sustyle.css" rel="stylesheet" type="text/css" />
		
		<style type="text/css">
			.nav-cont .nav-extra{background: url(/static/home/images/extra.png);}

			.option{
				padding-top: 80px;
			}
			.goods img{
				width: 80px;
				height:80px;
			}
			.option img{
				width:160px;
				height:36px;
			}
		</style>





		<!-- 主体部分 -->
		<div class="am-g take-delivery">
			<div class="am-u-sm-7 success">
				<h2>商品已成功加入购物车</h2>
				<div class="goods">
					<img src="<?php echo $goods['goods_logo']; ?>">
					<a href="<?php echo url('home/goods/detail',['id' =>$goods['id']]); ?>"><?php echo $goods['goods_name']; ?></a>
				</div>
			</div>
			<div class="am-u-sm-5 option">
				<a href="<?php echo url('home/goods/detail',['id' =>$goods['id']]); ?>"><img src="/static/home/images/backtogoods.png"></a>
				<a href="<?php echo url('home/cart/index'); ?>"><img src="/static/home/images/addtocart.png"></a>
			</div>
		</div>





<!-- 底部内容 -->
<div class="footer ">
    <div class="footer-hd ">
        <p>
            <a href="# ">恒望科技</a>
            <b>|</b>
            <a href="# ">商城首页</a>
            <b>|</b>
            <a href="# ">支付宝</a>
            <b>|</b>
            <a href="# ">物流</a>
        </p>
    </div>
    <div class="footer-bd ">
        <p>
            <a href="# ">关于恒望</a>
            <a href="# ">合作伙伴</a>
            <a href="# ">联系我们</a>
            <a href="# ">网站地图</a>
        </p>
    </div>
</div>

</body>

</html>