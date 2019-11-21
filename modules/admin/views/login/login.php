<?= $this->render('../layouts/include.php'); $this->title = "登录" ?>
<style>
    img{
        width:200px;height:200px;
    }
</style>
<title><?= $this->title?></title>
<body class="gray-bg" style="background-image:('/images/log.jpg') ">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div style="margin-top:50%;">
        <div class=""><h1 class="logo-name"><img src="/images/head.jpg" alt="" class="img-circle"></h1></div>
        <form class="m-t" role="form" id="form">
            <div class="form-group">
                <input type="text" class="form-control"  name="username"  placeholder="用户名" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="密码" required="">
            </div>
            <input name="_csrf" type="hidden" id="_csrf" value="<?=Yii::$app->request->csrfToken ?>">
            <button type="button" class="btn btn-primary block full-width m-b" onclick="login()" >登 录</button>
            <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
            </p>
        </form>
    </div>
</div>
<script>
    function login() {
        layui.use('layer', function(){
            var layer = layui.layer;
            $.ajax({
                url: '<?= \Yii::$app->urlManager->createUrl(['admin/login/login'])?>',
                data:$("#form").serialize(),
                type:'POST',
                success:function(data){
                        layer.msg(data.code);
                },
                error:function(){
                    console.log("提交ajax函数异常");
                },
            });
        });
    }
</script>

