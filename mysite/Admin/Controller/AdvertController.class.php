<?php
namespace Admin\Controller;
use Common\Model;
use Common\Controller;
class AdvertController extends Controller\ControllerController {
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
       $model_advert = new \Common\Model\AdvertModel();
       $condition = "client_id={$this->host['id']}";
       $count = $model_advert->where($condition)->count();// 查询满足要求的总记录数
       $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       $show = $Page->show();// 分页显示输出
       $this->assign('page',$show);// 赋值分页输出
       $adverts = $model_advert->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
       $this->assign('adverts',$adverts);
       $this->assign('status',$model_advert->status());
       $this->display();
    }
    /**
     * 新增、编辑友情链接
     */
    public function edit($id=null){
       $model_advert = new \Common\Model\AdvertModel();
	   $error = '';
       if(IS_POST){
       		if(I('post.id')){
       			$model_advert->save($_POST);
       		}else{
       			$save_data = $_POST;
       			$save_data['client_id'] = $this->host['id'];
       			$save_data['status'] = "opened";
       			$save_data['created'] = date('Y-m-d H:m:s',time());
       			$model_advert->add($save_data);
       		}
       		$error = $model_advert->getError();
	       	if ($error){
	       		$this->redirect('/admin/advert/list?error='.$error);
	       	}else{
	       		$this->redirect('/admin/advert/list');
	       	}
       }
       $advert = array();
       if($id){
       		$advert = $model_advert->where("id={$id}")->find();
       }
       $this->assign('advert',$advert);
       $this->display();
    }
    /**
     * 状态 开放和关闭
     */
    public function status($id){
    	$model_advert = new \Common\Model\AdvertModel();
    	$advert = $model_advert->where("id={$id}")->find();
    	if($advert['status']=='opened'){
    		$advert['status'] = 'closed';
    		$model_advert->save($advert);
    	}else{
    		$advert['status'] = 'opened';
    		$model_advert->save($advert);
    	}
    	$this->redirect('/admin/advert/list');
    }
    /**
     * 删除
     */
    public function delete($id){
    	$model_advert = new \Common\Model\AdvertModel();
    	$model_advert->where("id={$id}")->delete();
    	$this->redirect('/admin/advert/list');
    }
}