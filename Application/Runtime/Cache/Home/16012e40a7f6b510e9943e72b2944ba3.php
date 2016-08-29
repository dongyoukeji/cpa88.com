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

<div class="notice_main">
    <div class="search">
        <strong>NOTICE 通知</strong>
        <span class="check2">
            <a href="<?php echo U('/notice/0');?>" data-role="0"  <?php if(empty($_GET['cid'])): ?>id="check2"<?php endif; ?> >全部</a>
            <a href="<?php echo U('/notice/4');?>" data-role="4" <?php if(($_GET['cid']) == "4"): ?>id="check2"<?php endif; ?> >公告</a>
            <a href="<?php echo U('/notice/5');?>" data-role="5" <?php if(($_GET['cid']) == "5"): ?>id="check2"<?php endif; ?>>常见问题</a>
            <a href="<?php echo U('/notice/6');?>" data-role="6"  <?php if(($_GET['cid']) == "6"): ?>id="check2"<?php endif; ?>>结算通知</a>
        </span>
        <div>
            <input type="text" placeholder="输入关键词" value="<?php echo (urldecode($_GET['q'])); ?>" class="search_input">
            <input type="submit" value="" class="search_logo">
        </div>
    </div>
    <div class="notice_main_problem" id="notice_main_problem">
        <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["cid"]) == "4"): ?><ul>
                        <li>
                            <a href="<?php echo U('/notices/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a>
                            <?php if(($vo["cid"]) == "4"): ?><b>[公告]</b><?php endif; ?>
                            <strong><?php echo (date('Y-m-d',$vo["create_time"])); ?></strong>
                        </li>
                    </ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["cid"]) != "4"): ?><ul>
                        <li>
                            <a href="<?php echo U('/notices/'.$vo['id']);?>"><?php echo ($vo["title"]); ?></a>
                            <?php if(($vo["cid"]) == "5"): ?><b><em>[常见问题]</em></b><?php endif; ?>
                            <?php if(($vo["cid"]) == "6"): ?><i>[结算]</i><?php endif; ?>
                            <strong><?php echo (date('Y-m-d',$vo["create_time"])); ?></strong>
                        </li>
                    </ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <div class="page1"><?php echo ($page); ?></div>
            <?php else: ?>
            <div class="product_list_infor_none" style="width: 97%;">
                没有添加相应的产品
            </div><?php endif; ?>
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