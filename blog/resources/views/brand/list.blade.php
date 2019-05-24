<link rel="stylesheet" href="{{asset('css/page.css')}}">
<form align="center">
	<input type="text" name="name" value="{{$query['name']??''}}" placeholder="请输入关键字" >
	<input type="text" name="url" value="{{$query['url']??''}}" placeholder="请输入关键字" >
	<button>搜索</button>
</form>
<table border=1 align="center">
	<tr>
		<td>品牌id</td>
		<td>品牌名称</td>
		<td>品牌logo</td>
		<td>品牌网址</td>
		<td>品牌简介</td>
		<td>操作</td>
	</tr>
	
	@foreach($data as $v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td><img src="{{config('app.img_url')}}{{$v->logo}}" width="100"></td>
		<td>{{$v->url}}</td>
		<td>{{$v->desc}}</td>
		<td><a href="del?id={{$v->id}}">删除</a>||<a href="edit?id={{$v->id}}">修改</a></td>
	</tr>
	@endforeach
	<tr>
		<td colspan="6" align="center" border=0>{{$data->appends($query)->links()}}</td>
	</tr>
</table>