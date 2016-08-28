<?php
namespace Common\Model;
use Think\Model;
class ProductTypeTypeModel extends Model {
    protected $tableName = 'product_types';
    public static function status(){
    	return array(
    		'opened'=>'开放',
    		'closed'=>'关闭',
    	);
    }
}