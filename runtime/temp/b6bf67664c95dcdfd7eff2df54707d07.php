<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/Users/apple/Sites/workspace/tpshop/public/../application/home/view/cart/cart.html";i:1522049550;s:69:"/Users/apple/Sites/workspace/tpshop/application/home/view/layout.html";i:1522031245;}*/ ?>
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

<title>购物车页面</title>


<link href="/static/home/css/cartstyle.css" rel="stylesheet" type="text/css" />
<link href="/static/home/css/optstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.nav-cont .nav-extra{background: url(/static/home/images/extra.png);}
</style>

<!--购物车 -->
<div class="concent">
	<div id="cartTable">
		<div class="cart-table-th">
			<div class="wp">
				<div class="th th-chk">
					<div id="J_SelectAll1" class="select-all J_SelectAll">

					</div>
				</div>
				<div class="th th-item">
					<div class="td-inner">商品信息</div>
				</div>
				<div class="th th-price">
					<div class="td-inner">单价</div>
				</div>
				<div class="th th-amount">
					<div class="td-inner">数量</div>
				</div>
				<div class="th th-sum">
					<div class="td-inner">金额</div>
				</div>
				<div class="th th-op">
					<div class="td-inner">操作</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>

		<tr class="item-list">
			<div class="bundle  bundle-last ">
				<div class="bundle-hd">
					<div class="bd-promos">
						<div class="bd-has-promo">已享优惠:<span class="bd-has-promo-content">省￥19.50</span>&nbsp;&nbsp;</div>
						<div class="act-promo">
							<a href="#" target="_blank">第二支半价，第三支免费<span class="gt">&gt;&gt;</span></a>
						</div>
						<span class="list-change theme-login">编辑</span>
					</div>
				</div>
				<div class="clear"></div>
				<div class="bundle-main">
					<?php foreach($list as $v): ?>
					<ul goods_id="<?php echo $v['goods_id']; ?>" goods_attr_ids="<?php echo $v['goods_attr_ids']; ?>" number="<?php echo $v['number']; ?>" cart_id="<?php echo $v['id']; ?>" class="item-content clearfix">
						<li class="td td-chk">
							<div class="cart-checkbox ">
								<input class="check row_check" name="items[]" value="170037950254" type="checkbox">
								<label for="J_CheckBox_170037950254"></label>
							</div>
						</li>
						<li class="td td-item">
							<div class="item-pic">
								<a href="<?php echo url('home/goods/detail',['id' => $v['goods']['id']]); ?>" target="_blank" data-title="<?php echo $v['goods']['goods_name']; ?>" class="J_MakePoint" data-point="tbcart.8.12">
									<img src="<?php echo $v['goods']['goods_logo']; ?>" class="itempic J_ItemImg" height="80" width="80"></a>
							</div>
							<div class="item-info">
								<div class="item-basic-info">
									<a href="#" target="_blank" title="<?php echo $v['goods']['goods_name']; ?>" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo $v['goods']['goods_name']; ?></a>
								</div>
							</div>
						</li>
						<li class="td td-info">
							<div class="item-props item-props-can">
								<?php foreach($v['goodsattr'] as $attr): ?>
								<span class="sku-line"><?php echo $attr['attr_name']; ?>：<?php echo $attr['attr_value']; ?></span>
								<br>
								<?php endforeach; ?>
								<span tabindex="0" class="btn-edit-sku theme-login">修改</span>
								<i class="theme-login am-icon-sort-desc"></i>
							</div>
						</li>
						<li class="td td-price">
							<div class="item-price price-promo-promo">
								<div class="price-content">
									<div class="price-line">
										<em class="price-original"><?php echo $v['goods']['goods_price']; ?></em>
									</div>
									<div class="price-line">
										<em class="J_Price price-now" tabindex="0"><?php echo $v['goods']['goods_price']; ?></em>
									</div>
								</div>
							</div>
						</li>
						<li class="td td-amount">
							<div class="amount-wrapper ">
								<div class="item-amount ">
									<div class="sl">
										<input class="min am-btn sub_number" name="" type="button" value="-" />
										<input class="text_box current_number" name="" type="text" value="<?php echo $v['number']; ?>" style="width:30px;" />
										<input class="add am-btn add_number" name="" type="button" value="+" />
									</div>
								</div>
							</div>
						</li>
						<li class="td td-sum">
							<div class="td-inner">
								<em tabindex="0" class="J_ItemSum number row_price"><?php echo $v['goods']['goods_price'] * $v['number']; ?></em>
							</div>
						</li>
						<li class="td td-op">
							<div class="td-inner">
								<a title="移入收藏夹" class="btn-fav" href="#"> 移入收藏夹</a>
								<a href="javascript:;" data-point-url="#" class="delete"> 删除</a>
							</div>
						</li>
					</ul>
					<?php endforeach; ?>
				</div>
			</div>
		</tr>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>

	<div class="float-bar-wrapper">
		<div id="J_SelectAll2" class="select-all J_SelectAll">
			<div class="cart-checkbox">
				<input class="check-all check" name="select-all" value="true" type="checkbox">
				<label for="J_SelectAllCbx2"></label>
			</div>
			<span>全选</span>
		</div>
		<div class="operations">
			<a href="#" hidefocus="true" class="deleteAll">删除</a>
			<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
		</div>
		<div class="float-bar-right">
			<div class="amount-sum">
				<span class="txt">已选商品</span>
				<em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
				<div class="arrow-box">
					<span class="selected-items-arrow"></span>
					<span class="arrow"></span>
				</div>
			</div>
			<div class="price-sum">
				<span class="txt">合计:</span>
				<strong class="price">¥<em id="J_Total">0.00</em></strong>
			</div>
			<div class="btn-area">
				<a href="javascript:void(0);" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
					<span>结&nbsp;算</span></a>
			</div>
		</div>
	</div>
</div>
<script>
	$(function () {
		//封装一个重新计算合计金额和总数量的函数
		var changetotal = function () {
			//获取所选中的行
			var checked_checkbox = $('.row_check:checked');
			//遍历 取到每个所选中行的数量和金额进行累加
			var total_number = 0;
			var total_price = 0.00;
			$.each(checked_checkbox,function (i,v) {
				total_number += parseInt($(v).closest('ul').find('.current_number').val());
				total_price += parseFloat($(v).closest('ul').find('.J_ItemSum').text());
			})
			//将累加的数据显示在页面上
			$('#J_SelectedItemsCount').text(total_number);

			$('#J_Total').text(total_price);
		}
		//封装一个函数发送AJAX请求修改购买数量
		var changenum = function (new_number, element) {
			var goods_id = $(element).closest('ul').attr('goods_id');
			var goods_attr_ids = $(element).closest('ul').attr('goods_attr_ids');
			//组装请求参数
			var data = {
				'number':new_number,
				'goods_id':goods_id,
				'goods_attr_ids':goods_attr_ids
			};
			$.ajax({
				'url':'<?php echo url("home/cart/changenum"); ?>',
				'type':'post',
				'data':data,
				'dataType':'json',
				'success':function (response) {
					if (response.code !=10000){
						alert(response.msg);return;
					}
					//将修改后的数量显示到页面
					$(element).closest('ul').find('.current_number').val(new_number);
					//修改当前行的金额
					var price = parseFloat($(element).closest('ul').find('.J_Price').text());
					var row_price = price * new_number;
					$(element).closest('ul').find('.J_ItemSum').text(row_price);
					//将修改后的数量更行到当前行的number属性中
					$(element).closest('ul').attr('number',new_number);
					//调用changetotal函数重新计算已选择的商品数量和总金额
					changetotal();
				}
			})
		}
		//给+号绑定点击事件
		$('.add_number').click(function () {
			var current_number = parseInt($(this).closest('ul').find('.current_number').val());
			if (current_number == 100){
				return
			}
			//重新计算新的数量
			var new_number = current_number + 1;
			//调用changenum函数发送Ajax请求
			changenum(new_number,this);
		})

		//给-号绑定点击事件
		$('.sub_number').click(function () {
			var current_number = parseInt($(this).closest('ul').find('.current_number').val());
			if (current_number == 1){
				return
			}
			//重新计算新的数量
			var new_number = current_number - 1;
			//调用changenum函数发送Ajax请求
			changenum(new_number,this);
		})

		//给input输入框绑定change事件
		$('.current_number').change(function () {
			//直接获取输入框的值
			var current_number = $(this).val();
			var new_number = parseInt(current_number);
			//输入的值必须为数字 NaN
			if (isNaN(new_number)){
				var old_number = $(this).closest('ul').attr('number');
				$(this).val(old_number);
				alert('购买数量必须是一个数字');return;
			}
			if (new_number <= 0) {
				var old_number = $(this).closest('ul').attr('number');
				$(this).val(old_number);
				alert('参数非法');return;
			}
			if (new_number >= 100) {
				var old_number = $(this).closest('ul').attr('number');
				$(this).val(old_number);
				alert('数量超过限制');return;
			}
		})

		//给删除绑定点击事件
		$('.delete').click(function () {
			//组装参数请求
			var data = {
				'goods_id':$(this).closest('ul').attr('goods_id'),
				'goods_attr_ids':$(this).closest('ul').attr('goods_attr_ids')
			};
			var _this = this;
			//发送ajax请求
			$.ajax({
				'url':'<?php echo url("home/cart/delcart"); ?>',
				'type':'post',
				'data':data,
				'dataType':'json',
				'success':function (response) {
					if (response.code !=10000) {
						alert(response.msg);return;
					}
					//将当前行记录从页面中删除
					$(_this).closest('ul').remove();
					//调用changetotal函数重新计算已选商品数量和总金额
					changetotal();
				}
			})
		})

		//给每一行的checkbox绑定事件
		$('.row_check').change(function () {
			changetotal();
			//获取所有的行数 每一行的checkbox数量
			var checkbox_all = $('.row_check');
			//获取所选中的行
			var checkbox_checked = $('.row_check:checked');
			//对比两个数量,得到全选应该处于的状态
			var status = checkbox_all.length == checkbox_checked.length;
			$('.check-all').prop('checked',status);
		})

		//给 全选的checkbox绑定事件
		$('.check-all').change(function () {
			//将每一行的checkbox选中状态和全选保持一致
			var status = $(this).prop('checked');
			$('.row_check').prop('checked',status);
			//调用changetotal函数 重新计算已选商品数量和总金额
			changetotal();
		})

		//给结算绑定点击事件
		$('#J_Go').click(function () {
			//
			//
			var checked_checkbox = $('.row_check:checked');
			//每一行的ID值拼接成一个参数
			var cart_ids = '';
			$.each(checked_checkbox,function (i,v) {
				//
				cart_ids += $(v).closest('ul').attr('cart_id') + ',';
			});
			//去除逗号
			cart_ids = cart_ids.slice(0,-1);
			//页面跳转
			var url = "<?php echo url('home/cart/flow2'); ?>" + "?cart_ids=" + cart_ids;
			location.href = url;
		})
	})

</script>

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