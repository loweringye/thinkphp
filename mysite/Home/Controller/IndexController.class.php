<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$jssdk = new \Api\Controller\JSSDKController('wx27c73742201f4d58', '021518e0e934f9d02d35107a98832d74');
    	$this->assign('jssdk',$jssdk->getSignPackage());
    	$this->display();
    }
    public function read(){

    }
}