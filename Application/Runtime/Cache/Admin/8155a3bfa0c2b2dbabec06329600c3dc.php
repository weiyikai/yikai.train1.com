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
    #train_no-word{margin-top: 20px;margin-bottom: 2px;}
    #hard_carriage_num-word{margin-top: 10px;margin-bottom: 2px;}
    #soft_seat_num-word{margin-top: 10px;margin-bottom: 2px;}
    #hard_seat_num-word{margin-top: 10px;margin-bottom: 2px;}
    #soft_carriage_num-word{margin-top: 10px;margin-bottom: 2px;}
    #fromStation-word{margin-top: 10px;margin-bottom: 2px;}
    #toStation-word{margin-top: 10px;margin-bottom: 2px;}
    #viaStation-word{margin-top: 10px;margin-bottom: 2px;}
    #hard_price-word{margin-top: 10px;margin-bottom: 2px;}
    #soft_price-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #train_no-label{margin-left: 40px;}
    #hard_carriage_num-label{margin-left: 40px;}
    #soft_seat_num-label{margin-left: 40px;}
    #hard_seat_num-label{margin-left: 40px;}
    #soft_carriage_num-label{margin-left: 40px;}
    #fromStation-label{margin-left: 40px;}
    #toStation-label{margin-left: 40px;}
    #viaStation-label{margin-left: 40px;}
    #hard_price-label{margin-left: 40px;}
    #soft_price-label{margin-left: 40px;}
    #add-info{display: none;margin-top: 13px;}

</style>

<div id="background">
    <div id="content-before"></div>
    <div id="train_no-word">
        <label id="train_no-label" class="label label-default label-word" for="train_no">车&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;次</label>
        <input id="train_no" type="text" class="myinput" placeholder="请输入车次" />
    </div>
    <div id="fromStation-word">
        <label id="fromStation-label" class="label label-default label-word" for="fromStation">起&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;始&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;站</label>
        <input id="fromStation" type="text" class="myinput" placeholder="请输入起始站" />
    </div>
    <div id="toStation-word">
        <label id="toStation-label" class="label label-default label-word" for="toStation">终&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;到&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;站</label>
        <input id="toStation" type="text" class="myinput" placeholder="请输入终到站" />
    </div>
    <div id="viaStation-word">
        <label id="viaStation-label" class="label label-default label-word" for="viaStation">途&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;径&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;站&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;点</label>
        <input id="viaStation" type="text" class="myinput" placeholder="请输入途径站点(用英文逗号隔开)" />
    </div>
    <div id="hard_carriage_num-word">
        <label id="hard_carriage_num-label" class="label label-default label-word" for="hard_carriage_num">硬&nbsp;&nbsp;&nbsp;&nbsp;座&nbsp;&nbsp;&nbsp;&nbsp;车&nbsp;&nbsp;&nbsp;&nbsp;厢&nbsp;&nbsp;数</label>
        <input id="hard_carriage_num" type="text" class="myinput" placeholder="请输入硬座车厢数" />
    </div>
    <div id="hard_seat_num-word">
        <label id="hard_seat_num-label" class="label label-default label-word" for="hard_seat_num">每节硬座车厢座位数</label>
        <input id="hard_seat_num" type="text" class="myinput" placeholder="请输入每节硬座车厢座位数" />
    </div>
    <div id="hard_price-word">
        <label id="hard_price-label" class="label label-default label-word" for="hard_price">硬&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;座&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;票&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价</label>
        <input id="hard_price" type="text" class="myinput" placeholder="请输入硬座票价（元）" />
    </div>
    <div id="soft_carriage_num-word">
        <label id="soft_carriage_num-label" class="label label-default label-word" for="soft_carriage_num">软&nbsp;&nbsp;&nbsp;&nbsp;座&nbsp;&nbsp;&nbsp;&nbsp;车&nbsp;&nbsp;&nbsp;&nbsp;厢&nbsp;&nbsp;数</label>
        <input id="soft_carriage_num" type="text" class="myinput" placeholder="请输入软座车厢数" />
    </div>
    <div id="soft_seat_num-word">
        <label id="soft_seat_num-label" class="label label-default label-word" for="soft_seat_num">每节软座车厢座位数</label>
        <input id="soft_seat_num" type="text" class="myinput" placeholder="请输入每节软座车厢座位数" />
    </div>
    <div id="soft_price-word">
        <label id="soft_price-label" class="label label-default label-word" for="soft_price">软&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;座&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;票&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价</label>
        <input id="soft_price" type="text" class="myinput" placeholder="请输入软座票价（元）" />
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
        var train_no = $('#train_no');
        var fromStation = $('#fromStation');
        var toStation = $('#toStation');
        var viaStation = $('#viaStation');
        var hard_carriage_num = $('#hard_carriage_num');
        var hard_seat_num = $('#hard_seat_num');
        var hard_price = $('#hard_price');
        var soft_carriage_num = $('#soft_carriage_num');
        var soft_seat_num = $('#soft_seat_num');
        var soft_price = $('#soft_price');

        train_no.val("");
        fromStation.val("");
        toStation.val("");
        viaStation.val("");
        hard_carriage_num.val("");
        hard_seat_num.val("");
        hard_price.val("");
        soft_carriage_num.val("");
        soft_seat_num.val("");
        soft_price.val("");
    });

    //新增
    $('#add').click(function () {

        var train_no = $('#train_no');
        var fromStation = $('#fromStation');
        var toStation = $('#toStation');
        var viaStation = $('#viaStation');
        var hard_carriage_num = $('#hard_carriage_num');
        var hard_seat_num = $('#hard_seat_num');
        var hard_price = $('#hard_price');
        var soft_carriage_num = $('#soft_carriage_num');
        var soft_seat_num = $('#soft_seat_num');
        var soft_price = $('#soft_price');

        if(train_no.val() === ""){
            infoshow('车次不能为空');
            return;
        }
        if(fromStation.val() === ""){
            infoshow('起始站不能为空');
            return;
        }
        if(toStation.val() === ""){
            infoshow('终到站不能为空');
            return;
        }
        if(hard_carriage_num.val() === ""){
            infoshow('硬座车厢数不能为空');
            return;
        }
        if(hard_seat_num.val() === ""){
            infoshow('每节硬座车厢座位数不能为空');
            return;
        }
        if(hard_price.val() === ""){
            infoshow('硬座票价不能为空');
            return;
        }
        if(soft_carriage_num.val() === ""){
            infoshow('软座车厢数不能为空');
            return;
        }
        if(soft_seat_num.val() === ""){
            infoshow('每节硬座车厢座位数不能为空');
            return;
        }
        if(soft_price.val() === ""){
            infoshow('软座票价不能为空');
            return;
        }
        $.post('<?php echo (C("view_url_base")); ?>/Admin/Business/doTrainsAdd',
            {
                train_no:train_no.val(),
                fromStation:fromStation.val(),
                toStation:toStation.val(),
                viaStation:viaStation.val(),
                hard_carriage_num:hard_carriage_num.val(),
                hard_seat_num:hard_seat_num.val(),
                hard_price:hard_price.val(),
                soft_carriage_num:soft_carriage_num.val(),
                soft_seat_num:soft_seat_num.val(),
                soft_price:soft_price.val()
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
                    layer.msg(result.info,
                        {
                            icon:2,
                            time:3000
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