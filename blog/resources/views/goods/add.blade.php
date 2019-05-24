<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部-有点</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css" />
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    {{--    <script src="/js/layui.js"></script>--}}
</head>
<body>
<form action="javasacript:" method="post">
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
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
        </div>
    </div>
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <meta name="_token" content="{{ csrf_token() }}"/>
        <div class="goodsadd bor">
            <div class="baTop">
                <span>上传广告</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    商品名称：<input type="text" name="goods_name" class="goods_name" />
                </div>
                <div class="bbD">
                    商品价格：<input type="text" name="goods_price" class="goods_price" />
                </div>
                <div class="bbD">
                    商品数量：<input type="text" name="goods_number" class="goods_number" />
                </div>
                <div class="bbD">
                    商品分类：<select name="brand_id" id="">
                                <option value="电脑">电脑</option>
                                <option value="手机">手机</option>
                            </select>
                </div>
                <div class="bbD">
                    商品图片：
                    <div class="bbDd">
                        <div class="bbDImg">+</div>
                        <input type="file" name="goods_img" class="goods_file" />
                    </div>
                </div>
                <div class="bbD">
                    是否显示：<label><input type="radio" name="is_on_sale" value="1" checked="checked" />是</label>
                    <label><input type="radio" name="is_on_sale" value="2" />否</label>
                </div>

                <div class="bbD">
                    <p class="bbDP">
                        <button  class="goods">提交</button>
                    </p>
                </div>
            </div>
        </div>

        <!-- 上传广告页面样式end -->
    </div>
</div>
</form>
</body>
</html>

<script>
    $(function(){
        $('.goods').click(function() {
                    // alert(111);
                    var goods_name = $('.goods_name').val();
                    var goods_price = $('.goods_price').val();
                    var goods_number = $('.goods_number').val();
                    var brand_id = $('.brand_id').val();
                    var goods_file = $('.goods_file').val();
                    // var fd=new FormData($('#pageAll'));
                    // console.log(goods_file);
                    if (goods_name == "") {
                        alert("商品名称不能为空");
                        return false;
                    }
                    if (goods_price == "") {
                        alert('商品价格不能为空');
                        return false;
                    }
                    if (goods_number == "") {
                        alert('商品数量不能为空');
                        return false;
                    }
                    if(goods_file==""){
                        alert('商品图片不能为空');
                        return false;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                    });

                    $.post(
                        "{{url('/goods/doadd')}}",
                        {goods_name:goods_name,goods_price:goods_price,goods_number:goods_number,goods_file:goods_file,brand_id:brand_id},
                        // {fd},
                        // processData: false,
                        // contentType: false,
                        function(res){
                             // console.log(res);
                            if (res.code == 1){
                                window.location.href='/goods/index';
                            } else{
                                alert('添加失败');
                            }

                        },
                        'json',
                    )
        });

        })
</script>