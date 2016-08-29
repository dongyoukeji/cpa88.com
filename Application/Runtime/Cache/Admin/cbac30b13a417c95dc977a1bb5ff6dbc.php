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
            <a href="/Admin/Member/see?mid=<?php echo ($_GET['mid']); ?>" >基本信息</a>
            <a href="/Admin/Member/plist?mid=<?php echo ($_GET['mid']); ?>" >产品列表</a>
            <a href="/Admin/Member/add?mid=<?php echo ($_GET['mid']); ?>" id="admin_bg_t_x">添加产品</a>
            <span class="admin_yhgl_top">
                <a href="/Admin/Member/plist">返回包列表</a>
            </span>
        </div>
        <form action="/Admin/Member/paddhd" method="post" enctype="multipart/form-data">
            <div class="admin_bg_fb">
                    <span>
                    	<em>产品类型</em>
                        <select name="type" id="change-type">
                            <?php if(is_array($col)): $i = 0; $__LIST__ = $col;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </span>
                    <span>
                    	<em>产品名称</em>
                        <select name="ptype" id="plist">
                            <?php if(is_array($pro)): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo1["id"]); ?>"><?php echo ($vo1["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <input name="mid" type="hidden" value="<?php echo ($_GET['mid']); ?>">
                    </span>
                    <span>
                    	<em>详细</em>
                        <div class="admin_tgxz">
                            <?php if(is_array($tpro["pro_attr"])): $k = 0; $__LIST__ = $tpro["pro_attr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="admin_tgxz_n">
                                    <input name="pro_attr[<?php echo ($k); ?>][t]" type="checkbox" value="<?php echo ($vo["t"]); ?>" onchange="change(this,0)">
                                    <i><?php if(($vo["t"]) == "meiti"): ?>富媒体<?php else: echo ($vo["t"]); endif; ?> </i>
                                    <input class="admin_tgxz_j" name="pro_attr[<?php echo ($k); ?>][sh_price]" type="text" placeholder="上家价格" value="<?php echo ($vo["sh_price"]); ?>" onchange="change(this,1)">
                                    <input class="admin_tgxz_j" name="pro_attr[<?php echo ($k); ?>][price]" type="text" placeholder="用户价格" value="<?php echo ($vo["price"]); ?>" onchange="change(this,1)">
                                    <select name="pro_attr[<?php echo ($k); ?>][type]">
                                        <option value="1"  <?php if(($vo["type"]) == "1"): ?>selected<?php endif; ?> >日结</option>
                                        <option value="2" <?php if(($vo["type"]) == "2"): ?>selected<?php endif; ?>>周结</option>
                                        <option value="3" <?php if(($vo["type"]) == "3"): ?>selected<?php endif; ?>>月结</option>
                                    </select>
                                    <a class="add-package" data-role="<?php echo ($k); ?>" data-index="1" onclick="javascript:create_package('<?php echo ($vo["t"]); ?>',<?php echo ($k); ?>,this)">添加包</a>
                                    <div class="admin_tg_btj">
                                        <input name="pro_attr[<?php echo ($k); ?>][0][pack][pack]" type="text" placeholder="包名"  class="package-name" onblur="check_package(this)" onchange="change(this,0)">
                                        <input id="admin_btj_1" name="pro_attr[<?php echo ($k); ?>][0][pack][link]" type="text" placeholder="推广链接" class="" onchange="change(this,0)">
                                        <input name="pro_attr[<?php echo ($k); ?>][0][pack_<?php echo ($vo["t"]); ?>][file]" type="file">
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </span>
                    <span>
                    	<em>备注</em>
                        <textarea name="desc" cols="" rows="" placeholder="备注信息填写"></textarea>
                    </span>
                <div class="admin_bg_b2 admin_bg_b3">
                    <input name="" type="submit" value="确认添加">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $flag = true;
    $(function () {
        $('input[type="checkbox"]').bind('click',function (e) {
            $('.error').remove();
        });
        $('form').submit(function (e) {
            $('input[type="checkbox"]').each(function (index) {
                 if($(this).is(':checked')){
                     $parent = $(this).parent('.admin_tgxz_n');
                     $input = $parent.find('input[type="text"]');
                     $input.each(function (index) {
                         if($(this).val()==''){
                             $(this).css('border','1px solid red');
                             $flag = false;
                         }else {
                             $(this).removeAttr('style');
                         }
                     });
                 }
            });
            if($('input[type="checkbox"]').is(':checked')==false){
                if(!$('.admin_tgxz').siblings('div').hasClass('error')){
                    $('.admin_tgxz').after('<div style="color:red;clear: both; margin-left:75px;" class="error">至少需要勾填一项</div>');
                }
                $flag = false;
            }
            return $flag;
        });

        $('#change-type').change(function (e) {
            $.post('/Admin/Member/changes',{id:$(this).val()},function (data) {
                if(data.status==1){
                    var plist  = data.plist;
                    var first  = data.first.pro_attr;
                    $html="";
                    $html1="";
                    for(var i=0;i<plist.length;i++){
                        $html +="<option value='"+plist[i]['id']+"'>"+plist[i]['title']+"</option>";
                    }
                    for (var j=0;j< first.length;j++){

                       $html1+='<div class="admin_tgxz_n">';
                       $html1+='  <input name="pro_attr['+j+'][t]" type="checkbox" value="'+first[j]['t']+'" >';
                        if(first[j]['t']=='meiti'){
                            $html1+='   <i>富媒体 </i>';
                        }else{
                            $html1+='   <i>'+first[j]['t']+'</i>';
                        }
                        if(first[j]['sh_price']!=null){
                            $html1+='   <input class="admin_tgxz_j" name="pro_attr['+j+'][sh_price]" type="text" placeholder="上家价格" value="'+first[j]['sh_price']+'" onchange="change(this,1)">';
                        }else{
                            $html1+='   <input class="admin_tgxz_j" name="pro_attr['+j+'][sh_price]" type="text" placeholder="上家价格" value="" onchange="change(this,1)">';
                        }
                       $html1+='   <input class="admin_tgxz_j" name="pro_attr['+j+'][price]" type="text" placeholder="价格" value="'+first[j]['price']+'" onchange="change(this,0)">';


                       $html1+='   <select name="pro_attr['+j+'][type]">';
                        if(first[j]['type']==1){
                            $html1+='        <option value="1" selected>日结</option>';
                            $html1+='        <option value="2">周结</option>';
                            $html1+='        <option value="3" >月结</option>';
                        }else if(first[j]['type']==2){
                            $html1+='        <option value="1" >日结</option>';
                            $html1+='        <option value="2" selected>周结</option>';
                            $html1+='        <option value="3" >月结</option>';
                        }else{
                            $html1+='        <option value="1">日结</option>';
                            $html1+='        <option value="2">周结</option>';
                            $html1+='        <option value="3" selected>月结</option>';
                        }

                       $html1+='   </select>';
                       $html1+='        <a class="add-package" data-role="'+j+'" data-index="1" onclick="javascript:create_package(\''+first[j]['t']+'\','+j+',this)">添加包</a>';
                       $html1+='        <div class="admin_tg_btj">';
                       $html1+='        <input name="pro_attr['+j+'][0][pack][pack]" type="text" placeholder="包名" onblur="check_package(this)" onchange="change(this,0)">';
                       $html1+='        <input id="admin_btj_1" name="pro_attr['+j+'][0][pack][link]" type="text" placeholder="推广链接" class="" onchange="change(this,0)">';
                       $html1+='        <input name="pro_attr['+j+'][0][pack_'+first[j]['t']+'][file]" type="file">';
                       $html1+='        </div>';
                       $html1+='       </div>';

                    }
                    $('#plist').empty().html($html);
                    $('.admin_tgxz').empty().html($html1);
                }
            });
        });

        $('#plist').change(function () {
            $.post('/Admin/Member/change_pro',{id:$(this).val()},function (data) {
                var first  = data.first.pro_attr;
                if(data.status==1){
                    var first  = data.first.pro_attr;
                    $html1="";

                    for (var j=0;j< first.length;j++){

                        $html1+='<div class="admin_tgxz_n">';
                        $html1+='  <input name="pro_attr['+j+'][t]" type="checkbox" value="'+first[j]['t']+'">';
                        if(first[j]['t']=='meiti'){
                            $html1+='   <i>富媒体 </i>';
                        }else{
                            $html1+='   <i>'+first[j]['t']+'</i>';
                        }
                        if(first[j]['sh_price']!=null){
                            $html1+='   <input class="admin_tgxz_j" name="pro_attr['+j+'][sh_price]" type="text" placeholder="上家价格" value="'+first[j]['sh_price']+'" onchange="change(this,1)">';
                        }else{
                            $html1+='   <input class="admin_tgxz_j" name="pro_attr['+j+'][sh_price]" type="text" placeholder="上家价格" value="" onchange="change(this,1)">';
                        }
                        $html1+='   <input class="admin_tgxz_j" name="pro_attr['+j+'][price]" type="text" placeholder="用户价格" value="'+first[j]['price']+'" onchange="change(this,0)">';


                        $html1+='   <select name="pro_attr['+j+'][type]">';
                        if(first[j]['type']==1){
                            $html1+='        <option value="1" selected>日结</option>';
                            $html1+='        <option value="2">周结</option>';
                            $html1+='        <option value="3" >月结</option>';
                        }else if(first[j]['type']==2){
                            $html1+='        <option value="1" >日结</option>';
                            $html1+='        <option value="2" selected>周结</option>';
                            $html1+='        <option value="3" >月结</option>';
                        }else{
                            $html1+='        <option value="1">日结</option>';
                            $html1+='        <option value="2">周结</option>';
                            $html1+='        <option value="3" selected>月结</option>';
                        }
                        $html1+='   </select>';
                        $html1+='        <a class="add-package" data-role="'+j+'" data-index="1" onclick="javascript:create_package(\''+first[j]['t']+'\','+j+',this)">添加包</a>';
                        $html1+='        <div class="admin_tg_btj">';
                        $html1+='        <input name="pro_attr['+j+'][0][pack][pack]" type="text" placeholder="包名" onblur="check_package(this)" onchange="change(this,0)">';
                        $html1+='        <input id="admin_btj_1" name="pro_attr['+j+'][0][pack][link]" type="text" placeholder="推广链接" class="" onchange="change(this,0)">';
                        $html1+='        <input name="pro_attr['+j+'][0][pack_'+first[j]['t']+'][file]" type="file">';
                        $html1+='        </div>';
                        $html1+='       </div>';

                    }
                    $('.admin_tgxz').empty().html($html1);
                }
            });
        });

    });
    function create_package(t,id,obj) {
        $html="";
        $this = $(obj);
        $index = id;
        $tindex = $this.attr('data-index');
        $html ='<div class="admin_tg_btj">';
        $html +='<input name="pro_attr['+$index+']['+$tindex+'][pack][pack]" type="text" placeholder="包名"  onblur="check_package(this)" onchange="change(this,0)">';
        $html +='<input id="admin_btj_1" name="pro_attr['+$index+']['+$tindex+'][pack][link]" type="text" placeholder="推广链接" class="" onchange="change(this,0)">';
        $html += '<input name="pro_attr['+$index+']['+$tindex+'][pack_'+t+'][file]" type="file">';
        $html += '<span style="cursor: pointer;" onclick="javascript:closed('+$index+',this);">×</span>';
        $html +='</div>';
        $this.siblings('.admin_tg_btj').last().after($html);
        $this.attr('data-index',++$tindex);
    }
    function check_package(obj) {
        $this=$(obj);
        if($this.val()!=''){
            $.post('/Admin/Member/check_packname',{pid:$('#plist').val(),title:$this.val(),cid:$('#change-type').val(),mid:'<?php echo ($_GET['mid']); ?>'},function (data) {
                if(data.status==0){
                    alert(data.msg);
                    $this.css('border','1px solid red');
                    $flag = false;
                }else {
                    $this.removeAttr('style');
                    $flag = true;
                }
            });
        }
    }
    function change(obj,id) {
        var reg = /^\d+(\.\d+)?$/;
        $this = $(obj);
        if($this.val()!=''){
            $this.removeAttr('style');
            $flag = true;
        }else {
            $flag = false;
        }
        if(id==1){
            if(!reg.test($this.val())){
                $flag = false;
                alert('请填写数字');
                $this.css('border','1px solid red');
            }else{
                $flag = true;
            }
        }
    }
    function closed(id,obj) {
        $(obj).parent('div.admin_tg_btj').remove();
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