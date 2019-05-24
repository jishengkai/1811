<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品展示</title>
    <link rel="stylesheet" href="{{asset('css/page.css')}}">
</head>
<body>
<form action="" align="center">
    <input type="text" name="goods_name" placeholder="请输入关键字">
    <input type="text" name="brand_id" placeholder="请输入关键字">
    <button>搜索</button>
</form>
    <table border="1" align="center">
        <tr>
            <td>商品id</td>
            <td>商品名称</td>
            <td>商品价格</td>
            <td>商品数量</td>
            <td>商品分类</td>
            <td>商品图片</td>
            <td>操作</td>
        </tr>
        @foreach($res as $v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_number}}</td>
            <td>{{$v->brand_id}}</td>
            <td>{{$v->goods_img}}</td>
            <td><a href="">删除</a>||<a href="">修改</a></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7" align="center">{{$res->appends($query)->links()}}</td>
        </tr>
    </table>
</body>
</html>
