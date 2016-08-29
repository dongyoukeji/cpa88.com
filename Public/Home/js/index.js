var pass = /^\S{6,16}$/;



$(function () {
	//搜索wwwwwww
	$(function() {

		$(".change_input i").click(function()
		{
			$(this).hide();
			$(this).next().show().focus();
		});

		$(".reivse_reset").click(function()
		{
			$(".changePassword1").val("").css({"box-shadow": "0px 0px 0px"});
			$(".changePassword1").prev().show().css({"box-shadow": "0px 0px 0px"});
			$(".changePassword1").parent().css("border","");
			$(".infor_reivse").hide();
		});

		$(".changePassword").click(function () {
			$(".infor_reivse").toggle();
		});

		$("#initPassword").blur(function () {
			if ($(this).val() == "") {
				$(this).css({"box-shadow": "0px 0px 3px 1px red"});
				$(this).parent().css("border", "1px solid red");
				$(this).prev().show();
				return false;
			}
			else {
				$(this).prev().hide();
				$(this).css({"box-shadow": "0px 0px 0px"});
				$(this).parent().css("border", "");
			}
		});

		$("#newPassword1").blur(function () {
			if ($(this).val() == "") {
				$(this).parent().css("border", "1px solid red");
				$(this).css({"box-shadow": "0px 0px 3px 1px red"});
				$(this).prev().show();
				return false;
			}
			else if(pass.test($(this).val())==false)
			{
				$(this).focus().val("").css({"box-shadow": "0px 0px 3px 1px red"});
				$(this).parent().css("border", "1px solid red");
				alert("请输入6-16位字符，不包括特殊字符!");
				return false;
			}
			else if($(this).val() != $("#newPassword2").val() && $("#newPassword2").val()!="")
			{
				$("#newPassword2").val("").focus().css({"box-shadow": "0px 0px 3px 1px red"});
				$("#newPassword2").parent().css("border", "1px solid red");
				$(this).css({"box-shadow": "0px 0px 0px", "border": ""});
				alert("再次输入密码与新密码不一致!")
				return false;
			}
			else {
				$(this).css({"box-shadow": "0px 0px 0px"});
				$(this).prev().hide();
				$(this).parent().css("border", "");
			}
		}).focus(function()
		{
			$(this).prev().hide();
			$(this).show().focus();
		});

		$("#newPassword2").blur(function () {
			if($("#newPassword1").val()=="")
			{
				$(this).val("").prev().show();
				$("#newPassword1").prev().hide();
				$("#newPassword1").parent().css("border", "1px solid red");
				$("#newPassword1").focus().css({"box-shadow": "0px 0px 3px 1px red"});
				return false;
			}
			else if ($(this).val() == "") {
				$(this).css({"box-shadow": "0px 0px 3px 1px red"});
				$(this).parent().css("border", "1px solid red");
				$(this).prev().show();
				return false;
			}

			else if($(this).val()!= $("#newPassword1").val())
			{
				$("#newPassword2").val("").css({"box-shadow": "0px 0px 3px 1px red"}).focus();
				$(this).parent().css("border","1px solid red");
				alert("再次输入密码与新密码不一致!")
				return false;
			}

			else {
				$(this).css({"box-shadow": "0px 0px 0px", "border": ''});
				$(this).parent().css("border", "");
				$(this).prev().hide();
			}
		}).focus(function()
		{
			$(this).prev().hide();
			$(this).show().focus();
		});

		$(".reivse_submit").click(function () {
			if ($("#initPassword").val() == "") {
				$("#initPassword").focus().css({"box-shadow": "0px 0px 3px 1px red"});
				$("#initPassword").parent().css("border", "1px solid red");
				$("#initPassword").prev().hide();
				return false;
			}

			else if ($("#newPassword1").val() == "") {
				$("#newPassword1").focus().css({"box-shadow": "0px 0px 3px 1px red"});
				$("#newPassword1").prev().hide();
				$("#newPassword1").parent().css("border", "1px solid red");
				return false;
			}

			else if(pass.test($("#newPassword1").val())==false)
			{
				$("#newPassword1").focus().val("").css({"box-shadow": "0px 0px 3px 1px red"});
				$("#newPassword1").parent().css("border", "1px solid red");
				alert("请输入6-16位字符，不包括特殊字符!");
				return false;
			}


			else if ($("#newPassword2").val() == "") {
				$("#newPassword2").focus().css({"box-shadow": "0px 0px 3px 1px red"});
				$("#newPassword2").prev().hide();
				$("#newPassword2").parent().css("border", "1px solid red");
				return false;
			}

			else if($("#newPassword2").val() != $("#newPassword1").val())
			{
				$("#newPassword2").focus().val("").css({"box-shadow": "0px 0px 3px 1px red"});
				$("#newPassword2").parent().css("border","1px solid red");
				alert("再次输入密码与新密码不一致!")
				return false;
			}
			else {
				$.post(url + "check_password", {
					old_pwd: $("#initPassword").val(),
					new_pwd: $("#newPassword1").val(),
					cofrim_pwd: $("#newPassword2").val()
				}, function (data) {

					if (data.status == 2) {
						$("#initPassword").val('').focus().css({"box-shadow": "0px 0px 3px 1px red",});
						$("#initPassword").parent().css("border","1px solid red");
						alert(data.msg);
						return false;
					}
					else if (data.status == 3) {
						$("#newPassword2").val('').focus().css({"box-shadow": "0px 0px 3px 1px red"});
						$("#newPassword2").parent().css("border","1px solid red");
						alert(data.msg);
						return false;
					}
					else if (data.status == 4) {
						$("#newPassword1").val('').focus().css({"box-shadow": "0px 0px 3px 1px red"});
						$("#newPassword1").parent().css("border","1px solid red");
						alert(data.msg);
						return false;
					}
					else if (data.status == 5) {
						alert(data.msg);
						return false;
					}
					else if (data.status == 6) {
						$(".changePassword1").css({"box-shadow": "0px 0px 0px"});
						$(".changpePassword1").parent().css("border","");
						alert("修改成功!");
						window.location.href = data.redirect;
					}
				});
			}
		});
	});


	$('.search_logo').click(function () {
		$p = (p>0)?p:1;
		$q = $('.search_input').val();

		if($('#check1').attr('href')===undefined){
			$url = $('#check2').attr('href');
			$data = $('#check2').attr('data-role');
			if($q!=''){
				$url = $url.split('.');
				
				$url = $url[0]+".html?q="+$q;
			}
		}else {
			$url = $('#check1').attr('href');
			$tt  = $('#check2').attr('data-role');
			$url = $url.split('.');
			if($q!=''){
				$url = $url[0]+'/'+$tt+'.html?q='+$q;
			}else{
				$url = $url[0]+'/'+$tt+'.html';
			}
		}
		window.location.href=$url;
	});
	$('.check2 a').click(function (e) {
		e.preventDefault();
		$url = $('#check1').attr('href');
		$q = $('.search_input').val();

		if($url==undefined){
			$url = $(this).attr('href');
		}else {
			$tt = $(this).attr('data-role');
			$url = $url.split('.');
			$url = $url[0]+'/'+$tt+'.html';
		}

		if($q!==undefined && $q!=''){
			//$url = $url.split('.');
			//$url = $url[0]+'/'+encodeURI(encodeURI($q))+'.html';
		}

		window.location.href=$url;
	});

	$('.filter>a').click(function (e) {
		e.preventDefault();
		$data = $(this).attr('data-role');
		$url = $('#product_navbg').attr('href');
		$url = $url.split('.');
		$url = $url[0]+'/'+$data+'.html';
		window.location.href = $url;
	});

	// 合作伙伴
	$.getJSON(url + 'get_flink',function(data) {
		$html='';
		for(var i=0;i<data.list.length;i++){
			$html +='<a href="'+data.list[i].uri+'" target="_blank"><img src="'+data.list[i].ico+'" alt="'+data.list[i].title+'"></a>';
		}
		$('.main_partners_list').html($html);
	});
	//登录信息
	$.getJSON(url+'is_login.html',function (data) {
		if(data.status==1){
			$('.login_1').hide();
			$html = ' <a href="#" class="active">欢迎您，'+data.data.username+'';
			if(data.data.type==0){
				// $html +='个人用户</a>';
				$('#user_type').text('个人用户');
			}
			if(data.data.type==1){
				// $html +='企业用户</a>';
				$('#user_type').text('企业用户');
			}
			$html +='<a href="'+data.data.personal+'" class="width0 center">个人中心</a>';
			$html +='<a href="javascript:void(0);" class="width0 exit" onclick="Logout();">退出登录</a>';
			$('#user_name').text(data.data.username);
			$('.login_2').html($html).show();
		}else{
			if(action =='Private'){
				window.location.href=data.redirect;
			}
			$('.login_1').show();
			$('.login_2').show();
		}
	});
	//登录信息
	$.getJSON(url+'is_login.html', function(data){
		if (data.status == 1){
			$html = '<div class="infoall" id="infoall0">';
			$html += '<em>联系人/ </em>';
			$html += '<input class="userInfor" id="username" type="text" value="'+data.data.real_name+'" disabled onblur="userInforContact(this)">';
			$html += '	</div>';
			$html += '	<div class="infoall"  id="infoall1">';
			$html += '	<em>联系方式/ </em>';
			$html += '	<input class="userInfor" id="userInforPhone" type="text" value="'+data.data.tel+'" disabled onblur="psPhoneNumber()">';
			$html += '	<input class="userInfor" name="mid" id="mid" type="hidden" value="'+data.data.id+'"/>';
			$html += '	</div>';
			$html += '	<div class="infoall"  id="infoall2">';
			$html += '	<em>电子邮箱/ </em>';
			$html += '	<input class="userInfor" id="userInforEmail" type="text" value="'+data.data.email+'" disabled onblur="psEmailNumber()">';
			$html += '	</div>';
			$('#info').html($html);
			$('#jifen').text(data.data.jifen);
		}
	});
	//支付信息
	$.getJSON(url+'user_pay.html', function(data){

		if (data.status == 1){
			if(data.data.pay_type==1){		//网银
				$html = '<option value="3" selected>网银</option>';
				$html += '<option value="2" >支付宝</option>';
				$("#accountAliNumber").val(data.data.pay_account);
				$("#accountAliName").val(data.data.pay_getname);
				$('#accountBankAddr').val(data.data.bank_name);
				$('#bankValue').val(data.data.pay_account);
				$('#accountBankUser').val(data.data.pay_getname);
				$("#accountBankName").html(data.data.bank_select);
				$("#getType").html($html);
				$("#getType1").show();
				$("#getType2").hide();
			}else{
				$html = '<option value="3">网银</option>';
				$html += '<option value="2" selected>支付宝</option>';
				$("#accountAliNumber").val(data.data.pay_account);
				$("#accountAliName").val(data.data.pay_getname);
				$("#getType").html($html);
				$("#getType1").hide();
				$("#getType2").show();
			}
		}
	});

	$.getJSON(url+'lists.html?sz=4&cid=5',function (data) {
		$html="";
		for(var i=0;i<data.list.length;i++){
			$html+='<a href="'+data.list[i].uri+'">'+data.list[i].title+'</a>';
		}
		$('#qs,#wt').html($html);
	});

	$.getJSON(url+'lists.html?sz=4&cid=4',function (data) {
		$html="";
		for(var i=0;i<data.list.length;i++){
			$html+='<a href="'+data.list[i].uri+'">'+data.list[i].title+'</a>';
		}
		$('#ns').html($html);
	});

	$.getJSON(url+'lists.html?sz=5&cid=6',function (data) {
		$html="";
		for(var i=0;i<data.list.length;i++){
			
			$html+='<strong><a href="'+data.list[i].uri+'">'+data.list[i].title+'</a><i>'+data.list[i].create_time+'</i></strong>';
		}
		$('#js').html($html);
	});
	$.getJSON(url+'lists.html?sz=1&cid=4&sp=250',function (data) {
		$html="";

		for(var i=0;i<data.list.length;i++){
			$html+='<span><a href="'+data.list[i].uri+'">'+data.list[i].title+'</a><em>'+data.list[i].create_time+'</em><p>'+data.list[i].description+'</p></span>';
		}
		$('#tj').html($html);
	});

	/*
		公告置顶
		// $.getJSON(url+'lists.html?sz=1&cid=4&sp=250&attr=top',function (data) {console.log(data);});
	 */


	//首页产品信息
	$.getJSON(url+'com_list.html?sz=10',function (data) {
		$html="";
		$html1="";
		for(var i=0;i<5;i++){
			$html+=' <a href="'+data.list[i].url+'" class="product">';
			$html+='	<b>￥'+data.list[i].price;
			$html+='<span class="triangle"></span>';
			$html+='	</b>';
			$html+='	<strong>';
			$html+='	<img src="'+data.list[i].image+'" alt="'+data.list[i].title+'">';
			$html+='	</strong>';
			$html+='	<em>'+data.list[i].type+'/'+data.list[i].ptype+'</em>';
			$html+='	<i>'+data.list[i].balance_time+'</i>';
			$html+='	</a>';
		}

		for(var j=5; j<10;j++){
			$html1+=' <a href="'+data.list[j].url+'"class="product">';
			$html1+='	<b>￥'+data.list[j].price;
			$html1+='<span class="triangle"></span>';
			$html1+='	</b>';
			$html1+='	<strong>';
			$html1+='	<img src="'+data.list[j].image+'" alt="'+data.list[j].title+'">';
			$html1+='	</strong>';
			$html1+='	<em>'+data.list[j].type+'/'+data.list[j].ptype+'</em>';
			$html1+='	<i>'+data.list[j].balance_time+'</i>';
			$html1+='	</a>';
		}
		$('#tp').html($html);
		$('#bt').html($html1);
	});

	$("#inforSave").click(function(){
		$flag = true;
		if($("#username").val() == ""){
			$(this).css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$flag = false;
		}else if($("#userInforPhone").val() == ""){
			$(this).css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$flag = false;
		}else if($("#userInforEmail").val() == ""){
			$(this).css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$flag = false;
		}else if(!phoneRegex.test($("#userInforPhone").val())){
			$("#infoall1").css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$flag = false;
		}else if(!emailRegex.test($("#userInforEmail").val())){
			$("#infoall").css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
			$flag = false;
		}else{
			$(".infoall").css({"box-shadow":"","border":"1px solid #ddd"});
			$("#username").attr("disabled","disabled");
			$("#userInforPhone").attr("disabled","disabled");
			$("#userInforEmail").attr("disabled","disabled");
			$(this).hide();
			$("#inforChange").show();
			$("#psUserInfo").removeClass("psInfo");
		}
		if($flag){
			$id = $('#mid').val();
			$username = $("#username").val();
			$tel = $("#userInforPhone").val();
			$email = $("#userInforEmail").val();
			$.post(url+'user_check_info',{mid:$id,username:$username,email:$email,phonenumber:$tel},function (data) {
				if(data.status==1){
					redirect(data.redirect,data.msg,1);
				}else{
					layer.msg(data.msg, {icon: 1});
				}
			});
		}
	});
	
	//修改账号,替换‘保存’按钮上的点击事件
	$("#user_infor_bg").click(function(){
		$bankName = $("#accountBankName");
		$bankAddr = $("#accountBankAddr");
		$bankValue = $("#bankValue");
		$bankUser = $("#accountBankUser");
		$accountAliNumber = $("#accountAliNumber");
		$accountAliName = $("#accountAliName");
		$accChange = $("#accChange");
		$psMoneyInfo = $("#psMoneyInfo");
		$getType = $("#getType").val();
		$flag = true;
		//网银
		if($getType == 3){
			if($bankName.val() == ""){
				$bankName.css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$flag = false;
			}else if($bankAddr.val() == ""){
				$bankAddr.css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$flag = false;
			}else if($bankValue.val() == ""){
				$bankValue.css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$flag = false;
			}else if(!bankRegex.test($bankValue.val())){
				$bankValue.css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$flag = false;
			}else if($bankUser.val() == ""){
				$bankUser.css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$flag = false;
			}
			//条件符合后，提交网银数据
			else{
				$psMoneyInfo.removeClass("psInfo");
				$(".user_infor_type strong input").removeClass("userMoneyInfo2");
				$("#getType1 strong input").attr("disabled","disabled");
				$(this).hide();
				$accChange.show();
			}
		}
		//支付宝
		else if($getType == 2){
			$flag = true;
			if($accountAliNumber.val() == ""){
				$accountAliNumber.css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$flag = false;
			}else if($accountAliName.val() == ""){
				$accountAliName.css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
				$flag = false;
			}
			//条件符合后，提交支付宝数据
			else{
				$psMoneyInfo.removeClass("psInfo");
				$(".user_infor_type strong input").removeClass("userMoneyInfo2");
				$("#getType1 strong input").attr("disabled","disabled");
				$(this).hide();
				$accChange.show();
			}
		}

		if($flag){
			 $mid = $('#mid').val();
			if($('#getType').val()==2){
				$.post(url+'user_check_pay',{mid:$mid,makeMoney:2,AliPayName:$accountAliName.val(),AliMoney:$accountAliNumber.val()},function (data) {
					if(data.status==1){
						redirect(data.redirect,data.msg,1);
					}else{
						layer.msg(data.msg, {icon: 1});
					}
				});
			}
			if($('#getType').val()==3){
				$.post(url+'user_check_pay',{mid:$mid,makeMoney:3,accountIfor:$bankName.val(),bankAddress:$bankAddr.val(),bankNumber:$bankValue.val(),getMoney:$bankUser.val()},function (data) {
					if(data.status==1){
						redirect(data.redirect,data.msg,1);
					}else{
						layer.msg(data.msg, {icon: 1});
					}
				});
			}
		}
	});
	//获取银行列表
	$("#getType").change(function () {
		if($(this).val() == 2){	//支付宝
			$.get(url+'get_bank?',function (data) {
					if(data.data.last_pay!=null){
						$('#accountAliNumber').val(data.data.last_pay.pay_account);
						$('#accountAliName').val(data.data.last_pay.pay_getname);
					}else{
						$('#accountAliNumber').val('');
						$('#accountAliName').val('');
					}
					
			});
			$('#getType2').show();
			$('#getType1').hide();
		}else{
			$('#getType2').hide();
			$.get(url+'get_bank?t=1',function (data) {
					$('#accountBankName').html(data.data.banks);		//选定的银行
					if(data.data.last_pay!=null){
						$('#accountBankAddr').val(data.data.last_pay.bank_name);
						$('#bankValue').val(data.data.last_pay.pay_account);
						$('#accountBankUser').val(data.data.last_pay.pay_getname);
					}else{
						$('#accountBankAddr').val('');
						$('#bankValue').val('');
						$('#accountBankUser').val('');
					}
			});
			$('#getType1').show();
		}
	});

	//失去光标，替换input上的onblur()方法
	$(".user_infor_type strong input").blur(function(){
		if($(this).val()==""){
			$(this).css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
		}else{
			$(this).css({"box-shadow":"","border":""});
		}
	});
	//判断银行卡号是否符合正则表达式
	$("#bankValue").blur(function(){
		if(bankRegex.test($("#bankValue").val())==false){
			$(this).css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
		}else{
			$(this).css({"box-shadow":"","border":""});
		}
	});

	// 在线客服
	var myDiv = $("#online2");
	$("#online1").click(function (event) {
		showDiv();//调用显示DIV方法
		$("#online1").hide();
		$(document).one("click", function () {
		//对document绑定一个影藏Div方法
		$(myDiv).hide();
		$("#online1").show();
	});
	$(".hotline span").click(function (event){
		$(myDiv).hide();
		$("#online1").show();
	});
	event.stopPropagation();//阻止事件向上冒泡
	});
	$(myDiv).click(function (event) {
		event.stopPropagation();//阻止事件向上冒泡
	});
	function showDiv() {
		$(myDiv).fadeIn();
	}


	$('#inforChange').click(function(){
		$(this).hide();
		$('#inforSave').show();
		$('#psUserInfo').addClass('psInfo');
		$('#info .infoall').css({"box-shadow":"0px 0px 3px 1px #29A7E2","border":"1px solid #29A7E2"});
		$('#info .infoall input').removeAttr('disabled');
	});

});

function Logout() {
	$.get(url+'logout.html',function (data) {
			if(data.status==1){
				window.location.href=data.redirect;
			}else{
				alert('退出失败请重试');
			}
	});
}

// 注册页面点击select更改文字
function changeUser(){
	var userType = document.getElementById("userType").value;
	var privateUser = document.getElementById("privateUser");
	var companyUser = document.getElementById("companyUser");
	var companyPrivate = document.getElementById("companyPrivate");
	var privateName = document.getElementById("privateName");
	if(userType == "1"){
		companyPrivate.innerHTML = "个人信息";
		privateName.placeholder="联系人";
	}else{
		companyPrivate.innerHTML = "公司信息";
		privateName.placeholder="公司名称";
	}
}

var phoneRegex = /^((13[0-9])|(15[^4,\D])|(18[0,5-9]))\d{8}$/;

var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


var bankRegex = /^(\d{4}(?:\s\d{4}){3})|(\d{4}(?:\s\d{4}){3}\d{3})$/;

function idBlock(id){
	document.getElementById(id).style.display = "block";
}
function idNone(id){
	document.getElementById(id).style.display = "none";
}

function psPhoneNumber(){
	var infoall = getElementsClass("infoall");
	var userInforPhone = document.getElementById("userInforPhone");
	if (phoneRegex.test(userInforPhone.value) == false) {
		infoall[1].style.boxShadow = "0px 0px 3px red";
		infoall[1].style.border = "1px solid red";
	}else{
		infoall[1].style.boxShadow = "0px 0px 3px #29A7E2";
		infoall[1].style.border = "1px solid #29A7E2";
	}
}

function psEmailNumber(){
	var infoall = getElementsClass("infoall");
	var userInforEmail = document.getElementById("userInforEmail");
	if (emailRegex.test(userInforEmail.value) == false) {
		infoall[2].style.boxShadow = "0px 0px 3px red";
		infoall[2].style.border = "1px solid red";
	}else{
		infoall[2].style.boxShadow = "0px 0px 3px #29A7E2";
		infoall[2].style.border = "1px solid #29A7E2";
	}
}

function userInforContact(obj){
	var infoall = getElementsClass("infoall");
	if (obj.value == "") {
		infoall[0].style.boxShadow = "0px 0px 3px red";
		infoall[0].style.border = "1px solid red";
	}else{
		infoall[0].style.boxShadow = "0px 0px 3px #29A7E2";
		infoall[0].style.border = "1px solid #29A7E2";
	}
}

function changeAcc(){
	var getType = document.getElementById("getType");
	var psMoneyInfo = document.getElementById("psMoneyInfo");
	psMoneyInfo.setAttribute("class", "psInfo");
	idNone("accChange");
	idBlock("user_infor_bg");
	for(var i = 0; i < userInfor.length; i++){
		userInfor[i].removeAttribute("disabled");
		userInfor[i].setAttribute("class", "userMoneyInfo2");
		getType.removeAttribute("disabled");
	}
}

var userInfor = getElementsClass("accountIfor");
function saveAcc(){
	var getType = document.getElementById("getType");
	var psMoneyInfo = document.getElementById("psMoneyInfo");
	if (getType.value == 3) {
		for(var i = 0; i < userInfor.length-2; i++){
			if (userInfor[i].value == "") {
				userInfor[i].setAttribute("class", "userMoneyInfo1");
			}else{
				userInfor[i].removeAttribute("class", "userMoneyInfo1");
			}
			if (bankRegex.test(userInfor[2].value) == false) {
				userInfor[2].setAttribute("class", "userMoneyInfo1");
			}else{
				userInfor[2].removeAttribute("class", "userMoneyInfo1");
			}
			if (userInfor[0].value != "" && userInfor[1].value != "" && userInfor[2].value != "" && userInfor[3].value != "" && bankRegex.test(userInfor[2].value) == true) {
				userInfor[i].style.boxShadow = "";
				userInfor[i].style.border = "";
				userInfor[i].setAttribute("disabled","true");
				userInfor[i].removeAttribute("class", "userMoneyInfo1");
				getType.setAttribute("disabled","true");
				idBlock("accChange");
				idNone("user_infor_bg");
				psMoneyInfo.removeAttribute("class", "psInfo");
			}
		}
	}else{
		for (var i = 4; i < userInfor.length; i++) {
			if (userInfor[i].value == "") {
				userInfor[i].setAttribute("class", "userMoneyInfo1");
			}else{
				userInfor[i].removeAttribute("class", "userMoneyInfo1");
			}
			if(userInfor[4].value != "" && userInfor[5].value != ""){
				userInfor[i].style.boxShadow = "";
				userInfor[i].style.border = "";
				userInfor[i].setAttribute("disabled","true");
				userInfor[i].removeAttribute("class", "userMoneyInfo1");
				getType.setAttribute("disabled","true");
				idBlock("accChange");
				idNone("user_infor_bg");
				psMoneyInfo.removeAttribute("class", "psInfo");
			}
		}
	}
}


function initPassword(){
	var initPassword = document.getElementById("initPassword");
	var newPassword1 = document.getElementById("newPassword1");
	var newPassword2 = document.getElementById("newPassword2");
	if (initPassword.value == "") {
		initPassword.setAttribute("class", "newpassBg");
		return false;
	}else{
		initPassword.removeAttribute("class", "newpassBg");
	}
	if (newPassword2.value != newPassword1.value) {
		newPassword2.setAttribute("class", "newpassBg");
		return false;
	}else{
		newPassword2.removeAttribute("class", "newpassBg");
	}
	if (newPassword1.value == "" && newPassword2.value == "") {
		newPassword1.setAttribute("class", "newpassBg");
	}
	if (newPassword1.value != "" && newPassword2.value != "" && initPassword.value != "" && newPassword2.value == newPassword1.value) {
		idNone("changePad");
		initPassword.value = "";
		newPassword1.value = "";
		newPassword2.value = "";
	}
}

function initPassNull(obj){
	if (obj.value == "") {
		obj.setAttribute("class", "newpassBg");
	}else{
		obj.removeAttribute("class","newpassBg");
	}
}


function banNumberOnKey() {  
    document.getElementById("bankValue").onkeyup =function() {  
        this.value =this.value.replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 "); 
    };  
}

/**
 * 跳转页面
 * @param url
 * @param msg
 * @param sec
 */
function redirect(url,msg,sec) {
	layer.msg(msg,{icon:1});
	setTimeout(function () {
		if(sec>0){
			window.location.href=url;
		}
	},sec*500);
}
/**
 * 广告轮播器
 * @param  {[type]}
 * @param  {[type]}
 * @param  {[type]}
 * @return {[type]}
 */
$(function(){
     var i = 0;
     var temp1 = $('.main_adv_ul1 li').size();
    
     init();
     var start = setInterval(move,5000);
     $('.main_adv').hover(function () {
        clearInterval(start);
     },function () {
        setInterval(move,5000);
     });
     $('.main_adv_ul2').hover(function () {
        clearInterval(start);
     });
     $('.main_adv_ul2 li').hover(function () {
         var x = $(this).index();
         $('.main_adv_ul1').stop().css('left',-x*1050+'px');
         $('.main_adv_ul2 li').eq(x).addClass('active').siblings().removeClass('active');
     },function () {
        setInterval(move,5000);
     });

     /**
      * 初始化函数
      * @return {[type]}
      */
     function init() {
         for(var j = 0; j<temp1; j++){
         if(j == 0)
            $('.main_adv_ul2').append('<li class="active">&#8226;</li>');
         else
            $('.main_adv_ul2').append('<li>&#8226;</li>');
         }
     }
     /**
      * 移动函数
      * @return {[type]}
      */
     function move(){
         i++;
         if (i>=temp1){
            i=0;
         }
         $('.main_adv_ul1').stop().css('left',-i*1050+'px');
         $('.main_adv_ul2 li').eq(i).addClass('active').siblings().removeClass('active');
     }
 });