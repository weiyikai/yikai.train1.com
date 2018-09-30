<?php if (!defined('THINK_PATH')) exit();?>
<link rel="stylesheet" href="/Public/Home/css/bootstrap3.3.5.min.css">
<script src="/Public/Home/js/jquery-1.7.2.min.js"></script>
<script src="/Public/Home/js/velocity.min.js"></script>
<script src="/Public/Home/js/velocity.ui.min.js"></script>
<script src="/Public/Home/js/layer/layer.js"></script>
<style>
    #background{position: absolute;z-index: 0;width: 100%;height: 100%;background: linear-gradient(to bottom,rgb(238, 238, 238) 0,rgb(188, 224, 210) 100%) no-repeat;}
    #loginpart{position: absolute;z-index: 5;left: calc(50% - 150px);top: calc(50% - 180px);width: 300px;height: 300px;border-radius: 25px;background: rgb(24,160,106);}
    input.myinput{border: solid 1px #E0E0E0;width: 220px;height: 35px;padding: 3px 10px 3px 10px;}
    /*button.mybutton{width: 75px;height: 35px;color: #407b5c;background-color: #8bcd3d;border-color: #4cae4c;border-radius: 0;}*/
    /*button.mybutton:hover{color: #407b5c;background-color: #79cf13;}*/
    /*button.mybutton:active{color: #407b5c;background-color: #6dbb10;}*/
    /*button.mybutton:active:focus{color: #407b5c;}*/
    /*button.mybutton:focus{color: #407b5c;}*/
    #login-button{margin-top: 30px;}
    #register-button{margin-top: 10px;}
    label.word{font-size: 20px;}
    label.label-word{background-color: #FFFFFF;color: #189e68;font-size: 15px;}
    #content-before{margin-top: 30px;}
    #realname-word{margin-top: 20px;margin-bottom: 2px;}
    #cur_money-word{margin-top: 10px;margin-bottom: 2px;}
    #qpay-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #realname-label{margin-left: 40px;}
    #cur_money-label{margin-left: 40px;}
    #qpay-label{margin-left: 40px;}
    #add-info{display: none;margin-top: 13px;}
</style>

<div id="background">
    <!--<img id="logo" alt="喂车科技" src="/Public/Ip/img/IpLogo.png" />-->
    <div id="content-before"></div>
    <div id="realname-word">
        <label id="realname-label" class="label label-default label-word" for="realname">用户姓名</label>
        <input id="realname" type="text" class="myinput" value="<?php echo ($realname); ?>" disabled />
    </div>
    <div id="cur_money-word">
        <label id="cur_money-label" class="label label-default label-word" for="cur_money">当前余额</label>
        <input id="cur_money" type="text" class="myinput" value="<?php echo ($current_my_money); ?>元" disabled />
    </div>
    <div id="qpay-word">
        <label id="qpay-label" class="label label-default label-word" for="qpay_money">快速充值</label>
        <input id="qpay_money" type="text" class="myinput" placeholder="请输入充值金额" />
    </div>
    <div id="login-button" class="textcenter">
        <button id="qpay" type="button" class="layui-btn">充值</button>
        <button id="quit" type="button" class="layui-btn layui-btn-danger">取消</button>
    </div>
    <div id="add-info" class="textcenter">
        <label id="info" class="label label-danger">充值失败</label>
    </div>
</div>
<script type="text/javascript">
    //取消
    $('#quit').click(function () {
        window.location.reload();
    });

    //新增
    $('#qpay').click(function () {

        var qpay = $('#qpay_money');
        if(qpay.val() === ""){
            infoshow('快速充值金额不能为空');
            return;
        }
        $.post('<?php echo (C("view_url_base")); ?>/Business/doQPay',
            {
                qpay:qpay.val()
            },
            function (result) {
                if(result.status === 200){
                    layer.msg(result.info,
                        {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.reload();
                        });
                }
                else
                {
                    layer.msg(result.info,
                        {
                            icon:2,time:2000
                        },
                        function () {
                            window.location.reload();
                        });
                }
            },
            "json"
        );
    });

    var infoshow = function(text){
        $("#add-info").velocity("finish");
        $("#info").html(text);
        $("#add-info").velocity({
            opacity: [1, 0]
        }, {
            display: "block",
            duration: 300,
            complete: function() {
                $("#add-info").velocity({
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