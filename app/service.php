<?php

use app\AppService;

// 系统服务定义文件
// 服务在完成全局初始化之后执行
return [
    AppService::class,
    app\index\service\Log_Reg_Service::class,
    app\admin\service\BuyerCartService::class,
];
