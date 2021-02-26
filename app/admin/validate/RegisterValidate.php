<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class RegisterValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    //email和telephone缺少判断是否唯一
        //'email' => 'require|email|unique:user',
        'email' => 'require|email',
        'nickname' => 'require|min:2|max:10|chsDash',
        'password' => 'require|min:8|max:20',
        'confirm_password' => 'require|confirm:password',
        'telephone' => 'require|min:11|max:11',

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'email.require' => '邮箱不能为空',
        'email' => '邮箱格式不正确',
        'email.unique' => '邮箱已存在',
        'nickname.require' => '昵称不能为空',
        'nickname.min' => '昵称长度不足2位',
        'nickname.max' => '昵称长度超过10位',
        'nickname.chsDash' => '昵称只能是汉字，字母，数字或下划线或破折号',
        'password.require' => '密码不能为空',
        'password.min' => '密码长度不足8位',
        'password.max' => '密码长度超过20位',
        'confirm_password.require' => '密码确认不能为空',
        'confirm_password.confirm' => '两次密码不一致',
        'telephone.require' => '电话号码不能为空',
        'telephone.min' => '电话号码不是11位',
        'telephone.max' => '电话号码不是11位',
        'telephone.unique' => '电话号码已存在',
    ];
}
