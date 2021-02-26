<?php
declare (strict_types = 1);

namespace app\index\service;

use app\admin\model\UserModel;
use app\admin\validate\LoginValidate;
use app\admin\validate\RegisterValidate;
use think\facade\Session;

class Log_Reg_Service  extends \think\Service
{

    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
        app()->bind('log_reg_service', Log_Reg_Service::class);
        app()->bind('goodsservice', GoodsService::class);

    }

    //验证登陆信息是否合法
    public function check_login_information($email, $password){
        try{
            validate(LoginValidate::class) -> check([
                'password' => $password,
                'email' => $email,
            ]);
        }catch (Exception $e){
            $e -> getError();
        }
        return true;
    }

    //登陆
    public function doLogin($email, $password){
        $user = UserModel::where(['email' => $email, 'password' => $password]) -> find();
        //将网名和id放进session
        Session::set('id', $user['id']);
        Session::set('nickname', $user['nickname']);
        return $user;
    }

    //验证注册信息是否合法
    public function check_register_information($email, $nickname, $password, $comfirm_password, $telephone){
        try{
            validate(RegisterValidate::class) -> check([
                'email' => $email,
                'nickname' => $nickname,
                'password' => $password,
                'confirm_password' => $comfirm_password,
                'telephone' => $telephone,

            ]);
        }catch (Exception $e){
            $e -> getError();
        }
        return true;
    }

    //注册
    public function doRegister($email, $nickname, $password, $telephone){
        $data = [
            'email' => $email,
            'nickname' => $nickname,
            'password' => $password,
            'telephone' => $telephone,
            //一开始注册是普通用户
            //0为普通用户，1为用户成为了卖家，创建店铺后会更新为1
            'status' => 0,
        ];
        return $result = UserModel::insert($data);
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
