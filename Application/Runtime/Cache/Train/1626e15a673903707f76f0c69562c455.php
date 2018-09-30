<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>登录喂车车运营平台</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, minimal-ui">
    <link rel="shortcut icon" href="/Public/Ip/img/favicon.ico">
    <link rel="Bookmark" href="/Public/Ip/img/favicon.ico">
</head>
<link rel="stylesheet" href="/Public/Ip/css/bootstrap3.3.5.min.css">
<script src="/Public/Ip/js/jquery1.11.3.min.js"></script>
<script src="/Public/Ip/js/velocity.min.js"></script>
<script src="/Public/Ip/js/velocity.ui.min.js"></script>
<style>
    #background{position: absolute;z-index: 0;width: 100%;height: 100%;background: linear-gradient(to bottom,rgb(238, 238, 238) 0,rgb(188, 224, 210) 100%) no-repeat;}
    #logo{position: absolute;z-index: 1;bottom: 5%;right: 5%;width: 50%;max-width: 100px;}
    #loginpart{display: none;position: absolute;z-index: 5;left: calc(50% - 150px);top: calc(50% - 185px);width: 300px;height: 320px;border-radius: 25px;background: rgb(24,160,106);}
    input.myinput{border: solid 1px #E0E0E0;width: 220px;height: 35px;padding: 3px 10px 3px 10px;}
    button.mybutton{width: 222px;height: 35px;color: #407b5c;background-color: #8bcd3d;border-color: #4cae4c;border-radius: 0;}
    button.mybutton:hover{color: #407b5c;background-color: #79cf13;}
    button.mybutton:active{color: #407b5c;background-color: #6dbb10;}
    button.mybutton:active:focus{color: #407b5c;}
    button.mybutton:focus{color: #407b5c;}
    #login-button{margin-top: 30px;}
    label.word{font-size: 20px;}
    label.label-word{background-color: #FFFFFF;color: #189e68;font-size: 15px;}
    #content-before{margin-top: 30px;}
    #acc-word{margin-top: 20px;margin-bottom: 2px;}
    #pwd-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #acc-label{margin-left: 40px;}
    #pwd-label{margin-left: 40px;}
    #login-info{display: none;}
</style>
<body>
<div id="background"></div>
<img id="logo" alt="喂车科技" src="/Public/Ip/img/IpLogo.png" />
<div id="loginpart">
    <div id="content-before"></div>
    <div id="word" class="textcenter">
        <label class="label word"><b>登录运营平台</b></label>
    </div>
    <div id="acc-word">
        <label id="acc-label" class="label label-default label-word" for="account">账号</label>
    </div>
    <div id="acc-input" class="textcenter">
        <input id="account" type="text" class="myinput" placeholder="请输入账号" />
    </div>
    <div id="pwd-word">
        <label id="pwd-label" class="label label-default label-word" for="password">密码</label>
    </div>
    <div id="pwd-input" class="textcenter">
        <input id="password" type="password" class="myinput" placeholder="请输入密码" />
    </div>
    <div id="login-button" class="textcenter">
        <button id="requireSubmit" type="button" class="mybutton btn">登录</button>
    </div>
    <div id="login-info" class="textcenter">
        <label id="info" class="label label-danger">登录失败</label>
    </div>
</div>
</body>
</html>
<script>
    $("#loginpart").delay(300).velocity("transition.slideUpIn", {duration:1250});
    $(document).keypress(function(e) {
        if (e.which === 13) {
            $("#requireSubmit").click();
        }
    });
    var url = '<?php echo (C("view_url_base")); ?>/Index/index';
    $("#requireSubmit").click(function() {
        account1 = $("#account");
        password1 = $("#password");
        if (account1.val() == '') {
            infoshow("账号不能为空!");
            account1.focus();
            return;
        }
        if (password1.val() == '') {
            infoshow("密码不能为空!");
            password1.focus();
            return;
        }
        $.post("<?php echo (C("view_url_base")); ?>/Login/handleLogin", {
            data: {
                account: account1.val(),
                password: password1.val()
            }
        }, function(result, status) {
            if (status != 'success') {
                alert(status);
                return;
            }
            if (result != "success") {
                infoshow(result);
                return;
            }
            location.href = url;
        }, "text");
    });
    var infoshow = function(text){
        $("#login-info").velocity("finish");
        $("#info").html(text);
        $("#login-info").velocity({
            opacity: [1, 0]
        }, {
            display: "block",
            duration: 300,
            complete: function() {
                $("#login-info").velocity({
                    opacity: [0, 1]
                }, {
                    display: "none",
                    delay: 3000,
                    duration: 1500
                });
            }
        });
    }
</script>