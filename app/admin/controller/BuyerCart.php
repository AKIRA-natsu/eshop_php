<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Session;
use think\facade\Request;

class  BuyerCart
{
    //跳转显示购物车页面
    public function to_buyercart()
    {
        $cart_list = app('buyercartservice') -> show_all_buyercart();
        //因为购物车可能为空，为空会导致页面data显示没有定义
        //如果数组不为空，就跳转到购物车页面
        //如果数组位空，创建一个空的购物车页面，除了网名没有任何参数，返回到空购物车页面
        if (!empty($cart_list))
            return view('buyercart', [
                'nickname' => Session::get('nickname'),
                'data' => $cart_list,
            ]);
        else
            return view('buyercart_empty', [
                'nickname' => Session::get('nickname'),
            ]);
    }

    public function insert_into_buyercart($store_id, $goods_id, $goods_price, $cart_num){
        //已经在php页面中限制了cart_num只能是1-4位数字
        //但输入的不是数字时，会直接报错
        $result = app('buyercartservice') -> insert_into_buyercart($store_id, $goods_id, $goods_price, $cart_num);
        if ($result)
            //重定向到显示购物车的页面
            return redirect((string) url('buyercart/to_buyercart'));
        else
            return view('./error/error', [
                'message' => "放入购物车失败！"
            ]);
    }

    public function update_cart_num($cart_id, $cart_num){
        //输入的cart_num同上，输入不是数字会报错
        $result = app('buyercartservice') -> update_cart_num($cart_id, $cart_num);
        if ($result)
            return redirect((string) url('buyercart/to_buyercart'));
        else
            return view('./error/error', [
                'message' => "更改购物车商品数量失败！"
            ]);
    }

    public function delete_cart($cart_id){
        //传回的数据是"数字 ,数字 ,数字 ,数字 ,"，用explode以','为分界线割开变成数组
        $cartids = explode(',', $cart_id);
        //去掉最后一项空值
        $cartids = array_filter($cartids);
        //用foreach循环删除
        foreach ($cartids as $id){
            app('buyercartservice') -> delete_cart($id);
        }
    return redirect((string) url('buyercart/to_buyercart'));
    }
}
