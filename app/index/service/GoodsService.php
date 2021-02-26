<?php
declare (strict_types = 1);

namespace app\index\service;

use app\admin\model\AddressModel;
use app\admin\model\GoodsDetailModel;
use app\admin\model\GoodsModel;
use app\admin\model\StoreModel;
use app\admin\model\UserModel;
use think\facade\Session;

class GoodsService  extends \think\Service
{
    //显示所有商品
    public function show_all_goods(){
        return $goods_list = GoodsModel::select();
    }

    //模糊查询商品，分页查询
    public function select_goods($goods_name){
        return $goods_list = GoodsModel::where('goods_name', 'like', '%'. $goods_name .'%') -> paginate(12);
    }

    //通过goods_id找到商品的名称价格信息等，店铺的信息，商品的详细信息，共三张表
    public function show_goods_details($goods_id){
        $good = GoodsModel::where(['goods_id' => $goods_id]) -> find();
        $store = StoreModel::where(['store_id' => $good['store_id']]) -> find();
        $good_detail_list = GoodsDetailModel::where(['goods_id' => $goods_id]) -> select();
        //good赋值到数组good名称，store赋值到数组store名称。。。。。。
        return $data = [
            'good' => $good,
            'store' => $store,
            'good_detail_list' => $good_detail_list,
        ];
    }

    //通过store_id找到店铺名称和商品列表
    //默认为商店持有人默认地址为联系方式，地址等
    public function show_store_goods($store_id){
        $store = StoreModel::where(['store_id' => $store_id]) -> find();
        $store_goods_list = GoodsModel::where(['store_id' => $store_id]) -> select();
        $seller = UserModel::where(['id' => $store['id']]) -> find();
        $seller_address = AddressModel::where(['id' => $seller['id'], 'status' => 1]) -> find();
        //分页格式，一页显示六个商品
        //        $store_goods_list = GoodsModel::where(['store_id' => $store_id]) -> paginate(6);
        return $data = [
            'store' => $store,
            'seller' => $seller,
            'seller_address' => $seller_address,
            'goods_list' => $store_goods_list,
        ];
    }

}
