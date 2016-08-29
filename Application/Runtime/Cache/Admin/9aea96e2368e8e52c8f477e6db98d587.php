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
<div class="admin_r_all" style="height: 555px;">
    <style type="text/css">
        .admin_bg_b li{
            line-height:70px;}
        .admin_bg_b li img{
            vertical-align:middle;}
    </style>
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a href="#" id="admin_bg_t_x">友情链接列表</a>
            <a href="/Admin/Flink/add">添加友情链接</a>
            <div class="admin_bg_t_ss">
                <!--<span>-->
                    <!--<input name="" type="text" placeholder="标题">-->
                    <!--<input name="" type="submit" value="搜索">-->
                <!--</span>-->
                <!--<strong>-->
                    <!--<select name="">-->
                        <!--<option value="">筛选</option>-->
                        <!--<option value="">站内公告</option>-->
                        <!--<option value="">常见问题</option>-->
                        <!--<option value="">结算通知</option>-->
                    <!--</select>-->
                <!--</strong>-->
            </div>
        </div>
        <div class="admin_bg_b">
            <ul class="admin_bg_b_t">
                <li class="admin_bg4">时间</li>
                <li class="admin_bg4">名称</li>
                <li class="admin_bg4">图标</li>
                <li class="admin_bg7">链接</li>
                <li class="admin_bg7">状态</li>
                <li class="admin_bg1">操作</li>
            </ul>
            <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
                        <li class="admin_bg4"><?php echo (date('Y-m-d',$vo["date"])); ?></li>
                        <li class="admin_bg4">
                            <?php echo ($vo["title"]); ?>
                        </li>
                        <li class="admin_bg4"><img src="/Uploads/<?php echo ($vo["ico"]); ?>" height="40" alt="<?php echo ($vo["title"]); ?>"></li>
                        <li class="admin_bg7">
                            <?php echo ($vo["uri"]); ?>
                        </li>
                        <li class="admin_bg7">
                           <?php if(($vo["status"]) == "0"): ?><b class="green">正常</b><?php else: ?><b class="red">禁用</b><?php endif; ?>
                        </li>
                        <li class="admin_bg1">
                            <a href="/Admin/Flink/add?id=<?php echo ($vo["id"]); ?>">编辑</a>
                            <?php if(($vo["status"]) == "0"): ?><a href="/Admin/Flink/status?id=<?php echo ($vo["id"]); ?>&t=1" class="check-status">禁用</a>
                                <?php else: ?>
                                <a href="/Admin/Flink/status?id=<?php echo ($vo["id"]); ?>&t=0" class="check-status">启用</a><?php endif; ?>
                            <a href="/Admin/Flink/del?id=<?php echo ($vo["id"]); ?>" class="confirm" data-role="您确定要删除文档吗？删除后将不能恢复。">删除</a>
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