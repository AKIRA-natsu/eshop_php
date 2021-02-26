<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>店铺详情</title>
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
            <p>店铺老板：{$data.seller.nickname}</p>
            <p>店铺地址：{$data.seller_address.address}</p>
            <p>店铺地址：{$data.seller_address.telephone}</p>
            <table class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;height: 50px;">
                <thead>
                <tr>
                    <td>商品名称</td>
                    <td>商品价格</td>
                    <td>商品库存</td>
                    <td>商品销量</td>
                </tr>
                </thead>
                <tbody>
                {volist name="$data.goods_list" id="list"}
                <tr>
                    <td><a href="{:url('goods/show_goods_details?goods_id='.$list.goods_id)}" style="color: black">{$list.goods_name}</a></td>
                    <td>{$list.goods_price}</td>
                    <td>{$list.goods_num}</td>
                    <td>{$list.goods_sel_num}</td>
                </tr>
                {/volist}
                </tbody>
            </table>
        </div>
    </div>

</div>
</html>
