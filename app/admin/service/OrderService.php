<?php
declare (strict_types = 1);

namespace app\admin\service;

use app\admin\model\AddressModel;
use app\admin\model\BuyerCartModel;
use app\admin\model\GoodsModel;
use app\admin\model\OrderModel;
use app\admin\model\StoreModel;
use app\admin\model\UserModel;
use think\facade\Session;

class OrderService  extends \think\Service
{
    public function show_all_order(){
        $order_list = OrderModel::where(['id' => Session::get('id')]) -> select();
        //用foreach循环把商品店铺信息显示出来
        $data = [];
        //存在订单中没有东西的情况，如果没有东西就直接返回空数组
        if ($order_list == null)
            return $order_list;
        $i = 0;
        foreach ($order_list as $list){
            $store_name = StoreModel::where(['store_id' => $list['store_id']]) -> column('store_name');
            $goods_name = GoodsModel::where(['goods_id' => $list['goods_id']]) -> column('goods_name');
            $data[$i] = [
                'store_name' => $store_name,
                'goods_name' => $goods_name,
                'order' => $list,
            ];
            $i++;
        }
        return $data;
    }

    public function insert_an_order($address_id, $cart_id){
        $cart = BuyerCartModel::where(['cart_id' => $cart_id]) -> find();
        $data = [
            'id' => Session::get('id'),
            'store_id' => $cart['store_id'],
            'goods_id' => $cart['goods_id'],
            'address_id' => $address_id,
            'order_time' => date('Y-m-d h:i:s', time()),
            'cart_num' => $cart['cart_num'],
            'cart_price' => $cart['cart_price'],
            'pay_status' => 0,
        ];
        OrderModel::insert($data);
        //下单完成后删除购物车相对应商品
        BuyerCartModel::where(['cart_id' => $cart_id]) -> delete();
    }

    public function pay_for_order($order_id){
        //更新已经付款，并更新付款时间
        $result = OrderModel::where(['order_id' => $order_id]) ->
            update([
                'pay_status' => 1,
                'pay_time' => date('Y-m-d h:i:s', time()),
            ]);
        //付款过后更新商品销量和库存
        $order = OrderModel::where(['order_id' => $order_id]) -> find();
        $good = GoodsModel::where(['goods_id' => $order['goods_id']]) -> find();
        return $result = GoodsModel::where(['goods_id' => $good['goods_id']]) -> update([
            'goods_num' => $good['goods_num'] - $order['cart_num'],
            'goods_sel_num' => $good['goods_sel_num'] + $order['cart_num'],
        ]);
    }

    public function change_order_address($order_id, $address_id){
        //获取原来的address_id，如果没有改变，直接返回true
        $order = OrderModel::where(['order_id' => $order_id]) -> find();
        if ($order['address_id'] == $address_id)
            return true;
        else
            return $result = OrderModel::where(['order_id' => $order_id]) -> update(['address_id' => $address_id]);
    }

    public function delete_order($order_id){
        return $result = OrderModel::where(['order_id' => $order_id]) -> delete();
    }

    public function show_order_detail($order_id){
        //订单表，地址表对应的买家地址，店铺表，商品表，用户表对应的卖家表，地址表对应的卖家地址
        $order = OrderModel::where(['order_id' => $order_id]) -> find();
        $buyer_address = AddressModel::where(['address_id' => $order['address_id']]) -> find();
        $store = StoreModel::where(['store_id' => $order['store_id']]) -> find();
        $goods = GoodsModel::where(['goods_id' => $order['goods_id']]) -> find();
        $seller = UserModel::where(['id' => $store['id']]) -> find();
        //默认以卖家默认地址为店铺地址，联系方式等
        $seller_address = AddressModel::where(['id' => $store['id'], 'status' => 1]) -> find();
        return $data = [
            'order' => $order,
            'buyer_address' => $buyer_address,
            'store' => $store,
            'goods' => $goods,
            'seller' => $seller,
            'seller_address' => $seller_address,
        ];
    }
}
