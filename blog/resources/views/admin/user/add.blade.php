
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员注册-有点</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css" />
    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<form action="">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;会员注册
        </div>
    </div>
    <div class="page ">
        <!-- 会员注册页面样式 -->
        <meta name="_token" content="{{ csrf_token() }}"/>
        <div class="banneradd bor">
            <div class="baTopNo">
                <span>会员注册</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    用户名：<input type="text" name="user_name" class="user_name" />
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;密码：<input type="password" name="user_pwd" class="user_pwd" />
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;确认密码：<input type="password" name="user_repwd" class="user_repwd" />
                </div>

                <div class="bbD">
                    <p class="bbDP">
                        <a class="btn_ok btn_yes" id="submit">提交</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- 会员注册页面样式end -->
    </div>
</div>
</form>
</body>
</html>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
        });
       $('#submit').click(function(){
         var user_name=$('.user_name').val();
         var user_pwd=$('.user_pwd').val();
         var user_repwd=$('.user_repwd').val();
         // console.log(user_pwd);

           if(user_name==""){
               alert('用户名必填');
               return false;
           }

           if(user_pwd==""){
               alert('用户密码必填');
               return false;
           }else if(user_pwd!=user_repwd){
               alert('用户密码与确认密码不能一致');
               return false;
           }else if(user_pwd.length!=6){
               alert('密码必须为6位');
               return false;
           }

           if(user_repwd==""){
               alert('确认密码必填');
               return false;
           }

            var falg = false;
            $.ajax({
               url:"{{url('/user/unique')}}",
               data:{user_name:user_name},
               type:'post',
               dataType:'json',
                async:true,
               success:function (res) {
                   if(res.code == 0){

                       $.post(
                           "{{url('/user/doadd')}}",
                           {user_name:user_name,user_pwd:user_pwd,user_repwd:user_repwd},
                           function(res){
                               // console.log(res);
                               if(res.code==1){
                                   location.href="/user/index";
                               }else{
                                   alert('添加失败');
                               }
                           },'json'
                       )

                   }
               }
           })

       });
    });
</script>