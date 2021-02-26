<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Session;

class Order
{
    //下单以后更新购物车，并且库存减少，销量增加

    //跳转到订单页面
    public function to_order(){
        $order_list = app('orderservice') -> show_all_order();
        if ($order_list)
            return view('order', [
                'nickname' => Session::get('nickname'),
                'order' => $order_list,
            ]);
        else
            return view('order_empty', [
                'nickname' => Session::get('nickname'),
            ]);
    }

    //跳转到订单页面前，先进入选择地址的页面
    //直接套用显示地址的代码
    public function to_address_choose($cart_id){
        $addresslist = app('addressservice') -> show_all_address();
        return view('address_choose', [
            'cart_id' => $cart_id,
            'nickname' => Session::get('nickname'),
            'address' => $addresslist,
        ]);
    }

    //插入订单并进行跳转
    public function insert_an_order($address_id, $cart_id){
        $cartids = explode(',', $cart_id);
        //去掉数组最后一项空数组，否则最后一项空的在添加的时候会报错
        $cartids = array_filter($cartids);
        foreach ($cartids as $id) {
            app('orderservice') -> insert_an_order($address_id, $id);
        }
        //重定向到显示订单的页面
        return redirect((string) url('order/to_order'));
    }

    public function pay_for_order($order_id, $pay_status){
        //付款做的不好，暂时点击就能付款
        //如果已经付过款，返回错误并提示已经付款，没有付款更新数据库再返回
        if ($pay_status == 1)
            return view('./error/error', [
                'message' => "已经付款！"
            ]);
        else{
            $result = app('orderservice') -> pay_for_order($order_id);
            if ($result)
                //重定向到显示订单的页面
                return redirect((string) url('order/to_order'));
            else
                return view('./error/error', [
                    'message' => "付款失败！"
                ]);
        }
    }

    public function to_address_change($order_id, $pay_status){
        //判断是否已经付款，已经付款不能进行地址的更改
        if ($pay_status == 1)
            return view('./error/error', [
                'message' => "已经付款无法更改地址，请联系商家更换地址！"
            ]);
        else{
            //套用上面address_choose的代码
            $addresslist = app('addressservice') -> show_all_address();
            return view('address_change', [
                'nickname' => Session::get('nickname'),
                'order_id' => $order_id,
                'address' => $addresslist
            ]);
        }
    }

    public function change_order_address($order_id, $address_id){
        $result = app('orderservice') -> change_order_address($order_id, $address_id);
        if ($result)
            return redirect((string) url('order/to_order'));
        else
            return view('./error/error', [
                'message' => "更改地址失败！"
            ]);
    }

    public function delete_order($order_id, $pay_status){
        //判断是否已经付款，已经付款不能再删除
        if ($pay_status == 1)
            return view('./error/error', [
                'message' => "已经付款无法取消订单，请联系商家退款或联系客服！"
            ]);
        else{
            $result = app('orderservice') -> delete_order($order_id);
            if ($result)
                return redirect((string) url('order/to_order'));
            else
                return view('./error/error', [
                    'message' => "删除订单失败！"
                ]);
        }
    }

    public function show_order_detail($order_id){
        $data = app('orderservice') -> show_order_detail($order_id);
        return view('order_detail', [
            'nickname' => Session::get('nickname'),
            'data' => $data,
        ]);
    }
}
