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
    <script type="text/javascript" src="/Public/Home/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/lazyload.js"></script>
    <script type="text/javascript" src="/Public/Home/js/weisay.js"></script>
    <script type="text/javascript" src="/Public/Home/js/hoveraccordion.js"></script>
    <script type="text/javascript" src="/Public/Home/js/slider.js"></script>
    <script type="text/javascript" src="/Public/Home/js/index.js"></script>
    <script src="/Public/Home/js/velocity.min.js"></script>
    <script src="/Public/Home/js/velocity.ui.min.js"></script>
    <script src="/Public/Home/js/velocity.ui.min.js"></script>
    <link href="/Public/Home/css/index.css" rel="stylesheet">
    <link href="/Public/Home/css/jquery-ui.css" rel="stylesheet">
    <link href="/Public/Home/css/green.css" rel="stylesheet">
    <link href="/Public/Home/css/highlight.css" rel="stylesheet">
    <script type="text/javascript" src="/Public/Home/js/jquery-ui-datepicker.js"></script>
    <style>
        #login-info {display: none;}
        .textcenter {text-align: center}
        .label{display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em}
        .label-danger {background-color: #dd0000}
    </style>
</head>
<body>
<!--页面主体  开始-->
<div class="context">
    <!--车票查询框 开始-->
    <div class="layout booking"><div class="lay-hd">车票查询</div>
        <div class="lay-bd">
            <div class="booking-in">
                <div class="booking-bd">
                    <div id="login-info" class="textcenter">
                        <label id="info" class="label label-danger">查询失败</label>
                    </div>
                    <ul class="clearfix">
                        <li>出发地<input placeholder="选择城市" name="" maxlength="15" type="text" id="fromStationText" class="inp-txt" value="">
                        </li>
                        <li>
                            目的地<input placeholder="您要去哪?" name="" maxlength="15" type="text" id="toStationText" class="inp-txt" value="">
                        </li>
                        <li>
                            出发日<input readonly="readonly" maxlength="10" autocomplete="off" type="text" class="inp-txt" name="leftTicketDTO.train_date" id="train_date" value="">
                        </li>
                    </ul>
                    <span class="i-change" id="change_station" style="cursor: pointer;"></span>
                    <div class="tc"><button id="requireSubmit" class="btn-login">查&nbsp;&nbsp;&nbsp;&nbsp;询</button>
                    </div>
                    <!-- <p class="tc mt5 color666" th:text="#{index_yushouqi(${yshouStart},${yshouEnd})}">今天可售6月1日—6月20日的车票</p> -->
                </div>
            </div>
        </div>

    </div>
    <!--车票查询框 结束-->
    <!--轮播开始-->
    <div class="main"> ﻿
        <div id="box">
            <div id="container">
                <div class="item">
                    <img src="/Public/Home/img/6.jpg" width="495" height="328" />
                </div>

                <div class="clear"></div>
                <div class="item">
                    <img src="/Public/Home/img/map3.gif" width="495" height="328" />
                </div>
                <div class="clear"></div>
                <div class="item">
                    <div class="pic">
                        <h2><a href="http://sc.chinaz.com" rel="bookmark" target="_blank" title="详细阅读 《将bat批处理文件注册成windows Service服务》">将bat批处理文件注册成windows Service服务</a></h2>
                        <a href="http://sc.chinaz.com" rel="bookmark" target="_blank" title="将bat批处理文件注册成windows Service服务">
                            <div class="thumbnail"> <img class="home-thumb" title="将bat批处理文件注册成windows Service服务" src="/Public/Home/img/5.jpg" width="140px" height="100px" alt="将bat批处理文件注册成windows Service服务"></div>
                        </a>
                        <div class="con_post">最近做程序需要用到将.bat文件注册成windows Service服务需求，网上找了一下方法很多，下面介绍一下用window的 sc create 命令来做的方法
                            c create MyService binPath= &#8220;C:\Program Files\restartOracle.bat
                            &#8220;  type= share start= auto displayname= &#8220;AutoS...</div>
                    </div>
                    <div class="clear"></div>
                    <div  class="txt">作者：小贝 | 发布：2013年9月22日 | 分类：<a href="http://sc.chinaz.com" title="查看 技术代码 中的全部文章" rel="category tag">技术代码</a> | 踩踏：403次</div>
                    <div class="txt"></div>
                    <div class="slider_num"><a href="http://sc.chinaz.com" title="《将bat批处理文件注册成windows Service服务》上的评论">4条吐槽</a></div>
                </div>
                <div class="clear"></div>
                <div class="item">
                    <div class="pic">
                        <h2><a href="http://sc.chinaz.com" rel="bookmark" target="_blank" title="详细阅读 《SQL设计与命名规范》">SQL设计与命名规范</a></h2>
                        <a href="http://sc.chinaz.com" rel="bookmark" target="_blank" title="SQL设计与命名规范">
                            <div class="thumbnail"> <img class="home-thumb" title="SQL设计与命名规范" src="/Public/Home/img/4.jpg" width="140px" height="100px" alt="SQL设计与命名规范"></div>
                        </a>
                        <div class="con_post">一.设计规范：
                            1.采用有意义的字段名：尽可能的把字段描述的清楚些（见名之意）；
                            2.遵守数据库三范式(3NF)规定：
                            A:表内的每一个值都只能被表达一次；
                            B:表内的每一行都应该被唯一的标识(有唯一键)；
                            C:表内不应该存储依赖于其他键的非键信息。
                            3.小心保留词：要保证你的字段...</div>
                    </div>
                    <div class="clear"></div>
                    <div  class="txt">作者：小贝 | 发布：2013年8月20日 | 分类：<a href="http://sc.chinaz.com" title="查看 技术代码 中的全部文章" rel="category tag">技术代码</a> | 踩踏：610次</div>
                    <div class="txt"></div>
                    <div class="slider_num"><a href="http://sc.chinaz.com" title="《SQL设计与命名规范》上的评论">8条吐槽</a></div>
                </div>
                <div class="clear"></div>
                <div class="item">
                    <img src="/Public/Home/img/7.jpg" width="495" height="328" />
                </div>
                <div class="clear"></div>
            </div>
            <div id="control"></div>
        </div>
        <div class="clear"></div>
    </div>
    <!--轮播结束-->
</div>
<div class="select_city" id="in_city" style="display: none"></div>


<!--<center>-->
    <!--<input type="text" placeholder="选择城市" id="place" name="">-->
    <!--<input type="text" placeholder="您要去哪？" id="destination" name="">-->
    <!--&lt;!&ndash; 城市 &ndash;&gt;-->
    <!--<div id="in_city" style="display: none"></div>-->
<!--</center>-->
<!--页面主体  结束-->

</body>
</html>
<script type="text/javascript">
    $(function () {
        $("#train_date").datepicker({
            minDate:0,
            maxDate:+6
        });
    });
</script>
<script type="text/javascript">
    var cityA = $(".city_a_le1 a"); //城市
    var pla = $("#fromStationText");  //出发地
    var dest = $("#toStationText");  //目的地

    // 默认值
    inCity.width = "345";  //城市选择框  宽
    inCity.height = "auto";  //城市选择框  高
    inCity.id = "#in_city";  //城市选择框  父级ID
    inCity.Children = '.city_a_le1';  //城市名box
    // 初始化 城市HTML模板
    $(inCity.id).prepend(inCity._template.join(''));
    inCity.Hot(cityA);


    //城市 导航
    var apay = $(".screen a");

    var placeThis; //当前选择标签
    apay.click(function(obj){  //城市导航
        inCity.payment($(this));
    });


    inCity.place(pla); //出发地

    inCity.destination(dest);  //目的地
    inCity.cityClick(cityA); //显示赋值城市
</script>
<script type="text/javascript">
    var url = "<?php echo (C("view_url_base")); ?>/Index/serachList";
$("#requireSubmit").click(function () {


    var fromStation = $('#fromStationText');
    var toStation   = $('#toStationText');
    var begin_date  = $('#train_date');
    if(fromStation.val() === ""){
        infoshow("起始站不能为空");
        fromStation.focus();
        return;
    }
    if(toStation.val() === ""){
        infoshow("终到站不能为空");
        toStation.focus();
        return;
    }
    if(begin_date.val() === ""){
        infoshow("请选择发车时间");
        begin_date.focus();
        return;
    }

    $.ajax({
        type:'post',
        url:"<?php echo (C("view_url_base")); ?>/Index/doSerach",
        dataType:'json',
        data: {
            fromStation: fromStation.val(),
            toStation: toStation.val(),
            begin_date: begin_date.val()
        },
        beforeSend:function () {
            layer.load(1, {shade: [0.3,'#000']});
        },
        success:function (result) {
            layer.closeAll('loading');
            if(result.status === 200){
                window.location.href = result.data;
            }
        },
        error:function () {
            layer.msg('系统错误！',{icon:5,shift:6,time:6e3});
            layer.closeAll('loading');
        }
    });
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