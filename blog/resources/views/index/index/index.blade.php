<!DOCTYPE html>
<html lang="zh-cn">
@include('index/index/title')
<body>
<div class="maincont">
    <div class="head-top">
        <img src="/images/head.jpg" />
        <dl>
            <dt><a href="user.html"><img src="/images/touxiang.jpg" /></a></dt>
            <dd>
                <h1 class="username">{{$email}}</h1>
                <ul>
                    <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
                    <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
                    <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
                    <div class="clearfix"></div>
                </ul>
            </dd>
            <div class="clearfix"></div>
        </dl>
    </div><!--head-top/-->
    <form action="#" method="get" class="search">
        <input type="text" class="seaText fl" />
        <input type="submit" value="搜索" class="seaSub fr" />
    </form><!--search/-->
    @if($email!="请登录")
        <marquee><h3 >欢迎{{$email}}到来</h3></marquee>
    @else
    <ul class="reg-login-click">
        <li><a href="/login/index">登录</a></li>
        <li><a href="/register/index" class="rlbg">注册</a></li>
        <div class="clearfix"></div>
    </ul><!--reg-login-click/-->
    @endif
    <div id="sliderA" class="slider">
        @foreach ($res as $v)
        <img src="{{config('app.img_url')}}{{$v->goods_img}}" />
        @endforeach
    </div><!--sliderA/-->
    <ul class="pronav">
        @foreach ($res as $v)
        <li><a href="">{{$v->goods_name}}</a></li>
        @endforeach
    </ul><!--pronav/-->
    <div class="index-pro1">
        @foreach ($res as $v)
        <div class="index-pro1-list">
            <dl>
                <dt><a href="/proinfo/detail/{{$v->goods_id}}"><img src="{{config('app.img_url')}}{{$v->goods_img}}" /></a></dt>
                <dd class="ip-text"><a href="/proinfo/detail/{{$v->goods_id}}">{{$v->goods_name}}</a><span>商品数量：{{$v->goods_number}}</span></dd>
                <dd class="ip-price"><strong>{{$v->shop_price}}</strong> <span>¥599</span></dd>
            </dl>
        </div>
        @endforeach
    </div><!--index-pro1/-->
    <div class="prolist">
        @foreach ($res as $v)
        <dl>
            <dt><a href="/proinfo/detail/{{$v->goods_id}}"><img src="{{config('app.img_url')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
            <dd>
                <h3><a href="/proinfo/detail/{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
                <div class="prolist-price"><strong>¥{{$v->shop_price}}</strong> <span>¥599</span></div>
                <div class="prolist-yishou"><span>5.0折</span> <em>商品数量：{{$v->goods_number}}</em></div>
            </dd>
            <div class="clearfix"></div>
        </dl>
        @endforeach
    </div><!--prolist/-->
    <div class="joins"><a href="fenxiao.html"><img src="/images/jrwm.jpg" /></a></div>
    <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/login/index">退出</a></div>
    <div class="height1"></div>

    @include('index/index/foot')
</div><!--maincont-->

<script>
    $(function () {
        $("#sliderA").excoloSlider();
    });
</script>
</body>
</html>