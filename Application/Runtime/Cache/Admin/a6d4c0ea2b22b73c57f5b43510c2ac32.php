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
<script type="text/javascript" src="/Public/Plug/jeDate/jedate/jedate.js"></script>
<div class="admin_r_all" style="height: 477px;">
    <div class="admin_bg_all">
        <div class="admin_bg_t">
            <a href="#" id="admin_bg_t_x">XONE 产品信息</a>
                    <span class="admin_yhgl_top">
                        <a href="/Admin/Member/plist?mid=<?php echo ($_GET['mid']); ?>">返回产品列表</a>
                    </span>
        </div>
        <div class="admin_bg_b">
            <ul class="admin_bg_b_t">
                <li class="admin_bg6">开通时间</li>
                <li class="admin_bg7">产品</li>
                <li class="admin_bg5">类型</li>
                <li class="admin_bg5">推广方式</li>
                <li class="admin_bg5">结算方式</li>
                <li class="admin_bg5">价格</li>
                <li class="admin_bg4">数据</li>
            </ul>

            <ul>
                <li class="admin_bg6"><p></p><?php echo (date('Y-m-d',$pro["create_time"])); ?></li>
                <li class="admin_bg7"><?php echo (get_pro($pro["pid"])); ?></li>
                <li class="admin_bg5"><?php echo (get_col($pro["cid"])); ?></li>
                <li class="admin_bg5"><?php if(($pro["type"]) == "meiti"): ?>富媒体<?php else: echo ($pro["type"]); endif; ?></li>
                <li class="admin_bg5"><?php echo (jiesuan1($pro["date"])); ?></li>
                <li class="admin_bg5"><?php echo ($pro["price"]); ?></li>
                <li class="admin_bg4"><a href="/Admin/Member/export?mid=<?php echo ($_GET['mid']); ?>&pid=<?php echo ($_GET['id']); ?>">下载</a> </li>
                <form action="/Admin/Member/package" method="post" enctype="multipart/form-data">
                    <div class="team_bottom">
                        <div class="admin_tgfs">
                            <a href="#" id="admin_tgfs_xz"><?php if(($pro["type"]) == "meiti"): ?>富媒体<?php else: echo ($pro["type"]); endif; ?></a>
                        </div>
                        <div class="admin_tgfs admin_tgfs2">
                            <?php if(is_array($pro["pack_list"])): $i = 0; $__LIST__ = $pro["pack_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/Admin/Member/ckeck?id=<?php echo ($vo["id"]); ?>&mid=<?php echo ($_GET['mid']); ?>&p=<?php echo ($_GET['p']); ?>" <?php if(($vo["id"]) == $_GET['id']): ?>id="admin_tgfs_xz" class="admin_tgfs_xz_title"<?php endif; ?>><?php echo ($vo["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div style="float:right;" >
                            删除包:<select  id="package-names">
                                        <option value="0">-请选择-</option>
                                        <?php if(is_array($pro["pack_list"])): $i = 0; $__LIST__ = $pro["pack_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    <a href="javascript:void(0);" class="btn-delpack">删除</a>
                        </div>
                        <div class="admin_tgfs_in">
                            <input name="date" type="text"  placeholder="请输入日期" class="laydate-icon" id="textymdhms" readonly>
                            <input name="sh_price" type="text" value="<?php echo ($pro["sh_price"]); ?>" placeholder="上家价格" id="sh_price" onblur="change_val(this,1)">
                            <input name="price" type="text" value="<?php echo ($pro["price"]); ?>" placeholder="用户价格" id="price" onblur="change_val(this,1)">
                            <input name="real" id="real" type="text" placeholder="上家数据" class="" id="real" onblur="change_val(this,1)">
                            <input name="qudao" type="text" placeholder="用户数据" class="" id="qudao" onblur="change_val(this,1)">
                            <input type="hidden" name="pid" value="<?php echo ($pro["id"]); ?>" class="" id="pid">
                            <input type="hidden" name="mid" value="<?php echo ($pro["mid"]); ?>" id="mid">
                            <input type="hidden" name="download" value="<?php echo ($pro["download"]); ?>" id="download">
                            <input name="sh_ckeck" type="text" placeholder="上家核减数据" id="sh_ckeck">
                            <input name="ckeck" type="text" placeholder="用户核减数据" id="ckeck">
                            <label>
                                <input type="checkbox" name="sh_shui" id="sh_shui" value="1">
                                <em>上家税点</em>
                            </label>
                            <label>
                                 <input type="checkbox" name="check_shui" id="shui" value="1">
                                 <em>下家税点</em>
                            </label>
                            <input style="width:200px;" name="file" type="file">
                            <?php if(($member_type) == "0"): ?><input type="hidden" name="shui" value="<?php echo ($shui); ?>"><?php else: ?><input type="hidden" name="shui" value="0"><?php endif; ?>
                        </div>
                        <label class="admin_tgfs_t">
                            <i>时间</i>
                            <i>上家价格/元</i>
                            <i>用户价格/元</i>
                            <i>上家数据</i>
                            <i>用户数据</i>
                            <i>上家核减数据</i>
                            <i>用户核减数据</i>
                            <i>结算税率</i>
                            <i>上家结算金额</i>
                            <i>用户结算金额</i>
                            <i>收益金额</i>
                            <i>官方截图</i>
                            <i>结算状态</i>
                        </label>

                        <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><label data-role="<?php echo ($vo1["id"]); ?>">
                                    <i><?php echo (date('Y-m-d',$vo1["time"])); ?></i>
                                    <i><?php echo ($vo1["sh_price"]); ?></i>
                                    <i><?php echo ($vo1["price"]); ?></i>
                                    <i><span  class="check-input" data-role="real"><?php if(($real) == "0"): ?>-<?php else: echo ($vo1["real"]); endif; ?></span></i>
                                    <i><span class="check-input" data-role="qudao"><?php echo ($vo1["qudao"]); ?></span></i>
                                    <i><span class="check-input" data-role="sh_checked"><?php if(($vo1["sh_checked"]) == "-"): ?>-<?php else: echo ($vo1["sh_checked"]); endif; ?></span></i>
                                    <i><span class="check-input" data-role="checked"><?php echo ($vo1["checked"]); ?></span></i>
                                    <i id="chou-shui"><?php if(($member_type) == "0"): echo ($shui); else: ?>-<?php endif; ?></i>
                                    <i><?php if(($vo1["sh_total"]) != "0"): echo ($vo1["sh_total"]); else: ?>-<?php endif; ?> </i>
                                    <i><?php if(($vo1["total"]) != "0"): echo ($vo1["total"]); else: ?>-<?php endif; ?></i>
                                    <i><?php if(($vo1["shouyi"]) == "0"): ?>-<?php else: echo ($vo1["shouyi"]); endif; ?></i>
                                    <i><?php if(!empty($vo1["image"])): ?>已上传<?php else: ?>未上传<?php endif; ?></i>
                                    <i>
                                        <?php if($vo1["status"] == 1 and $vo1["total"] != 0): ?><span style="color:green;">已结算</span><?php endif; ?>
                                        <?php if($vo1["status"] == 0 and $vo1["total"] != 0): ?><span style="color:red;">未结算</span><?php endif; ?>
                                        <?php if($vo1["status"] == 0 and $vo1["checked"] == 0 and $vo1["total"] == 0): ?>-<?php endif; ?>
                                    </i>
                                </label><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="admin_null"><?php echo ($page); ?></div>
                            <?php else: ?>
                            <div class="admin_null">暂无数据</div><?php endif; ?>
                        <!--<div style="line-height:30px; text-align:center;">翻页</div>-->
                        <div class="admin_tgxx">
                            <em>推广地址：<input name="url" type="text" value="<?php echo ($pro["resource"]); ?>"></em>
                            <em>安装包：<input name="file1" type="file"></em>
                            <input class="admin_tg_an" name="" type="submit" value="保存数据">
                            <textarea name="desc" cols="" rows="" placeholder="备注信息"><?php echo ($pro["des"]); ?></textarea>
                        </div>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</div>
<script>
    $flag = true;
    $(function () {
        jeDate({
            dateCell:"#textymdhms",
            format:"YYYY-MM-DD",
            isinitVal:true,
            isTime:true,
            festival: true, //显示节日
            maxDate: jeDate.now(0), //1代表明天，2代表后天，以此类推
            choosefun:function(val) {
               $.post('/Admin/Member/change_date',{pid:'<?php echo ($_GET['id']); ?>',mid:'<?php echo ($_GET['mid']); ?>',date:val},function(data) {
                    if(data.status==1){
                        $('#mid').val(data.data.mid);
                        $('#pid').val(data.data.pid);
                        $('#price').val(data.data.price);
                        $('#qudao').val(data.data.qudao);
                        if(data.data.checked!='-'){
                            $('#ckeck').val(data.data.checked);
                        }
                        if(data.data.sh_checked!='-'){
                            $('#sh_ckeck').val(data.data.sh_checked);
                        }
                        $('#real').val(data.data.real);
                        $('#sh_price').val(data.data.sh_price);
                       if(data.data.sh_type==1){
                           $('#sh_type').attr('checked',true);
                       }else {
                           $('#sh_type').attr('checked',false);
                       }
                       $('.admin_tgfs_in').append('<input type="hidden" name="data_insert" value="1"><input type="hidden" name="data_id" value="'+data.data.id+'">');
                    }else{
                        $('.admin_tgfs_in').append('<input type="hidden" name="data_insert" value="0"><input type="hidden" name="data_id" value="0">');

                        $('#qudao').val('');
                        $('#ckeck').val('');
                        $('#real').val('');
                        $('#sh_ckeck').val('');
                    }
               });
            }
        });
        $('form').validate();
        $('form').on('submit',function (e) {
            e.preventDefault();
            if($('form').valid() && $flag){
                $index = layer.load(2);
                $('form').ajaxSubmit({
                    success:function(data){
                        if(data.status=1){
                            layer.close($index);
                           redirect('/Admin/Member/ckeck?id=<?php echo ($_GET['id']); ?>&mid=<?php echo ($_GET['mid']); ?>&p=<?php echo ($_GET['p']); ?>',data.msg,3);
                        }else{
                            layer.msg(data.msg, {icon: 2});
                        }
                    }
                });
            }
        });
        // 第一个参数 单击事件处理，第二个参数 双击事件处理
        $(".check-input").dblclick(function () {
            $('<input type="text" id="this-input" style="width: 40px;text-align:center;border: none;" value="'+$(this).text()+'" onblur="change(this);">').insertBefore($(this));
            $(this).hide();
        });

        $('.btn-delpack').click(function (e) {
            e.preventDefault();
            $val = $('#package-names').val();

            if($val!==0){
                $.post('/Admin/Member/delpack',{t:'<?php echo ($pro["type"]); ?>',cid:'<?php echo ($pro["cid"]); ?>',id:$val,mid:'<?php echo ($_GET['mid']); ?>',title:$('.admin_tgfs_xz_title').text(),pid:'<?php echo ($pro["pid"]); ?>'},function (data) {
                    window.location.reload();
                });
            }
        });
    });
    //鼠标单击和双击事件组件
function change(obj) {
    $this=$(obj);
    $id = $this.parent('i').parent('label').attr('data-role');
    $val  = $this.val();
    $type  = $this.siblings('span.check-input').attr('data-role');
    $shui  = $('#chou-shui').text();
    if($('#sh_shui').is(':checked')){
        $_shui  = 1;
    }else {
        $_shui  = 0;
    }

    $.post('/Admin/Member/check_data',{id:$id,val:$val,t:$type,shui:$shui,sh_shui:$_shui,pid:"<?php echo ($_GET['id']); ?>"},function (data) {
        if(data.status==1){
            setTimeout(function () {
                window.location.reload();
            },500);
        }
    });
}
 function change_val(obj,id) {
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
                $this.removeAttr('style');
                $flag = true;
            }
        }
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