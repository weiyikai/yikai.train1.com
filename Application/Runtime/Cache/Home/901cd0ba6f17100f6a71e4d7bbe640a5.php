<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <script src="/Public/Home/js/jquery-1.9.1.min.js"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- js i18n -->
    <!-- jquery validation i18n -->
    <!-- head and footer -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>客运服务 | 铁路客户服务中心</title>
</head>
<body>
<!--header start-->
<div class="header"><div style="z-index: 2000" class="header-bd"><a href="http://www.12306.cn/"><h1 class="logo">中国铁路客户服务中心-客运中心</h1>
</a>
    <div class="login-info"><div class="phone-link">
    </div>
        <div class="menu"><a href="/otn/index/initMy12306" class="menu-bd" id="js-my">我的12306<b></b>
        </a>
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
        <span class="login-txt" style="color: #666666"><span>
          您好，请</span>
<a id="login_user" href="/otn/login/init" class="colorA" style="margin-left:-0.5px;">登录</a>
| <a id="regist_out" href="/otn/regist/init">注册</a>
</span>
    </div>
    <div class="nav">
        <ul>
            <li><a href="/otn/index/init" class="current">客运首页</a>
            </li>
            <li id="selectYuding"><a href="/otn/leftTicket/init" class="">车票预订</a>
             </li>
             <li><a href="/otn/lcQuery/init" class="">接续换乘</a>
             </li>
            <li><a href="https://cx.12306.cn/tlcx/index.html" target="_blank" class="">铁路畅行</a>
            </li>
            <li><a href="https://exservice.12306.cn/excater/index.html" target="_blank" class="">餐饮•特产</a>
             </li>
              <li style="width: 71px;" id="js-xd" class="nav-guide"><a href="javascript:" class="">出行向导</a>
                </li>
            <li id="selectHelp"><a href="/otn/gonggao/help.html" class="">信息服务</a>
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
    <title>jQuery点击弹出城市选择器代码 - 站长素材</title>

    <link rel="stylesheet" type="text/css" media="all" href="/Public/Home/css/tyle.css">
    <script src="/Public/Home/js/jquery-1.9.1.min.js"></script>

</head>

<body>
<center>
    <input type="text" placeholder="选择城市" id="place" name="">
    <input type="text" placeholder="您要去哪？" id="destination" name="">
    <!-- 城市 -->
    <div id="in_city" style="display: none"></div>
</center>
<script type="text/javascript" src="/Public/Home/js/index.js"></script>
<script type="text/javascript">

    var cityA = $(".city_a_le1 a"); //城市
    var pla = $("#place");  //出发地
    var dest = $("#destination");  //目的地
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
    })

    inCity.place(pla); //出发地
    inCity.destination(dest);  //目的地
    inCity.cityClick(cityA); //显示赋值城市
</script>

<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
    <p>适用浏览器：IE8、360、FireFox、Chrome、Safari、Opera、傲游、搜狗、世界之窗.</p>
    <p>来源：<a href="http://sc.chinaz.com/" target="_blank">站长素材</a></p>
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