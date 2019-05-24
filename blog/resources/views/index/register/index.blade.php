<!DOCTYPE html>
<html lang="zh-cn">
@include('index/index/title');
<body>
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>会员注册</h1>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </header>
    <div class="head-top">
        <img src="/images/head.jpg" />
    </div><!--head-top/-->
    <form action="javascirpt:;" method="post" class="reg-login">
        <h3>已经有账号了？点此<a class="orange" href="/login/index">登陆</a></h3>
        <div class="lrBox">
            <div class="lrList"><input type="text" name="email" class="email"  placeholder="输入手机号码或者邮箱号" /></div>
            <div class="lrList2"><input type="text" name="code" class="code" placeholder="输入短信验证码" /> <button id="b_code">获取验证码</button></div>
            <div class="lrList"><input type="password" name="r_pwd" class="r_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
            <div class="lrList"><input type="password" name="repwd" class="re_pwd" placeholder="再次输入密码" /></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="button" class="btn" value="立即注册" />
        </div>
    </form><!--reg-login/-->
    <div class="height1"></div>
    @include('index/index/foot');
</div><!--maincont-->
</body>
</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#b_code').click(function(){
        // alert(123);
        var email=$('.email').val();
        var reg = /^\w+@\w+\.com$/;
        var reg2= /^1[34578]\d{9}$/;
        // console.log(email);

        if(email==''){
            alert('请填写手机号或邮箱号');
            return false;
        }

        //ajax验证唯一性
        var flag=true;
        if(reg2.test(email) || reg.test(email)){
            $.ajax({
                url:"{{('/register/check')}}",
                dataType:'json',
                data:{email:email},
                type:'post',
                async:false,
                success:function(res){
                    console.log(res);
                    if(res.count>=1){
                        alert('邮箱或手机号已存在');
                        flag=false;
                    }
                }
            });
            // return false;
        }else{
            alert('请输入正确的手机号或邮箱号格式');
            return false;
        }

        if(!flag){
            return;
        }

        //发送邮箱获取验证码
        $.post(
            "{{url('/register/sendEmail')}}",
                {email:email},
                function(res){
                    if(res.code==1){
                        alert(res.font);
                    }
                },'json'
        );

    });

    //点击注册
    $('.btn').click(function(){
        // alert(123);
        var email=$('.email').val();
        var code=$('.code').val();
        var r_pwd=$('.r_pwd').val();
        var re_pwd=$('.re_pwd').val();
        var reg1=/^\d{6,18}$/;
        // console.log(email);
        // console.log(code);
        // console.log(r_pwd);
        // console.log(re_pwd);
        if(code==''){
            alert('验证码不能为空');
            return false;
        }

        if(r_pwd==''){
            alert('密码不能为空');
            return false;
        }else if(!reg1.test(r_pwd)){
            alert('密码必须数字字母有6-18位组成');
            return false;
        }

        if(re_pwd==''){
            alert('确认密码不能为空');
            return false;
        }else if(r_pwd!=re_pwd){
            alert('密码与确认密码不一致');
        }

        //ajax验证唯一性
        var flag=true;
        $.ajax({
            url:"{{('/register/check')}}",
            dataType:'json',
            data:{email:email},
            type:'post',
            async:false,
            success:function(res){
                console.log(res);
                if(res.count>=1){
                    alert('邮箱或手机号已存在');
                    flag=false;
                }
            }
        });
        if(!flag){
            return;
        }

        $.post(
            "{{'/register/add_do'}}",
            {email:email,r_pwd:r_pwd,code:code},
            function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.font);
                    location.href="{{'/login/index'}}";
                }
            },'json'
        )
    });
</script>

