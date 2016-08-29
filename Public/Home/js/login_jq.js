
(function ($)
{
	$.support.placeholder = ('placeholder' in document.createElement('input'));
})(jQuery);


$(function(){
	//光标离开后内容为空显示

	$("input[type='text']").each(function()
	{
		if (!$.support.placeholder)
		{
			$(this).val($(this).attr("placeholder")).css("color","#666");
		}
	}).focus(function()
	{
		if($(this).val()==$(this).attr("placeholder"))
		{
			$(this).val("");
		}
	}).keydown(function()
	{
		$(this).css("color","#666");
	});





		$(".login_user").blur(function(){
			$flage = true;
			if($(this).val() == "" || $(this).val()==$(this).attr("placeholder"))
			{
				if(!$.support.placeholder)
				{
					$(this).val($(this).attr("placeholder"));
				}
				else
				{
					$(this).val("");
				}
				$(this).val($(this).attr("placeholder")).css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$("#msg").text("请输入用户名");
				return false;
			}else{
				$(this).css({"box-shadow":"","border":"1px solid #ddd"});
				$("#msg").text("");
				$flage;	
			}
		});

		$(".cover_password").click(function()
		{
			$(this).hide().next().show().focus();
		}).focus(function()
		{
			$(this).hide().next().show().focus();
		});

		$(".login_password").blur(function(){
			$flage = true;
			if($(this).val() == ""){
				$(this).hide().css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$(".cover_password").show().css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$(".cover_password").val($(".cover_password").attr("placeholder"));
				$("#msg").text("请输入密码");
				//$(this).focus();
			}else{
				$(this).show().css({"box-shadow":"0px 0px 0px","border":"1px solid #ddd"});
				$(".cover_password").hide().css({"box-shadow":"","border":"1px solid #ddd"});
				$("#msg").text("");
				$flage;	
			}
		});
		$code_flag=false;
		$(".login_code").blur(function(){
			if($(this).val() == "" || $(this).val()==$(this).attr("placeholder"))
			{
				if(!$.support.placeholder)
				{
					$(this).val($(this).attr("placeholder"));
				}
				else
				{
					$(this).val("");
				}
				$(this).css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$("#msg").text("请输入验证码");
				return false;
			}
			else
			{
				$val = $('.login_code').val();
				$(this).css({"box-shadow":"0px 0px 0px","border":"1px solid #ddd"});
			}
		});
		
	//点击登录check内容是否为空
	$("#login").click(function(){
		if($(".login_user").val() == "" || $(".login_user").val()==$(".login_user").attr("placeholder")){
			$(".login_user").focus().css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$("#msg").text("请输入用户名");
			//$flage = false;
			return false;
		}else if($(".login_password").val() == ""){
			$(".login_password").show().focus().css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"}).prev().hide();
			$("#msg").text("请输入密码");
			//$flage = false;
			return false;
		}else if($(".login_code").val() == "" || $(".login_code").val()==$(".login_code").attr("placeholder")){
			$(".login_code").focus().css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$("#msg").text("请输入验证码");
			//$flage = false;
			return false;
		}else{
			$.get(url+'check_code?code='+$(".login_code").val(),function (data) {
				if(data.status==1){
					$('form').ajaxSubmit({
							success:function(data){
								if(data.status==2){
									window.location.href=data.redirect;
									//redirect(data.data.redirect,data.msg,3);
								}else if(data.status==0){
									$(".login_user").css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
									$("#msg").text(data.msg);
									$(".login_user").focus();
								}else{
									$(".login_password").focus().css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
									$("#msg").text(data.msg);
									$(".login_code").val("");
									$(".code_image").attr("src",$(".code_image").attr("src")+'?id='+Math.random());
								}
							}
						});
				}else{
					$(".login_code").val("").css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
					$("#msg").text(data.msg);
					$(".code_image").attr("src",$(".code_image").attr("src")+'?id='+Math.random());
				}
			});
			return false;
		}
	});
});

function check_code(obj) {
	$val = $('#'+obj).val();
	$.get(url+'check_code?code='+$val,function (data) {
		if(data.status==0){
			$(".login_code").css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$("#msg").text(data.msg);
			return false;
		}else{
			$(".login_code").css({"box-shadow":"0px 0px 0px","border":"1px solid #ddd"});
			$("#msg").text('');
		}
	});
}