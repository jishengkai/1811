<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文章修改</title>
</head>
<body>
<form action="/news/update" method="post" enctype="multipart/form-data">
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
        <input type="hidden" name="n_id" value="{{$res->n_id}}">
    <table>
        <p>
            文章标题
            <input type="text" name="n_name" class="n_name" value="{{$res->n_name}}">
        </p>
        <p>
            文章分类
            <select name="c_id"  class="c_id" >
                @foreach ($c as $v)
                    <option value='{{$v->c_id}}' @if($res->c_id==$v->c_id) selected @endif >@php echo str_repeat('&nbsp;&nbsp;',$v->level) @endphp {{$v->c_name}}</option>
                @endforeach
            </select>
        </p>
        <p>
            文章重要性
            <input type="radio" name="n_zhong" value="2"  class="n_zhong" @if($res->n_zhong==2) checked @endif />普通
            <input type="radio" name="n_zhong" value="1" class="n_zhong" @if($res->n_zhong==1) checked @endif />置顶
        </p>
        <p>
            是否显示
            <input type="radio" name="n_status" value="√"  class="n_status" @if($res->n_status=='√') checked @endif />√
            <input type="radio" name="n_status" value="×" class="n_status" @if($res->n_status=='×') checked @endif />×
        </p>
        <p>
            文章作者
            <input type="text" name="n_auther" class="n_auther" value="{{$res->n_auther}}" >
        </p>
        <p>
            作者email
            <input type="email" name="n_email" class="n_email" value="{{$res->n_email}}">
        </p>
        <p>
            关键字
            <input type="text" name="n_guan" class="n_guan" value="{{$res->n_guan}}">
        </p>
        <p>
            网页描述
            <textarea name="n_desc" id="" cols="30" rows="10" class="n_desc">{{$res->n_id}}</textarea>
        </p>
        <p>
            上传文件
            <input type="file" name="news_file" class="news_file" value="{{$res->news_file}}">
        </p>
        <p>
            <input type="submit" class="sub" value="修改">
        </p>
    </table>
</form>
</body>
</html>
<script src="/js/jquery-3.3.1.min.js"></script>
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
            if(n_zhong!=2 && n_zhong!=1){
                alert('文章重要性不能为空');
                return false;
            }
            if(n_status!='√' && n_status!='×'){
                alert('是否显示不能为空');
                return false;
            }
        })
    });
</script>
