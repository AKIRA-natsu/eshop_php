<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\admin\model\UserModel;
use think\facade\Request;
use think\facade\Session;

class Goods
{
    public function select_goods(){
        //直接用select_goods($goods_name)的方法跳转下一页可能出错
        //用下面获取值的办法可以不报错
        $goods_name = Request::param('goods_name');
        $goods_list = app('goodsservice') -> select_goods($goods_name);
        return view('./index/homepage_findgoods', [
            'nickname' => Session::get('nickname'),
            'goods' => $goods_list,
        ]);
    }

    //参数写小括号里，点击商品名称必定有goods_id参数
    public function show_goods_details($goods_id){
        $data = app('goodsservice') -> show_goods_details($goods_id);
        //回来的date格式为{goods:{}, store:{}, good_detail_list:{}}
        //可以把下面return注释掉，改成return Json($data);看传回的是什么样子的Json数据
        //直接返回$data会报错，不能输出array格式
        return view('./index/show_goods_details', [
            'nickname' => Session::get('nickname'),
            'data' => $data,
        ]);
    }

    public function show_store_goods($store_id){
        $data = app('goodsservice') -> show_store_goods($store_id);
        return view('./index/store_goods', [
            'nickname' => Session::get('nickname'),
            'data' => $data,
        ]);
    }

}
