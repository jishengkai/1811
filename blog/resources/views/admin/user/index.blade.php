
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员管理-有点</title>
    <link rel="stylesheet" type="text/css" href="/css/css.css" />

    <link rel="stylesheet" href="{{asset('css/page.css')}}"/>
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
        <!-- vip页面样式 -->
        <div class="vip">
            <div class="conform">
                <form>
                    <div class="cfD">
                        <input class="addUser" name="user_name" type="text" placeholder="输入用户名" />
                        <button class="button">搜索</button>
                        <a class="addA addA1" href="/user/add">管理员添加</a>

                    </div>
                </form>
            </div>
            <!-- vip 表格 显示 -->
            <div class="conShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66px" class="tdColor tdC">id</td>
                        <td width="150px" class="tdColor">用户名称</td>
                        <td width="150px" class="tdColor">注册时间</td>
                        <td width="130px" class="tdColor">操作</td>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td>{{$v->user_id}}</td>
                        <td>{{$v->user_name}}</td>
                        <td>{{$v->created_at}}</td>
                        <td><a href=""><img class="operation" src="/img/update.png"></a>
                                <img class="operation" src="/img/delete.png">
                        </td>
                    </tr>
                    @endforeach

                </table>
                {{$data->appends($query)->links()}}
            </div>

        </div>
        <!-- vip页面样式end -->
    </div>

</div>


<!-- 删除弹出框 -->
<div class="banDel">
    <div class="delete">
        <div class="close">
            <a><img src="/img/shanchu.png" /></a>
        </div>
        <p class="delP">你确定要删除此条记录吗？</p>
        <p class="delP2">
            <a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
        </p>
    </div>
</div>
<!-- 删除弹出框  end-->
</body>
