<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="/Public/Home/img/train.jpg">
    <link rel="Bookmark" href="/Public/Home/img/train.jpg">
    <script type="text/javascript" src="/Public/Home/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/bootstrap3.3.5.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/fakeLoader.min.js"></script>
    <script src="/Public/Home/js/layer/layer.js"></script>
    <link rel="stylesheet" href="/Public/Home/js/layui/css/layui.css">
    <link type="text/css" href="/Public/Home/css/common.css" rel="stylesheet">
   <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
    <!-- js i18n -->
    <!-- jquery validation i18n -->
    <!-- head and footer -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>客运服务 | 铁路客户服务中心</title>
</head>
<body>
<!--header start-->
<style>
    .red{color: red;}
</style>

<div class="header"><div style="z-index: 2000" class="header-bd"><a href="<?php echo (C("view_url_base")); ?>/Index/index"><h1 class="logo">中国铁路客户服务中心-客运中心</h1>
</a>
    <div class="login-info"><div class="phone-link">
    </div>
        <div class="menu"><a href="<?php echo (C("view_url_base")); ?>/Admin/Admin/login">进入后台</a>
            <div class="menu-list" style="display: none;"><b></b>
                <ul><li><a href="/otn/queryOrder/initNoComplete">未完成订单</a>
                </li>
                    <li><a href="/otn/queryOrder/init">已完成订单(改/退)</a>
                    </li>
                    <li class="line"></li>
                    <li><a href="https://exservice.12306.cn/excater/queryMyOrder.html" target="_blank">我的餐饮•特产</a>
                    </li>
                    <li><a href="/otn/insurance/init">我的保险</a>
                    </li>
                    <li><a href="https://cx.12306.cn/tlcx/welcome.html" target="_blank">我的会员</a>
                    </li>
                    <li class="line"></li>
                    <li><a href="/otn/modifyUser/initQueryUserInfo">查看个人信息</a>
                    </li>
                    <li><a href="/otn/userSecurity/init">账户安全</a>
                    </li>
                    <li class="line"></li>
                    <li><a href="/otn/passengers/init">常用联系人</a>
                    </li>
                    <li class="line"></li>
                    <li><a href="/otn/icentre/serviceQuery">温馨服务查询</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if(empty($_SESSION['realname'])): ?><span class="login-txt" style="color: #666666"><span>
          您好，请</span>
<a id="login_user" href="<?php echo (C("view_url_base")); ?>/User/login" class="colorA" style="margin-left:-0.5px;">登录</a>
                | <a id="regist_out" style="color: #02b902" href="<?php echo (C("view_url_base")); ?>/User/register">注册</a>
            </span>
            <?php else: ?>
            <span class="login-txt" style="color:#666666;">
                <span>欢迎您!</span>
                <a id="my_info1" href="<?php echo (C("view_url_base")); ?>/User/myself"><?php echo (session('realname')); ?></a>
                |<span>剩余</span>
                <a id="my_info2" href="<?php echo (C("view_url_base")); ?>/Business/remainMoney"><span class="red"><?php echo (session('money')); ?></span></a>元
            | <a id="login_out" class="colorA" href="<?php echo (C("view_url_base")); ?>/User/logout">注销</a>
            </span><?php endif; ?>
    </div>
    <div class="nav">
        <ul>
            <li><a href="<?php echo (C("view_url_base")); ?>/Index/index" class="">客运首页</a>
            </li>
            <li><a href="<?php echo (C("view_url_base")); ?>/Business/my_order" class="">我的订单</a>
             </li>
             <li><a href="<?php echo (C("view_url_base")); ?>/Business/pay" class="">充值中心</a>
             </li>
            <li><a href="<?php echo (C("view_url_base")); ?>/Business/message" target="_blank" class="">消息中心</a>
            </li>
            <li><a href="<?php echo (C("view_url_base")); ?>/Business/remainMoney"  class="">余额查询</a>
             </li>
            <li><a href="<?php echo (C("view_url_base")); ?>/Business/touristAdd"  class="">乘客录入</a>
            </li>
    </ul>
    </div>
</div>
</div>
<!--header end-->

<link rel="stylesheet" href="/Public/Home/js/layui/css/layui.css">
<script src="/Public/Home/js/layui/layui.js"></script>
<script src="/Public/Home/js/jquery.downCount.js"></script>
<style>
    .red{color: red}
    ul.countdown {
        list-style: none;
        padding: 0;
        display: block;
        text-align: center;
    }
    ul.countdown li {
        display: inline-block;
    }
    ul.countdown li span {
        font-size: 50px;
        font-weight: 300;
        line-height: 80px;
    }
    ul.countdown li.seperator {
        font-size: 80px;
        line-height: 70px;
        vertical-align: top;
    }
    ul.countdown li p {
        color: #a7abb1;
        font-size: 14px;
    }
    a {
        color: #76949F;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    .source {
        width: 405px;
        margin: 0 auto;
        background: #4f5861;
        color: #a7abb1;
        font-weight: bold;
        display: block;
        white-space: pre;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .btn {
        background: #f56c4c;
        margin: 40px auto;
        padding: 12px;
        display: block;
        width: 100px;
        color: white;
        text-align: center;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
    }
    .btn:hover {
        text-decoration: none;
        opacity: .7;
    }
</style>

<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>支付页
        <i class="layui-icon" style="font-size: 20px">&#xe60f;</i>
    </legend>
    <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
        <legend>订单信息
            <i class="layui-icon" style="font-size: 20px">&#xe63c;</i>
        </legend>
        <div style="width: 70%;margin-left: 160px;">
            <table class="layui-table" lay-even="" lay-skin="nob">
                <thead>
                <tr>
                    <th>订单号</th>
                    <th>订单状态</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($pay_orderList)): foreach($pay_orderList as $key=>$pv): ?><tr>
                        <th id="orderId"><?php echo ($pv["orderId"]); ?></th>
                        <th><?php echo ($pv["current_order_status"]); ?></th>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </fieldset>

    <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
        <legend>已选车次
            <i class="layui-icon" style="font-size: 20px">&#xe63c;</i>
        </legend>
        <div style="width: 70%;margin-left: 160px;">
            <table class="layui-table" lay-even="" lay-skin="nob">
                <thead>
                <tr>
                    <th>车次</th>
                    <th>起始站</th>
                    <th>终到站</th>
                    <th>发车时间</th>
                    <th>硬座票价</th>
                    <th>软座票价</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($pay_trainsInfoList)): foreach($pay_trainsInfoList as $key=>$pv): ?><tr>
                        <th id="train_no"><?php echo ($pv["train_no"]); ?></th>
                        <th><?php echo ($pv["fromStation"]); ?></th>
                        <th><?php echo ($pv["toStation"]); ?></th>
                        <th><?php echo ($pv["begin_date"]); ?></th>
                        <th><span class="red"><?php echo ($pv["hard_price"]); ?></span></th>
                        <th><span class="red"><?php echo ($pv["soft_price"]); ?></span></th>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </fieldset>

    <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
        <legend>已选乘客
            <i class="layui-icon" style="font-size: 20px">&#xe63c;</i>
        </legend>
        <div style="width: 70%;margin-left: 160px;">
            <table class="layui-table" lay-even="" lay-skin="nob">
                <thead>
                <tr>
                    <th>真实姓名</th>
                    <th>身份证</th>
                    <th>联系方式</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($pay_touristList)): foreach($pay_touristList as $key=>$pv): ?><tr>
                        <th><?php echo ($pv["realname"]); ?></th>
                        <th><?php echo ($pv["sfz"]); ?></th>
                        <th><?php echo ($pv["tel"]); ?></th>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </fieldset>

    <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
        <legend>已选座位
            <i class="layui-icon" style="font-size: 20px">&#xe63c;</i>
        </legend>
        <div style="width: 70%;margin-left: 160px;">
            <table class="layui-table" lay-even="" lay-skin="nob">
                <thead>
                <tr>
                    <th>座位类型</th>
                    <th>座位数量</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($pay_seatinfoList)): foreach($pay_seatinfoList as $key=>$pv): ?><tr>
                        <th class="red"><?php echo ($pv["seat_type"]); ?></th>
                        <th class="red"><?php echo ($pv["seat_num"]); ?></th>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </fieldset>

    <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
        <legend>需支付
            <i class="layui-icon" style="font-size: 20px">&#xe63c;</i>
        </legend>
        <div style="width: 70%;margin-left: 160px;text-align: center;">
            <blockquote class="layui-elem-quote"><span class="red" style="font-size: 50px;"><?php echo ($order_money); ?></span>元</blockquote>
            <blockquote class="layui-elem-quote">
                <ul class="countdown">
                    <!--<li> <span id="days" class="days">00</span>-->
                    <!--<p class="days_ref">days</p>-->
                    <!--</li>-->
                    <!--<li class="seperator">.</li>-->
                    <!--<li> <span id="hours" class="hours">00</span>-->
                    <!--<p class="hours_ref">hours</p>-->
                    <!--</li>-->
                    <!--<li class="seperator">:</li>-->
                    <li> <span id="minutes" class="minutes">00</span>
                        <p class="minutes_ref">minutes</p>
                    </li>
                    <li class="seperator">:</li>
                    <li> <span id="seconds" class="seconds">00</span>
                        <p class="seconds_ref">seconds</p>
                    </li>
                </ul>
                请在<span class="red">15</span>分钟内内完成支付，否则系统将自动为您取消本次订单。支付成功后，将为您自动分配座位</blockquote>
        </div>
        <div style="width: 70%;margin-left: 160px;margin-top:20px;margin-bottom:20px;text-align: center;">
            <button class="layui-btn" id="pay_now">马上支付</button>
            <button class="layui-btn layui-btn-danger cancel">取消订单</button>
        </div>
    </fieldset>
</fieldset>



<script>
    //倒计时
    var intDiff = parseInt(60*15);//倒计时总秒数量

    function timer(intDiff){
        var interval = window.setInterval(function(){
            var day=0,
                hour=0,
                minute=0,
                second=0;//时间默认值
            if(intDiff > -1){
                day = Math.floor(intDiff / (60 * 60 * 24));
                hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            else
            {
                window.clearInterval(interval);
                layer.msg('时间到,系统为您自动取消订单，请前往首页重新下单',
                    {
                        icon:2,
                        time:3000
                    });
                $.post('<?php echo (C("view_url_base")); ?>/Order/doOrderCancel',{
                    orderId:$('#orderId').html()
                },function (result) {
                    if(result.status === 200){
                        layer.msg(result.info,
                            {
                                icon: 1,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            },
                            function () {
                                window.location.href = '<?php echo (C("view_url_base")); ?>/Index/index';
                            });
                    }else{
                        layer.msg(result.info,
                            {
                                icon: 2,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            },
                            function () {
                                window.location.href = '<?php echo (C("view_url_base")); ?>/Index/index';
                            });
                    }
                },'json');

            }
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            // $('#day_show').html(day+"天");
            // $('#hour_show').html('<s id="h"></s>'+hour+'时');
            $('#minutes').html('<s></s>'+minute+'分');
            $('#seconds').html('<s></s>'+second+'秒');
            intDiff--;
        }, 1000);
    }

    $(function(){
        timer(intDiff);
    });

    //取消订单
    $('.cancel').click(function () {
        layer.confirm('确定取消订单吗?您刚才填写的订单信息将不会被保存',{
                btn:['是的','取消']
            },function () {
            $.post('<?php echo (C("view_url_base")); ?>/Order/doOrderCancel',{
                orderId:$('#orderId').html()
            },function (result) {
                if(result.status === 200){
                    layer.msg(result.info,
                        {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.href = '<?php echo (C("view_url_base")); ?>/Index/index';
                        });
                }else{
                    layer.msg(result.info,
                        {
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.href = '<?php echo (C("view_url_base")); ?>/Index/index';
                        });
                }
            },'json');
        });
    });

    //马上支付
    $('#pay_now').click(function () {
        var orderId = $('#orderId');
        var train_no = $('#train_no');

        $.post('<?php echo (C("view_url_base")); ?>/Business/showPayNow',{
            orderId:orderId.html(),
            train_no:train_no.html()
        },function (result) {
            if(result.status === 200){
                var openBusiness = layer.open({
                    title: '支付页',
                    index:1,
                    type: 1,
                    shift: 2,
                    area: ['30%', '50%'],
                    shadeClose: false,
                    maxmin: true,
                    content: result.data.content
                })
            }
        },'json');
    });
</script>
<!--页面底部  开始-->
<div class="footer">
    <p>关于我们|网站声明</p>
</div>
<!--页面底部  结束-->
</body>
</html>
<script>
    window.onunload=function(e){
        var e = window.event||e;
        e.returnValue=("确定离开当前页面吗？");
    }
</script>