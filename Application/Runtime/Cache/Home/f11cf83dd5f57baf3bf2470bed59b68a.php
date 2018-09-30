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
<style>
    .red{color: #393D49;}
</style>

<script type="text/javascript" src="/Public/Home/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.minicolors.js"></script>
<script src="/Public/Home/js/layer/layer.js"></script>
<script type="text/javascript" src="/Public/Home/js/colorset.js"></script>
<link rel="stylesheet" href="/Public/Home/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="/Public/Home/css/jquery.minicolors.css">
<body>
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend><span class="red">乘客信息</span>
        <i class="layui-icon touristAdd" style="font-size: 20px">&#xe608;</i>
    </legend>
    <div class="shadow" style="display: none;"></div>
    <!---->
    <div id="changePage1">
        <div id="wrapper1">
            <div class="table-responsive">
                <style>
                    table.table-hover>tbody>tr:hover {
                        background-image: linear-gradient(to bottom, rgb(245, 245, 245) 0, rgb(206, 221, 213) 100%);
                    }table.table-hover tr:nth-child(even) {
                         background-color: #E1E1E1;
                     }
                </style>
                <div style="margin-left: 20px;margin-right:20px;margin-top: 20px;">
    <table class="table table-hover" width="100%" id="tbl_add">
        <thead>
        <tr>
            <th>序号</th>
            <th>真实姓名</th>
            <th>身份证</th>
            <th>联系方式</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="tbl_content">
        <?php if(is_array($touristList)): foreach($touristList as $key=>$pv): ?><tr>
                <th id="id"><?php echo ($pv["id"]); ?></th>
                <th><?php echo ($pv["realname"]); ?></th>
                <th><?php echo ($pv["sfz"]); ?></th>
                <th><?php echo ($pv["tel"]); ?></th>
                <th>
                    <button class="layui-btn layui-btn-danger touristDel">删除</button>
                </th>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
    <a href='<?php echo (C("view_url_base")); ?>/Index/index' class="layui-btn" style="margin-left: 600px;margin-bottom: 10px;">去买票</a>

<!-- 自动建议bootatrap JS -->
<link rel="stylesheet" href="/Public/Home/css/autosuggest.min.css">
<script src="/Public/Home/js/jquery.autosuggest.min.js"></script>
<!-- End自动建议bootatrap JS -->

<!-- 加载颜色选择器 -->
<script type="text/javascript" src="/Public/Home/js/jquery.minicolors.js"></script>
<link rel="stylesheet" href="/Public/Home/css/jquery.minicolors.css">
<script type="text/javascript" src="/Public/Home/js/colorset.js"></script>
<!-- 加载颜色选择器 -->


<script>
    table = $("#tbl_add").DataTable({
        "oLanguage": {
            "sLengthMenu": "每页显示 _MENU_ 条记录",
            "sZeroRecords": "抱歉， 没有找到",
            "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
            "sInfoEmpty": "没有数据",
            "sSearch": "关键字筛选：",
            "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "前一页",
                "sNext": "后一页",
                "sLast": "尾页"
            },
        },
        "order": [[ 0, "desc" ]],
        "columnDefs": [
        ]
    });
    $(".dataTables_filter input").attr("placeholder", "请输入关键字进行筛选");

    //乘客添加
    $('.touristAdd').click(function () {
        $.post('<?php echo (C("view_url_base")); ?>/Business/showTouristAdd',
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

    //乘客的删除
    $('.touristDel').click(function () {
        var tourist_id = $('#id').html();
        layer.confirm('确定删除此乘客？', {
                btn: ['是的','取消']//按钮
            },
            function () {
                $.post('<?php echo (C("view_url_base")); ?>/Business/doTouristDel',
                    {
                        tourist_id:tourist_id
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
                                    icon: 2,
                                    time: 3000 //2秒关闭（如果不配置，默认是3秒）
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
            </div>
        </div>
    </div>
</fieldset>
</body>
</html>
<script>
    window.reload();
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