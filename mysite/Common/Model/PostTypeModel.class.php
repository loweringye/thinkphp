<?php
namespace Common\Model;
use Think\Model;
class PostTypeModel extends Model {
    protected $tableName = 'post_types';
    public static function status(){
    	return array(
    		'opened'=>'开放',
    		'closed'=>'关闭',
    	);
    }
}