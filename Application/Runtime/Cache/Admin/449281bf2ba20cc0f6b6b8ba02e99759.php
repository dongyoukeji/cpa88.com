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
<link rel="stylesheet" href="/Public/Plug/kindeditor-4.1.10/themes/default/default.css" />
<link rel="stylesheet" href="/Public/Plug/kindeditor-4.1.10/plugins/code/prettify.css" />
<script type="text/javascript" charset="utf-8" src="/Public/Plug/kindeditor-4.1.10/kindeditor-all-min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Plug/kindeditor-4.1.10/lang/zh_CN.js"></script>
<script charset="utf-8" src="/Public/Plug/kindeditor-4.1.10/plugins/code/prettify.js"></script>
<div class="admin_r_all" style="height: 555px;">
    <form action="/Admin/Notify/edithd" method="post">
        <div class="admin_bg_fb">
             <span>
                <em>通知类别</em>
                <select name="cid">
                    <?php if(is_array($col)): $i = 0; $__LIST__ = $col;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo1["id"]); ?>" <?php if(($vo1["id"]) == $arc["cid"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo1["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </span>
            <span>
                <em>标题</em>
                <input name="title" type="text" value="<?php echo ($arc["title"]); ?>" class="required">
                <input name="id" type="hidden" value="<?php echo ($arc["id"]); ?>" >
            </span>
            <span>
                <em>描述</em>
                <div class="">
                    <textarea name="description" rows="5"><?php echo ($arc["description"]); ?></textarea>
                </div>
            </span>
            <span>
                <em>内容</em>
                <div class="admin_bjq">
                    <textarea name="content" id="editor"><?php echo ($arc["content"]); ?></textarea>
                </div>
            </span>
            <!-- <span>
                <em>属性</em>
                <div class="">
                    <label><input type="checkbox" name="attr[com]" value="1" <?php if(($arc["com"]) == "1"): ?>checked<?php endif; ?> >推荐</label>
                    <label><input type="checkbox" name="attr[hot]" value="1" <?php if(($arc["hot"]) == "1"): ?>checked<?php endif; ?> >最热</label>
                    <label><input type="checkbox" name="attr[new]" value="1" <?php if(($arc["new"]) == "1"): ?>checked<?php endif; ?> >最新</label>
                    <label><input type="checkbox" name="attr[head]" value="1" <?php if(($arc["head"]) == "1"): ?>checked<?php endif; ?> >头条</label>
                    <label><input type="checkbox" name="attr[top]" value="1" <?php if(($arc["top"]) == "1"): ?>checked<?php endif; ?> >置顶</label>
                </div>
            </span> -->
            <div class="admin_bg_b2 admin_bg_b3">
                <input name="" type="submit" value="确认发布">
            </div>

        </div>
    </form>
</div>
<script  type="text/javascript">
    KindEditor.ready(function(K) {
        var editor1 = K.create('#editor', {
            cssPath : '/Public/Plug/kindeditor-4.1.10/plugins/code/prettify.css',
            uploadJson : '/Public/Plug/kindeditor-4.1.10/php/upload_json.php',
            fileManagerJson : '/Public/Plug/kindeditor-4.1.10/php/file_manager_json.php',
            allowFileManager : true,
            width:$('.admin_bjq').width(),
            height:400,
            afterCreate : function() {
                var self = this;
                K.ctrl(document, 13, function() {
                    self.sync();
                    K('form[name=example]')[0].submit();
                });
                K.ctrl(self.edit.doc, 13, function() {
                    self.sync();
                    K('form[name=example]')[0].submit();
                });
            }
        });
        $('form').validate();
        $('form').on('submit',function (e) {
            e.preventDefault();
            if($('form').valid()){
                $('form').ajaxSubmit({
                    success:function(data){
                        if(data.status=1){
                            redirect('/Admin/Notify/index',data.msg,3);
                        }else{
                            layer.msg(data.msg, {icon: 1});
                        }
                    }
                });
            }
        });
        prettyPrint();
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