<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>商城主页</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    body{
        background: url("http://pic1.win4000.com/wallpaper/a/589d21f451e0b.jpg");
    }
</style>
<body>
<!--最外层的布局容器-->
<div class="container">
    <!--LOGO部分-->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-6" style="line-height: 50px;height: 50px; color: gold">
            欢迎登陆，{$nickname}
        </div>
        <div class="col-md-4 hidden-sm hidden-xs">
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6" style="line-height: 50px;height: 50px;">
            <a href="{:url('../../admin/buyercart/to_buyercart')}" style="color: gold">购物车</a>
            <a href="{:url('index/logout')}" style="color: gold">退出</a>
        </div>
    </div>

    <!--导航栏部分-->
    <nav class="navbar navbar-inverse" style="background: #eacdff; border: 0px;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{:url('index/index')}" style="color: black">首页</a>
                <div style="position: absolute; right: 10px" class="search_input_bar">
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <form action="{:url('goods/select_goods')}">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="搜索商品" name="goods_name">
        </div>
    </form>

    <!--商品部分-->
    <div class="row">
        <!--
            右边商品项部分
        -->
        <div class="col-md-12">

            <!-- 只显示数据库表中前12个商品 -->
            {volist name="goods" id="list"}

            <div class="col-md-2 col-sm-4 col-xs-4" style="text-align: center;height: 240px;">
                <a href="{:url('goods/show_goods_details?goods_id='.$list.goods_id)}" style="color: black">
                    <img src="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=113518992,3708350327&fm=26&gp=0.jpg" style="max-width: 80%;"/>
                </a>
                <p><a href="{:url('goods/show_goods_details?goods_id='.$list.goods_id)}" style="color: black">{$list.goods_name}</a></p>
                <p style="color: #fbfffb;">{$list.goods_price}</p>
            </div>

            {/volist}
            <div style="text-align: center; line-height: 100px;">{$goods|raw}</div>
        </div>
    </div>

</div>
</html>
