<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo C('SiteConfig.title');?>|首页</title>
    <link rel="stylesheet" href="/Public/Home/css/weball.css">
    <meta name="keyword" content="<?php echo C('SiteConfig.keyword');?>" >
    <meta name="description" content="<?php echo C('SiteConfig.description');?>" >
    <script src="/Public/Home/js/jquery.min.js"></script>
    <script src="/Public/Home/js/getClassName.js"></script>
    <script type="text/javascript">
        var url ="/Home/Index/",imageUrl ="/Public/Home/images/",filesUrl ="/Uploads/files/",name="/Home/Index",action='';
    </script>
</head>
<body>
<div class="web_all">
    <!-- 站头 -->
    <div class="header">
        <div class="nav">
            <a href="<?php echo U('/');?>" class="home">HOME</a>
				<span>
					 <a href="<?php echo U('/product');?>" <?php if((CONTROLLER_NAME) == "Product"): ?>class="bgcolor"<?php endif; ?>  >PRODUCT 产品</a>
                    <a href="<?php echo U('/notice');?>"   <?php if((CONTROLLER_NAME) == "Notice"): ?>class="bgcolor"<?php endif; ?>>NOTICE 通知</a>
					<a href="javascript:void(0);">ABOUT US 我们</a>
				</span>
        </div>
        <div class="logo">
            <img src="/Public/Home/images/footer_logo1.fw.png" alt="">
            <i>专注互联网营销，十多年行业经验的营销团队、运营团队</i>
        </div>
        <div class="login">
            <div class="login_1">
                <a href="<?php echo U('/login');?>" class="enter">LOGIN 登录</a>
                <a href="<?php echo U('/register');?>">REGISTER 注册</a>
            </div>
            <div  class="login_2" style="display:none;">

            </div>
        </div>
    </div>
<div class="main">
    <!-- 产品列表 -->
    <div class="main_product">
        <div id="tp">

        </div>
        <div class="drives">
            <a href="<?php echo U('/product/1');?>" class="computer"></a>
        </div>
        <div class="drives">
            <a href="<?php echo U('/product/2');?>" class="phone"></a>
        </div>
        <div id="bt">

        </div>
    </div>
    <!-- 广告条advertisement -->
    <div class="main_adv">
        <ul class="main_adv_ul1">
            <?php $_list_news=M("Advert")->field("*")->where("status=0")->limit(5)->order("")->select();$_column=M("Column")->find("");$column=$_column;$list=$_list_news; if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["image"]); ?>" alt=""></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <ul class="main_adv_ul2">
        </ul>
    </div>
    <!-- 通知 -->
    <div class="main_notice">
        <div class="main_notice_list">
					<span>
						<b>站内公告</b>
						<a href="<?php echo U('/notice/4');?>">更多</a>
					</span>
            <div id="tj">
            </div>
        </div>
        <div class="main_notice_list">
					<span>
						<b>常见问题</b>
						<a href="<?php echo U('/notice/5');?>">更多</a>
					</span>
            <div id="wt">
            </div>
        </div>
        <div class="main_notice_list border_none">
					<span>
						<b>结算通知</b>
						<a href="<?php echo U('/notice/6');?>">更多</a>
					</span>
            <div id="js">
            </div>
        </div>
    </div>
    <!-- 申请流程 -->
    <div class="main_process">
				<span class="pro_title">
					<b></b>
					<strong>
                        <em>Application process</em>
                        <a><img src="/Public/Home/images/flow.fw.png" alt=""></a>
                    </strong>
				</span>
        <div class="main_process_flow">
            <a href="javascript:;" class="flow1">
                <b>用户注册</b>
            </a>
            <em>&gt;</em>
            <a href="javascript:;" class="flow2">
                <b>选择产品</b>
            </a>
            <em>&gt;</em>
            <a href="javascript:;" class="flow3">
                <!-- <img src="/Public/Home/images/05.gif" alt=""> -->
                <b>联系客服</b>
            </a>
            <em>></em>
            <a href="javascript:;" class="flow4">
                <b>客服开通</b>
            </a>
            <em>&gt;</em>
            <a href="javascript:;" class="flow5">
                <b>广告传播</b>
            </a>
            <em>&gt;</em>
            <a href="javascript:;" class="flow6">
                <b>获取佣金</b>
            </a>
        </div>
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