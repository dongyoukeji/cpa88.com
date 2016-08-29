<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>PINKAN总公司后台</title>
<meta content="关键词" name="Keywords">
<meta content="描述" name="Description">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/admin_all.css">
<link type="text/css" href="/Public/Plug/layer-v2.2/layer/skin/layer.css" rel="stylesheet" />
<script type="text/javascript" src="/Public/Admin/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.form.js"></script>
<script type="text/javascript" src="/Public/Plug/layer-v2.2/layer/layer.js"></script>
<script src="/Public/Plug/jquery.validate/jquery.validate.js" type="text/javascript"></script>
<link href="/Public/Plug/jquery.validate/jquery.validate.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_all">
	<div class="admin_l">
    <a></a>
    <span>
        <i>1024</i>
        <strong>506</strong>
        <i>30</i>
    </span>
    <div>
        <i>BASIC DATA</i>
        <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["contr_name"]) != "Admin"): ?><a href="<?php echo ($vo["url"]); ?>" <?php if((CONTROLLER_NAME) == $vo["contr_name"]): ?>id="admin_dhxz"<?php endif; ?>><?php echo ($vo["name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <i>EXECUTION DATA</i>
        <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["contr_name"]) == "Admin"): ?><a href="<?php echo ($vo["url"]); ?>" <?php if((CONTROLLER_NAME) == $vo["contr_name"]): ?>id="admin_dhxz"<?php endif; ?>><?php echo ($vo["name"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <!--<?php if(($gid) == "-1"): ?><a href="/Admin/Admin" <?php if((CONTROLLER_NAME) == "Admin"): ?>id="admin_dhxz"<?php endif; ?>>账号管理</a><?php endif; ?>-->
    </div>
</div>
	<div class="admin_r">
		 <span>
        	<i>总公司后台</i>
        	<a href="<?php echo U('public/logout');?>">退出登录</a>
            <strong><?php echo ($time); ?></strong>
        </span>
<script src="/Public/Plug/jquery.validate/my.rules.js" type="text/javascript"></script>
<div class="admin_r_all" style="height: 477px;">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a>ID:xone</a>
            <a href="#" id="admin_bg_t_x">客服管理</a>
        </div>
        <form action="/Admin/Advert/addhd" method="post" enctype="multipart/form-data">
            <div class="admin_bg_fb">
                    <span>
                        <em>名称</em>
                        <input type="text" name='title' id="title"  value="<?php echo ($kefu["title"]); ?>" class="required" />
                    </span>
                    <span>
                        <em>图片</em>
                        <input name='image' id="image" type="file" value="<?php echo ($kefu["image"]); ?>" class="required" />
                        <nempty name="kefu.image">
                            <img src="<?php echo ($kefu["image"]); ?>" alt="<?php echo ($kefu["title"]); ?>">
                            <input name='image_old' id="image_old" type="hidden" value="<?php echo ($kefu["image"]); ?>" />
                        </nempty>
                        <input name='id' id="id" type="hidden" value="<?php echo ($kefu["id"]); ?>" />
                    </span>
                    <span>
                        <em>地址</em>
                        <input type="url" name='url' id="url"  class="required"  value="<?php if(!empty($kefu["url"])): echo ($kefu["url"]); else: ?>http://<?php endif; ?>" />
                    </span>
                    <span>
                        <em>状态</em>
                        <label>
                            <input type="radio" name="status" <?php if(($$kefu["status"]) == "0"): ?>checked="checked"<?php endif; ?> <?php if(empty($$kefu)): ?>checked="checked"<?php endif; ?> value="0">正常
                        </label>
                         <label>
                             <input type="radio" name="status" <?php if(($$kefu["status"]) == "1"): ?>checked="checked"<?php endif; ?> value="1">禁用
                         </label>
                    </span>
                <div class="admin_bg_b2 admin_bg_b3">
                    <input name="" type="submit" value="<?php if(!empty($kefu["id"])): ?>确认修改<?php else: ?>确认添加<?php endif; ?>">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('form').validate({
            rules:{
                title:{
                    required:true
                },
                image:{
                    required:false
                },
                url:{
                    required:true,
                    url:true
                }
            },
            messages:{
                title:{
                    required:"标题不能为空"
                },
                image:{
                    required: "图片不能为空"
                },
                url:{
                    required: "地址不能为空",
                    url:'url不合法'
                }
            }
        });

        $('form').submit(function (e) {
            e.preventDefault();
            if($('form').valid()){
                $index = layer.load(2); //又换了种风格，并且设定最长等待10秒
                $(this).ajaxSubmit({
                    success:function (data) {
                        if(data.status==0){
                            layer.msg(data.msg,{icon:2});
                        }else{
                            layer.close($index);
                            redirect(data.redirect,data.msg,3);
                        }
                    }
                })
            }
        });
    });
</script>
    </div>
</div>
<script>
    function wh_all(){
        var a=$(window).width();
        var b=$('.admin_l').width();
        $('.admin_r').css('width',a-b)
        $('.admin_l').css('height',$(window).height());
        $('.admin_r_all').css('height',$(window).height()-100);
    }
    $(function(){
        wh_all();
        $(window).resize(function(){
            wh_all();
        });
        $('.btn-all').click(function () {
            $url = $(this).attr('data-role');
            window.location.href=$url;
        });
        /**
         * confirm提示框
         */
        $('.confirm').click(function (e) {
            e.preventDefault();
            $msg =$(this).attr('data-role');
            $href=$(this).attr('href');
            layer.confirm($msg, {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.get($href,function (data) {
                    if(data.status==0){
                        layer.msg(data.msg, {icon: 2});
                    }else {
                        reload(data.msg,5);
                    }
                });
            });
        });
        /**
         * tips 提示
         */
        $('.tips').click(function () {
            layer.tips($(this).attr('data-role'), $(this));
        });

        $('.check-status').click(function (e) {
            e.preventDefault();
            $href = $(this).attr('href');
            $.get($href,function (data) {
                if(data.status==1){
                    window.location.reload();
                }
            });
        });
    });
    /**
     * 跳转页面
     * @param url       跳转地址
     * @param msg       提示信息
     * @param sec       跳转时间:0不跳转
     */
    function redirect(url,msg,sec) {
        layer.msg(msg+","+sec+"秒后页面跳转",{icon:1,time:sec*1000});
        setTimeout(function () {
            if(sec>0){
                window.location.href=url;
            }
        },sec*1000);
    }
    /**
     * 重新加载页面
     * @param msg
     * @param sec
     */
    function reload(msg,sec) {
        layer.msg(msg+"，"+sec+"秒后页面重新加载",{icon:1,time:sec*1000});
        setTimeout(function () {
            if(sec>0){
                window.location.reload();
            }
        },sec*1000);
    }
</script>
</body>
</html>