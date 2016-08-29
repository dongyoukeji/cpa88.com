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
<script src="/Public/Plug/jquery.validate/jquery.validate.js" type="text/javascript"></script>
<link href="/Public/Plug/jquery.validate/jquery.validate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/Public/Plug/kindeditor-4.1.10/kindeditor-all-min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Plug/kindeditor-4.1.10/lang/zh_CN.js"></script>
<script charset="utf-8" src="/Public/Plug/kindeditor-4.1.10/plugins/code/prettify.js"></script>
<div class="admin_r_all" style="height: 478px;">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a href="/Admin/Product/index" >产品列表</a>
            <a href="#" id="admin_bg_t_x">产品添加</a>
        </div>
        <form action="/Admin/Product/edithd" method="post" id="form1">
            <div class="admin_bg_fb">
                    <span>
                    	<em>序号</em>
                        <input name="sort" type="text" value="<?php echo ($pro["sort"]); ?>" class="" data-role="排序数字越大越靠前">
                        <input name="id" type="hidden" value="<?php echo ($pro["id"]); ?>">
                    </span>
                    <span>
                    	<em>产品类型</em>
                        <select name="pro_type">
                            <?php if(is_array($col)): $i = 0; $__LIST__ = $col;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo1["id"]); ?>"  <?php if(($vo1["id"]) == $pro["type"]): ?>selected<?php endif; ?>><?php echo ($vo1["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </span>
                    <span>
                    	<em>产品名称</em>
                        <input name="pro_name" type="text" class=" required" data-role="产品名称" value="<?php echo ($pro["title"]); ?>">
                    </span>
                    <span>
                    	<em>封面预览</em>
                        <?php if(!empty($pro["image"])): ?><img src="<?php echo ($pro["image"]); ?>" width="200" id="show-image"><?php endif; ?>
                    </span>
                    <span>
                    	<em>产品封面</em>
                        <input type="text" id="url1" value="<?php echo ($pro["image"]); ?>" name="pro_image" class="required" data-role="请上传产品封面"/>
                        <input type="button" id="image1" value="选择图片" style="width:80px;height:34px;"/>
                    </span>
                    <span>
                    	<em>详细</em>
                        <div class="admin_tgxz">
                            <div class="admin_tgxz_n2">
                                <input name="pro_attr[0][t]" type="checkbox" value="CPA" <?php if(($pro["pro_attr"]["CPA"]["t"]) == "CPA"): ?>checked<?php endif; ?>>
                                <i>CPA</i>
                                <input class="admin_tgxz_j" name="pro_attr[0][sh_price]" value="<?php echo ($pro["pro_attr"]["CPA"]["sh_price"]); ?>" type="text" placeholder="上家价格" onchange="change(this,1)">
                                <input class="admin_tgxz_j" name="pro_attr[0][price]" value="<?php echo ($pro["pro_attr"]["CPA"]["price"]); ?>" type="text" placeholder="用户价格" onchange="change(this,1)">
                                <select name="pro_attr[0][type]">
                                    <option value="1" <?php if(($pro["pro_attr"]["CPA"]["type"]) == "1"): ?>selected<?php endif; ?> >日结</option>
                                    <option value="2" <?php if(($pro["pro_attr"]["CPA"]["type"]) == "2"): ?>selected<?php endif; ?>>周结</option>
                                    <option value="3" <?php if(($pro["pro_attr"]["CPA"]["type"]) == "3"): ?>selected<?php endif; ?>>月结</option>
                                </select>
                                <input name="pro_attr[0][com]" type="checkbox" value="1" <?php if(($pro["pro_attr"]["CPA"]["com"]) == "1"): ?>checked<?php endif; ?>>
                                <i>推荐</i>
                            </div>
                            <div class="admin_tgxz_n2">
                                <input name="pro_attr[1][t]" type="checkbox" value="CPS"  <?php if(($pro["pro_attr"]["CPS"]["t"]) == "CPS"): ?>checked<?php endif; ?>>
                                <i>CPS</i>
                                <input class="admin_tgxz_j" name="pro_attr[1][sh_price]"  value="<?php echo ($pro["pro_attr"]["CPS"]["sh_price"]); ?>" type="text" placeholder="上家价格" onchange="change(this,1)">
                                <input class="admin_tgxz_j" name="pro_attr[1][price]"  value="<?php echo ($pro["pro_attr"]["CPS"]["price"]); ?>" type="text" placeholder="用户价格" onchange="change(this,1)">
                                <select name="pro_attr[1][type]">
                                    <option value="1" <?php if(($pro["pro_attr"]["CPS"]["type"]) == "1"): ?>selected<?php endif; ?>>日结</option>
                                    <option value="2" <?php if(($pro["pro_attr"]["CPS"]["type"]) == "2"): ?>selected<?php endif; ?>>周结</option>
                                    <option value="3" <?php if(($pro["pro_attr"]["CPS"]["type"]) == "3"): ?>selected<?php endif; ?>>月结</option>
                                </select>
                                <input name="pro_attr[1][com]" type="checkbox" value="1" <?php if(($pro["pro_attr"]["CPS"]["com"]) == "1"): ?>checked<?php endif; ?>>
                                <i>推荐</i>
                            </div>
                            <div class="admin_tgxz_n2">
                                <input name="pro_attr[2][t]" type="checkbox" value="CPC" <?php if(($pro["pro_attr"]["CPC"]["t"]) == "CPC"): ?>checked<?php endif; ?>>
                                <i>CPC</i>
                                <input class="admin_tgxz_j" name="pro_attr[2][sh_price]" value="<?php echo ($pro["pro_attr"]["CPC"]["sh_price"]); ?>" type="text" placeholder="上家价格" onchange="change(this,1)">
                                <input class="admin_tgxz_j" name="pro_attr[2][price]" value="<?php echo ($pro["pro_attr"]["CPC"]["price"]); ?>" type="text" placeholder="用户价格" onchange="change(this,1)">
                                <select name="pro_attr[2][type]">
                                    <option value="1" <?php if(($pro["pro_attr"]["CPC"]["type"]) == "1"): ?>selected<?php endif; ?>>日结</option>
                                    <option value="2" <?php if(($pro["pro_attr"]["CPC"]["type"]) == "2"): ?>selected<?php endif; ?>>周结</option>
                                    <option value="3" <?php if(($pro["pro_attr"]["CPC"]["type"]) == "3"): ?>selected<?php endif; ?>>月结</option>
                                </select>
                                <input name="pro_attr[2][com]" type="checkbox" value="1" <?php if(($pro["pro_attr"]["CPC"]["com"]) == "1"): ?>checked<?php endif; ?>>
                                <i>推荐</i>
                            </div>
                            <div class="admin_tgxz_n2">
                                <input name="pro_attr[3][t]" type="checkbox" value="CPM" <?php if(($pro["pro_attr"]["CPM"]["t"]) == "CPM"): ?>checked<?php endif; ?>>
                                <i>CPM</i>
                                <input class="admin_tgxz_j" name="pro_attr[3][sh_price]" value="<?php echo ($pro["pro_attr"]["CPM"]["sh_price"]); ?>" type="text" placeholder="上家价格" onchange="change(this,1)">
                                <input class="admin_tgxz_j" name="pro_attr[3][price]" value="<?php echo ($pro["pro_attr"]["CPM"]["price"]); ?>" type="text" placeholder="用户价格" onchange="change(this,1)">
                                <select name="pro_attr[3][type]">
                                    <option value="1" <?php if(($pro["pro_attr"]["CPM"]["type"]) == "1"): ?>selected<?php endif; ?>>日结</option>
                                    <option value="2" <?php if(($pro["pro_attr"]["CPM"]["type"]) == "2"): ?>selected<?php endif; ?>>周结</option>
                                    <option value="3" <?php if(($pro["pro_attr"]["CPM"]["type"]) == "3"): ?>selected<?php endif; ?>>月结</option>
                                </select>
                                <input name="pro_attr[3][com]" type="checkbox" value="1" <?php if(($pro["pro_attr"]["CPM"]["com"]) == "1"): ?>checked<?php endif; ?>>
                                <i>推荐</i>
                            </div>
                            <div class="admin_tgxz_n2">
                                <input name="pro_attr[4][t]" type="checkbox" value="meiti" <?php if(($pro["pro_attr"]["meiti"]["t"]) == "meiti"): ?>checked<?php endif; ?>>
                                <i>富媒体</i>
                                <input class="admin_tgxz_j" name="pro_attr[4][sh_price]" value="<?php echo ($pro["pro_attr"]["meiti"]["sh_price"]); ?>" type="text" placeholder="上家价格" onchange="change(this,1)">
                                <input class="admin_tgxz_j" name="pro_attr[4][price]" value="<?php echo ($pro["pro_attr"]["meiti"]["price"]); ?>" type="text" placeholder="用户价格" onchange="change(this,1)">
                                <select name="pro_attr[4][type]">
                                    <option value="1" <?php if(($pro["pro_attr"]["meiti"]["type"]) == "1"): ?>selected<?php endif; ?>>日结</option>
                                    <option value="2" <?php if(($pro["pro_attr"]["meiti"]["type"]) == "1"): ?>selected<?php endif; ?>>周结</option>
                                    <option value="3" <?php if(($pro["pro_attr"]["meiti"]["type"]) == "1"): ?>selected<?php endif; ?>>月结</option>
                                </select>
                                <input name="pro_attr[4][com]" type="checkbox" value="1" <?php if(($pro["pro_attr"]["meiti"]["com"]) == "1"): ?>checked<?php endif; ?>>
                                <i>推荐</i>
                            </div>
                        </div>
                    </span>
                    <span>
                    	<em>详情介绍</em>
                        <div class="admin_bjq" >
                            <textarea id="editor" name="pro_content"><?php echo ($pro["content"]); ?></textarea>
                        </div>
                    </span>
                    <span>
                    	<em>客服</em>
                        <div class="admin_tgxz">
                            <!--<label>-->
                                <!--<input name="server[]" type="checkbox" value="1" <?php if(in_array(1,$pro['service'])): ?>checked<?php endif; ?> />-->
                                <!--<i>ONE</i>-->
                            <!--</label>-->
                            <!--<label>-->
                                <!--<input name="server[]" type="checkbox" value="2"  <?php if(in_array(2,$pro['service'])): ?>checked<?php endif; ?>>-->
                                <!--<i>TOW</i>-->
                            <!--</label>-->

                            <?php if(is_array($kefu)): $i = 0; $__LIST__ = $kefu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kf): $mod = ($i % 2 );++$i;?><label>
                                    <input name="server[]" type="checkbox" value="<?php echo ($kf["id"]); ?>" <?php if(in_array($kf['id'],$pro['service'])): ?>checked<?php endif; ?> >
                                    <i><?php echo ($kf["name"]); ?></i>
                                </label><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </span>
                <div class="admin_bg_b2 admin_bg_b3">
                    <input name="" type="submit" value="确认添加" class="btn-submit">
                </div>
            </div>
        </form>
    </div>
</div>
<script  type="text/javascript">
    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager : true
        });
        K('#image1').click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    imageUrl : K('#url1').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        K('#url1').val(url);
                        K('#show-image').attr('src',url).show();
                        editor.hideDialog();
                    }
                });
            });
        });
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
                $('form').validate();
                $('form').on('submit',function (e) {
                    e.preventDefault();
                    if($('form').valid()){
                        $('form').ajaxSubmit({
                            success:function(data){
                                if(data.status=1){
                                    redirect('/Admin/Product/index',data.msg,3);
                                }else{
                                    layer.msg(data.msg, {icon: 1});
                                }
                            }
                        });
                    }
                });
            }
        });
        prettyPrint();
    });

    function change(obj,id) {
        var reg = /^\d+(\.\d+)?$/;
        $this = $(obj);
        if($this.val()!=''){
            $this.removeAttr('style');
        }

        if(id==1){
            if(!reg.test($this.val())){
                alert('请填写数字');
                $this.css('border','1px solid red');
            }
        }
    }
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