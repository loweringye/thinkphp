<?php
namespace Common\Model;
use Think\Model;
class PostModel extends Model {
    protected $tableName = 'posts';
    public static function status(){
    	return array(
    		'opened'=>'开放',
    		'closed'=>'关闭',
    	);
    }
}