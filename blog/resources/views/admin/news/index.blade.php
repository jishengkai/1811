<link rel="stylesheet" href="/css/page.css">
<form action="" >
    <select name="c_id">
        @foreach($res as $v)
        <option value="{{$v->c_id}}">{{$v->c_name}}</option>
        @endforeach
    </select>
    <input type="text" name="n_name" placeholder="请输入标题名称">
    <button>搜索</button>
</form>
<div  id="con">
<table border="1" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <tr>
        <td>序号</td>
        <td>文章标题</td>
        <td>文章分类</td>
        <td>文章重要性</td>
        <td>是否显示</td>
        <td>添加日期</td>
        <td>上传图片</td>
        <td>操作</td>
    </tr>
    @foreach ($data as $v)
    <tr>
        <td>{{$v->n_id}}</td>
        <td>{{$v->n_name}}</td>
        <td>{{$v->c_name}}</td>
        <td>
            @if($v->n_zhong==1)
                置顶
            @else
                普通
            @endif
        </td>
        <td>
            @if($v->n_status=='√')
                √
            @else
                ×
            @endif
        </td>
        <td>{{date('Y-m-d H:i:s',$v->created_at)}}</td>
        <td><a href="/news/detail/{{$v->n_id}}"><img src="{{config('app.img_url')}}{{$v->news_file}}" width="100"></a></td>
        <td><a href="javascript:;" class="del" n_id='{{$v->n_id}}'>删除</a>||
            <a href="edit?n_id={{$v->n_id}}">修改</a>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="8" align="center">{{$data->appends($query)->links()}}</td>
    </tr>
</table>
</div>
<script src="/js/jquery-3.3.1.min.js"></script>
<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //ajax删除
        $('.del').click(function(){
            var _this=$(this);
            var n_id=_this.attr('n_id');
            // alert(n_id);

            $.post(
                "/news/del",
                {n_id:n_id},
                function(res){
                    // console.log(res);
                    if(res.code==1){
                        alert(res.font);
                        //本页面刷新
                        window.location.reload();
                    }
                },'json'
            )
        });

        //ajax分页
       $(document).on('click','.pagination a',function(){
           var url=$(this).attr('href');
           //alert(url);
           $.ajax({
              url:url,
              success:function(res){
                  // alert(res);
                 $('#con').html(res);
              }
           });
           return false;
       })


</script>
