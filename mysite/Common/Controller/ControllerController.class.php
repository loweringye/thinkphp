<?php
namespace Common\Controller;
use Think\Controller;
class ControllerController extends Controller {
	public $host ;
	function initialize(){
		$this->host = current_host();
		if(!$this->host){
			die('forbbiden!');
		}
		$this->assign('host',$this->host);
	}
}