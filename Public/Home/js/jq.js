var phoneRegex = /^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/;
var emailRegex = /^([a-zA-Z0-9_-]){30}@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
var bank = /^(\d{4}(?:\s\d{4}){3})|(\d{4}(?:\s\d{4}){3}\d{3})$/;
var pass = /^\S{6,16}$/;
var userRegex = /^[a-zA-Z\d_\u4e00-\u9fa5]{2,12}$/;

$(document).ready(function(){
    $("input").each(
        function(){
            $(this).keypress( function(e) {
                var key = window.event ? e.keyCode : e.which;
                if(key.toString() == "13"){
                    return false;
                }
            });
        });
});


(function () {
    $.support.placeholder = ('placeholder' in document.createElement('input'));
})(jQuery);


$(function () {
    $(".register_input1").each(function () {
        if (!$.support.placeholder) {
            $(this).val($(this).attr("placeholder")).css("color", "#666");
        }
    }).keydown(function (e) {
        $(this).css("color", "#666");
    });

    $(".register_input").each(function () {
        if (!$.support.placeholder) {
            $(this).val($(this).attr("placeholder")).css("color", "#666");
        }
    }).focus(function () {
        if ($(this).val() == $(this).attr("placeholder")) {
            $(this).val("");
        }
    }).blur(function () {
        if ($(this).val() == "") {
            if (!$.support.placeholder) {
                $(this).val($(this).attr("placeholder"));
            }
            else {
                $(this).val("");
            }
            $(this).css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入" + $(this).attr("placeholder"));
        }
        else {
            $(this).css({"box-shadow": "", "border": "1px solid #ddd"});
            $(".showContent").text("");
            return true;
        }
    })
     .keydown(function () {
        $(this).css("color", "#666");
    });

    $("#password1").click(function () {
        $(this).next().show().focus();
        $(this).hide();
    }).focus(function () {
        $(this).next().show().focus();
        $(this).hide();
    });

    $("#password2").click(function () {
        if ($("#password11").val() == "" || $("#password11").val() == $("#password11").attr("placeholder")) {
            $("#password1").hide();
            $("#password11").show().focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输密码");
        }
        else {
            $(this).next().show().focus();
            $(this).hide();
        }

    });

    $("#password2").focus(function () {
        if ($("#password11").val() == "" || $("#password11").val() == $("#password11").attr("placeholder")) {
            $("#password1").hide();
            $("#password11").show().focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输密码");
        }
        else {
            $(this).next().show().focus();
            $(this).hide();
        }
    });

    $("#password11").blur(function () {
        if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
            $(this).css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"}).hide();
            $(this).prev().show().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输密码");
        }
        else if (pass.test($(this).val()) == false) {
            $("#password11").css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入6-16字符");
        }
        else if ($(this).val() != $("#password22").val() && $("#password22").val() != "") {
            $("#password22").css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("密码不一致");
        }
        else {
            $(this).css({"box-shadow": "", "border": "1px solid #ddd"});
            $(".showContent").text("");
            return true;
        }
    });

    $("#password22").blur(function () {
        if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
            $(this).hide().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(this).prev().show().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请确认密码");
        } else if ($(this).val() != $("#password11").val()) {
            $("#password22").val("").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("密码不一致");
        } else {
            $(this).css({"box-shadow": "", "border": "1px solid #ddd"});
            $("#password11").css({"box-shadow": "", "border": "1px solid #ddd"});
            $(".showContent").text("");
            return true;
        }
    });

    //$("#AliPayName").blur(function () {
    //    if($(this).val() == '' || $(this).val() == $(this).attr('placeholder')){
    //        $("#AliPayName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
    //        $(".showContent").show().text("请输入支付宝账号");
    //    }else if (!phoneRegex.test($("#AliPayName").val()) && !emailRegex.test($("#AliPayName").val())) {
    //        $("#AliPayName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
    //        $(".showContent").show().text("支付宝账号不合法");
    //    } else {
    //        $(".showContent").show().text("");
    //        $("#AliPayName").css({"box-shadow": "", "border": "1px solid #ddd"});
    //    }
    //});

    $("#privateContact").blur(function () {
        if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
            $(this).css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入" + $(this).attr("placeholder"));
        }
        else if (phoneRegex.test($(this).val()) == false) {
            $(this).focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("联系方式无效");
        } else {
            $(this).css({"box-shadow": "", "border": "1px solid #ddd"});
            $(".showContent").text("");
            return true;
        }
    });

    $("#bankNumber").change(function () {
        if (bank.test($(this).val()) == false) {
            $(this).val("").css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent1").text("收款账号无效");
        } else {
            $(this).css({"box-shadow": "", "border": "1px solid #ddd"});
            $(".showContent1").text("");
        }
    }).keydown(function () {
        $(this).val($(this).val().replace(/\s/g, '').replace(/(\d{4})(?=\d)/g, "$1 "));
    });

    $("#privateEmail").blur(function () {
        if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
            $(this).css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入" + $(this).attr("placeholder"));
        }
        else if (emailRegex.test($(this).val()) == false) {
            $(this).focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("邮箱无效");
        }
        else {
            $(this).css({"box-shadow": "", "border": "1px solid #ddd"});
            $(".showContent").text("");
            return true;
        }
    });
});


$(function () {
    $index='';

    $flag = false;

    $("#next_btn").click(function () {

        if ($("#loginName").val() == "" || $("#loginName").val() == $("#loginName").attr("placeholder")) {

            $("#loginName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入用户名");
            return false;
        }
        else if (!userRegex.test($("#loginName").val())) {
            $("#loginName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入2-12位字符，不包括特殊字符");
            return false;
        }

        else if ($("#password11").val() == "" || $("#password11").val() == $("#password11").attr("placeholder")) {
            $("#password11").show();
            $("#password1").hide();
            $("#password11").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入密码");
            return false;
        }

        else if (pass.test($("#password11").val()) == false) {
            $("#password11").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入6-16字符");
            return false;
        }

        else if ($("#password22").val() == "" || $("#password22").val() == $("#password22").attr("placeholder")) {
            $("#password22").show();
            $("#password2").hide();
            $("#password22").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请确认密码");
            return false;
        }

        else if ($("#password11").val() != $("#password22").val() && $("#password22").val() != "") {
            $("#password22").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("密码不一致");
            return false;
        }

        else if ($("#privateName").val() == "" || $("#privateName").val() == $("#privateName").attr("placeholder")) {
            $("#privateName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入" + $("#privateName").attr("placeholder"));
            return false;
        }

        else if ($("#privateContact").val() == "" || $("#privateContact").val() == $("#privateContact").attr("placeholder")) {
            $("#privateContact").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入联系方式");
            return false;
        }

        else if (phoneRegex.test($("#privateContact").val()) == false) {
            $("#privateContact").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("联系方式无效");
            return false;
        }

        else if ($("#privateEmail").val() == "" || $("#privateEmail").val() == $("#privateEmail").attr("placeholder")) {
            $("#privateEmail").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入邮箱");
            return false;
        }

        else if (emailRegex.test($("#privateEmail").val()) == false) {
            $("#privateEmail").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("邮箱无效");
            return false;
        }

        else {
            $(this).css({"box-shadow": "", "border": "1px solid #ddd"});
            $(".showContent").text("");
            //if(userRegex.test($("#loginName").val())==true)
            //{
                $.post(url + 'check_username', {username: $("#loginName").val()}, function (data) {
                    if (data.status == 1) {
                        $("#loginName").css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"}).focus();
                        $(".showContent").text(data.msg);
                        return false;
                    } else {
                        $("#loginName").css({"box-shadow": "", "border": "1px solid #ddd"});
                        $(".showContent").text("");
                        $("#login_main_login3").show();
                        $("#login_main_login2").hide();
                    }
                });
            //}

            return false;
        }


    });

    $("#success_btn").click(function () {

        $flag = true;


        if ($("#AliPayType").is(':hidden') && $("#bankType").is(':hidden')) {
            $(".showContent").show().text("请选择支付方式");
        }

        else if ($("#AliPayType").is(':hidden')) {
            if ($("#bankName").val() == "" || $("#bankName").val() == $("#bankName").attr("placeholder")) {
                $(".showContent").show().text("请输入" + $("#bankName").attr("placeholder"));
                $("#bankName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
                $flag = false;
            }

            else if ($("#bankAddress").val() == "" || $("#bankAddress").val() == $("#bankAddress").attr("placeholder")) {
                $(".showContent").show().text("请输入" + $("#bankAddress").attr("placeholder"));
                $("#bankAddress").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
                $flag = false;
            }

            else if ($("#bankNumber").val() == "" || $("#bankNumber").val() == $("#bankNumber").attr("placeholder")) {
                $(".showContent").show().text("请输入" + $("#bankNumber").attr("placeholder"));
                $("#bankNumber").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
                $flag = false;
            }

            else if ($("#bankMoney").val() == "" || $("#bankMoney").val() == $("#bankMoney").attr("placeholder")) {
                $(".showContent").show().text("请输入" + $("#bankMoney").attr("placeholder"));
                $("#bankMoney").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
                $flag = false;
            }


            else if ($("#listServer").is(":checked") == false) {

                if (confirm("是否同意服务条款？")) {
                    $("#listServer").attr("checked", "true");
                    $flag = false;
                }
                else {
                    $flag = false;
                }
            }
        }

        else if ($("#bankType").is(':hidden')) {
            if ($("#AliPayName").val() == "" || $("#AliPayName").val() == $("#AliPayName").attr("placeholder") || (!phoneRegex.test($("#AliPayName").val()) && !emailRegex.test($("#AliPayName").val()))) {
                if ($("#AliPayName").val() == "" || $("#AliPayName").val() == $("#AliPayName").attr("placeholder")) {
                    $(".showContent").show().text("请输入" + $("#AliPayName").attr("placeholder"));
                    $("#AliPayName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
                    return false;
                } else if (!phoneRegex.test($("#AliPayName").val()) && !emailRegex.test($("#AliPayName").val())) {
                    $(".showContent").show().text("支付宝账号不合法");
                    $("#AliPayName").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
                    return false;
                } else {
                    $flag = false;
                }
            }

            else if ($("#AliMoney").val() == "" || $("#AliMoney").val() == $("#AliMoney").attr("placeholder")) {
                $(".showContent").show().text("请输" + $("#AliMoney").attr("placeholder"));
                $("#AliMoney").focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
                $flag = false;
            }

            else if ($("#listServer").is(":checked") == false) {

                if (confirm("是否同意服务条款？")) {
                    $("#listServer").attr("checked", "true");
                    $flag = true;
                } else {
                    $flag = false;
                }
            }
        }

        if ($flag) {
            var url = $('form').attr('action');
            $('#password_md5').val($.md5($('#password11').val()));
            var data = $('form').serialize();

            $.post(url, data, function (data) {
                //console.log(data);
                if (data.status == 1) {
                    redirect(data.redirect, data.msg, 3);
                }
            });
        }
        return false;
    });

    $('#payType').click(function () {
        val = $(this).val();
        // $('.hide' + $id).show().siblings('span.login_input').hide();
        if (val == 1) {
            $('#bankType,#AliPayType').hide();
        }else if(val == 2){
            $('#bankType').hide();
            $('#AliPayType').show();
        }else {
            $('#AliPayType').hide();
            $('#bankType').show();
        }
    });

    // 阅读条款
    $("#zixiread").click(function () {
        $("#serverBg").show();
        $("#serverList").show();
    });

    // 关闭条款
    $("#serverClose").click(function () {
        $("#serverBg").hide();
        $("#serverList").hide();
    });

    $("#loginName").blur(function () {
        if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
            //alert("111");
            //if(!$.support.placeholder) {
            //    $(this).val($(this).attr("placeholder"));
            //}
            //else
            //{
            //    $(this).val("");
            //}
            $(this).css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入" + $(this).attr("placeholder"));
            return false;
        }
        else if (userRegex.test($(this).val()) == false) {
            $(this).focus().css({"box-shadow": "0px 0px 3px 1px red", "border": "1px solid red"});
            $(".showContent").text("请输入2-12位字符，不包括特殊字符");
            return false;
        }
        else {
            $.post(url + 'check_username', {username: $(this).val()}, function (data) {
                $index=data.status;
                if ($index == 1) {
                    $("#loginName").focus().css({"box-shadow":"0px 0px 3px 1px red","border":"1px solid red"});
                    $(".showContent").text(data.msg);
                } else {
                    $("#loginName").css({"box-shadow": "0px 0px 0px", "border": "1px solid #ddd"});
                }
            });
        }
    });
});



