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
        var url ="/Home/Product/",imageUrl ="/Public/Home/images/",filesUrl ="/Uploads/files/",p ="<?php echo ($_GET['p']); ?>",action ='<?php echo (CONTROLLER_NAME); ?>';
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

<div class="pro_main">
    <div class="search">
        <strong>PRODUCT 产品</strong>
				<span class="check1">
					<a href="<?php echo U('/product/0');?>" <?php if(empty($_GET['t'])): ?>id="check1"<?php endif; ?> data-role="0">全部</a>
					<a href="<?php echo U('/product/1');?>" <?php if(($_GET['t']) == "1"): ?>id="check1"<?php endif; ?> data-role="1">PC端</a>
					<a href="<?php echo U('/product/2');?>" <?php if(($_GET['t']) == "2"): ?>id="check1"<?php endif; ?>  data-role="2">移动端</a>
				</span>
				<span class="check2">
					<a href="#"  <?php if(empty($_GET['tt'])): ?>id="check2"<?php endif; ?>  data-role="0" >全部</a>
					<a href="#"  <?php if(($_GET['tt']) == "CPA"): ?>id="check2"<?php endif; ?> data-role="CPA">CPA</a>
					<a href="#"  <?php if(($_GET['tt']) == "CPS"): ?>id="check2"<?php endif; ?> data-role="CPS">CPS</a>
					<a href="#"  <?php if(($_GET['tt']) == "CPC"): ?>id="check2"<?php endif; ?> data-role="CPC">CPC</a>
					<a href="#"  <?php if(($_GET['tt']) == "CPM"): ?>id="check2"<?php endif; ?> data-role="CPM">CPM</a>
					<a href="#"  <?php if(($_GET['tt']) == "meiti"): ?>id="check2"<?php endif; ?> data-role="meiti">富媒体</a>
				</span>
        <div>
            <input type="text" placeholder="输入产品名称"  <?php if(!empty($_GET['q'])): ?>value="<?php echo (urldecode($_GET['q'])); ?>"<?php endif; ?>  class="search_input">
            <input type="button" value="" class="search_logo">
        </div>
    </div>
    <div class="pro_main_list">
        <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["type"] == 1): ?><a href="<?php echo U('/pro_details/'.$vo['id']);?>">
                        <strong>
                            <i class="type1">
                                PC
                                <b class="triangle0 triangle1"></b>
                            </i>
                            <div></div>
                            <img src="<?php echo ($vo["image"]); ?>" alt="<?php echo ($vo["title"]); ?>">
                            <em>推广中</em>
                        </strong>
					<span class="pro_intro">
						<strong>
                            <em>名称：</em>
                            <b><?php echo ($vo["title"]); ?></b>
                        </strong>
						<strong>
                            <em>类型：</em>
                            <b>PC端</b>
                        </strong>
                        <strong>
                            <em>推广：</em>
                            <b><?php echo ($vo["attr"]); ?></b>
                        </strong>
						<strong>
                            <em>方式：</em>
                            <b><?php echo ($vo["balance_time"]); ?></b>
                        </strong>
						<strong>
                            <em>价格：</em>
                            <i><?php echo ($vo["price"]); ?></i>
                        </strong>
					</span>
                    </a>
                    <?php else: ?>
                    <a href="<?php echo U('/pro_details/'.$vo['id']);?>">
                        <strong>
                            <i class="type2">
                                APP
                                <b class="triangle0 triangle2"></b>
                            </i>
                            <div></div>
                            <img src="<?php echo ($vo["image"]); ?>" alt="<?php echo ($vo["title"]); ?>">
                            <em>推广中</em>
                        </strong>
					<span class="pro_intro">
						<strong>
                            <em>名称：</em>
                            <b><?php echo ($vo["title"]); ?></b>
                        </strong>
						<strong>
                            <em>类型：</em>
                            <b>移动端</b>
                        </strong>
                        <strong>
                            <em>推广：</em>
                            <b><?php echo ($vo["attr"]); ?></b>
                        </strong>
						<strong>
                            <em>方式：</em>
                            <b><?php echo ($vo["balance_time"]); ?></b>
                        </strong>
						<strong>
                            <em>价格：</em>
                            <i><?php echo ($vo["price"]); ?></i>
                        </strong>
					</span>
                    </a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
            <div class="product_list_infor_none" style="width: 97%;">
                没有添加相应的产品
            </div><?php endif; ?>
        <div class="page cle"><?php echo ($page); ?></div>
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