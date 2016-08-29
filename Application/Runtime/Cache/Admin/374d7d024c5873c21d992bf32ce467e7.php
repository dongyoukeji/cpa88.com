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
<div class="admin_r_all" style="height: 480px;">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a href="#" id="admin_bg_t_x">XONE/<?php echo (get_member($member["id"])); ?> 结算信息</a>
            <span class="admin_yhgl_top">
                <a href="/Admin/Balance/index">返回结算列表</a>
            </span>
        </div>
        <div class="admin_bg_b">
            <ul class="admin_bg_b_t">
                <li class="admin_bg6">结算时间</li>
                <li class="admin_bg7">产品</li>
                <li class="admin_bg5">类型</li>
                <li class="admin_bg5">推广方式</li>
                <li class="admin_bg5">结算方式</li>
                <li class="admin_bg5">价格</li>
                <li class="admin_bg4">数据</li>
            </ul>
            <ul>
                <li class="admin_bg6"><p></p><?php echo (date('Y-m-d',$pro["time"])); ?></li>
                <li class="admin_bg7"><?php echo (get_pack_name($pro["pid"])); ?></li>
                <li class="admin_bg5"><?php echo (get_pack_t($pro["pid"])); ?></li>
                <li class="admin_bg5"><?php echo (get_pack_type($pro["pid"])); ?></li>
                <li class="admin_bg5"><?php echo (get_pack_jiesuan($pro["pid"])); ?></li>
                <li class="admin_bg5"><?php echo ($pro["price"]); ?></li>
                <li class="admin_bg4"><a href="/Admin/Balance/export?id=<?php echo ($_GET['id']); ?>&mid=<?php echo ($_GET['mid']); ?>&pid=<?php echo ($pro["pid"]); ?>">下载</a></li>
                <div class="team_bottom">
                    <div class="admin_tgfs">
                        <a href="#" id="admin_tgfs_xz"><?php echo (get_pack_type($pro["pid"])); ?></a>
                    </div>
                    <div class="admin_tgfs admin_tgfs2">
                        <a href="#" id="admin_tgfs_xz"><?php echo (get_pro_name($pro["pid"])); ?></a>
                    </div>
                    <label class="admin_tgfs_t">
                        <i>时间</i>
                        <i>上家单价</i>
                        <i>用户单价</i>
                        <i>上家数据</i>
                        <i>用户数据</i>
                        <i>上家核减</i>
                        <i>用户核减</i>
                        <i>上家金额</i>
                        <i>用户金额(支付/元)</i>
                        <i>收益金额</i>
                        <i>结算状态</i>
                    </label>
                    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><volist name="list" id="vo1">
                            <label>
                                <i><?php echo (date('Y-m-d',$vo1["time"])); ?></i>
                                <i><?php echo ($vo1["sh_price"]); ?></i>
                                <i><?php echo ($vo1["price"]); ?></i>
                                <i><?php echo ($vo1["real"]); ?></i>
                                <i><?php echo ($vo1["qudao"]); ?></i>
                                <i><?php echo ($vo1["sh_checked"]); ?></i>
                                <i><?php echo ($vo1["checked"]); ?></i>
                                <i>
                                    <?php if(($vo1["sh_total"]) == "0"): ?>-
                                        <?php else: ?>
                                        <?php echo ($vo1["sh_total"]); endif; ?>
                                </i>
                                <i>
                                    <?php if(($vo1["total"]) == "0"): ?>-
                                        <?php else: ?>
                                        <?php echo ($vo1["total"]); endif; ?>
                                </i>
                                <i>
                                    <?php if(($vo1["shouyi"]) == "0"): ?>-
                                        <?php else: ?>
                                        <?php echo ($vo1["shouyi"]); endif; ?>
                                </i>
                                <i>
                                    <?php if(($vo1["status"] == 0) and ($vo1["total"] == 0) ): ?>-<?php endif; ?>
                                    <?php if(($vo1["status"] == 0) and ($vo1["total"] != 0) ): ?>未结算<?php endif; ?>
                                    <?php if(($vo1["status"] == 1) and ($vo1["total"] != 0) ): ?>已结算<?php endif; ?>
                                </i>
                            </label><?php endforeach; endif; else: echo "" ;endif; ?>
                        <!--<div>-->
                            <!--<?php echo ($page); ?>-->
                        <!--</div>-->

                        <form action="/Admin/Balance/add" method="post" enctype="multipart/form-data">
                            <div class="admin_tgxx">
                                <input type="hidden" name="id" value="<?php echo ($pro["id"]); ?>">
                                <input type="hidden" name="pay_account" id="pay_account" value="">
                                <input type="hidden" name="pay_pay" id="pay_pay" value="">
                                打款截图:
                                <input type="file" name="file_kuan" id="file_kuan" value="" class="required">
                                <textarea name="des" cols="" rows="" placeholder="备注信息"><?php echo ($vo["des"]); ?></textarea>
                            </div>
                            <div class="admin_skxx">
                                <?php if(($pro["status"]) == "0"): if(($pay["pay_type"]) == "0"): ?><span class="pay_info">汇款方式:支付宝</span>
                                        <span class="pay_info">支付宝账号:<?php echo ($pay["pay_account"]); ?></span>
                                        <span class="pay_info">收款人姓名:<?php echo ($pay["pay_getname"]); ?></span>
                                        <?php else: ?>
                                        <span class="pay_info1">汇款方式:网银</span>
                                    <span class="pay_info1">银行名称:
                                    <?php if(is_array($bank)): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bk): $mod = ($i % 2 );++$i; if(($key) == $pay["bank_type"]): echo ($bk); endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </span>
                                        <span class="pay_info1">开户行:<?php echo ($pay["bank_name"]); ?></span>
                                        <span class="pay_info1">银行账号:<?php echo ($pay["pay_account"]); ?></span>
                                        <span class="pay_info1">收款人姓名:<?php echo ($pay["pay_getname"]); ?></span><?php endif; ?>
                                    <?php else: ?>
                                    <?php if(($pay["pay_type"]) == "0"): ?><span class="pay_info">汇款方式:<?php echo ($pay["pay_type1"]); ?></span>
                                        <span class="pay_info">支付宝账号:<?php echo ($pay["pay_account"]); ?></span>
                                        <span class="pay_info">收款人姓名:<?php echo ($pay["pay_getname"]); ?></span>
                                        <?php else: ?>
                                        <span class="pay_info1">汇款方式:<?php echo ($pay["pay_type1"]); ?></span>
                                        <span class="pay_info1">银行名称:<?php echo ($pay["bank_type1"]); ?></span>
                                        <span class="pay_info1">开户行:<?php echo ($pay["bank_name"]); ?></span>
                                        <span class="pay_info1">银行账号:<?php echo ($pay["pay_account"]); ?></span>
                                        <span class="pay_info1">收款人姓名:<?php echo ($pay["pay_getname"]); ?></span><?php endif; endif; ?>
                            </div>
                            <div class="admin_bg_b2">
                                <input type="submit" value="确认结算" name="" >
                            </div>
                        </form><?php endif; ?>
                </div>
            </ul>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('form').on('submit',function (e) {
            e.preventDefault();
            $('form').validate({
               role:{
                   file_kuan:{
                       required:true
                   }
               },
                messages:{
                    file_kuan:{
                        required: ""
                    }
                }
            });
            if($('form').valid()){
                layer.confirm('您确定要结算吗？结算之后不可撤销', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $_result='';
                    if('<?php echo ($pay["pay_type"]); ?>'==0){
                        $('.pay_info').each(function (index) {
                            $str =  $(this).text();
                            $str1 = $str.split(':');
                            $_result += ','+$str1[1];
                        });
                        $('#pay_account').val($_result.substr(1));
                        $('#pay_pay').val(0);
                    }else{
                        $('.pay_info1').each(function (index) {
                            $str =  $(this).text();
                            $str1 = $str.split(':');
                            $_result += ','+$str1[1];
                        });
                        $('#pay_account').val($_result.substr(1));
                        $('#pay_pay').val(1);
                    }

                    $('form').ajaxSubmit({
                        success:function(data){
                            if(data.status=1){
                                redirect('/Admin/Balance/index',data.msg,3);
                            }else{
                                layer.msg(data.msg, {icon: 2});
                            }
                        }
                    });
                });
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