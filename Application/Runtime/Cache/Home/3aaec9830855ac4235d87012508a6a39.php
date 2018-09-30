<?php if (!defined('THINK_PATH')) exit();?>
<link rel="stylesheet" href="/Public/Home/css/bootstrap3.3.5.min.css">
<script src="/Public/Home/js/jquery-1.7.2.min.js"></script>
<script src="/Public/Home/js/velocity.min.js"></script>
<script src="/Public/Home/js/velocity.ui.min.js"></script>
<script src="/Public/Home/js/layer/layer.js"></script>
<style>
    #background{position: absolute;z-index: 0;width: 100%;height: 100%;background: linear-gradient(to bottom,rgb(238, 238, 238) 0,rgb(188, 224, 210) 100%) no-repeat;}
    #loginpart{position: absolute;z-index: 5;left: calc(50% - 150px);top: calc(50% - 180px);width: 300px;height: 300px;border-radius: 25px;background: rgb(24,160,106);}
    input.myinput{border: solid 1px #E0E0E0;width: 220px;height: 35px;padding: 3px 10px 3px 10px;}
    /*button.mybutton{width: 75px;height: 35px;color: #407b5c;background-color: #8bcd3d;border-color: #4cae4c;border-radius: 0;}*/
    /*button.mybutton:hover{color: #407b5c;background-color: #79cf13;}*/
    /*button.mybutton:active{color: #407b5c;background-color: #6dbb10;}*/
    /*button.mybutton:active:focus{color: #407b5c;}*/
    /*button.mybutton:focus{color: #407b5c;}*/
    #login-button{margin-top: 30px;}
    #register-button{margin-top: 10px;}
    label.word{font-size: 20px;}
    label.label-word{background-color: #FFFFFF;color: #189e68;font-size: 15px;}
    #content-before{margin-top: 30px;}
    #name-word{margin-top: 20px;margin-bottom: 2px;}
    #sfz-word{margin-top: 10px;margin-bottom: 2px;}
    #tel-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #name-label{margin-left: 40px;}
    #sfz-label{margin-left: 40px;}
    #tel-label{margin-left: 40px;}
    #add-info{display: none;margin-top: 13px;}
</style>

<div id="background">
    <!--<img id="logo" alt="喂车科技" src="/Public/Ip/img/IpLogo.png" />-->
    <div id="content-before"></div>
    <div id="name-word">
        <label id="name-label" class="label label-default label-word" for="realname">乘客姓名</label>
        <input id="realname" type="text" class="myinput" placeholder="请输入乘客姓名" />
    </div>
    <div id="sfz-word">
        <label id="sfz-label" class="label label-default label-word" for="sfz">身份证号</label>
        <input id="sfz" type="text" class="myinput" placeholder="请输入身份证" />
    </div>
    <div id="tel-word">
        <label id="tel-label" class="label label-default label-word" for="tel">联系方式</label>
        <input id="tel" type="text" class="myinput" placeholder="请输入联系方式" />
    </div>
    <div id="login-button" class="textcenter">
        <button id="add" type="button" class="layui-btn">新增</button>
        <button id="reset" type="reset" class="layui-btn layui-btn-warm">重置</button>
        <button id="quit" type="button" class="layui-btn layui-btn-danger">取消</button>
    </div>
    <div id="add-info" class="textcenter">
        <label id="info" class="label label-danger">新增失败</label>
    </div>
</div>
<script type="text/javascript">
    //取消
    $('#quit').click(function () {
        window.location.reload();
    });
    //重置
    $('#reset').click(function () {
        var realname = $('#realname');
        var sfz = $('#sfz');
        var tel = $('#tel');
        realname.val("");
        sfz.val("");
        tel.val("");
    });

    /*
根据〖中华人民共和国国家标准 GB 11643-1999〗中有关公民身份号码的规定，公民身份号码是特征组合码，由十七位数字本体码和一位数字校验码组成。排列顺序从左至右依次为：六位数字地址码，八位数字出生日期码，三位数字顺序码和一位数字校验码。
    地址码表示编码对象常住户口所在县(市、旗、区)的行政区划代码。
    出生日期码表示编码对象出生的年、月、日，其中年份用四位数字表示，年、月、日之间不用分隔符。
    顺序码表示同一地址码所标识的区域范围内，对同年、月、日出生的人员编定的顺序号。顺序码的奇数分给男性，偶数分给女性。
    校验码是根据前面十七位数字码，按照ISO 7064:1983.MOD 11-2校验码计算出来的检验码。

出生日期计算方法。
    15位的身份证编码首先把出生年扩展为4位，简单的就是增加一个19或18,这样就包含了所有1800-1999年出生的人;
    2000年后出生的肯定都是18位的了没有这个烦恼，至于1800年前出生的,那啥那时应该还没身份证号这个东东，⊙﹏⊙b汗...
下面是正则表达式:
 出生日期1800-2099  (18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])
 身份证正则表达式 /^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i
 15位校验规则 6位地址编码+6位出生日期+3位顺序号
 18位校验规则 6位地址编码+8位出生日期+3位顺序号+1位校验位

 校验位规则     公式:∑(ai×Wi)(mod 11)……………………………………(1)
                公式(1)中：
                i----表示号码字符从由至左包括校验码在内的位置序号；
                ai----表示第i位置上的号码字符值；
                Wi----示第i位置上的加权因子，其数值依据公式Wi=2^(n-1）(mod 11)计算得出。
                i 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1
                Wi 7 9 10 5 8 4 2 1 6 3 7 9 10 5 8 4 2 1

*/
    //身份证号合法性验证
    //支持15位和18位身份证号
    //支持地址编码、出生日期、校验位验证
    function IdentityCodeValid(code) {
        var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
        var tip = "";
        var pass= true;

        if(!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)){
            tip = "身份证号格式错误";
            pass = false;
        }

        else if(!city[code.substr(0,2)]){
            tip = "地址编码错误";
            pass = false;
        }
        else{
            //18位身份证需要验证最后一位校验位
            if(code.length == 18){
                code = code.split('');
                //∑(ai×Wi)(mod 11)
                //加权因子
                var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
                //校验位
                var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
                var sum = 0;
                var ai = 0;
                var wi = 0;
                for (var i = 0; i < 17; i++)
                {
                    ai = code[i];
                    wi = factor[i];
                    sum += ai * wi;
                }
                var last = parity[sum % 11];
                if(parity[sum % 11] != code[17]){
                    tip = "校验位错误";
                    pass =false;
                }
            }
        }
        if(!pass) infoshow(tip);
        return pass;
    }

    //新增
    $('#add').click(function () {

        var realname = $('#realname');
        var sfz = $('#sfz');
        var tel = $('#tel');

        if(realname.val() === ""){
            infoshow('乘客姓名不能为空');
            return;
        }
        if(sfz.val() === ""){
            infoshow('身份证号不能为空');
            return;
        }
        if(!IdentityCodeValid(sfz.val())){
            sfz.focus();
            return;
        }
        if(tel.val() === ""){
            infoshow('联系方式不能为空');
            return;
        }
        var isMobile=/^1[3578]\d{9}$|^147\d{8}$/; //手机号码验证规则
        if(tel.val().length !== 11 || !isMobile.test(tel.val())){
            infoshow("请输入有效的联系方式");
            tel.focus();
            return;
        }
        $.post('<?php echo (C("view_url_base")); ?>/Business/doTouristAdd',
            {
                realname:realname.val(),
                sfz:sfz.val(),
                tel:tel.val()
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
                    layer.msg(result.data.data+result.info,
                        {
                            icon:2,
                            time:3000
                        },
                        function () {
                            window.location.reload();
                        });
                }
            },
            "json"
        );
    });

    var infoshow = function(text){
        $("#add-info").velocity("finish");
        $("#info").html(text);
        $("#add-info").velocity({
            opacity: [1, 0]
        }, {
            display: "block",
            duration: 300,
            complete: function() {
                $("#add-info").velocity({
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