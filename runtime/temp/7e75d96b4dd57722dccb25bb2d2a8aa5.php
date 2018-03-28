<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"/Users/apple/Sites/workspace/tpshop/public/../application/admin/view/goods/goods_edit.html";i:1522030041;s:70:"/Users/apple/Sites/workspace/tpshop/application/admin/view/layout.html";i:1521343339;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/static/admin/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/static/admin/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
    <script src="/static/admin/js/jquery-1.8.1.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<!-- 上 -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                    <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user icon-white"></i><?php echo $nickname; ?>
                        <i class="icon-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="javascript:void(0);">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="<?php echo url('admin/login/logout'); ?>">安全退出</a></li>
                    </ul>
                </li>
            </ul>
            <a class="brand" href="index"><span class="first">后台管理系统</span></a>
            <ul class="nav">
                <li class="active"><a href="index">首页</a></li>
                <li><a href="javascript:void(0);">系统管理</a></li>
                <li><a href="javascript:void(0);">权限管理</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 左 -->
<div class="sidebar-nav">
    <?php foreach($top_nav as $k => $top_v): ?>
    <a href="#error-menu<?php echo $k; ?>" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i><?php echo $top_v['auth_name']; ?></a>
    <ul id="error-menu<?php echo $k; ?>" class="nav nav-list collapse in">
        <?php foreach($sec_nav as $sec_v): if($sec_v['pid']==$top_v['id']): ?>
        <li><a href="<?php echo url($sec_v->auth_c.'/'.$sec_v->auth_a); ?>"><?php echo $sec_v['auth_name']; ?></a></li>
        <?php endif; endforeach; ?>
    </ul>
    <?php endforeach; ?>

</div>

<script type="text/javascript" charset="utf-8" src="/plugins/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/plugins/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>

    <!-- 右 -->
    <div class="content">
        <div class="header">
            <h1 class="page-title">商品编辑</h1>
        </div>
        
        <!-- edit form -->
        <form action="<?php echo url('update'); ?>" method="post" id="tab" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $info['id']; ?>" name="id" >
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#basic" data-toggle="tab">基本信息</a></li>
              <li role="presentation"><a href="#desc" data-toggle="tab">商品描述</a></li>
              <li role="presentation"><a href="#attr" data-toggle="tab">商品属性</a></li>
              <li role="presentation"><a href="#pics" data-toggle="tab">商品相册</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="basic">
                    <div class="well">
                        <label>商品名称：</label>
                        <input type="text" name="goods_name" value="<?php echo $info['goods_name']; ?>" class="input-xlarge">
                        <label>商品价格：</label>
                        <input type="text" name="goods_price" value="<?php echo $info['goods_price']; ?>" class="input-xlarge">
                        <label>商品数量：</label>
                        <input type="text" name="goods_number" value="<?php echo $info['goods_number']; ?>" class="input-xlarge">
                        <label>商品logo：</label>
                        <input type="file" name="goods_logo" value="<?php echo $info['goods_logo']; ?>" class="input-xlarge">
                        <label>商品分类</label>
                        <select name="cate_id" id="">
                            <option value="">==请选择==</option>
                            <?php foreach($category as $v): ?>
                            <option value="<?php echo $v['id']; ?>" <?php if($v['id'] == $info['cate_id']): ?>selected="selected"<?php endif; ?>><?php echo $v['cate_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="tab-pane fade in" id="desc">
                    <div class="well">
                        <label>商品简介：</label>
                        <textarea id="editor" name="goods_introduce" style="width: 1000px; height: 500px" class="input-xlarge" ><?php echo $info['goods_introduce']; ?> </textarea>
                    </div>
                </div>
                <div class="tab-pane fade in" id="attr">
                    <div class="well">
                        <label>商品分类：</label>
                        <select name="type_id" class="input-xlarge">
                            <option value="2">电脑</option>
                        </select>

                    </div>
                </div>
                <div class="tab-pane fade in" id="pics">
                    <div class="well">
                        <?php foreach($goodspics as $v): ?>
                        <div>
                        <img src="<?php echo $v['pics_mid']; ?>" alt=""><a pics_id="<?php echo $v['id']; ?>" class="delpics" href="javascript:;">[-]</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="well">
                            <div>[<a href="javascript:void(0);" class="add">+</a>]商品图片：<input type="file" name="goods_pics[]" value="" class="input-xlarge"></div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">保存</button>
            </div>
        </form>
        <!-- footer -->
        <footer>
            <hr>
            <p>© 2017 <a href="javascript:void(0);" target="_blank">ADMIN</a></p>
        </footer>
    </div>
    <script type="text/javascript">
        $(function(){
            UE.getEditor('editor');
            $('.add').click(function(){
                var add_div = '<div>[<a href="javascript:void(0);" class="sub">-</a>]商品图片：<input type="file" name="goods_pics[]" value="" class="input-xlarge"></div>';
                $(this).parent().after(add_div);
            });
            $('.sub').live('click',function(){
                $(this).parent().remove();
            });

            $('.delpics').click(function () {
                var that=this;
                $.ajax({
                    'url':'<?php echo url("admin/goods/delpics"); ?>',
                    'type':'post',
                    'data':{'pics_id':$(this).attr('pics_id')},
                    'dataType':'json',
                    'success':function (response) {
                        console.log(response);
                        if (response.code !=10000){
                            alert(response.msg);
                            return;
                        }
                        $(that).parent().remove();
                    }
                })
            })
        });
    </script>



</body>
</html>