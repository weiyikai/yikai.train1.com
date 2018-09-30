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
<script type="text/javascript" src="/Public/Admin/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.minicolors.js"></script>
<script src="/Public/Admin/js/layer/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/js/colorset.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="/Public/Admin/css/jquery.minicolors.css">
<body>
<div class="shadow" style="display: none;"></div>
<!---->
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
            
<fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;margin-left: 20px;margin-right: 20px;">
    <legend><span class="red">列车车次显示</span>
        <i class="layui-icon" style="font-size: 20px" id="trainsAdd">&#xe608;</i>
    </legend>
    <div style="margin-left: 20px;margin-right:20px;margin-top: 20px;">
        <table class="table table-hover" width="100%" id="tbl_trains">
            <thead>
            <tr>
                <th>序号</th>
                <th>车次</th>
                <th>起始站</th>
                <th>终到站</th>
                <th>途径站点</th>
                <th>硬座车厢数</th>
                <th>每节硬座车厢座位数</th>
                <th>硬座票价</th>
                <th>软座车厢数</th>
                <th>每节软座车厢座位数</th>
                <th>软座票价</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tbl_content">
            <?php if(is_array($trainsList)): foreach($trainsList as $key=>$pv): ?><tr>
                    <th id="tid"><?php echo ($pv["id"]); ?></th>
                    <th><?php echo ($pv["train_no"]); ?></th>
                    <th><?php echo ($pv["fromStation"]); ?></th>
                    <th><?php echo ($pv["toStation"]); ?></th>
                    <th><?php echo ($pv["viaStation"]); ?></th>
                    <th><?php echo ($pv["hard_carriage_num"]); ?></th>
                    <th><?php echo ($pv["hard_seat_num"]); ?></th>
                    <th><?php echo ($pv["hard_price"]); ?></th>
                    <th><?php echo ($pv["soft_carriage_num"]); ?></th>
                    <th><?php echo ($pv["soft_seat_num"]); ?></th>
                    <th><?php echo ($pv["soft_price"]); ?></th>
                    <th>
                        <button class="layui-btn layui-btn-danger trainsDel">删除</button>
                    </th>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</fieldset>


<!-- 自动建议bootatrap JS -->
<link rel="stylesheet" href="/Public/Admin/css/autosuggest.min.css">
<script src="/Public/Admin/js/jquery.autosuggest.min.js"></script>
<!-- End自动建议bootatrap JS -->

<!-- 加载颜色选择器 -->
<script type="text/javascript" src="/Public/Admin/js/jquery.minicolors.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/jquery.minicolors.css">
<script type="text/javascript" src="/Public/Admin/js/colorset.js"></script>
<!-- 加载颜色选择器 -->

<script>
    table = $("#tbl_trains").DataTable({
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


    //车次添加
    $('#trainsAdd').click(function () {
        $.post('<?php echo (C("view_url_base")); ?>/Admin/Business/showTrainsAdd',{
        },function (result) {
            if(result.status === 200){
                var openBusiness = layer.open({
                    title: '列车车次添加',
                    index:1,
                    type: 1,
                    shift: 2,
                    area: ['35%', '90%'],
                    shadeClose: false,
                    maxmin: true,
                    content: result.data.content
                })
            }
        },'json');
    });

    //车次删除
    $('.trainsDel').click(function () {
        layer.confirm('确定删除此车次？', {
            btn: ['是的','取消']//按钮
        },function () {
            var tid = $('#tid').html();
            $.post('<?php echo (C("view_url_base")); ?>/Admin/Business/doTrainsDel', {
                tid: tid
            }, function (result) {
                if (result.status === 200) {
                    layer.msg(result.info,
                        {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.reload();
                        });
                }
                else {
                    layer.msg(result.info,
                        {
                            icon: 2,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        },
                        function () {
                            window.location.reload();
                        });
                }
            }, 'json');
        });
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