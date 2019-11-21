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
                <input type="text" class="form-control" id="username"  name="username"  placeholder="管理员用户名" required=""  value="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password"  name="password" placeholder="管理员密码" required="" value="" >
            </div>
            <input name="_csrf" type="hidden" id="_csrf" value="<?=Yii::$app->request->csrfToken ?>">
            <button type="button" class="btn btn-primary block full-width m-b" onclick="login()" >登 录</button>
            <p class="text-muted text-center" onclick="register()"> <a ><small>忘记密码了？</small></a> | <a >注册一个新账号</a>
            </p>
        </form>
    </div>
</div>
<script>
    function login() {
        layui.use('layer', function(){
            var layer = layui.layer;
            //检查为空操作
            if( !$('#username').val() || !$('#password').val() ){
                layer.msg('请检查输入的内容不能为空');
                return false;
            }else{
                $.ajax({
                    url: '<?= \Yii::$app->urlManager->createUrl(['admin/login/login'])?>',
                    data:$("#form").serialize(),
                    type:'POST',
                    dataType: 'json',
                    success:function(data){
                        if(data.code = 200){
                            layer.open({
                                content:data.msg,
                                icon:1,
                                success: function(){
                                   setTimeout(function(){
                                       window.location.href="<?= \Yii::$app->urlManager->createUrl(['admin/index/index'])?>";
                                   },1000)
                                }
                            });
                        }
                    },
                    error:function(){
                        console.log("提交ajax函数异常");
                    },
                });
            }
        });
    }
    function register(){
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.msg('请联系管理员！');
        });
    }
</script>

