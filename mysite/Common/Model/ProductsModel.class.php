<?php
namespace Common\Model;
use Think\Model;
class ProductModel extends Model {
    protected $tableName = 'products';
    public static function status(){
    	return array(
    		'opened'=>'开放',
    		'closed'=>'关闭',
    	);
    }
}