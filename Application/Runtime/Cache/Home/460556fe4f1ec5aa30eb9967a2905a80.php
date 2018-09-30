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
    #need_money-word{margin-top: 20px;margin-bottom: 2px;}
    #my_money-word{margin-top: 10px;margin-bottom: 2px;}
    #cur_train_no-word{margin-top: 10px;margin-bottom: 2px;}
    #cur_orderId-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #need_money-label{margin-left: 40px;}
    #my_money-label{margin-left: 40px;}
    #cur_train_no-label{margin-left: 40px;}
    #cur_orderId-label{margin-left: 40px;}
    #add-info{display: none;margin-top: 13px;}
</style>

<div id="background">
    <div id="content-before"></div>
    <div id="cur_orderId-word">
        <label id="cur_orderId-label" class="label label-default label-word" for="cur_orderId">当前订单号</label>
        <input id="cur_orderId" type="text" class="myinput" value="<?php echo ($cur_orderId); ?>" disabled />
    </div>
    <div id="need_money-word">
        <label id="need_money-label" class="label label-default label-word" for="need_money">当前需支付</label>
        <input id="need_money" type="text" class="myinput" value="<?php echo ($need_money); ?>" disabled />元
    </div>
    <div id="my_money-word">
        <label id="my_money-label" class="label label-default label-word" for="my_money">当前总余额</label>
        <input id="my_money" type="text" class="myinput" value="<?php echo ($my_money); ?>" disabled />元
    </div>
    <div id="cur_train_no-word">
        <label id="cur_train_no-label" class="label label-default label-word" for="cur_train_no">当前列车次</label>
        <input id="cur_train_no" type="text" class="myinput" value="<?php echo ($cur_train_no); ?>" disabled />
    </div>
    <div id="login-button" class="textcenter">
        <button id="yes" type="button" class="layui-btn">确定</button>
        <button id="quit" type="button" class="layui-btn layui-btn-danger">取消</button>
    </div>
</div>
<script type="text/javascript">
    //取消
    $('#quit').click(function () {
        window.location.reload();
    });

    //支付
    $('#yes').click(function () {

        var need_money = $('#need_money');
        var my_money = $('#my_money');
        var cur_train_no = $('#cur_train_no');
        var cur_orderId = $('#cur_orderId');
        $.post('<?php echo (C("view_url_base")); ?>/Business/doPayNow',
            {
                need_money:need_money.val(),
                my_money:my_money.val(),
                cur_train_no:cur_train_no.val(),
                cur_orderId:cur_orderId.val()
            },
            function (result) {
                if(result.status === 200){
                    layer.msg(result.info,
                        {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.href = '<?php echo (C("view_url_base")); ?>/Business/my_order';
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
</script>