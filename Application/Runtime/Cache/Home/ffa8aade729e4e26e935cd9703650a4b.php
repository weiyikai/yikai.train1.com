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
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/Public/Home/js/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/Home/css/jquery.dataTables.min.css" />
    <script type="text/javascript" src="/Public/Home/js/jquery.dataTables.min.js"></script>
    <script src="/Public/Home/js/layui/layui.js"></script>
    <script src="/Public/Home/js/velocity.min.js"></script>
    <script src="/Public/Home/js/velocity.ui.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>

</head>
<body>


<style>
    .red{color: red;}
    ul { list-style-type: none;}
    li { display: inline-block;}
    li { margin: 10px 0;}
    input.labelauty + label { font: 12px "Microsoft Yahei";}
</style>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>订单确认
        <i class="layui-icon" style="font-size: 20px">&#xe63c;</i>
    </legend>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>车次信息确认
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
            <th>硬座剩余</th>
            <th>硬座票价</th>
            <th>软座剩余</th>
            <th>软座票价</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($order_trainsinfoList)): foreach($order_trainsinfoList as $key=>$pv): ?><tr>
                <th class="train_no"><?php echo ($pv["train_no"]); ?></th>
                <th><?php echo ($pv["fromStation"]); ?></th>
                <th><?php echo ($pv["toStation"]); ?></th>
                <th><?php echo ($pv["begin_date"]); ?></th>
                <th><span class="red"><?php echo ($pv["hard_remain"]); ?></span></th>
                <th><span class="red"><?php echo ($pv["hard_price"]); ?></span></th>
                <th><span class="red"><?php echo ($pv["soft_remain"]); ?></span></th>
                <th><span class="red"><?php echo ($pv["soft_price"]); ?></span></th>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
    </div>
</fieldset>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>座位类型确认
        <i class="layui-icon" style="font-size: 20px">&#xe625;</i>
    </legend>
    <div style="width: 70%;margin-left: 160px;">
        <center>
        <ul>
            <li style="padding-right:10px;"><input type="radio" name="radio" value=1 checked>硬座</li>
            <li style="padding-left: 10px;"><input type="radio" name="radio" value=0>软座</li>
        </ul>
        </center>
    </div>
</fieldset>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>乘客信息确认
        <!--<i class="layui-icon touristAdd" style="font-size: 20px">&#xe608;</i>-->
    </legend>
    <div style="width: 70%;margin-left: 160px;">
    <table class="layui-table" lay-skin="line">
        <thead>
        <tr>
            <th>ID</th>
            <th>真实姓名</th>
            <th>身份证</th>
            <th>联系方式</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($order_touristList)): ?><tr><th><a href='<?php echo (C("view_url_base")); ?>/Business/touristAdd/'>暂无乘客，去录入</a></th></tr>
            <?php else: ?>
            <?php if(is_array($order_touristList)): foreach($order_touristList as $key=>$pv): ?><tr>
                    <th id="id_move"><?php echo ($pv["id"]); ?></th>
                    <th class="realname"><?php echo ($pv["realname"]); ?></th>
                    <th class="sfz"><?php echo ($pv["sfz"]); ?></th>
                    <th class="tel"><?php echo ($pv["tel"]); ?></th>
                    <th>
                        <button class="layui-btn layui-btn-danger touristMove">移除</button>
                    </th>
                </tr><?php endforeach; endif; endif; ?>
        </tbody>
    </table>
    </div>
</fieldset>

<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>注意事项
        <i class="layui-icon" style="font-size: 20px">&#xe62a;</i>
    </legend>
    <div style="width: 70%;margin-left: 160px;margin-top: 20px;">
        <blockquote class="layui-elem-quote">1.每次只能选择<span class="red">1</span>种座位类型进行购买。</blockquote>
        <blockquote class="layui-elem-quote">2.针对某一天的特定车次，每位乘客只能购买<span class="red">1</span>次。</blockquote>
        <blockquote class="layui-elem-quote">3.乘客人数至少<span class="red">1</span>人，最多<span class="red">5</span>人。</blockquote>
        <blockquote class="layui-elem-quote">4.乘客人数应<span class="red">小于等于</span>剩余（硬座/软座）的数量。</blockquote>
        <blockquote class="layui-elem-quote">5.仔细确认后，提交订单。</blockquote>
        <blockquote class="layui-elem-quote">6.提交订单后，请在<span class="red">15</span>分钟内完成支付。</blockquote>
    </div>
    <div style="width: 70%;margin-left: 160px;margin-bottom:20px;text-align: center;">
        <button class="layui-btn subOrder">提交订单</button>
        <button class="layui-btn layui-btn-danger back">重选车次</button>
    </div>
</fieldset>
</fieldset>
</body>
</html>



<script>
    //提交订单
    $('.subOrder').click(function () {
        layer.confirm('确定提交订单吗?',{
            btn:['是的','取消']
        }, function () {
            var train_no = $('.train_no').html();
            var seat_type = $('input[name="radio"]:checked').val();
            var order_pay =  '<?php echo (C("view_url_base")); ?>/Business/my_order';
            $.post('<?php echo (C("view_url_base")); ?>/Order/doSubOrder',{
                train_no:train_no,
                seat_type:seat_type
            },function (result) {
                if(result.status === 200){
                    layer.msg(result.info,
                        {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.href = order_pay;
                        });
                }
                else{
                    layer.open(
                        {
                            area: ['70%', '30%'],
                            title:'异常',
                            icon:2,
                            content:result.data.data+result.info
                        })
                }
            },'json');
        })
    });


    //重选则是返回上一页
    $('.back').click(function () {
        window.location.href = '<?php echo (C("view_url_base")); ?>/Index/serachList';
    });

    //暂时废除
    /*
    //弹出新增框
    $('.touristAdd').click(function () {
            $.post('<?php echo (C("view_url_base")); ?>/Order/showTouristAdd',
                {},
                function (result) {
                    if(result.status === 200) {
                        var openBusiness = layer.open({
                            title: result.data.myself + '的乘客信息表',
                            index:1,
                            type: 1,
                            shift: 2,
                            area: ['30%', '47%'],
                            shadeClose: false,
                            maxmin: true,
                            content: result.data.content
                        })
                    }
                }
                ,'json');

    });
    */

    //删除
    $('.touristMove').click(function () {
        var id_move  = $('#id_move').html();
        layer.confirm('确定移除此乘客？', {
            btn: ['是的','取消']//按钮
            },
            function () {
            $.post('<?php echo (C("view_url_base")); ?>/Order/doTouristMove',
                {
                    id_move:id_move
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
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.reload();
                        });
                }
                }
            ,'json')}
        );
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