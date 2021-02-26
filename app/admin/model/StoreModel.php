<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;

/**
 * @mixin think\Model
 */
class StoreModel extends Model
{
    //
    protected $connection = 'eshop';
    protected $table = 'es_store_info';
}
