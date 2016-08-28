<?php
namespace Common\Model;
use Think\Model;
class ClientModel extends Model {
    protected $tableName = 'clients';
    public static $validate = array(
    		array('code','require','账号必须填写！'),
    		array('password','require','密码必须填写！'),
    		array('code','check_code','账号不存在',1,'callback'),
    		array('password','check_pwd','密码不正确',0,'callback'),
    );
    public static $auto = array (
    		array('status','opened'),  // 新增的时候把status字段设置为1
    );
    
    public static $password = array(
    		array('password','require','密码必须填写！'),
    		array('re_password','require','确认密码必须填写！'),
    		array('re_password','password','密码不一致',0,'confirm'), // 验证确认密码是否和密码一致
    );
    
   protected function check_code(){
    	if(!D('client')->where("code='".I('post.code')."'")->getField('id')){
    		return false;
    	}else{
    		return true;
    	}
    }
    protected function check_pwd(){
    	$password = D('client')->where("code='".I('post.code')."'")->getField('password');
    	$org_password = md5(I('post.code').I('post.password'));
    	if($password!=$org_password){
    		return false;
    	}else{
    		return true;
    	}
    }
}