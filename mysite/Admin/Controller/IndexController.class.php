<?php
namespace Admin\Controller;
use Common\Model;
use Common\Controller;
class IndexController extends Controller\ControllerController {
    function _initialize(){
        if(!current_client()){
            $this->redirect('/admin/main/login');
        }
        $this->initialize();
    }
    /**
     * 首页
     */
    public function index(){
       $model_client = new \Common\Model\ClientModel();
       $auto = $model_client::$auto;
       $error = '';
       if(IS_POST){
	       	if (!$model_client->auto($auto)->create()){
	       		$error = $model_client->getError();
	       	}else{
	       		 $model_client->save();
	       		 $this->redirect('/admin/index/set');	
	       	}
       }
       $this->assign('error',$error);
       $this->display();
    }
    /**
     * 导航设置
     */
    public function nav(){
    	$model_post_type = new \Common\Model\PostTypeModel();
    	$model_setting = new \Common\Model\SettingModel();
    	if(IS_POST){
    		$first = $_POST['first'];
    		$second = $_POST['second'];
    		$hird = $_POST['hird'];
    		$content = array();
    		foreach ($first as $k=>$f){
    			$f = trim($f);
    			if(strlen($f)>0 && $f==1){//自定义
    				$key = $second && isset($second[$k])?$second[$k]:'';
    				$value = $hird && isset($hird[$k])?$hird[$k]:'';
    				$content[$k] = array($key=>$value);
    			}else{
    				$content[$k] = $f;
    			}
    		}
    		if(I('post.id')){
    			$save_data = array(
    					'id'=>I('post.id'),
    					'nav'=>json_encode($content,true)
    			);
    			$model_setting->save($save_data);
    		}else{
    			$save_data = array(
    				'client_id'=>$this->host['id'],
    				'nav'=>json_encode($content,true)
    			);
    			$save_data['created'] = date('Y-m-d H:m:s',time());
    			$model_setting->add($save_data);
    		}
    		$this->redirect('/admin');
    	}
    	$setting = $model_setting->where("client_id={$this->host['id']}")->find();
    	if($setting){
    		$setting['nav'] = json_decode($setting['nav'],true);
    	}
    	$post_types = $model_post_type->where("client_id={$this->host['id']}")->select();
    	$navs = array();
    	array_push($navs, array('/'=>'网站首页'));
    	foreach ($post_types as $post_type){
    		array_push($navs, array("/post/type/{$post_type['url_name']}"=>$post_type['name']));
    	}
    	array_push($navs, array(1=>'自定义设置'));
    	$this->assign('navs',$navs);
    	$this->assign('setting',$setting);
    	$this->display();
    }
    /**
     * 账号密码
     */
    public function accout(){
       $model_client = new \Common\Model\ClientModel();
       $password = $model_client::$password;
       $error = '';
       if(IS_POST){
	       	if (!$model_client->validate($password)->create()){
	       		$error = $model_client->getError();
	       	}else{
	       		$save = array(
	       			'id'=>$this->host['id'],
	       			'password'=>md5($this->host['code'].I('post.password')),
	       		);
	       		$model_client->save($save);
	       		$this->redirect('/admin/index/set');	
	       	}
       }
       $this->assign('error',$error);
    	$this->display();
    }
    /**
     * 异步保存客户资料
     */
    function ajax_save_client(){
    	$model_client = new \Common\Model\ClientModel();
    	if(IS_POST){
    		$data['id'] = $this->host['id'];
    		$data[I('post.key')] = I('post.value');
    		$model_client->save($data);
    	}
    }
}