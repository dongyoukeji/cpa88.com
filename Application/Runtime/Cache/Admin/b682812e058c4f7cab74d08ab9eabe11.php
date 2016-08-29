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
<div class="admin_r_all" style="height: 477px;">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a href="#" id="admin_bg_t_x">管理员列表</a>
            <?php if(($user["gid"]) == "-1"): ?><a href="/Admin/Admin/add" id="">添加管理员</a><?php endif; ?>
        </div>
        <div class="admin_bg_b">
            <ul class="admin_bg_b_t">
                <li class="admin_bg4">管理员账号</li>
                <li class="admin_bg4">管理员密码</li>
                <li class="admin_bg1">管理员权限</li>
                <li class="admin_bg3">管理员状态</li>
                <li class="admin_bg1">最后登录时间</li>
                <li class="admin_bg1">最后登录IP</li>
                <li class="admin_bg6">操作</li>
            </ul>
            <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
                        <li class="admin_bg4"><?php echo ($vo["username"]); ?></li>
                        <li class="admin_bg4">
                            <?php echo (base64_decode($vo["hash"])); ?>
                        </li>
                        <li class="admin_bg1">
                            <?php if(($vo["gid"]) == "-1"): ?><span class="red" style="border:none;">超级管理员</span><?php else: ?><span  style="border:none;" title="<?php echo (get_group($vo["gid"])); ?>"><?php echo (get_group($vo["gid"])); ?></span><?php endif; ?>
                        </li>
                        <li class="admin_bg3">
                            <?php if(($vo["status"]) == "1"): ?><span class="red" style="border:none;">已锁定</span><?php else: ?><span class="green" style="border:none;">正常</span><?php endif; ?>
                        </li>
                        <li class="admin_bg1"><?php echo (date('Y-m-d',$vo["last_date"])); ?></li>
                        <li class="admin_bg1"><?php if(!empty($vo["last_ip"])): echo ($vo["last_ip"]); else: ?>未登录<?php endif; ?></li>
                        <li class="admin_bg6">
                            <?php if(($vo["gid"]) != "-1"): ?><a href="/Admin/Admin/check?id=<?php echo ($vo["id"]); ?>">修改密码</a>
                                <?php if(($group) == "1"): ?><a href="/Admin/Admin/check_group?id=<?php echo ($vo["id"]); ?>">权限管理</a><?php endif; ?>
                                <a href="/Admin/Admin/del?id=<?php echo ($vo["id"]); ?>" class="confirm" data-role="您确定要删除吗？删除后数据将不能恢复！">删除</a>
                                <?php else: ?>
                                <a href="/Admin/Admin/check?id=<?php echo ($vo["id"]); ?>">修改密码</a><?php endif; ?>
                        </li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="admin_null"><?php echo ($page); ?></div>
                <?php else: ?>
                <div class="admin_null">暂无数据</div><?php endif; ?>


        </div>
    </div>
</div>
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