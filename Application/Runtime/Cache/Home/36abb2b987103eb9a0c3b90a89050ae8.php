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

<div class="notice_details_main">
    <div class="search">
        <strong>NOTICE 个人中心</strong>
				<span class="check2">
					<a href="<?php echo U('/private');?>">基本信息</a>
					<a href="<?php echo U('/my_product');?>" id="check2">开通的产品</a>
				</span>
				<span>
					<b>用户名：<i id="user_name"></i></b>
					<!--<a href="javascript:;" onclick="changePassword()">修改密码</a>-->
				</span>
                <span>
                    <b>我的积分：<em id="jifen"><?php echo (session('jifen')); ?> </em>分</b>
                    <!--<a href="#">兑换礼品</a>-->
                </span>
        <div>
            <b>用户类型：</b>
            <em id="user_type"></em>
        </div>
    </div>

    <div class="private_product_list">
        <div class="infor_reivse" id="changePad" style="display:none;">
					<span>
						<input type="password" id="initPassword" placeholder="原始登录密码" onblur="initPassNull(this)">
						<input type="password" id="newPassword1" placeholder="新密码" onblur="initPassNull(this)">
						<input type="password" id="newPassword2" placeholder="再次输入密码" onblur="initPassNull(this)">
					</span>
            <input class="reivse_submit" type="submit" value="确认修改" onclick="initPassword()">
            <input class="reivse_reset" type="reset" value="取消" onclick="resetmove()">
        </div>
        <div class="private_product_list_nav">
					<span class="border_none">
						<a href="<?php echo U('/my_product/0');?>" <?php if(empty($_GET['t'])): ?>id="product_navbg"<?php endif; ?>>全部</a>
						<a href="<?php echo U('/my_product/1');?>" <?php if(($_GET['t']) == "1"): ?>id="product_navbg"<?php endif; ?> >PC端</a>
						<a href="<?php echo U('/my_product/2');?>" <?php if(($_GET['t']) == "2"): ?>id="product_navbg"<?php endif; ?>>移动端</a>
					</span>
					<span class="filter">
						<a href="<?php echo U('/my_product/0');?>"  <?php if(empty($_GET['tt'])): ?>id="product_navbg"<?php endif; ?>>全部</a>
						<a href="javascript:void(0);" <?php if(($_GET['tt']) == "CPA"): ?>id="product_navbg"<?php endif; ?> data-role="CPA">CPA</a>
						<a href="javascript:void(0);" <?php if(($_GET['tt']) == "CPS"): ?>id="product_navbg"<?php endif; ?> data-role="CPS">CPS</a>
						<a href="javascript:void(0);" <?php if(($_GET['tt']) == "CPC"): ?>id="product_navbg"<?php endif; ?> data-role="CPC">CPC</a>
						<a href="javascript:void(0);" <?php if(($_GET['tt']) == "CPM"): ?>id="product_navbg"<?php endif; ?> data-role="CPM">CPM</a>
						<a href="javascript:void(0);" <?php if(($_GET['tt']) == "meiti"): ?>id="product_navbg"<?php endif; ?> data-role="meiti">富媒体</a>
					</span>
        </div>
        <div class="product_list_infor">

            <?php if(!empty($list)): ?><ul>
                    <li class="width5 align_c" id="height_none">产品名称</li>
                    <li class="width6" id="height_none">信息</li>
                    <li class="width6" id="height_none">开通价格</li>
                    <li class="width3" id="height_none">状态</li>
                    <li class="width7 align_c" id="height_none">操作</li>
                </ul>

                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
                        <li class="width5 align_c">
							<span>
								<img src="<?php echo (get_image($vo[0]["pid"])); ?>" alt="">
							</span>
                        </li>
                        <li class="width6">
							<span>

								<strong>产品名称：<b><?php echo (get_pro($vo[0]['pid'])); ?></b></strong>
								<strong>产品类型：<em><?php if(($vo[0]["cid"]) == "1"): ?>PC端 <?php else: ?>移动端<?php endif; ?></em></strong>
								<strong>结算方式：<b><?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if(($key) > "0"): ?>/<?php endif; echo (get_fangshi($vo1["date"])); endforeach; endif; else: echo "" ;endif; ?>
                                </b></strong>
								<strong>推广方式：<b><?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if(($key) > "0"): ?>/<?php endif; if(($vo1["type"]) == "meiti"): ?>富媒体<?php else: echo ($vo1["type"]); endif; endforeach; endif; else: echo "" ;endif; ?>
                                    </b>
                                </strong>
								<strong>结算方式：<b><?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if(($key) > "0"): ?>/<?php endif; echo (get_fangshi($vo1["date"])); endforeach; endif; else: echo "" ;endif; ?>
                                </b></strong>
							</span>
                        </li>
                        <li class="width6">
							<span>
                                 <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><p><?php if(($vo1["type"]) == "meiti"): ?>富媒体 <?php else: echo ($vo1["type"]); endif; ?>/<b><?php echo ($vo1["price"]); ?></b>元</p><?php endforeach; endif; else: echo "" ;endif; ?>
							</span>
                        </li>
                        <li class="width3">
							<span>
								<em>已开通</em>
							</span>
                        </li>
                        <li class="width7 align_c">
							<span>
								<a href="<?php echo U('/details/'.$vo[0]['id']);?>">查看详细</a>
								<i>更新至<?php echo (date('Y-m-d',$vo1["last"])); ?></i>
							</span>
                        </li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                <div class="product_list_infor_none">
                    您还没申请任何产品
                </div><?php endif; ?>
            <div class="web_dxqc"></div>
        </div>
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
        <div class="main_partners_list" >

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