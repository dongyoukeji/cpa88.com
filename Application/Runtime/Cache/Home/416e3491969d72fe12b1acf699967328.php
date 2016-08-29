<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if(!empty($vo["title"])): echo ($vo["title"]); ?>-<?php endif; ?>  <?php echo C('SiteConfig.title');?></title>
    <meta name="keyword" content="<?php echo C('SiteConfig.keyword');?>" >
    <meta name="description" content="<?php echo C('SiteConfig.description');?>" >
    <link rel="stylesheet" href="/Public/Home/css/weball.css">
    <script src="/Public/Home/js/getClassName.js"></script>
    <script src="/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript">
        //定义变量
        var url ="/Home/Private/",imageUrl ="/Public/Home/images/",filesUrl ="/Uploads/files/",p ="<?php echo ($_GET['p']); ?>",action ='<?php echo (CONTROLLER_NAME); ?>';
    </script>
</head>
<body>
<div class="web_all">
    <!-- 站头 -->
    <div class="header">
        <div class="nav">
            <a href="/" class="home">HOME</a>
				<span>
					<span>
                        <a href="<?php echo U('/product');?>" <?php if((CONTROLLER_NAME) == "Product"): ?>class="bgcolor"<?php endif; ?>  >PRODUCT 产品</a>
                        <a href="<?php echo U('/notice');?>"   <?php if((CONTROLLER_NAME) == "Notice"): ?>class="bgcolor"<?php endif; ?>>NOTICE 通知</a>
                        <a href="javascript:void(0);">ABOUT US 我们</a>
                    </span>
				</span>
        </div>
        <div class="logo">
            <img src="/Public/Home/images/footer_logo1.fw.png" alt="">
            <i>专注互联网营销，十多年行业经验的营销团队、运营团队</i>
        </div>
        <div class="login">
            <div class="login_1" style="display:none;">
                <a href="<?php echo U('/login');?>" class="enter">LOGIN 登录</a>
                <a href="<?php echo U('/register');?>">REGISTER 注册</a>
            </div>
            <div  class="login_2">

            </div>
        </div>
    </div>

<script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Plug/layer-v2.2/layer/layer.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.form.js"></script>

    <!-- 站中 -->
    <div class="notice_details_main">
        <div class="search">
            <strong>NOTICE 个人中心</strong>
				<span class="check2">
					<a href="<?php echo U('/private');?>" id="check2">基本信息</a>
					<a href="<?php echo U('/my_product');?>">开通的产品</a>
				</span>
				<span>
					<b>用户名：<i id="user_name"></i></b>
					<a href="javascript:;" class="changePassword">修改密码</a>
				</span>
            <div>
                <b>用户类型：</b>
                <em id="user_type"></em>
            </div>
        </div>

        <div class="private_infor">
            <div class="infor_reivse" id="changePad" style="display:none;">
                        <em class="change_input">
                            <i class="">原始登录密码</i>
                            <input type="password" class="changePassword1" id="initPassword" placeholder="">
                        </em>
                        <em class="change_input">
                            <i>新密码</i>
                            <input type="password" class="changePassword1" id="newPassword1" placeholder="">
                        </em>
                        <em class="change_input">
                            <i>再次输入密码</i>
                            <input type="password" class="changePassword1" id="newPassword2" placeholder="">
                        </em>
                <input class="reivse_submit" type="submit" value="确认修改">
                <input class="reivse_reset" type="reset" value="取消">
            </div>
            <div class="user_infor">
					<span>
						<b id="psUserInfo">用户信息</b>
						<a id="inforChange">修改</a>
						<a  style="display:none;" id="inforSave">保存</a>
					</span>
                <div>
						<span id="info">

						</span>
                </div>
            </div>
            <form action="/Home/Private/user_check_pay" id="form1" method="post">
                <div class="user_infor">
					<span>
						<b id="psMoneyInfo">收款信息</b>
						<a id="accChange" onclick="changeAcc()">修改</a>
						<a id="user_infor_bg" style="display:none;" onclick="saveAcc()">保存</a>
					</span>
                    <div>
                        <select id="getType"  disabled>

                        </select>
						<span class="user_infor_type" id="getType1">
							<strong>
                                <em>银行名称</em>
                                <!--<input class="accountIfor" id="accountBankName" type="text"  >-->
                                <select class="accountIfor" style="margin-left:12px;" name="accountIfor" id="accountBankName" disabled>

                                </select>
                            </strong>
							<strong>
                                <em>开户行</em>
                                <input class="accountIfor" id="accountBankAddr" name="accountBankAddr" type="text" disabled >
                            </strong>
							<strong>
                                <em>收款账号</em>
                                <input class="accountIfor" id="bankValue" name="bankValue" type="text" disabled  maxlength="23" onkeyup="banNumberOnKey()">
                            </strong>
							<strong>
                                <em>收款人姓名</em>
                                <input class="accountIfor" id="accountBankUser" name="accountBankUser" type="text"  disabled >
                            </strong>
						</span>
						<span class="user_infor_type" id="getType2" style="display:none;">
							<strong>
                                <em>支付宝账号</em>
                                <input class="accountIfor" id="accountAliNumber" name="accountAliNumber" type="text" disabled >
                            </strong>
							<strong>
                                <em>收款人姓名</em>
                                <input class="accountIfor" id="accountAliName" name="accountAliName" type="text"  disabled >
                            </strong>
						</span>
                    </div>
                </div>
            </form>
        </div>

        <!-- 广告条advertisement -->
        <div class="main_adv">
            <a href="#">
                <img src="/Public/Home/images/gg.fw.png" alt="">
            </a>
        </div>
        <!-- 合作伙伴 -->
        <div class="main_partners">
				<span class="pro_title">
					<b></b>
					<strong>
                        <em>Our partners</em>
                        <a><img src="/Public/Home/images/friend.fw.png" alt=""></a>
                    </strong>
				</span>
            <div class="main_partners_list">

            </div>
        </div>
    </div>
    <div class="serverBg" id="serverBg" style="display:none;"></div>

<div class="online">
    <span id="online1">
    </span>
    <div class="hotline" id="online2">
        <span>
        </span>
        <div>
            <em>CPA88在线客服</em>
            <ul>
                <li><em>商务小白</em></li>
                <li><a href='http://wpa.qq.com/msgrd?v=3&uin=1173989924&site=qq&menu=yes' target="_seft"
                title='在线即时交谈'><img src="/Public/Home/images/online.fw.png" alt=""></a></li>
            </ul>
            <ul>
                <li><em>商务老翟</em></li>
                <li><a href='http://wpa.qq.com/msgrd?v=3&uin=2880672180&site=qq&menu=yes' target="_seft"
                title='在线即时交谈'><img src="/Public/Home/images/online.fw.png" alt=""></a></li>
            </ul>
            <ul>
                <li><em>VIP客户-高跃</em></li>
                <li><a href='http://wpa.qq.com/msgrd?v=3&uin=1339858962&site=qq&menu=yes' target="_seft"
                title='在线即时交谈'><img src="/Public/Home/images/online.fw.png" alt=""></a></li>
            </ul>
            <span>
                <a href="#">腾讯微博</a>
                <a href="#">新浪微博</a>
            </span>
            <strong>电话：0512-86662522</strong>
        </div>
    </div>
</div>
<!-- 站尾 -->
<div class="footer">
	<span class="footer_logo">
		<img src="/Public/Home/images/footer_logo.fw.png" alt="">
	</span>
    <div class="footer_notic">
        <b>网站客服</b>
		<span id="kefu"></span>
    </div>
    <div class="footer_notic">
        <b>常见问题</b>
        <strong id="qs">
        </strong>
    </div>
    <div class="footer_notic border_none" style="border-right: 0;">
        <b>站内公告</b>
        <strong id="ns">
            
        </strong>
    </div>
    <div class="footer_code">
        <em>专注互联网营销</em>
        <em>十多年行业经验的营销团队</em>
        <img src="/Public/Home/images/ecode.fw.png" alt="">
    </div>
</div>
<em><?php echo C('SiteConfig.copyright');?></em>
<div class="cle"></div>
</div>
<script src="/Public/Home/js/index.js"></script>
<script>
    $(function(){
        $.getJSON(url+'get_kefu',function (data) {
            $html = "";
            for(var i=0;i<data.list.length;i++){
                $html +="<a target='_blank' href='"+data.list[i].uri+"' title='在线即时交谈'>"+data.list[i].name+"</a>"
            }
            $('#kefu').html($html);
        });
    });
</script>
</body>
</html>