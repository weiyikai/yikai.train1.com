<?php if (!defined('THINK_PATH')) exit();?><head>
    <title>注册账号</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, minimal-ui">
    <link rel="shortcut icon" href="/Public/Home/img/train.jpg">
    <link rel="Bookmark" href="/Public/Home/img/train.jpg">
</head>
<link rel="stylesheet" href="/Public/Home/css/bootstrap3.3.5.min.css">
<script src="/Public/Home/js/jquery-1.7.2.min.js"></script>
<script src="/Public/Home/js/velocity.min.js"></script>
<script src="/Public/Home/js/velocity.ui.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery-validation/jquery.validate.min.js"></script>
<script src="/Public/Home/js/layer/layer.js"></script>
<style>
    #background{position: absolute;z-index: 0;width: 100%;height: 100%;background: linear-gradient(to bottom,rgb(238, 238, 238) 0,rgb(188, 224, 210) 100%) no-repeat;}
    #logo{position: absolute;z-index: 1;bottom: 5%;right: 5%;width: 50%;max-width: 100px;}
    #loginpart{display: none;position: absolute;z-index: 5;left: calc(50% - 150px);top: calc(30% - 185px);width: 300px;height: 600px;border-radius: 25px;background: rgb(24,160,106);}
    input.myinput{border: solid 1px #E0E0E0;width: 220px;height: 35px;padding: 3px 10px 3px 10px;}
    button.mybutton{width: 222px;height: 35px;color: #407b5c;background-color: #8bcd3d;border-color: #4cae4c;border-radius: 0;}
    button.mybutton:hover{color: #407b5c;background-color: #79cf13;}
    button.mybutton:active{color: #407b5c;background-color: #6dbb10;}
    button.mybutton:active:focus{color: #407b5c;}
    button.mybutton:focus{color: #407b5c;}
    #login-button{margin-top: 30px;}
    #register-button{margin-top: 10px;}
    label.word{font-size: 20px;}
    label.label-word{background-color: #FFFFFF;color: #189e68;font-size: 15px;}
    #content-before{margin-top: 30px;}
    #acc-word{margin-top: 20px;margin-bottom: 2px;}
    #pwd-word{margin-top: 10px;margin-bottom: 2px;}
    #again-word{margin-top: 10px;margin-bottom: 2px;}
    #sfz-word{margin-top: 10px;margin-bottom: 2px;}
    #name-word{margin-top: 10px;margin-bottom: 2px;}
    #tel-word{margin-top: 10px;margin-bottom: 2px;}
    div.textcenter{text-align: center;}
    #acc-label{margin-left: 40px;}
    #pwd-label{margin-left: 40px;}
    #again-label{margin-left: 40px;}
    #sfz-label{margin-left: 40px;}
    #name-label{margin-left: 40px;}
    #tel-label{margin-left: 40px;}
    #register-info{display: none;margin-top: 10px;}

    .red{color: #dd0000}
</style>

<div id="background"></div>
<!--<img id="logo" alt="喂车科技" src="/Public/Ip/img/IpLogo.png" />-->
<div id="loginpart">
    <div id="content-before"></div>
    <div id="word" class="textcenter">
        <label class="label word"><b>注册</b></label>
    </div>
    <div id="acc-word">
        <label id="acc-label" class="label label-default label-word" for="account">账号<span class="red">*</span></label>
    </div>
    <div id="acc-input" class="textcenter">
        <input id="account" type="text" class="myinput" placeholder="请输入账号" />
    </div>
    <div id="pwd-word">
        <label id="pwd-label" class="label label-default label-word" for="password">密码<span class="red">*</span></label>
    </div>
    <div id="pwd-input" class="textcenter">
        <input id="password" type="password" class="myinput" placeholder="请输入密码" />
    </div>
    <div id="again-word">
        <label id="again-label" class="label label-default label-word" for="repassword">确认密码<span class="red">*</span></label>
    </div>
    <div id="again-input" class="textcenter">
        <input id="repassword" type="password" class="myinput" placeholder="请确认密码" />
    </div>
    <div id="name-word">
        <label id="name-label" class="label label-default label-word" for="realname">真实姓名<span class="red">*</span></label>
    </div>
    <div id="name-input" class="textcenter">
        <input id="realname" type="text" class="myinput" placeholder="请输入真实姓名" />
    </div>
    <div id="sfz-word">
        <label id="sfz-label" class="label label-default label-word" for="sfz">身份证<span class="red">*</span></label>
    </div>
    <div id="sfz-input" class="textcenter">
        <input id="sfz" type="text" class="myinput" placeholder="请输入合法身份证号码" />
    </div>
    <div id="tel-word">
        <label id="tel-label" class="label label-default label-word" for="telephone">联系方式<span class="red">*</span></label>
    </div>
    <div id="tel-input" class="textcenter">
        <input id="telephone" type="text" class="myinput" placeholder="请输入有效联系方式" />
    </div>
    <div id="login-button" class="textcenter">
        <button id="login" type="button" class="mybutton btn"><a href="<?php echo U('User/login');?>">已有账号，点击登录</a></button>
    </div>
    <div id="register-button" class="textcenter">
        <button id="register" type="button" class="layui-bg-red mybutton btn">注册</button>
    </div>
    <div id="register-info" class="textcenter">
        <label id="info" class="label label-danger">注册失败</label>
    </div>
</div>


<script type="text/javascript">

    $("#loginpart").delay(300).velocity("transition.slideUpIn", {duration:1250});

    $('#register').click(function () {

        var acc = $('#account');
        var password = $('#password');
        var repassword = $('#repassword');
        var realname = $('#realname');
        var sfz = $('#sfz');
        var telephone = $('#telephone');

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

        if(acc.val() === ""){
            infoshow("账号不能为空");
            acc.focus();
            return;
        }

        if(password.val() === ""){
            infoshow("密码不能为空");
            password.focus();
            return;
        }

        if(repassword.val() !== password.val()){
            infoshow("确认密码错误");
            repassword.focus();
            return;
        }

        if(realname.val() === ""){
            infoshow("真实姓名不能为空");
            realname.focus();
            return;
        }

        if(sfz.val() === ""){
            infoshow("身份证不能为空");
            sfz.focus();
            return;
        }

        if(!IdentityCodeValid(sfz.val())){
            sfz.focus();
            return;
        }

        if(telephone.val() === ""){
            infoshow("联系方式不能为空");
            telephone.focus();
            return;
        }

        var isMobile=/^1[3578]\d{9}$|^147\d{8}$/; //手机号码验证规则
        if(telephone.val().length !== 11 || !isMobile.test(telephone.val())){
            infoshow("请输入有效的联系方式");
            telephone.focus();
            return;
        }
        $.ajax({
            type:'post',
            url:'<?php echo (C("view_url_base")); ?>/User/doRegister',
            dataType:'json',
            data:{
                acc:acc.val(),
                password:password.val(),
                realname:realname.val(),
                sfz:sfz.val(),
                telephone:telephone.val()
            },
            beforeSend:function(){
                layer.load(1, {shade: [0.3,'#000']});
            },
            success:function (result) {
                layer.closeAll('loading');
                if(result.status === 200){
                    layer.confirm(result.info +',是否前往登录页面',{
                        btn:['是的','取消'],//按钮
                        icon:1,
                        shift:2
                    },function () {
                        window.location.href = '<?php echo (C("view_url_base")); ?>/User/login'
                        })
                }
                else{
                    layer.msg(result.info,{icon:2,shift:6,offset:40,time:10e3});
                }
            },
            error:function () {
                layer.msg('系统错误！',{icon:5,shift:6,time:6e3});
                layer.closeAll('loading');
            }

        });


    });

    var infoshow = function(text){
        $("#register-info").velocity("finish");
        $("#info").html(text);
        $("#register-info").velocity({
            opacity: [1, 0]
        }, {
            display: "block",
            duration: 300,
            complete: function() {
                $("#register-info").velocity({
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