<form action="update" method="post">
	@csrf
	<table>
		<tr>
			<th>品牌名称</th>
			<th><input type="text" name="name" value="{{$res->name}}"></th>
		</tr>
		<tr>
			<th>品牌logo</th>
			<th><input type="file" name="logo" value="{{$res->logo}}"></th>
		</tr>
		<tr>
			<th>品牌网址</th>
			<th><input type="text" name="url" value="{{$res->url}}"></th>
		</tr>
		<tr>
			<th>品牌简介</th>
			<th><textarea name="desc">{{$res->desc}}</textarea></th>
		</tr>
		<tr>
			<th><button>修改</button></th>
		</tr>
	</table>
	<input type="hidden" name="id" value="{{$res->id}}">
</form>
