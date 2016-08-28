<?php
namespace Admin\Controller;
use Common\Model;
use Common\Controller;
class PostController extends Controller\ControllerController {
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
       $model_post = new \Common\Model\PostModel();
       $model_post_type = new \Common\Model\PostTypeModel();
       
       $condition = "client_id={$this->host['id']}";
       $count = $model_post->where($condition)->count();// 查询满足要求的总记录数
       $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       $show = $Page->show();// 分页显示输出
       $this->assign('page',$show);// 赋值分页输出
       
       $posts = $model_post->where($condition)->select();
       $types = $model_post_type->where("status='opened' AND client_id={$this->host['id']}")->select();
       foreach ($types as $type){
       		$post_types[$type['id']] = $type['name'];
       }
       $this->assign('post_types',$post_types);
       $this->assign('posts',$posts);
       $this->assign('status',$model_post->status());
       $this->display();
    }
    /**
     * 新增、编辑友情链接
     */
    public function edit($id=null){
       $model_post = new \Common\Model\PostModel();
       $model_post_type = new \Common\Model\PostTypeModel();
	   $error = '';
       if(IS_POST){
       		if(I('post.id')){
       			$model_post->save($_POST);
       		}else{
       			$save_data = $_POST;
       			$save_data['client_id'] = $this->host['id'];
       			$save_data['status'] = "opened";
       			$save_data['created'] = date('Y-m-d H:m:s',time());
       			$model_post->add($save_data);
       		}
       		$error = $model_post->getError();
	       	if ($error){
	       		$this->redirect('/admin/post/list?error='.$error);
	       	}else{
	       		$this->redirect('/admin/post/list');
	       	}
       }
       $post = array();
       if($id){
       		$post = $model_post->where("id={$id}")->find();
       }
       $post_types = $model_post_type->where("status='opened' AND client_id={$this->host['id']}")->select();
       $this->assign('post',$post);
       $this->assign('post_types',$post_types);
       $this->display();
    }
    /**
     * 状态 开放和关闭
     */
    public function status($id){
    	$model_post = new \Common\Model\PostModel();
    	$post = $model_post->where("id={$id}")->find();
    	if($post['status']=='opened'){
    		$post['status'] = 'closed';
    		$model_post->save($post);
    	}else{
    		$post['status'] = 'opened';
    		$model_post->save($post);
    	}
    	$this->redirect('/admin/post/list');
    }
    /**
     * 删除
     */
    public function delete($id){
    	$model_post = new \Common\Model\PostModel();
    	$model_post->where("id={$id}")->delete();
    	$this->redirect('/admin/post/list');
    }
}