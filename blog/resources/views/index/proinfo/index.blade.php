<!DOCTYPE html>
<html lang="zh-cn">
@include('index/index/title');
<body>
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <form action="#" method="get" class="prosearch"><input type="text" /></form>
        </div>
    </header>
    <ul class="pro-select">
        <li class="pro-selCur"><a href="javascript:;">新品</a></li>
        <li><a href="javascript:;">销量</a></li>
        <li><a href="javascript:;">价格</a></li>
    </ul><!--pro-select/-->
    <div class="prolist">
        @foreach ($res as $v)
        <dl>
            <dt><a href="/proinfo/detail/{{$v->goods_id}}"><img src="{{config('app.img_url')}}{{$v->goods_img}}" width="300" height="200" /></a></dt>
            <dd>
                <h3><a href="/proinfo/detail/{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
                <div class="prolist-price"><strong>¥{{$v->shop_price}}</strong> <span>¥599</span></div>
                <div class="prolist-yishou"><span>5.0折</span> <em>商品数量：{{$v->goods_number}}</em></div>
            </dd>

        </dl>
        @endforeach
    </div><!--prolist/-->
    <div class="height1"></div>
    @include('index/index/foot');
</div><!--maincont-->

<script>
    $(function () {
        $("#sliderA").excoloSlider();
    });
</script>
</body>
</html>

