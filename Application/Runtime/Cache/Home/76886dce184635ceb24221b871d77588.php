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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
</head>
<style>
    .this-on{background-color:#66BB6A;color:#FFFFFF;}
    .this-off{background-color:#FFFFFF;color:#000000;}
    .t1{background-color:#337AB7;color:#FFFFFF;}
    .yfk{background-color:#D9534F;color:#FFFFFF;}
</style>
<script type="text/javascript" src="/Public/Home/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.minicolors.js"></script>
<script src="/Public/Home/js/layer/layer.js"></script>
<script type="text/javascript" src="/Public/Home/js/colorset.js"></script>
<link rel="stylesheet" href="/Public/Home/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="/Public/Home/css/jquery.minicolors.css">
<body>
<div class="shadow" style="display: none;"></div>
<!--<a class="btn <?php if((ACTION_NAME == 'getGroupList')): ?>btn-primary<?php endif; ?>" target="_blank" style="margin-bottom: 20px;" href="<?php echo (C("view_url_base")); ?>/Groups/getGroupList">集团列表</a>
<a class="btn <?php if((ACTION_NAME == 'showGroupAdd')): ?>btn-primary<?php endif; ?>" target="_blank" style="margin-bottom: 20px;" href="<?php echo (C("view_url_base")); ?>/Groups/showGroupAdd">添加集团</a>
-->
<div id="changePage">
    <div id="wrapper">
        <div class="table-responsive">
            <style>
                table.table-hover>tbody>tr:hover {
                    background-image: linear-gradient(to bottom, rgb(245, 245, 245) 0, rgb(206, 221, 213) 100%);
                }table.table-hover tr:nth-child(even) {
                     background-color: #E1E1E1;
                 }
            </style>
            
<style>
    .red{color: red;}
</style>
<table class="table table-hover" width="100%" id="tbl_products">
    <thead>
    <tr>
        <th>车次</th>
        <th>起始站</th>
        <th>终到站</th>
        <th>发车时间</th>
        <th>硬座</th>
        <th>软座</th>
        <th></th>
    </tr>
    </thead>
    <tbody id="tbl_content">
    <?php if(is_array($trainsList)): foreach($trainsList as $key=>$pv): ?><tr>
            <th data-field="train_no" class="train_no"><?php echo ($pv["train_no"]); ?></th>
            <th data-field="fromStation"><?php echo ($pv["fromStation"]); ?></th>
            <th data-field="toStation"><?php echo ($pv["toStation"]); ?></th>
            <th><?php echo ($pv["begin_date"]); ?></th>
            <!--<th><?php echo ($pv["viaStation"]); ?></th>-->
            <th>剩:<span class="red hard_remain"><?php echo ($pv["hard_remain"]); ?></span>张</th>
            <th>剩:<span class="red soft_remain"><?php echo ($pv["soft_remain"]); ?></span>张</th>
            <!--<td data-field="group_name"><?php echo ($pv["statNum"]); ?></td>-->
            <!--<td data-field="group_img_url" value="<?php echo ($pv["group_img_url"]); ?>"><a href="<?php echo ($pv["group_img_url"]); ?>" target="_blank"><img src="<?php echo ($pv["group_img_url"]); ?>" style="max-width: 30px"></a></td>-->
            <!--<td><a target="_blank" href="<?php echo (C("view_url_base")); ?>/Groups/showGroupEdit/id/<?php echo ($pv["group_id"]); ?>/merchant_type/2">基本信息</a></td>-->
            <!--<td><a target="_blank" href="<?php echo (C("view_url_base")); ?>/CreditSystem/getGroupStations/group_id/<?php echo ($pv["group_id"]); ?>">积分规则</a></td>-->
            <!--<td><a target="_blank" href="<?php echo (C("view_url_base")); ?>/VipType/index/group_id/<?php echo ($pv["group_id"]); ?>">储值卡</a></td>-->
            <!--<td><a target="_blank" href="<?php echo (C("view_url_base")); ?>/GroupStations/index/group_id/<?php echo ($pv["group_id"]); ?>">积分抵油</a></td>-->
            <!--<td><a target="_blank" href="<?php echo (C("view_url_base")); ?>/CreditSystem/getGroupLevle/group_id/<?php echo ($pv["group_id"]); ?>">积分定级</a></td>-->
            <!--<td><a target="_blank" href="<?php echo (C("view_url_base")); ?>/Settlement/index/merchant_id/<?php echo ($pv["group_id"]); ?>/merchant_type/2">结算设置</a></td>-->
            <th>
                <button class="layui-btn detail">详情</button>
                <?php if(empty($pv["total_remain"])): ?><button class="layui-btn layui-btn-disabled">预定</button>
                <?php else: ?>
                    <a href="<?php echo (C("view_url_base")); ?>/Order/index/train_no/<?php echo ($pv["train_no"]); ?>" class="layui-btn layui-btn-normal book">预定</a><?php endif; ?>

                <!--<a  href="<?php echo (C("view_url_base")); ?>/Order/index" id="order" class="btn btn-primary train-order" data-id='<?php echo ($pv["id"]); ?>'>预定</a>-->
            <!--<th><button class="btn btn-danger del-group" data-stid='<?php echo ($pv["group_id"]); ?>'>删除</button></th>-->
            </th>
        </tr><?php endforeach; endif; ?>
    </tbody>
</table>




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
    table = $("#tbl_products").DataTable({
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


    //详情
    $('.detail').click(function () {

        //预定按钮触发事件
        var train_no = $(this).parents('tr').children('th.train_no');
        $.post('<?php echo (C("view_url_base")); ?>/Index/detailDisplay',
            {train_no:train_no.html()},
            function (result) {
                if(result.status === 200) {
                    var openBusiness = layer.open({
                        title: train_no.html() + '详情信息',
                        type: 1,
                        shift: 2,
                        area: ['70%', '30%'],
                        shadeClose: false,
                        maxmin: true,
                        content: result.data.content
                    })
                }
            }
            ,'json');
    });

</script>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(function(){
        $(".shadow").fakeLoader({
            timeToHide:0,
            pos:"absolute",
            zIndex:2e9,
            spinner:"spinner2",
            bgColor:"rgba(46,204,113,0.5)"
        })
    })


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