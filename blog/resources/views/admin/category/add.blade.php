<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>行家添加-有点</title>
    @include('layouts.layouts')
    <link rel="stylesheet" type="text/css" href="/css/css.css" />
    <script type="text/javascript" src="/js/jquery.min.js"></script>

</head>
<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;行家添加
        </div>
    </div>
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="banneradd bor">
            <div class="baTopNo">
                <span>行家添加</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;头像：
                    <div class="vipHead vipHead1">
                        <img src="/img/userPICS.png" />
                        <p class="vipP">更换头像</p>
                        <input class="file1" type="file" />
                    </div>
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分类名称：
                    <input type="text" name="cate_name" class="input3" id="cate_name" />
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;所属分类：
                    <select name="parent_id" class="input3" >
                        <option class="p_id" value="">请选择分类</option>
                        <option class="p_id" value="1">顶级分类</option>
                        <option class="p_id" value="2">电脑</option>
                        <option class="p_id" value="3">手机</option>
                        <option class="p_id" value="4">汽车</option>
                    </select>
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;关&nbsp;键&nbsp;词：
                    <input type="text" name="keywords" class="input3" id="keywords" />
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分类简介：
                    <div class="btext2">
                        <textarea name="desc"  id="desc" class="text2"></textarea>
                    </div>
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是否推荐：
                    <label><input type="radio" class="is_status" name="is_status" value="是"/>&nbsp;是</label>
                    <label><input type="radio" class="is_status" name="is_status" value="否"/>&nbsp;否</label>
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <button class="btn_ok btn_yes" href="category/doadd">提交</button>
                        <a class="btn_ok btn_no" href="#">取消</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- 上传广告页面样式end -->
    </div>
</div>
</body>
</html>
<script>
    $('.btn_ok').click(function(){
        //alert(11);
        var cate_name=$('#cate_name').val();
        var parent_id=$('.p_id:selected').val();
        var keywords=$('#keywords').val();
        var is_status=$('.is_status:checked').val();
        var desc=$('#desc').val();
        //console.log(cate_name);
        // console.log(parent_id);
        // console.log(parent_id);

        if(cate_name==''){
            alert('分类名称不能为空');
            return false;
        }

        if(parent_id==''){
            alert('所属分类不能为空');
            return false;
        }

        if(keywords==''){
            alert('关键字不能为空');
            return false;
        }
        if(desc==''){
            alert('分类简介不能为空');
            return false;
        }

        if(is_status==''){
            alert('状态不能为空');
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post(
            "{{'/category/doadd'}}",
            {cate_name:cate_name,parent_id:parent_id,keywords:keywords,desc:desc,is_status:is_status},
            function(res){
                // console.log(res);
                if(res.code==1){
                    location.href="/category/index";
                }
            },'json'
        )
    })
</script>
