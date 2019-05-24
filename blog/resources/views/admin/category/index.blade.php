<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>行家-有点</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css" />
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/page.css">
    <!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
        </div>
    </div>

    <div class="page">
        <!-- banner页面样式 -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="connoisseur">
            <div class="conform">
                <form>

                    <div class="cfD">
                        <input class="addUser" type="text" name="cate_name" placeholder="输入分类名称" />
                        <button class="button">搜索</button>
                        <a class="addA addA1" href="connoisseuradd.html">添加分类</a>
                    </div>
                </form>
            </div>
            <!-- banner 表格 显示 -->
            <div class="conShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66px" class="tdColor tdC">序号</td>
                        <td width="135px" class="tdColor">分类名称</td>
                        <td width="145px" class="tdColor">所属分类</td>
                        <td width="140px" class="tdColor">关键词</td>
                        <td width="140px" class="tdColor">分类简介</td>
                        <td width="150px" class="tdColor">是否推荐</td>
                        <td width="130px" class="tdColor">操作</td>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td>{{$v->cate_id}}</td>
                        <td>{{$v->cate_name}}</td>
                        <td>{{$v->parent_id}}</td>
                        <td>{{$v->keywords}}</td>
                        <td>{{$v->desc}}</td>
                        <td>@if($v->is_status=='是')
                                是
                            @else
                                否
                            @endif
                        </td>
                        <td>
                            <a href="edit?cate_id={{$v->cate_id}}"><img src="/img/update.png"></a>
                            <a href="javascript:;"><img class="del" cate_id='{{$v->cate_id}}' src="/img/delete.png"></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{$data->appends($query)->links()}}
            </div>
            <!-- banner 表格 显示 end-->
        </div>
        <!-- banner页面样式end -->
    </div>
</div>
<script>
    $('.del').click(function(){
        var _this=$(this);
        var cate_id=_this.attr('cate_id');
        // console.log(cate_id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post(
            "{{'/category/del'}}",
            {cate_id:cate_id},
            function(res){
                //console.log(res);
                if(res.code==1){
                    location.href="/category/del";
                }
            }
        )
    })
</script>


