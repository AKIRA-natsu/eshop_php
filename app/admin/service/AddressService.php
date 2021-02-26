<?php
declare (strict_types = 1);

namespace app\admin\service;

use app\admin\model\AddressModel;
use app\admin\validate\AddressValidate;
use think\facade\Session;

class AddressService  extends \think\Service
{
    //显示用户所有的地址，返回的是查询的结果，空的情况下不会像购物车一样报错
    public function show_all_address(){
        $addresslist = AddressModel::where(['id' => Session::get('id')]) -> select() -> toArray();
        //array_column($addresslist, 'status') 获取数组中status的值
        //array_multisort(键值， 降序， 数组) 降序默认地址排最上面
        array_multisort(array_column($addresslist, 'status'), SORT_DESC, $addresslist);
        return $addresslist;
    }

    public function delete_address($address_id, $status){
        //分两种情况
        //一种是不是默认的地址，直接删掉即可
        //另一种是默认的地址，删除后要更新一条为新的默认地址
        if ($status == 1){
            $result = AddressModel::where(['address_id' => $address_id]) -> delete();
            $address = AddressModel::where(['id' => Session::get('id')]) -> find();
            $result = AddressModel::where(['address_id' => $address['address_id']]) -> update(['status' => 1]);
        }else
            $result = AddressModel::where(['address_id' => $address_id]) -> delete();
        return $result;
    }

    public function update_status($address_id){
        //查询用户默认的地址，status改为0，新的地址改为1
        $address = AddressModel::where(['status' => 1, 'id' => Session::get('id')]) -> find();
        AddressModel::where(['address_id' => $address['address_id']]) -> update(['status' => 0]);
        AddressModel::where(['address_id' => $address_id]) -> update(['status' => 1]);
    }

    public function add_a_address($address_name, $address, $address_detail, $address_post, $telephone, $status){
        //先验证地址是否合法
        try{
            validate(AddressValidate::class) -> check([
                'address_name' => $address_name,
                'address' => $address,
                'address_detail' => $address_detail,
                'address_post' => $address_post,
                'telephone' => $telephone,
            ]);
        }catch (Exception $e){
            return $e -> getError();
        }
        //判断用户的数量是否已经到10条，如果是10条不能再插入，返回false
        $id = Session::get('id');
        $addresslist = AddressModel::where(['id' => $id]) -> select();
        if (count($addresslist) >= 10)
            return false;
        //status选中返回的是on
        //如果status不为空，原本的默认地址改掉，新添加的地址变成默认地址
        //如果status为空，直接插入
        if ($status != null){
            $oneaddress = AddressModel::where(['id' => $id, 'status' => 1]) -> find();
            $result = AddressModel::where(['address_id' => $oneaddress['address_id']]) -> update(['status' => 0]);
            $data = [
                'address_name' => $address_name,
                'id' => $id,
                'address' => $address,
                'address_detail' => $address_detail,
                'address_post' => $address_post,
                'telephone' => $telephone,
                'status' => 1
            ];
        }else
            $data = [
                'address_name' => $address_name,
                'id' => $id,
                'address' => $address,
                'address_detail' => $address_detail,
                'address_post' => $address_post,
                'telephone' => $telephone,
                'status' => 0
            ];
        $result = AddressModel::insert($data);
        return $result;
    }

    public function get_a_address($address_id){
        return $address = AddressModel::where(['address_id' => $address_id]) -> find();
    }

    public function update_address($address_id, $address_name, $address, $address_detail, $address_post, $telephone){
        //同样需要验证地址的合法性
        try{
            validate(AddressValidate::class) -> check([
                'address_name' => $address_name,
                'address' => $address,
                'address_detail' => $address_detail,
                'address_post' => $address_post,
                'telephone' => $telephone,
            ]);
        }catch (Exception $e){
            return $e -> getError();
        }
        //如果直接更新，更新不做任何变化会报错
        //获取更新前的地址，比较每个值是否更改过，如果每个都和原本的信息一样，直接返回true
        $address_old = AddressModel::where(['address_id' => $address_id]) -> find();
        if (strcmp($address_name, $address_old['address_name']) == 0
            && strcmp($address, $address_old['address']) == 0
            && strcmp($address_detail, $address_old['address_detail']) == 0
            && strcmp($address_post, $address_old['address_post']) == 0
            && strcmp($telephone, $address_old['telephone']) == 0)
            return true;
        $data = [
            'address_name' => $address_name,
            'address' => $address,
            'address_detail' => $address_detail,
            'address_post' => $address_post,
            'telephone' => $telephone,
        ];
        return $result = AddressModel::where(['address_id' => $address_id]) -> update($data);
    }
}
