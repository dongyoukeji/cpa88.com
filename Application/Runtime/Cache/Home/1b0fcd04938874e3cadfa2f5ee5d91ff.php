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
        <div>
            <b>用户类型：</b>
            <em id="user_type"></em>
        </div>
    </div>
    <div class="pro_list_main_details">
        <div class="infor_reivse" id="changePad" style="display:none;">
					<span>
						<input type="password" placeholder="原始登录密码">
						<input type="password" placeholder="新密码">
						<input type="password" placeholder="再次输入密码">
					</span>
            <input class="reivse_submit" type="submit" value="确认修改">
            <input class="reivse_reset" type="reset" value="取消" onclick="resetmove()">
        </div>
        <a class="product">
            <b>
                <?php if(($pro["cid"]) == "1"): ?>PC端 <?php else: ?>移动端<?php endif; ?>
                <span class="triangle"></span>
            </b>
            <strong>
                <img src="<?php echo (get_image($pro["pid"])); ?>" alt="<?php echo ($pro["title"]); ?>">
            </strong>
            <p>推广中</p>
        </a>
        <span class="pro_intro">
            <strong>
                <em>名称：</em>
                <b><?php echo (get_pro($pro["pid"])); ?></b>
            </strong>
            <strong>
                <em>类型：</em>
                <b> <?php if(($pro["cid"]) == "1"): ?>PC端 <?php else: ?>移动端<?php endif; ?></b>
            </strong>
            <strong>
                <em>推广：</em>
                <b>
                    <?php if(is_array($ty)): $i = 0; $__LIST__ = $ty;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if(($key) > "0"): ?>/<?php endif; if(($vo1["type"]) == "meiti"): ?>富媒体<?php else: echo ($vo1["type"]); endif; endforeach; endif; else: echo "" ;endif; ?>
                </b>
            </strong>
            <strong>
                <em>方式：</em>
                <b>
                    <?php if(is_array($ty)): $i = 0; $__LIST__ = $ty;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if(($key) > "0"): ?>/<?php endif; echo (get_fangshi($vo1["date"])); endforeach; endif; else: echo "" ;endif; ?>
                </b>
            </strong>
            <strong>
                <em>价格：</em>
                <i>
                    <?php if(is_array($ty)): $i = 0; $__LIST__ = $ty;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if(($key) > "0"): ?>/<?php endif; echo ($vo1["price"]); ?></eq><?php endforeach; endif; else: echo "" ;endif; ?>
                </i>
            </strong>
        </span>
    </div>
    <div class="notice_details_main_list">
        <strong>
            <?php if(is_array($ty)): $i = 0; $__LIST__ = $ty;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><a href="<?php echo U('details/'.$vo1['id']);?>" <?php if(($vo1["type"]) == $pro["type"]): ?>id="product_navbg"<?php endif; ?> ><?php if(($vo1["type"]) == "meiti"): ?>富媒体<?php else: echo ($vo1["type"]); endif; ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </strong>
				<span>
                    <?php if(is_array($pro['pack_list'])): $i = 0; $__LIST__ = $pro['pack_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pl): $mod = ($i % 2 );++$i;?><a href="<?php echo U('/details/'.$pl['id']);?>" <?php if(($pl["id"]) == $pro["id"]): ?>id="product_navbg"<?php endif; ?>><?php echo ($pl["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</span>
        <div class="notice_details_main_list_excl">
            <strong>
                    <span>
                        <em>结算周期：<i><?php echo (get_fangshi($pro["date"])); ?></i></em>
                        <?php if(($pro["download"]) == "1"): ?><a href="/Home/Private/down_res?id=<?php echo ($pro["id"]); ?>" data-role="<?php echo ($pro["id"]); ?>" class="download-app">安装包下载</a><?php else: ?><b>推广链接：<a><?php echo ($pro["resource"]); ?></a></b><?php endif; ?>
                    </span>
                    <a href="/Home/Private/export_excel?mid=<?php echo (session('mid')); ?>&pid=<?php echo ($pro["id"]); ?>" id="download_exl">下载EXCL表单</a>
            </strong>
					<span>
						<ul id="title_bg">
                            <li class="width4">时间</li>
                            <li class="width3">价格/元</li>
                            <li class="width3">数据</li>
                            <li class="width3">核减/数据</li>
                            <li class="width3">收益金额/元</li>
                            <li class="width3">扣税0.06%</li>
                            <li class="width3">结算金额/元</li>
                            <li class="width3">官方截图</li>
                            <li class="width4" id="border_none">结算状态</li>
                        </ul>
                        <?php if(empty($list)): ?><div class="product_list_infor_none">暂无数据</div>
                            <?php else: ?>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["checked"]) != "-"): ?><ul>
                                        <li class="width4">
                                            <i class="red_sj position_ab"></i>
                                            <?php echo (date('Y-m-d',$vo["time"])); ?>
                                        </li>
                                        <li class="width3"><?php echo ($vo["price"]); ?></li>
                                        <li class="width3"><?php echo ($vo["real"]); ?></li>
                                        <li class="width3"><?php if(($vo["checked"]) == "-"): ?>-<?php else: echo ($vo["checked"]); endif; ?></li>
                                        <li class="width3"><?php echo ($vo["total1"]); ?></li>
                                        <li class="width3"><?php if($_SESSION['mtype'] == 0): echo ($vo["choushui"]); else: ?>-<?php endif; ?></li>
                                        <li class="width3"><?php echo ($vo["total"]); ?></li>
                                        <li class="width3"><?php if(!empty($vo["image"])): ?><a href="/Home/Private/dimage?id=<?php echo ($vo["id"]); ?>">下載</a> <?php else: ?>未上传<?php endif; ?></li>
                                        <li class="width4" id="border_none">
                                            <?php if(($vo["total"]) == "0"): ?>-
                                                <?php else: ?>
                                                <?php if(($vo["status"]) == "1"): ?><b>已結算</b>
                                                    <a href="/Home/Private/down_kuan?id=<?php echo ($vo["id"]); ?>">截图</a>
                                                    <?php else: ?><em>未结算</em><?php endif; endif; ?>
                                        </li>
                                    </ul>
                                    <?php else: ?>
                                    <ul>
                                        <li class="width4"><?php echo (date('Y-m-d',$vo["time"])); ?></li>
                                        <li class="width3"><?php echo ($vo["price"]); ?></li>
                                        <li class="width3"><?php echo ($vo["real"]); ?></li>
                                        <li class="width3">-</li>
                                        <li class="width3">-</li>
                                        <li class="width3">-</li>
                                        <li class="width3">-</li>
                                        <li class="width3"><?php if(!empty($vo["image"])): ?><a href="/Home/Private/dimage?id=<?php echo ($vo["id"]); ?>">下載</a> <?php else: ?>未上传<?php endif; ?></li>
                                        <li class="width4" id="border_none">-</li>
                                    </ul><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>

					</span>
                    <!--<?php if(!empty($list)): ?>-->
                        <!--<strong class="product_list_infor_none">暂无数据</strong>-->
                    <!--<?php endif; ?>-->
            <div>
                <i>
                    <b class="red_sj position_ab"></b>
                    红色角标为结算日
                </i>
                <span class="">
                    <?php echo ($page); ?>
                </span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#download_exl').click(function (e) {
            e.preventDefault();
            $.post('/Home/Private/export_excel',{mid:'<?php echo (session('mid')); ?>',pid:'<?php echo ($pro["id"]); ?>'},function (data) {
                if(data.status==1){
                    //window.open(data.redirect);
                    window.location.href=data.redirect;
                }else {
                    alert(data.msg);
                }
            });
        });
    });
</script>
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