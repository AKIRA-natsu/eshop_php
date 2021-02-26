<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>我的订单</title>
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
            {$nickname}
        </div>
        <div class="col-md-4 hidden-sm hidden-xs">
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6" style="line-height: 50px;height: 50px;">
            <a href="{:url('buyercart/to_buyercart')}" style="color: gold">购物车</a>
            <a href="{:url('order/to_order')}" style="color: gold">订单</a>
            <a href="{:url('address/to_address')}" style="color: gold">我的地址</a>
        </div>
    </div>

    <!--导航栏部分-->
    <nav class="navbar navbar-inverse" style="background: #eacdff; border: 0px;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{:url('../../index/index/index')}" style="color: black">首页</a>
                <div style="position: absolute; right: 10px">
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1" >
                        店铺名称
                    </div>
                    <div class="col-md-2" >
                        商品名称
                    </div>
                    <div class="col-md-1" >
                        商品数量
                    </div>
                    <div class="col-md-1" >
                        商品总价
                    </div>
                    <div class="col-md-2" >
                        下单时间
                    </div>
                    <div class="col-md-1" >
                        付款
                    </div>
                    <div class="col-md-2" >
                        付款时间
                    </div>
                    <div class="col-md-2" >
                        操作
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</html>
