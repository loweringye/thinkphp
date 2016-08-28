<?php
namespace Admin\Controller;
use Common\Model;
use Common\Controller;
class LinkController extends Controller\ControllerController {
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
       $model_link = new \Common\Model\LinkModel();
       $condition = "client_id={$this->host['id']}";
       $count = $model_link->where($condition)->count();// 查询满足要求的总记录数
       $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       $show = $Page->show();// 分页显示输出
       $this->assign('page',$show);// 赋值分页输出
       $links = $model_link->where($condition)->select();
       $this->assign('links',$links);
       $this->assign('status',$model_link->status());
       $this->display();
    }
    /**
     * 新增、编辑友情链接
     */
    public function edit($id=null){
       $model_link = new \Common\Model\LinkModel();
	   $error = '';
       if(IS_POST){
       		if(I('post.id')){
       			$model_link->save($_POST);
       		}else{
       			$save_data = $_POST;
       			$save_data['client_id'] = $this->host['id'];
       			$save_data['status'] = "opened";
       			$save_data['created'] = date('Y-m-d H:m:s',time());
       			$model_link->add($save_data);
       		}
       		$error = $model_link->getError();
	       	if ($error){
	       		$this->redirect('/admin/link/list?error='.$error);
	       	}else{
	       		$this->redirect('/admin/link/list');
	       	}
       }
       $link = array();
       if($id){
       		$link = $model_link->where("id={$id}")->find();
       }
       $this->assign('link',$link);
       $this->display();
    }
    /**
     * 状态 开放和关闭
     */
    public function status($id){
    	$model_link = new \Common\Model\LinkModel();
    	$link = $model_link->where("id={$id}")->find();
    	if($link['status']=='opened'){
    		$link['status'] = 'closed';
    		$model_link->save($link);
    	}else{
    		$link['status'] = 'opened';
    		$model_link->save($link);
    	}
    	$this->redirect('/admin/link/list');
    }
    /**
     * 删除
     */
    public function delete($id){
    	$model_link = new \Common\Model\LinkModel();
    	$model_link->where("id={$id}")->delete();
    	$this->redirect('/admin/link/list');
    }
}