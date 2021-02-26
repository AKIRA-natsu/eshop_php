<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Request;
use think\facade\Session;

class Address
{
    //跳转显示地址页面
    public function to_address(){
        $addresslist = app('addressservice') -> show_all_address();
        return view('address', [
            'nickname' => Session::get('nickname'),
            'address' => $addresslist,
            'count' => count($addresslist),
        ]);
    }

    //删除地址
    public function delete_address($address_id, $status){
        $result = app('addressservice') -> delete_address($address_id, $status);
        if ($result)
            //重定向到显示地址的页面
            return redirect((string) url('address/to_address'));
        else
            return view('./error/error', [
                'message' => "删除地址失败！"
            ]);
    }

    //更新地址默认
    public function update_status($address_id){
        app('addressservice') -> update_status($address_id);
        return redirect((string) url('address/to_address'));
    }

    //跳转到添加地址页面
    public function to_address_edit(){
        return view('address_edit', [
            'nickname' => Session::get('nickname')
        ]);
    }

    //插入一条地址，这样获得参数的方式，checkbox如果不选不会报错，取得为空
    public function add_a_address(){
        $address_name = Request::param('address_name');
        $address = Request::param('address');
        $address_detail = Request::param('address_detail');
        $address_post = Request::param('address_post');
        $telephone = Request::param('telephone');
        $status = Request::param('status');
        $result = app('addressservice') -> add_a_address($address_name, $address, $address_detail, $address_post, $telephone, $status);
        if ($result)
            return redirect((string) url('address/to_address'));
        else
            return view('./error/error', [
                'message' => "添加地址失败！"
            ]);
    }

    //跳转到更新地址的address_edit页面
    public function to_address_update($address_id){
        $address = app('addressservice') -> get_a_address($address_id);
        return view('address_update', [
            'nickname' => Session::get('nickname'),
            'address' => $address
        ]);
    }

    //更新地址信息
    public function update_address(){
        //更新地址需要用到address_id，比添加地址多了address_id，少了status
        $address_id = Request::param('address_id');
        $address_name = Request::param('address_name');
        $address = Request::param('address');
        $address_detail = Request::param('address_detail');
        $address_post = Request::param('address_post');
        $telephone = Request::param('telephone');
        $result = app('addressservice') -> update_address($address_id, $address_name, $address, $address_detail, $address_post, $telephone);
        if ($result)
            return redirect((string) url('address/to_address'));
        else
            return view('./error/error', [
                'message' => "更新地址失败！"
            ]);
    }
}
