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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<style>
    .red{color: #FF5722}
    input.myinput{border: solid 1px #E0E0E0;width: 220px;height: 35px;padding: 3px 10px 3px 10px;}
</style>


<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>充值须知
        <i class="layui-icon" style="font-size: 20px">&#xe60b;</i>
    </legend>
    <div style="width: 70%;margin-left: 160px;margin-top: 20px;">
        <blockquote class="layui-elem-quote">1.充值成功后，<span class="red">5-10</span>分钟之内到账。</blockquote>
        <blockquote class="layui-elem-quote">2.<span class="red">实名制</span>用户可以预先充值<span class="red">任意数量</span>的火车币，系统检测到后会在您所绑定的银行卡内自动扣除等金额的RMB。</blockquote>
        <blockquote class="layui-elem-quote">3.本站所有<span class="red">注册用户</span>均为实名制用户。</blockquote>
    </div>
</fieldset>

<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>充值
        <i class="layui-icon" style="font-size: 20px">&#xe63c;</i>
    </legend>
    <div style="width: 70%;margin-left: 160px;">
        <table class="layui-table" lay-skin="line">
            <thead>
            <tr>
                <th>用户</th>
                <th>真实姓名</th>
                <th>待充值金额</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($user_payList)): foreach($user_payList as $key=>$pv): ?><tr>
                    <th><?php echo ($pv["username"]); ?></th>
                    <th class="realname"><?php echo ($pv["realname"]); ?></th>
                    <th>
                        <input id="payMoney" type="text" class="myinput" placeholder="请输入待充金额">元
                    </th>
                    <th>
                        <button class="layui-btn payMoney">充值</button>
                        <a href="<?php echo (C("view_url_base")); ?>/Business/remainMoney" class="layui-btn layui-btn-normal ">余额查询</a>
                    </th>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</fieldset>
</body>
</html>

<script>
    $('.payMoney').click(function () {
        var realname = $(this).parents('tr').children('th.realname').html();
        var paymoeny = $('#payMoney');
        layer.confirm('确定为'+realname+'充值'+paymoeny.val()+'个火车币吗？',{
            btn: ['是的','取消'] //按钮
        },
        function () {
            if(paymoeny.val() === ""){
                layer.msg('充值金额不能为空',{
                    time:2000//3秒后自动关闭
                });
                paymoeny.focus();
            }
            if(isNaN(paymoeny.val())){
                layer.msg('请输入正确的金额数',{
                    time:2000//3秒后自动关闭
                });
                paymoeny.val("");
                paymoeny.focus();
            }
            $.post('<?php echo (C("view_url_base")); ?>/Business/doPay',{
                pay_money:parseInt(paymoeny.val())
            },function (result) {
                if(result.status === 200){
                    window.location.href = '<?php echo (C("view_url_base")); ?>/Business/remainMoney';
                }
                else{
                    layer.msg(result.info,
                        {
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        })
                }
            });
        });
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