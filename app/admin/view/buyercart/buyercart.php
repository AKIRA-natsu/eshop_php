<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>我的购物车</title>
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
<script>
    function deleteCarts(){
        var result = "";
        var count = 0;
        $(".cart_id").each(function(){
            if ($(this).is(":checked")){
                result += $(this).val() + ",";
                count++;
            } else {}
        })
        if(!confirm("确定删除这" + count + "件商品?")){
            return;
        }
        window.location.href= "delete_cart?cart_id=" + result;
    }

    function makeCart(){
        var result = "";
        var count = 0;
        $(".cart_id").each(function(){
            if ($(this).is(":checked")){
                result += $(this).val() + ",";
                count++;
            } else {}
        })
        if(!confirm("确定给这" + count + "件商品下单?")){
            return;
        }
        window.location.href= "../order/to_address_choose?cart_id=" + result;
    }

    function opcheckboxed(objName, type){
        var objNameList=document.getElementsByName(objName);
        if(null!=objNameList){
            for(var i=0;i<objNameList.length;i++){
                if(objNameList[i].checked==true)
                {
                    if(type != 'checkall') {  // 非全选
                        objNameList[i].checked=false;
                    }

                } else {
                    if(type != 'uncheckall') {  // 非取消全选
                        objNameList[i].checked=true;
                    }
                }
            }
        }
    }
</script>
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

    <!--商品部分-->
    <div class="row">

        <div class="col-md-10" style="width: 80%">

        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-1" >
                    </div>
                    <div class="col-md-3" >
                        加入购物车时间
                    </div>
                    <div class="col-md-3" >
                        商品信息
                    </div>
                    <div class="col-md-1" >
                        单价
                    </div>
                    <div class="col-md-1" >
                        数量
                    </div>
                    <div class="col-md-1" >
                        金额
                    </div>
                    <div class="col-md-2" >
                        操作
                    </div>
                </div>
            </div>
        </div>
        <div>
            {volist name="data" id="data"}
            <div class="panel panel-default">
                <div class="panel-heading">
                    {volist name="data.store" id="store"}
                    <a href="{:url('../../index/goods/show_store_goods?store_id='.$data.cart.store_id)}" style="color: black"><h4>{$store}</h4></a>
                    {/volist}
                </div>
                <div>
                    <form action="{:url('buyercart/update_cart_num')}">
                        <input type="hidden" name="cart_id" value="{$data.cart.cart_id}">
                        <div class="panel-body">
                            <div class="col-md-1 all_select" >
                                <input type="checkbox" id="cart_id" name="cart_id" class="cart_id" value="{$data.cart.cart_id}">
                            </div>
                            <div class="col-md-3">
                                {$data.cart.cart_time}
                            </div>
                            {volist name="data.goods" id="goods"}
                            <div class="col-md-3">
                                <a href="{:url('../../index/goods/show_goods_details?goods_id='
                                                                .$data.cart.goods_id)}" style="color: black">{$goods}</a>
                            </div>
                            {/volist}
                            <div class="col-md-1" >
                                ￥{$data.cart.cart_price/$data.cart.cart_num}
                            </div>
                            <div class="col-md-1" >
                                <div class="row">
                                    <div class="form-inline">
                                        <div><input type="number" id="number" size="1" min="1" max="999" name="cart_num"
                                                    value="{$data.cart.cart_num}"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1" >
                                ￥{$data.cart.cart_price}
                            </div>
                            <div class="col-md-2" >
                                <input type="submit" value="修改" style="border: none;">|
                                <input type="button" value="删除" style="border: none;"
                                       onclick="location.href='{:url(\'buyercart/delete_cart?cart_id=\'.$data.cart.cart_id.\'\')}'">|
                                <input type="button" value="下单" style="border: none;"
                                       onclick="location.href='{:url(\'order/to_address_choose?cart_id=\'.$data.cart.cart_id.\'\')}'">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            {/volist}
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4" >
                        <button onclick="opcheckboxed('cart_id', 'checkall')">全选</button>
                        <button onclick="opcheckboxed('cart_id', 'uncheckall')">取消全选</button>
                        <button onclick="opcheckboxed('cart_id', 'reversecheck')">反选</button>
                    </div>
                    <div class="col-md-3" >
                        清除失效商品信息（未做）
                    </div>
                    <div class="col-md-2" >
                        移入收藏夹（未做）
                    </div>
                    <div class="col-md-3" >
                        <input type="button" value="批量删除" style="border: none;" onclick="deleteCarts()">
                        <input type="button" value="批量下单" style="border: none;" onclick="makeCart()">
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
</body>
</html>
