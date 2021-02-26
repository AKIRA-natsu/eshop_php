<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>商品详情</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    body{
        background: url("http://pic1.win4000.com/wallpaper/a/589d21f451e0b.jpg");
    }
    .search_input_bar .search_input{
        border: 1px solid #DBDBDB;
        border-radius: 2px 0 0 2px;
        height: 30px;
        width: 220px;
        line-height: 30px;
        padding: 0 10px;
        box-sizing: border-box;
        vertical-align: top;
    }
    .search_input_bar .search_btn{
        background: #E62E2E;
        border: 0;
        border-radius: 0 2px 2px 0;
        height: 30px;
        width: 100px;
        color: #FFB3B3;
        vertical-align: top;
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
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                        onclick="location.href='{:url(\'goods/select_goods\')}'" style="border: 0px">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{:url('index/index')}" style="color: black">首页</a>
            </div>
        </div>
    </nav>

    <!--商品部分-->
    <div class="row">
        <!--
            右边商品项部分
        -->
        <div class="col-md-10">
            <h1><a href="{:url('goods/show_store_goods?store_id='.$data.store.store_id)}" style="color: black">{$data.store.store_name}</a></h1>

            <p>商品名称：{$data.good.goods_name}</p>
            <p>商品价格：{$data.good.goods_price}</p>
            <p>商品库存：{$data.good.goods_num}</p>
            <p>商品销量：{$data.good.goods_sel_num}</p>
            <p>商品详情：</p>
            {volist name='$data.good_detail_list' id="list"}
            <div class="col-md-4 col-sm-8 col-xs-12" style="text-align: center;height: 50px;">
                <!-- height调整大小添加图片 -->
                <p>{$list.goods_detail}</p>
            </div>
            {/volist}

        </div>
        <form action="{:url('../../admin/buyercart/insert_into_buyercart')}">
            <div class="search_input_bar">
                <input type="hidden" name="store_id" value="{$data.store.store_id}">
                <input type="hidden" name="goods_id" value="{$data.good.goods_id}">
                <input type="hidden" name="goods_price" value="{$data.good.goods_price}">
                <input type="number" class="search_input" placeholder="请输入加入购物车的数量" name="cart_num" min="1" max="9999"><!--
                --><button type="submit" class="search_btn iconfont">加入购物车</button>
            </div>
        </form>
    </div>

</div>
</html>
