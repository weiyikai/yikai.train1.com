<?php if (!defined('THINK_PATH')) exit();?>
<head>
    <title>登录订票系统</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, minimal-ui">
    <link rel="shortcut icon" href="/Public/Admin/img/train.jpg">
    <link rel="Bookmark" href="/Public/Admin/img/train.jpg">
</head>
<link rel="stylesheet" href="/Public/Home/css/bootstrap3.3.5.min.css">
<script src="/Public/Admin/js/jquery-1.7.2.min.js"></script>
<script src="/Public/Admin/js/velocity.min.js"></script>
<script src="/Public/Admin/js/velocity.ui.min.js"></script>
<script src="/Public/Admin/js/layer/layer.js"></script>
<style>
    #background{position: absolute;z-index: 0;width: 100%;height: 100%;background: linear-gradient(to bottom,rgb(238, 238, 238) 0,rgb(188, 224, 210) 100%) no-repeat;}
    #logo{position: absolute;z-index: 1;bottom: 5%;right: 5%;width: 50%;max-width: 100px;}
    #loginpart{display: none;position: absolute;z-index: 5;left: calc(50% - 150px);top: calc(50% - 185px);width: 300px;height: 300px;border-radius: 25px;background: rgb(5,213,218);}
    input.myinput{border: solid 1px #E0E0E0;width: 220px;height: 35px;padding: 3px 10px 3px 10px;}
    button.mybutton{width: 222px;height: 35px;color: #407b5c;background-color: #8bcd3d;border-color: #4cae4c;border-radius: 0;}
    button.mybutton:hover{color: #407b5c;background-color: #79cf13;}
    button.mybutton:active{color: #407b5c;background-color: #6dbb10;}
    button.mybutton:active:focus{color: #407b5c;}
    button.mybutton:focus{color: #407b5c;}
    #login-button{margin-top: 30px;}
    #register-button{margin-top: 10px;}
    label.word{font-size: 20px;}
    label.label-word{background-color: #FFFFFF;color: #189e68;font-size: 15px;}
    #content-before{margin-top: 30px;}
    #acc-word{margin-top: 20px;margin-bottom: 2px;}
    #pwd-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #acc-label{margin-left: 40px;}
    #pwd-label{margin-left: 40px;}
    #login-info{display: none;margin-top: 13px;}
</style>

<div id="background"></div>

<div id="loginpart">
    <div id="content-before"></div>
    <div id="word" class="textcenter">
        <label class="label word"><b>管理员登录</b></label>
    </div>
    <div id="acc-word">
        <label id="acc-label" class="label label-default label-word" for="account">Admin账号</label>
    </div>
    <div id="acc-input" class="textcenter">
        <input id="account" type="text" class="myinput" placeholder="请输入Admin账号" />
    </div>
    <div id="pwd-word">
        <label id="pwd-label" class="label label-default label-word" for="password">Admin密码</label>
    </div>
    <div id="pwd-input" class="textcenter">
        <input id="password" type="password" class="myinput" placeholder="请输入Admin密码" />
    </div>
    <div id="login-button" class="textcenter">
        <button id="login" type="button" class="mybutton btn">登录</button>
    </div>
    <div id="login-info" class="textcenter">
        <label id="info" class="label label-danger">登录失败</label>
    </div>
</div>
<script type="text/javascript">

    $("#loginpart").delay(300).velocity("transition.slideUpIn", {duration:1250});


    $('#login').click(function () {

        var username = $('#account');
        var password = $('#password');

        if(username.val() === ""){
            infoshow('Admin账号不能为空');
            return;
        }
        if(password.val() === ""){
            infoshow('Admin密码不能为空');
            return;
        }

        $.post('<?php echo (C("view_url_base")); ?>/Admin/Admin/doLogin',
            {
                username:username.val(),
                password:password.val()
            },
            function (result) {
                if(result.status === 200){
                    layer.msg(result.info,
                        {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },function () {
                           window.location.href = '<?php echo (C("view_url_base")); ?>/Admin/Index/index';
                        });
                }
                else
                {
                    layer.msg(result.info,{icon:2});
                }
            },
            "json"
        );
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