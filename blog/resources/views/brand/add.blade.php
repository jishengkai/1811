<form action="doadd" method="post" enctype="multipart/form-data">
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
			<tr>
				<th>品牌名称</th>
				<th><input type="text" name="name"></th>
			</tr>
			<tr>
				<th>品牌logo</th>
				<th><input type="file" name="logo"></th>
			</tr>
			<tr>
				<th>品牌网址</th>
				<th><input type="text" name="url"></th>
			</tr>
			<tr>
				<th>品牌简介</th>
				<th><textarea name="desc"></textarea></th>
			</tr>
			<tr>
				<th><button>提交</button></th>
			</tr>
		</table>
</form>
