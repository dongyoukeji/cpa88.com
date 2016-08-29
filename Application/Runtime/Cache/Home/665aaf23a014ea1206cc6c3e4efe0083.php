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
        var url ="/Home/Index/",imageUrl ="/Public/Home/images/",filesUrl ="/Uploads/files/",p ="<?php echo ($_GET['p']); ?>",action ='<?php echo (CONTROLLER_NAME); ?>';
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

<script type="text/javascript" src="/Public/Home/js/jquery.md5.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.form.js"></script>
<script>
	$url ="/Home/Index/";
</script>
<form action="/Home/Index/register_handler" method="post" autocomplete="off">
	<div class="login_main">
		<!-- 第一步 -->
		<div class="login_main_login" id="login_main_login2">
				<span>
					<b>注册，第一步</b>
					<a>基本信息</a>
				</span>
			<div class="login_main_login_input">
				<select id="userType" name="puserType" onclick="changeUser()">
					<option value="1">个人用户</option>
					<option value="2">企业用户</option>
				</select>
					<span class="login_input">
						<input class="login_user register_input" id="loginName" type="text" value="" title="用户名" placeholder="用户名" name="username" autocomplete="off">
						<input class="login_password register_input1" id="password1"  type="text" value="" title="登录密码" placeholder="密码">
						<input class="login_password" style='display:none;' id="password11" type="password" placeholder="密码" name="" maxlength="16" autocomplete="off">
						<input  id="password_md5" type="hidden" name="password_md5">
						<input class="login_password register_input1" id="password2" type="text" value="" title="再次输入密码" placeholder="再次输入密码"/>
						<input class="login_password" style='display:none;' id="password22" type="password" name="password" title="再次输入密码" placeholder="再次输入密码" autocomplete="off">
					</span>
				<!-- 个人信息 -->
					<span class="login_input" id="privateUser">
						<em id="companyPrivate">个人信息</em>
						<input class="login_user register_input" id="privateName" type="text" value="" title="联系人" placeholder="联系人" name="contacts">
						<input class="login_phone register_input" id="privateContact" type="text" value="" placeholder="联系方式" title="联系方式" name="phonenumber" >
						<input class="login_email register_input" id="privateEmail" type="text" value="" title="信箱" placeholder="信箱" name="email">
					</span>
					<span class="login_btn">
						<b class="showContent"></b>
						<input type="button" id="next_btn" value="下一步，填写账户信息" >
					</span>
			</div>
			<div class="cle"></div>
		</div>
		<!-- 第二步 -->
		<div class="login_main_login" id="login_main_login3" style="display: none;">
				<span>
					<b>注册，第二步</b>
					<a>收款信息</a>
				</span>
			<div class="login_main_login_input">
				<select name="makeMoney" id="payType">
					<option value="1">请选择收款方式</option>
					<option value="2" >支付宝</option>
					<option value="3" >网银</option>
				</select>
					<!-- 支付宝 -->
					<span class="login_input hide2" id="AliPayType" style="display:none">
						<input class="padding" id="AliPayName" type="text" placeholder="支付宝账号" name="AliPayName" >
						<input class="padding register_input" id="AliMoney" type="text" placeholder="收款人姓名/公司名称" name="AliGetMoney">
					</span>
					<!-- 网银 -->
					<span class="login_input hide3" id="bankType" style="display:none;">
						<!--<input class="padding" id="bankName" type="text" placeholder="银行名称" name="bankName">-->
						 <select name="accountIfor" id="bankName">
							 <option value="1">中国银行</option>
							 <option value="2">招商银行</option>
							 <option value="3">交通银行</option>
							 <option value="4">农业银行</option>
							 <option value="5">建设银行</option>
						 </select>
						<input class="padding register_input" id="bankAddress" type="text" placeholder="开户行" name="bankAddress">
						<input class="padding register_input" id="bankNumber" type="text" placeholder="收款账号" name="bankNumber" maxlength="23">
						<input class="padding register_input" id="bankMoney" type="text" placeholder="收款人姓名/公司名称" name="getMoney">
					</span>
				<label>
					<input type="checkbox" id="listServer">
					<i>服务条款</i>
					<a href="#" id="zixiread">[请仔细阅读]</a>
				</label>
					<span class="login_btn">
						<b class="showContent"></b>
						<input type="submit" id="success_btn" value="注册完成" >
					</span>
			</div>
			<div class="cle"></div>
		</div>
		<!-- 服务条款 -->
		<div class="serverList" id="serverList">
			<b>
				服务条款
				<i id="serverClose">×</i>
			</b>
				<span>
				cpa88广告联盟介绍: <br />
				cpa88广告联盟为苏州东游网络科技有限公司旗下网站，是互联网广告和线上营销方案提供商，主要为广告主、网站主提供公平、公正的交易平台。<br />
				cpa88广告联盟 以现代科技为支撑，以标准化管理为手段，以高素质人才队伍为基石，为广告主、网站主提供完善的服务。<br />
				cpa88广告联盟 成立于2011年1月，拥有自己的网络广告核心技术并应用到各个广告产品中，赢得了业界的一致赞誉!截止2011年5月30日拥有会员500多家。联盟自成立以来，发展迅速，并拥有一批经验丰富的技术开发人员，拥有完善的信息管理及客户服务管理制度，具有雄厚的技术力量和经济实力，有足够的能力履行对每一位客户的服务承诺。<br />
				cpa88广告联盟拥有经验丰富的营销团队，并且在营销运作模式上不断创新，陆续推出丰富的营销模式，以满足广大站长朋友们的多样化需求。我们将以客户满意为己任，为实现更贴心、更完善的服务不懈努力。<br />
				颠覆传统的匹配技术，经过严格筛选的广告位，99%的准确目标用户定位，使营销效果提高数十倍。<br />
				cpa88广告联盟凭借稳定的系统平台，安全可靠的支付信誉，在业界已经建立起良好的口碑。我们相信，必将与广大站长朋友和广告服务商们拥有愉快的合作。<br />
				支持中心:<br />
				公正、公平的竞争环境，完全公开的交易信息<br />
				完善、规范的模式及流程，有效保障自己的权益<br />
				简单易用功能强大的广告系统，准确的业绩跟踪系统，准确可靠的统计结算系统<br /><br />
				网络广告的计费方式:<br />
				（1） CPC按照点击次数来计算广告费，此类的广告单价通常表现为 1000点击/ 元。<br />
				（2） CPM按照显示次数来计算广告费，此类的广告单价通常表现为 1000显示/ 元。<br />
				（3） CPA/CPL/CPS通常我们叫做按达成诉求（纯效果）计算广告费，此类的广告单价通常表现为，1个注册用户/ 元、1个订单/ 元、销售分成比例。 <br /><br />
				cpa88广告联盟对网站主跟广告主的规定 网站主跟广告主 页面不得含有以下内容:<br />
				（1） 违反国家宪法所确定的基本原则的；<br />
				（2） 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；<br />
				（3） 损害国家荣誉和利益的；<br />
				（4） 煽动民族仇恨、民族歧视，破坏民族团结的；<br />
				（5） 破坏国家宗教政策，宣扬邪教和封建迷信的；<br />
				（6） 散布谣言，扰乱社会秩序，破坏社会稳定的；<br />
				（7） 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；<br />
				（8） 侮辱或者诽谤他人，侵害他人合法权益的；<br />
				（9） 含有法律、行政法规禁止的其他内容的；<br />
			</span>
		</div>
		<div class="serverBg" id="serverBg" style="display:none;"></div>
	</div>
</form>
<script src="/Public/Home/js/jq.js"></script>
<script type="text/javascript" src="/Public/Plug/layer-v2.2/layer/layer.js"></script>
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