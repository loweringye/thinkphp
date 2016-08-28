<?php
namespace Admin\Controller;
use Common\Model;
use Common\Controller;
class PostTypeController extends Controller\ControllerController {
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
       $model_post_type = new \Common\Model\PostTypeModel();
       
       $condition = "client_id={$this->host['id']}";
       $count = $model_post_type->where($condition)->count();// 查询满足要求的总记录数
       $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       $show = $Page->show();// 分页显示输出
       $this->assign('page',$show);// 赋值分页输出
       
       $post_types = $model_post_type->where($condition)->select();
       $this->assign('post_types',$post_types);
       $this->assign('status',$model_post_type->status());
       $this->display();
    }
    /**
     * 新增、编辑友情链接
     */
    public function edit($id=null){
       $model_post_type = new \Common\Model\PostTypeModel();
	   $error = '';
       if(IS_POST){
       		if(I('post.id')){
       			$model_post_type->save($_POST);
       		}else{
       			$save_data = $_POST;
       			$save_data['client_id'] = $this->host['id'];
       			$save_data['status'] = "opened";
       			$save_data['created'] = date('Y-m-d H:m:s',time());
       			$model_post_type->add($save_data);
       			
       		}
       		$error = $model_post_type->getError();
	       	if ($error){
	       		$this->redirect('/admin/post_type/list?error='.$error);
	       	}else{
	       		$this->redirect('/admin/post_type/list');
	       	}
       }
       $post_type = array();
       if($id){
       		$post_type = $model_post_type->where("id={$id}")->find();
       }
       $this->assign('post_type',$post_type);
       $this->display();
    }
    /**
     * 状态 开放和关闭
     */
    public function status($id){
    	$model_post_type = new \Common\Model\PostTypeModel();
    	$post_type = $model_post_type->where("id={$id}")->find();
    	if($post_type['status']=='opened'){
    		$post_type['status'] = 'closed';
    		$model_post_type->save($post_type);
    	}else{
    		$post_type['status'] = 'opened';
    		$model_post_type->save($post_type);
    	}
    	$this->redirect('/admin/post_type/list');
    }
    /**
     * 删除
     */
    public function delete($id){
    	$model_post_type = new \Common\Model\PostTypeModel();
    	$model_post_type->where("id={$id}")->delete();
    	$this->redirect('/admin/post_type/list');
    }
}