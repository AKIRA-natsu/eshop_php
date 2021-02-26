<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class AddressValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'address_name' => "require|chsDash",
        'address' => "require|chsDash",
        'address_detail' => "require|chsDash",
        'address_post' => "require|min:6|max:6",
        'telephone' => 'require|min:11|max:11',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'address_name.require' => '收件人姓名不能为空',
        'address_name.chsDash' => '收件人姓名只能是汉字，字母，数字或下划线或破折号',
        'address.require' => '地址不能为空',
        'address.chsDash' => '地址只能是汉字，字母，数字或下划线或破折号',
        'address_detail.require' => '详细地址不能为空',
        'address_detail.chsDash' => '详细地址只能是汉字，字母，数字或下划线或破折号',
        'address_post.require' => '邮编不能为空',
        'address_post.min' => '邮编不是6位数字',
        'address_post.max' => '邮编不是6位数字',
        'telephone.require' => '电话号码不能为空',
        'telephone.min' => '电话号码不是11位',
        'telephone.max' => '电话号码不是11位',
    ];
}
