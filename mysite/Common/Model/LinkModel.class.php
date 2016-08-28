<?php
namespace Common\Model;
use Think\Model;
class LinkModel extends Model {
    protected $tableName = 'links';
    public static function status(){
    	return array(
    		'opened'=>'开放',
    		'closed'=>'关闭',
    	);
    }
}