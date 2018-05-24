<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"/www/wwwroot/crm.yuanhang.org/template/business/index_index.html";i:1525744919;}*/ ?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="renderer" content="webkit"> 	
    <title>POSCRM-登陆</title>
    <link rel="stylesheet" type="text/css" href="//crm.yuanhang.org/public/static/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="//crm.yuanhang.org/public/static/css/login.css">
    <script type="text/javascript" src="//crm.yuanhang.org/public/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="//crm.yuanhang.org/public/static/layui/layui.js"></script>
</head>
<body class="login_bg">
    <div class="login_from">
        <div class="login_title">
            <h1>欢迎登录POSCRM</h1>
        </div>
        <form class="layui-form" id="doLogin" action="#" method="post">
            <div class="form_group">
                <input class="layui-input" id="username" type="text" value="" name="username" placeholder="请输入账号">
                <span class="errorinfo">请您输入用户名</span>
            </div>
            <div class="form_group">
                <input class="layui-input" id="password" type="password" value="" name="password" placeholder="请输入密码">
                <span class="errorinfo">密码不能为空</span>
            </div>
			<button class="layui-btn" lay-submit lay-filter="form">登 录</button>
        </form>
        <p class="copyright">Powered by <a href="#" target="_blank">POSCRM</a></p>
    </div>

    <script>
        layui.use('form', function(){
			var form = layui.form;
            var verify = function (obj) {
                obj.addClass('layui-form-danger')
                    .focus()
                    .one('input',function () {
                        obj.removeClass('layui-form-danger').next('span').fadeOut();
                    })
                    .next('span').slideDown('fast');
            }
            form.on('submit(form)', function(data){
                var input = $(data.form).find('input');
                for(var i=0;i<input.length;i++){
                    var t = input.eq(i);
                    if(t.val() == ''){
                        verify(t);
                        return false;
                    }
                }
				$.ajax({
                    url:'<?php echo url('index/dologin'); ?>',
					type:'POST',
                    data:$('#doLogin').serialize(),
                    dataType:"json",
                    error:function(data){
                        common.layerAlertE('链接错误！', '提示');
                    },
                    success:function(data){
                        if(data.code==1){
                            layer.msg(data.msg, {icon: 6,time:1000}, function(index){
                                layer.close(index);
                                window.location.href = data.data;
                            });
                        }else{
                            layer.msg(data.msg, {icon: 5,time:2000});
                            return false;
                        }
                    }
                });
                return false;
            });
        });
    </script>
</body>
</html>