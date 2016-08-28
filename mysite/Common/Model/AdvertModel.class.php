<?php
namespace Common\Model;
use Think\Model;
class AdvertModel extends Model {
    protected $tableName = 'adverts';
    public static function status(){
    	return array(
    		'opened'=>'开放',
    		'closed'=>'关闭',
    	);
    }
}