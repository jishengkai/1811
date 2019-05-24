<table border="1">
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
            <td><img src="{{config('app.img_url')}}{{$v->news_file}}" width="100"></td>
            <td><a href="javascript:;" class="del" n_id='{{$v->n_id}}'>删除</a>||
                <a href="edit?n_id={{$v->n_id}}">修改</a>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="8" align="center">{{$data->appends($query)->links()}}</td>
    </tr>

</table>