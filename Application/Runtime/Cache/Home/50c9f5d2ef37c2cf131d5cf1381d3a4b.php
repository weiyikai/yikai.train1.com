<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1><button id="B1">登录</button></h1>
</body>
</html>

<script>
    $('#B1').click(function () {
        $.post('<?php echo (C("view_url_base")); ?>/Login/doLogin',
            {
                data:{
                    username6:1
                }
            },
            function (result,status) {
                if(result === ""){
                    alert(123);
                    return;
                }
                // alert(456);
                window.location.href = result;
            },
            "text"
        );
    })
</script>