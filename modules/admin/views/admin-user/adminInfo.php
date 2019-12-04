<?= $this->render('../layouts/include.php'); $this->title = "个人资料" ?>
<style>
    img{
        width:200px;height:200px;
        border: 1px dashed gray;
    }
    h2{margin-top:10px; }
</style>
<title><?= $this->title?></title>
<body class="gray-bg" style="background-image:('/images/log.jpg') ">
<div class="contact" >
    <div class="col-sm-4 col-sm-offset-4" style="margin-top: 5%;">
        <div class="layui-card">
            <div class="layui-card-header font-bold">个人资料 <span class="pull-right"><?= $data['username'] ?></span> </div>
            <div class="layui-card-body text-center">
                <p><img id="headImg" class="img-circle" src="<?= $data['head']?>" alt=""></p>
                 <input class="layui-btn-xs"  id="img" onchange="changeHead(this)" name="head" value="更换头像" type="file" >
                <hr>
                <form  class="layui-form" id="form">
                    <div class="layui-row">
                        <div class="layui-col-md12" style="padding-bottom:1%;" >
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="padding-left: 0px;">用户昵称:</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username"    placeholder="请输入新的昵称" autocomplete="off" class="layui-input" value="<?= $data['username']?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="padding-left: 0px;">绑定手机:</label>
                                <div class="layui-input-block">
                                    <input type="text" name="mobile"    placeholder="请输入新的联系方式" autocomplete="off" class="layui-input" value="<?= $data['mobile']?>">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="padding-left: 0px;">登录密码:</label>
                                <div class="layui-input-block">
                                    <input type="password" name="password"   placeholder="请输入新的密码" autocomplete="off" class="layui-input" >
                                </div>
                            </div>
                            <input type="hidden" id="head" name="head" value="<?= $data['head'] ?>" >
                            <input type="hidden" name="id" value="<?= $data['id']?>">
                        </div>
                        <div class="layui-col-md12">
                            <input class="layui-btn layui-btn-fluid layui-btn-sm" onclick="sure()" type="button" value="提交">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function changeHead(obj){
        // 上传图片
        var fd = new FormData();
        fd.append("img", document.getElementById("img").files[0]);
        $.ajax({
            url: '<?= \Yii::$app->urlManager->createUrl(['admin/admin-user/upload'])?>',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            success:function(data){
                if(data){
                    $("#headImg").attr('src',data.url);
                    $("#head").val(data.url);
                }
            },
            dataType:"json"
        })
    }
    function sure(){
        $.ajax({
            url: '<?= \Yii::$app->urlManager->createUrl(['admin/admin-user/edit'])?>',
            type:"post",
            data:$("#form").serialize(),
            success:function(data){
                layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.open({
                            content:data.msg,
                            icon:1,
                            success: function(){
                                setTimeout(function(){
                                    // window.location.href = window.location.host+'/admin/index/index';
                                    window.location.reload();
                                },1000)
                            }
                        });
                });
            },
            dataType:"json"
        })
    }
</script>

