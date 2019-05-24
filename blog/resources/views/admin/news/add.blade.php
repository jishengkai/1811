<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文章添加</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<form action="/news/doadd" method="post" enctype="multipart/form-data" class="submits" >
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @csrf

    <table>
        <p>
            文章标题
            <input type="text" name="n_name" class="n_name">
        </p>
        <p>
            文章分类
            <select name="c_id"  class="c_id">
                @foreach ($res as $v)
                <option value='{{$v->c_id}}'>{{$v->c_name}}</option>
                @endforeach
            </select>
        </p>
        <p>
            文章重要性
            <input type="radio" name="n_zhong" value="2"  class="n_zhong">普通
            <input type="radio" name="n_zhong" value="1" class="n_zhong">置顶
        </p>
        <p>
            是否显示
            <input type="radio" name="n_status" value="√"  class="n_status">√
            <input type="radio" name="n_status" value="×" class="n_status">×
        </p>
        <p>
            文章作者
            <input type="text" name="n_auther" class="n_auther" >
        </p>
        <p>
            作者email
            <input type="email" name="n_email" class="n_email">
        </p>
        <p>
            关键字
            <input type="text" name="n_guan" class="n_guan">
        </p>
        <p>
            网页描述
            <textarea name="n_desc" id="" cols="30" rows="10" class="n_desc"></textarea>
        </p>
        <p>
            上传文件
            <input type="file" name="news_file" class="news_file">
        </p>
        <p>
            <input type="button" class="sub" value="提交">
        </p>
    </table>
</form>
</body>
</html>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script>
    $(function(){
        $('.sub').click(function(){
            // alert(12);die;
            var n_name=$('.n_name').val();
            // var c_id=$('.c_id').val();
            var n_zhong=$('.n_zhong:checked').val();
            var n_status=$('.n_status:checked').val();
            // console.log(n_name);
            // console.log(n_zhong);
            // console.log(n_status);die;

            if(n_name==''){
                alert('文章标题不能为空');
                return false;
            }
            // alert(111);
            if(n_zhong!=1 && n_zhong!=2){
                alert('文章重要性不能为空');
                return false;
            }
            if(n_status!='√' && n_status!='×'){
                alert('是否显示不能为空');
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //ajax提交名称唯一性
            var flag=true;
            $.ajax({
                url:"{{url('/news/check')}}",
                data:{n_name:n_name},
                type:'post',
                dataType:'json',
                async:false,
                success:function(res){
                    // console.log(res);
                    if(res.count){
                        // console.log(res.count);
                        alert('文章名称已存在');
                        flag=false;
                    }
                }
            });

            if(!flag){
                return;
            }
            // return false;


            $('.submits').submit();

        })
    });
</script>
