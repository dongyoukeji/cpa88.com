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
        var url ="/Home/Notice/",imageUrl ="/Public/Home/images/",filesUrl ="/Uploads/files/",p ="<?php echo ($_GET['p']); ?>",action ='<?php echo (CONTROLLER_NAME); ?>';
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

<div class="notice_details_main">
    <div class="search">
        <strong>NOTICE 通知</strong>
		<span class="check2">
             <a href="<?php echo U('/notice/index');?>" data-role=""  <?php if(Think.get.cid == '' and cid == ''): ?>id="check2"<?php endif; ?> >全部</a>
             <a href="<?php echo U('/notice/index?cid=4');?>" data-role="" <?php if(($_GET['cid']) == "4"): ?>id="check2"<?php endif; ?> <?php if(($cid) == "4"): ?>id="check2"<?php endif; ?>>公告</a>
             <a href="<?php echo U('/notice/index?cid=5');?>" data-role="" <?php if(($_GET['cid']) == "5"): ?>id="check2"<?php endif; ?> <?php if(($cid) == "5"): ?>id="check2"<?php endif; ?>>常见问题</a>
             <a href="<?php echo U('/notice/index?cid=6');?>" data-role=""  <?php if(($_GET['cid']) == "6"): ?>id="check2"<?php endif; ?> <?php if(($cid) == "6"): ?>id="check2"<?php endif; ?>>结算通知</a>
        </span>
        <div>
            <input type="text" placeholder="输入产品名称" class="search_input">
            <input type="submit" value="" class="search_logo">
        </div>
    </div>

    <div class="notice_details_main_problem">
				<span>
					<strong>
                        <h2><?php echo ($vo["title"]); ?></h2>
                        <em>发布时间：</em>
                        <b><?php echo (date('Y-m-d',$vo["create_time"])); ?></b>
                        <em>发布人：</em>
                        <b>官方</b>
                    </strong>
					<div class="share">
                        <b>分享</b>
                    </div>
					<a href="<?php echo U('/notice');?>">[返回]</a>
				</span>
        <div class="notice_content">
            <?php echo (htmlspecialchars_decode($vo["content"])); ?>
        </div>
        <div class="notice_btns">
            <span class="notice_btns_up">
                <b>上一篇：</b>
                <?php if(empty($next)): ?>没有了<?php else: ?><a href="<?php echo U('/notices/'.$next['id']);?>" title="<?php echo ($pre["title"]); ?>"><?php echo ($next["title"]); ?></a><?php endif; ?>
            </span>
            <span class="notice_btns_down">
                <b>下一篇：</b>
               <?php if(empty($pre)): ?>没有了<?php else: ?><a href="<?php echo U('/notices/'.$pre['id']);?>" title="<?php echo ($pre["title"]); ?>"><?php echo ($pre["title"]); ?></a><?php endif; ?>
            </span>
        </div>
    </div>
    <!-- 广告条advertisement -->
    <div class="main_adv">
        <ul class="main_adv_ul1">
            <?php $_list_news=M("Advert")->field("*")->where("status=0")->limit(5)->order("")->select();$_column=M("Column")->find("9");$column=$_column;$list=$_list_news; if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["image"]); ?>" alt=""></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <ul class="main_adv_ul2">
        </ul>
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
        <div class="main_partners_list" id="main_partners_list">
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