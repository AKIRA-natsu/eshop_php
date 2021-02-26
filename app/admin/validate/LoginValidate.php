<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class LoginValidate extends Validate
{
    protected $rule = [
        'password' => 'require|min:8|max:20',
        'email' => 'require|email',
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
        'password.require' => '密码不能为空',
        'password.min' => '密码长度不足8位',
        'password.max' => '密码长度超过20位',
    ];
}
