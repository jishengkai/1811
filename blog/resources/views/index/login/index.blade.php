
@include('index/index/title');
<body>
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>会员注册</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/images/head.jpg" />
    </div><!--head-top/-->
    <form action="javacript:;" method="post" class="reg-login">
        <h3>还没有三级分销账号？点此<a class="orange" href="/register/index">注册</a></h3>
        <div class="lrBox">
            <div class="lrList"><input type="text" name="email" class="email" placeholder="输入手机号码或者邮箱号" /></div>
            <div class="lrList"><input type="text" name="r_pwd" class="r_pwd" placeholder="输入密码" /></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="button" class="btn" value="立即登录" />
        </div>
    </form><!--reg-login/-->
    <div class="height1"></div>
    @include('index/index/foot');
</div><!--maincont-->
<script>
    $('.btn').click(function(){
        //alert(31);
        var email=$('.email').val();
        var r_pwd=$('.r_pwd').val();
        if(email==''){
            alert('手机号码或者邮箱号不能为空');
            return false;
        }

        if(r_pwd==''){
            alert('验证码不能为空');
            return false;
        }

        $.post(
            "{{'/login/loginDo'}}",
            {email:email,r_pwd:r_pwd},
            function(res){
                // console.log(res);
                alert(res.font);
                if(res.code==1){
                    location.href="{{'/index/index'}}";
                }
            },'json'
        )
    });
</script>

