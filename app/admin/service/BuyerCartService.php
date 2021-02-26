<?php
declare (strict_types = 1);

namespace app\admin\service;

use app\admin\model\BuyerCartModel;
use app\admin\model\GoodsModel;
use app\admin\model\StoreModel;
use think\facade\Session;

class BuyerCartService  extends \think\Service
{

    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
    	//
        app()->bind('buyercartservice', BuyerCartService::class);
        app()->bind('addressservice', AddressService::class);
        app()->bind('orderservice', OrderService::class);

    }

    //购物车插入用户id，商品id，店铺id，购买数量，总价，加入购物车的时间
    //用户id从session中获取
    public function insert_into_buyercart($store_id, $goods_id, $goods_price, $cart_num){
        $id = Session::get('id');
        //判断购物车中否是已经有这个商品
        //如果存在这个商品，更新购物车中该商品的数量，总价和时间
        $cart = BuyerCartModel::where(['goods_id' => $goods_id, 'store_id' => $store_id, 'id' => $id]) -> find();
        if ($cart){
            $data = [
                //数量 = 新加的数量 + 购物车中有的数量
                'cart_num' => $cart_num + $cart['cart_num'],
                //总价 = 数量 * 传过来的单价
                'cart_price' => ($cart_num + $cart['cart_num']) * $goods_price,
                //获取加入购物车的时间    格式 -> 年-月-日 时:分:秒
                'cart_time' => date('Y-m-d h:i:s', time()),
            ];
            //有商品的情况下需要更新不是插入
            BuyerCartModel::where(['cart_id' => $cart['cart_id']]) -> update($data);
            return true;
        }else{
            $data = [
                'id' => $id,
                'goods_id' => $goods_id,
                'store_id' => $store_id,
                //购物车中没有，直接插入需要的数量
                'cart_num' => $cart_num,
                'cart_price' => $cart_num * $goods_price,
                'cart_time' => date('Y-m-d h:i:s', time()),
            ];
            //购物车中没有商品，插入到购物车
            BuyerCartModel::insert($data);
            return true;
        }
        return false;
    }

    //根据用户id显示所有购物车
    public function show_all_buyercart(){
        $cart_list = BuyerCartModel::where(['id' => Session::get('id')]) -> select();
        //返回的data是自己定义拼接的数组，没有下面这句话会报错 $data没有定义
        $data = [];
        //存在购物车中没有东西的情况，如果没有东西就直接返回空数组
        if ($cart_list == null)
            return $cart_list;
        //购物车中只有商品店铺id，用foreach循环将商品店铺显示出来
        //如果不用i++的方式，所有的值会覆盖只剩最后一个
        $i = 0;
        foreach ($cart_list as $item){
            $store = StoreModel::where(['store_id' => $item['store_id']]) -> column('store_name');
            $goods = GoodsModel::where(['goods_id' => $item['goods_id']]) -> column('goods_name');
            $data[$i] = [
                'store' => $store,
                'goods' => $goods,
                'cart' => $item
            ];
            $i++;
        }
        return $data;
    }

    //更新购物车商品信息
    public function update_cart_num($cart_id, $cart_num){
        $cart = BuyerCartModel::where(['cart_id' => $cart_id]) -> find();
        //获得单价
        $price = $cart['cart_price'] / $cart['cart_num'];
        //只需要更新总价和数量
        $data = [
            'cart_num' => $cart_num,
            'cart_price' => $price * $cart_num,
        ];
        BuyerCartModel::where(['cart_id' => $cart_id]) -> update($data);
        return true;
    }

    public function delete_cart($cart_id){
        BuyerCartModel::where(['cart_id' => $cart_id]) -> delete();
    }

    
    /**
     * 执行服务
     *
     * @return mixed
     */
    public function boot()
    {
        //
    }
}
