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
            <a>ID:xone</a>
            <a href="/Admin/Member/see?mid=<?php echo ($_GET['mid']); ?>" id="admin_bg_t_x">基本信息</a>
            <a href="/Admin/Member/plist?mid=<?php echo ($_GET['mid']); ?>">产品列表</a>
            <a href="/Admin/Member/add?mid=<?php echo ($_GET['mid']); ?>">添加产品</a>
            <span class="admin_yhgl_top">
                <a href="/Admin/Member/index">返回用户列表</a>
            </span>
        </div>
        <div class="admin_bg_b">
            <ul class="admin_bg_b_t">
                <li class="admin_bg6">注册时间</li>
                <li class="admin_bg7">用户名</li>
                <li class="admin_bg5">用户类型</li>
                <!--<li class="admin_bg5">登录密码</li>-->
                <li class="admin_bg5">积分</li>
                <li class="admin_bg5">产品数量</li>
                <li class="admin_bg4">提现总额</li>
            </ul>
            <ul>
                <li class="admin_bg6"><?php echo (date('Y-m-d',$member["create_time"])); ?></li>
                <li class="admin_bg7"><?php echo ($member["username"]); ?></li>
                <li class="admin_bg5"><?php if(($member["type"]) == "0"): ?>个人<?php else: ?>企业<?php endif; ?></li>
                <!--<li class="admin_bg5">123456</li>-->
                <li class="admin_bg5"><?php echo ($member["jifen"]); ?></li>
                <li class="admin_bg5"><?php echo (get_pronum($member["id"])); ?></li>
                <li class="admin_bg4"><?php echo ($member["banlace"]); ?></li>
            </ul>
            <form action="/Admin/Member/see_info" method="post">
                <div class="admin_yhjbxx">

                    <span>
                            <strong>
                                <em>联系人/公司名称</em>
                                <input name="real_name" type="text" name="payfor" value="<?php echo ($member["real_name"]); ?>">
                            </strong>
                            <strong>
                                <em>联系方式</em>
                                <input name="tel" type="text" value="<?php echo ($member["tel"]); ?>">
                            </strong>
                            <strong>
                                <em>邮箱</em>
                                <input name="email" type="text" value="<?php echo ($member["email"]); ?>">
                                <input name="mid" type="hidden" value="<?php echo ($member["id"]); ?>">
                                <input name="pay[id]" type="hidden" value="<?php echo ($vo["id"]); ?>">
                            </strong>
                        </span>
                    <?php if(is_array($payway)): $i = 0; $__LIST__ = $payway;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span>
                            <strong>
                                <em>收款方式</em>
                                <select name="pay[payway]" id="paypay">
                                    <option value="1" <?php if(($vo["pay_type"]) == "1"): ?>selected<?php endif; ?> >网银</option>
                                    <option value="0" <?php if(($vo["pay_type"]) == "0"): ?>selected<?php endif; ?> >支付宝</option>
                                </select>
                            </strong>

                                <div id="black01"  class="hide" <?php if(($vo["pay_type"]) == "1"): ?>style="display:block;"<?php endif; ?>>
                                    <strong>
                                        <em>银行名称</em>
                                        <select name="pay[bank]">
                                            <?php if(is_array($bank)): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bk): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($vo["bank_type"]) == $key): ?>selected<?php endif; ?>><?php echo ($bk); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </strong>
                                    <strong>
                                        <em>开户行</em>
                                        <input name="pay[bank_name]" type="text" value='<?php if(($vo["pay_type"]) == "1"): echo ($vo["bank_name"]); endif; ?>' class="required">
                                        <input name="pay[id]" type="hidden" value="<?php echo ($vo["id"]); ?>" >
                                    </strong>
                                    <strong>
                                        <em>账号</em>
                                        <input name="pay[pay_account]" type="text" value='<?php if(($vo["pay_type"]) == "1"): echo ($vo["pay_account"]); endif; ?>' class="required" maxlength="23" id="bankValue" onkeyup="banNumberOnKey()">
                                    </strong>
                                    <strong>
                                        <em>收款人/公司名称</em>
                                        <input name="pay[pay_getname]" type="text" value='<?php if(($vo["pay_type"]) == "1"): echo ($vo["pay_getname"]); endif; ?>' class="required">
                                    </strong>
                                </div>

                                <div  id="black02" class="hide" <?php if(($vo["pay_type"]) == "0"): ?>style="display:block;"<?php endif; ?>>
                                        <strong>
                                            <em>支付宝账号</em>
                                            <input name="pay[pay_account1]" type="text" value='<?php if(($vo["pay_type"]) == "0"): echo ($vo["pay_account"]); endif; ?>' class="required">
                                            <input name="pay[id]" type="hidden" value="<?php echo ($vo["id"]); ?>" >
                                        </strong>
                                        <strong>
                                            <em>收款人/公司名称</em>
                                            <input name="pay[pay_getname1]" type="text" value='<?php if(($vo["pay_type"]) == "0"): echo ($vo["pay_getname"]); endif; ?>' class="required">
                                        </strong>
                                </div>

                        </span><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="admin_bg_b2">
                        <input type="submit" value="保存信息" name="">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var bank=/^(\d{4}(?:\s\d{4}){3})|(\d{4}(?:\s\d{4}){3}\d{3})$/;

    $(function () {
        $('#paypay').change(function (e) {
            if($(this).val()==1){
                $('#black01').show();
                $('#black02').hide();
            }
            if($(this).val()==0){
                $('#black01').hide();
                $('#black02').show();
            }
        });

        $('form').validate();
        $('form').on('submit',function (e) {
            $flag = bank.test($('#bankValue').val());
            e.preventDefault();
            if(!$flag && $('#paypay').val()==1){
                layer.alert('请填写正确的银行卡号');
                return '';
            }
            if($('form').valid()){
                $('form').ajaxSubmit({
                    success:function(data){
                        if(data.status=1){
                            redirect('/Admin/Member/see?mid=<?php echo ($_GET['mid']); ?>',data.msg,2);
                        }else{
                            layer.msg(data.msg, {icon: 1});
                        }
                    }
                });
            }
        });


    });
    function banNumberOnKey() {
        document.getElementById("bankValue").onkeyup =function() {
            this.value =this.value.replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
        };
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