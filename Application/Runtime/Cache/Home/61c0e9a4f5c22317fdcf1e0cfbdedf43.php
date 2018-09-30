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
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend>余额查询
        <i class="layui-icon" style="font-size: 20px">&#xe60b;</i>
    </legend>
    <div style="width: 70%;margin-left: 160px;">
        <table class="layui-table" lay-skin="line">
            <thead>
            <tr>
                <th>用户</th>
                <th>真实姓名</th>
                <th>钱包金额</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($user_moneyList)): foreach($user_moneyList as $key=>$pv): ?><tr>
                    <th><?php echo ($pv["username"]); ?></th>
                    <th><?php echo ($pv["realname"]); ?></th>
                    <th><?php echo ($pv["money"]); ?></th>
                    <th>
                        <a href="<?php echo (C("view_url_base")); ?>/Business/pay" class="layui-btn layui-btn-warm">去充值</a>
                    </th>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</fieldset>
</body>
</html>
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