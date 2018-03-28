<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"/Users/apple/Sites/workspace/tpshop/public/../application/admin/view/goods/goods_add.html";i:1521513945;s:70:"/Users/apple/Sites/workspace/tpshop/application/admin/view/layout.html";i:1521343339;}*/ ?>
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
            <h1 class="page-title">商品新增</h1>
        </div>

        <!-- add form -->
        <form action="<?php echo url('save'); ?>" method="post" id="tab" enctype="multipart/form-data">
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
                        <input type="text" name="goods_name" value="" class="input-xlarge">
                        <label>商品价格：</label>
                        <input type="text" name="goods_price" value="" class="input-xlarge">
                        <label>商品数量：</label>
                        <input type="text" name="goods_number" value="" class="input-xlarge">
                        <label>商品logo：</label>
                        <input type="file" name="goods_logo" value="" class="input-xlarge">
                        <label>商品分类</label>
                        <select name="cate_id" id="">
                            <option value="">==请选择==</option>
                            <?php foreach($category as $v): ?>
                            <option value="<?php echo $v['id']; ?>"><?php echo $v['cate_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="tab-pane fade in" id="desc">
                    <div class="well">
                        <label>商品简介：</label>
                        <textarea name="goods_introduce"  class="input-xlarge" id="editor" style="width: 1000px; height: 500px"></textarea>
                    </div>
                </div>
                <div class="tab-pane fade in" id="attr">
                    <div class="well">
                        <label>商品类型：</label>
                        <select name="type_id" class="input-xlarge">
                            <option value="">==请选择==</option>
                            <?php foreach($type as $v): ?>
                            <option value="<?php echo $v['id']; ?>"><?php echo $v['type_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="attrs">

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="pics">
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

            $("select[name=type_id]").change(function(){
                var type_id = $(this).val();
                $.ajax({
                    'url':'<?php echo url("getattr"); ?>',
                    'type':'post',
                    'data':'type_id=' + type_id,
                    'dataType':'json',
                    'success':function (response) {
                        if (response.code !=10000){
                            alert(resopnse.msg);
                            return;
                        }

                        var attr = response.data;
                        var str = '';
                        $.each(attr,function (i,v) {
                            str += "<label>" + v.attr_name + ":</label>";
                            if (v.attr_input_type==0){
                                str += "<input  type='text' name='attr_name[" + v.id + "][]' value='' class='input-xlarge'>"
                            }else if (v.attr_input_type == 1){
                                str += "<select name='attr_name[" + v.id + "][]'>";
                                $.each(v.attr_values,function (index,value) {
                                    str += "<option value='" + value + "'>" + value + "</option>";
                                });

                                str += "</select>";
                            }else {
                                $.each(v.attr_values,function (index,value) {
                                    str += "<input type='checkbox' name='attr_name[" + v.id + "][]' value='" + value + "'>" + value + "&emsp;"
                                })

                            }
                        });
                        $('#attrs').html(str);
                    }


                })
            });
        });
    </script>



</body>
</html>