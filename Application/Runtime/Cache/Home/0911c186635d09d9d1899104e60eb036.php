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
    #name-word{margin-top: 20px;margin-bottom: 2px;}
    #sfz-word{margin-top: 10px;margin-bottom: 2px;}
    #tel-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #name-label{margin-left: 40px;}
    #sfz-label{margin-left: 40px;}
    #tel-label{margin-left: 40px;}
    #add-info{display: none;margin-top: 13px;}
</style>

<div id="background">
<!--<img id="logo" alt="喂车科技" src="/Public/Ip/img/IpLogo.png" />-->
    <div id="content-before"></div>
    <div id="name-word">
        <label id="name-label" class="label label-default label-word" for="realname">乘客姓名</label>
        <input id="realname" type="text" class="myinput" placeholder="请输入乘客姓名" />
    </div>
    <div id="sfz-word">
        <label id="sfz-label" class="label label-default label-word" for="sfz">身份证号</label>
        <input id="sfz" type="text" class="myinput" placeholder="请输入身份证" />
    </div>
    <div id="tel-word">
        <label id="tel-label" class="label label-default label-word" for="tel">联系方式</label>
        <input id="tel" type="text" class="myinput" placeholder="请输入联系方式" />
    </div>
    <div id="login-button" class="textcenter">
        <button id="add" type="button" class="layui-btn">新增</button>
        <button id="reset" type="reset" class="layui-btn layui-btn-warm">重置</button>
        <button id="quit" type="button" class="layui-btn layui-btn-danger">取消</button>
    </div>
    <div id="add-info" class="textcenter">
        <label id="info" class="label label-danger">新增失败</label>
    </div>
</div>
<script type="text/javascript">
    //取消
    $('#quit').click(function () {
        window.location.reload();
    });
    //重置
    $('#reset').click(function () {
        var realname = $('#realname');
        var sfz = $('#sfz');
        var tel = $('#tel');
        realname.val("");
        sfz.val("");
        tel.val("");
    });

    //新增
    $('#add').click(function () {

        var realname = $('#realname');
        var sfz = $('#sfz');
        var tel = $('#tel');

        if(realname.val() === ""){
            infoshow('乘客姓名不能为空');
            return;
        }
        if(sfz.val() === ""){
            infoshow('身份证号不能为空');
            return;
        }
        if(tel.val() === ""){
            infoshow('联系方式不能为空');
            return;
        }
        $.post('<?php echo (C("view_url_base")); ?>/Order/doTouristAdd',
            {
                realname:realname.val(),
                sfz:sfz.val(),
                tel:tel.val()
            },
            function (result) {
                if(result.status === 200){
                    layer.msg(result.info,
                        {
                            icon: 1,
                            time: 3000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.reload();
                        });
                }
                else
                {
                    layer.msg(result.data.data+result.info,
                        {
                            icon:2,
                            time:6000
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