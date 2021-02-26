<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>更新地址</title>
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


    <div class="container">
        <form role="form" action="{:url('order/to_order')}" method="get">
            <div class="form-group">
                <label for="address">店铺名称</label>
                <input type="text" class="form-control" value="{$data.store.store_name}" readonly>
            </div>
            <div class="form-group">
                <label for="address">卖家姓名</label>
                <input type="text" class="form-control" value="{$data.seller_address.address_name}" readonly>
            </div>
            <div class="form-group">
                <label for="address">卖家电话</label>
                <input type="text" class="form-control" value="{$data.seller_address.telephone}" readonly>
            </div>
            <div class="form-group">
                <label for="address">卖家地址</label>
                <input type="text" class="form-control" value="{$data.seller_address.address} {$data.seller_address.address_detail}" readonly>
            </div>
            <div class="form-group">
                <label for="address">商品总价</label>
                <input type="text" class="form-control" value="{$data.goods.goods_name}" readonly>
            </div>
            <div class="form-group">
                <label for="address">商品数量</label>
                <input type="text" class="form-control" value="{$data.order.cart_num}" readonly>
            </div>
            <div class="form-group">
                <label for="address">商品总价</label>
                <input type="text" class="form-control" value="{$data.order.cart_price}" readonly>
            </div>
            <div class="form-group">
                <label for="addresssee">收货人姓名</label>
                <input type="text" class="form-control" value="{$data.buyer_address.address_name}" readonly>
            </div>
            <div class="form-group">
                <label for="telephone">手机号码</label>
                <input type="text" class="form-control" value="{$data.buyer_address.telephone}" readonly>
            </div>
            <div class="form-group">
                <label for="postcode">邮政编码</label>
                <input type="text" class="form-control" value="{$data.buyer_address.address_post}" readonly>
            </div>
            <div class="form-group">
                <label for="address">地址</label>
                <input type="text" class="form-control" value="{$data.buyer_address.address} {$data.buyer_address.address_detail}" readonly>
            </div>
            <div class="form-group">
                <label for="address">下单时间</label>
                <input type="text" class="form-control" value="{$data.order.order_time}" readonly>
            </div>
            <div class="form-group">
                <label for="address">付款时间</label>
                <input type="text" class="form-control" value="{$data.order.pay_time}" readonly>
            </div>
            <div align="center">
                <button type="submit" class="btn btn-primary">确认</button>
            </div>
        </form>
    </div>


</div>
</html>
