<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="/Public/Admin/img/train.jpg">
    <link rel="Bookmark" href="/Public/Admin/img/train.jpg">
    <script type="text/javascript" src="/Public/Admin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap3.3.5.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/fakeLoader.min.js"></script>
    <script src="/Public/Admin/js/layer/layer.js"></script>
    <link rel="stylesheet" href="/Public/Admin/js/layui/css/layui.css">
    <link type="text/css" href="/Public/Admin/css/common.css" rel="stylesheet">
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
    <!-- js i18n -->
    <!-- jquery validation i18n -->
    <!-- head and footer -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>后台</title>
</head>
<body>
<div id="navi">
    <div id="menu" class="default">
        <ul>
            <li><a href="<?php echo (C("view_url_base")); ?>/Admin/Business/trainsManage">车次管理</a></li>
            <li><a href="<?php echo (C("view_url_base")); ?>/Admin/Business/trainsInfoManage">车次信息管理</a></li>
            <li style="margin-left: 200px;"></li>
            <li style="color: white">您好!<?php echo (session('admin_username')); ?></li>
            <li><a href = "<?php echo (C("view_url_base")); ?>/Admin/Admin/logout">注销</a></li>
            <li><a href = "<?php echo (C("view_url_base")); ?>/Index/index">去前台</a></li>
        </ul>
    </div><!-- close menu -->
</div><!-- close navi -->

<style>#navi {
    height: 50px;
    margin-top: 10px;
    margin-bottom: 20px;
    font-size:14px;
}
#height {
    height:500px
}

#menu {
    /*背景*/
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8AB9EB), color-stop(40%,#5C9DDC), color-stop(100%,#2374C5));
    background: -moz-linear-gradient(top, #8AB9EB, #5C9DDC, #2374C5);
    /*圆角*/
    width: 80%;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    line-height: 50px;
    text-align: center;
    margin: 0 auto;
    padding: 0;
}


ul {
    padding: 0;
}

ul li {
    list-style-type: none;
    display: inline;
    margin-right: 15px;
}

ul li a {
    color: #fff;
    text-decoration: none;
    /*文字阴影*/
    text-shadow: 1px 1px 1px #000;
    padding: 6px 12px;
    /*圆角*/
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;

    -webkit-transition-property: color, background;
    -webkit-transition-duration: 0.5s, 0.5s;
}

ul li a:hover {
    background:#FFC;
    color:#333;

    -webkit-transition-property: color, background;
    -webkit-transition-duration: 0.5s, 0.5s;
}

.default {
    width: 850px;
    height: 50px;

    box-shadow: 0 5px 20px #888;
    -webkit-box-shadow: 0 5px 20px #888;
    -moz-box-shadow: 0 5px 20px #888;
}

.fixed {
    position: fixed;
    top: -5px;
    left: 0;
    width: 100%;

    box-shadow: 0 0 40px #222;
    -webkit-box-shadow: 0 0 40px #222;
    -moz-box-shadow: 0 0 40px #222;
}</style>
<script>$(function(){
    var menu = $('#menu'),
        pos = menu.offset();

    $(window).scroll(function(){
        if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
            menu.fadeOut('fast', function(){
                $(this).removeClass('default').addClass('fixed').fadeIn('fast');
            });
        } else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
            menu.fadeOut('fast', function(){
                $(this).removeClass('fixed').addClass('default').fadeIn('fast');
            });
        }
    });
})</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<br><br><br>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( ^_^ )欢迎使用</h1>
<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;出行无忧火车票管理后台</h1>
<div style="margin-bottom: 430px;">

</div>
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