<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CPA88.com_后台登录</title>
	<link rel="stylesheet" href="/Public/Admin/css/login.css">
	<script type="text/javascript" src="/Public/Admin/js/jquery-2.2.1.min.js"></script>
</head>
<body style="background: url('/Public/Admin/images/login_bg.jpg'); background-size: cover;">
<div class="login2">
	<span>后台登陆</span>
	<form action="<?php echo U('public/login');?>" method="post">
		<div class="input_group">
			<label>管理员</label>
			<input type="text" name="username" id="username">
		</div>
		<div class="input_group">
			<label>密　码</label>
			<input type="password" name="password" id="password">
		</div>
		<input type="submit" class="btn" value="登录">
		<input type="reset" class="btn" value="重置">
	</form>
</div>
<script type="text/javascript">
	$(function () {
		$('form').submit(function (e) {
			e.preventDefault();
			$flag = true;
			$username = $('#username').val();
			$password = $('#password').val();
			if($username==''){
				alert('管理员账号不能为空');
				$flag = false ;
				return '';
			}
			if($password==''){
				alert('密码不能为空');
				$flag = false ;
				return '';
			}
			if($flag){
				$href = $('form').attr('action');
				$.post($href,{username:$username,password:$password},function (data) {
					if(data.status==0){
						alert(data.msg);
					}else {
						window.location.href= data.redirect;
					}
				});
			}
		});
	})
</script>
</body>
</html>