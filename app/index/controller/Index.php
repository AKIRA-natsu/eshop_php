<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\admin\model\UserModel;
use think\facade\Request;
use think\facade\Session;

class Index
{
    public function index()
    {
        if (Session::has('id')){
            $goods_list = app('goodsservice') -> show_all_goods();
            return view('homepage', [
                'goods' => $goods_list,
                'nickname' => Session::get('nickname')
            ]);
        }
        return view();
    }

    //登陆
    public function login(){
        $email = Request::param('email');
        $password = Request::param('password');
        //与service里的log_reg_service名字对应
        $check = app('log_reg_service') -> check_login_information($email, $password);
        if ($check){
            $result = app('log_reg_service') -> doLogin($email, $password);
            $goods_list = app('goodsservice') -> show_all_goods();
            if ($result)
                return view('homepage', [
                    'goods' => $goods_list,
                    'nickname' => Session::get('nickname'),
                ]);
            else
                return view('./error/error',
                    [
                        'message' => '登陆错误，请重新尝试'
                    ]);
        }
        return view('index');
    }

    //跳转到注册界面
    public function to_register(){
        return view('register');
    }

    //注册
    public function doRegister(){
        $email = Request::param('email');
        $nickname = Request::param('nickname');
        $password = Request::param('password');
        $comfirm_password = Request::param('comfirm_password');
        $telephone = Request::param('telephone');
        $check = app('log_reg_service') -> check_register_information($email, $nickname, $password, $comfirm_password, $telephone);
        if ($check){
            //合法之后将用户信息插入用户表
            $result = app('log_reg_service') -> doRegister($email, $nickname, $password, $telephone);
            //插入成功后将用户id和网名放入session，调用dologin()函数
            if ($result)
                app('log_reg_service') -> doLogin($email, $password);
            //session存入成功并且注册好用户直接返回商城主页
            $goods_list = app('goodsservice') -> show_all_goods();
            return view('homepage', [
                'goods' => $goods_list,
                'nickname' => $nickname,
            ]);
        }else
            return view('./error/error',
                [
                    'message' => '注册失败，请重新尝试'
                ]);
        return view('register');
    }

    public function logout(){
        return view('index');
    }
}
