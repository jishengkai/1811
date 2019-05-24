<!DOCTYPE html>
<html lang="zh-cn">
@include('index/index/title')
<body>
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>产品详情</h1>
        </div>
    </header>
    <div id="sliderA" class="slider">
        <img src="{{config('app.img_url')}}{{$res->goods_img}}" />
    </div><!--sliderA/-->
    <table class="jia-len">
        <tr>
            <th><strong class="shop_price">{{$res->shop_price}}</strong></th>
            <td>
{{--                <input type="text" class="spinnerExample" />--}}
                <div class="j_nums">
                    <input type="hidden" id="goods_number" value="{{$res->goods_number}}">
                    <input type="button" id="less" value="-" class="n_btn_2" />
                    <input type="text" value="1" id="buy_number"   class="n_ipt" />
                    <input type="button" id="add" value="+" class="n_btn_1" />
                </div>
                <input type="hidden" id="goods_id" value="{{$res->goods_id}}">
            </td>
        </tr>
    </table>
    <table>
        @foreach ($data as $v)
            <tr ><td><h5>用户评论:{{$v->g_name}}</h5></td></tr>
        <tr>
            <td>{{$v->g_email}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{{$v->g_dengji}}</td>
        </tr>
        <tr>
            <td>{{$v->g_desc}}</td>
            <td align="right">{{date('Y-m-d H:i:s',$v->created_at)}}</td>
        </tr>
        @endforeach
    </table>
    <div class="height2"></div>
    <h3 class="proTitle">商品规格</h3>
    <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
    </ul><!--guige/-->
    <div class="height2"></div>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品参数</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        <img src="{{config('app.img_url')}}{{$res->goods_img}}" width="636" height="822" />
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息....
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        <tr>
            <th>
                <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a href="javacript:;" id="addCart"  >加入购物车</a></td>
        </tr>
    </table>

    <form  width="100"  >
        <table >
            <tr>
                <td>用户名:</td>
                <td><input type="text" name="g_name" class="g_name"></td>
            </tr>
            <tr>
                <td>E_mail</td>
                <td><input type="text" name="g_email" class="g_email"></td>
            </tr>
            <tr>
                <td>评价等级:</td>
                <td >
                    <input type="radio" class="g_dengji" name="g_dengji" value="一星" >一星
                    <input type="radio" class="g_dengji" name="g_dengji" value="二星">二星
                    <input type="radio" class="g_dengji" name="g_dengji" value="三星">三星
                    <input type="radio" class="g_dengji" name="g_dengji" value="四星">四星
                    <input type="radio" class="g_dengji" name="g_dengji" value="五星" >五星
                </td>
            </tr>
            <tr>
                <td>评论内容</td>
                <td><textarea name="g_desc" class="g_desc" cols="60" rows="2"></textarea></td>
            </tr>
            <tr>
                <td><input type="button"  class="btn" value="提交评论"></td>
            </tr>
        </table>
    </form>
</div><!--maincont-->
<script>
    $(function () {
        $("#sliderA").excoloSlider();
    });
</script>

<!--jq加减-->
<script src="/js/jquery.spinner.js"></script>
<script>
    // $('.spinnerExample').spinner({});
    //点击加号
    $("#add").click(function(){
        var goods_number=$("#goods_number").val();
        var buy_number=parseInt($("#buy_number").val());
        // console.log(buy_number);
        if(buy_number>=goods_number){
            $("#buy_number").val(goods_number);
            //+按钮失效
            $(this).prop('disabled',true);
        }else{
            buy_number=buy_number+1;
            // console.log(buy_number);
            $("#buy_number").val(buy_number);
            //-生效
            $(this).next('input').prop('disabled',false)
        }
    });


    //点击减号
    $("#less").click(function(){
        var buy_number=parseInt($("#buy_number").val());
        // console.log(buy_number);
        if(buy_number<=1){
            $("#buy_number").val(1);
            //-按钮失效
            $(this).prop('disabled',true);
        }else{
            buy_number=buy_number-1;
            // console.log(buy_number);
            $("#buy_number").val(buy_number);
            //+生效
            $(this).prev('input').prop('disabled',false);
        }
    });


    //失去焦点
    $("#buy_number").blur(function(){
        var _this=$(this);
        var buy_number=_this.val();
        // console.log(buy_number);
        var goods_number=$("#goods_number").val();
        var reg=/^\d+$/;
        if(buy_number==''||buy_number<=1|| !reg.test(buy_number)){
            _this.val(1);
        }else if(buy_number>=goods_number){
            _this.val(goods_number);
        }else{
            buy_number=parseInt(buy_number);
            _this.val(buy_number);
        }
    });

    //加入购物车
    $("#addCart").click(function(){
        // alert(1111);
        var goods_id=$('#goods_id').val();
        var buy_number=$('#buy_number').val();
        var shop_price=$('.shop_price').text();
        // var shop1 = $('#id').val();
        // console.log(shop1);
        // return;
        $.post(
            "{{'/car/add'}}",
            {goods_id:goods_id,buy_number:buy_number},
            function(res){
                if(res.code == 1){
                    alert(res.font);
                    location.href="/car/index";
                }else if(res.code == 0){
                    alert(res.font);
                }else{
                    alert(res.font);
                    location.href = "/login/index";
                }
            },'json'
        );
    })


    //添加评论
    $('.btn').click(function(){
        var g_name=$('.g_name').val();
        var g_email=$('.g_email').val();
        var g_dengji=$('.g_dengji:checked').val();
        var g_desc=$('.g_desc').val();
        // console.log(g_name);
        // console.log(g_email);
        // console.log(g_dengji);
        // console.log(g_desc);

        $.post(
            "{{'/proinfo/pingLun'}}",
            {g_name:g_name,g_email:g_email,g_dengji:g_dengji,g_desc:g_desc},
            function(res){
                //console.log(res);
                if(res.code==1){
                    alert(res.font);
                    //location.href="go(0)";
                    history.go(0);
                }
            },'json'
        )


    })




</script>

</body>
</html>
