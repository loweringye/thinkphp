<?php
function get_static_url($url){
    return "/".APP_PATH.MODULE_NAME."/".C('THEME_PATH').'/'.C('DEFAULT_THEME').'/'.$url;
}
function current_client(){
    return session('admin_login')?session('admin_login'):false;
}
function current_host(){
	$host = $_SERVER['HTTP_HOST'];
	$model_client = new \Common\Model\ClientModel();
	$client = $model_client->where("status='opened' AND host='{$host}'")->find();
	if($client){
		return $client;
	}else{
		return null;
	}
}
function debug($params){
	echo "<pre>";
	print_r($params);
	echo "</pre>";
}
/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $m 模型，引用传递
 * @param $where 查询条件
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage(&$m,$where,$pagesize=10){
	$m1=clone $m;//浅复制一个模型
	$count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
	$m=$m1;//为保持在为定的连惯操作，浅复制一个模型
	$p=new Think\Page($count,$pagesize);
	$p->lastSuffix=false;
	$p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>%LIST_ROW%</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	$p->setConfig('prev','上一页');
	$p->setConfig('next','下一页');
	$p->setConfig('last','末页');
	$p->setConfig('first','首页');
	$p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

	$p->parameter=I('get.');

	$m->limit($p->firstRow,$p->listRows);

	return $p;
}
//将数组转换成xml字符串
function arrayToXml($array) {
	$xml = '';
	foreach ($array as $key => $value) {
		if (is_array($value)) {
			if (!is_numeric($key)) {
				$xml = $xml."<".$key.">";
			}
			$xml = $xml.arrayToXml($value);
			if (!is_numeric($key)) {
				$xml = $xml."</".$key.">";
			}

		}
		elseif ($key == 'is_attribute'){
			$xml = $xml.$value;
		}
		else {
			$xml = $xml."<".$key.">";
			$xml = $xml.$value;
			$xml = $xml."</".$key.">";

		}
	}
	return $xml;
}
//将对象转换成数组
function objectToArray(&$object)
{
	$object = (array)$object;
	foreach ($object as $key => $value)
	{
		if (is_object($value)) {
			objectToArray($value);
			$object[$key] = $value;
		}
		if (is_array($value)) {
			objectToArray($value);
			$object[$key] = $value;
		}
	}
	return $object;
}
/**
 * 取得字符串的长度，包括中英文。
 */
function mstrlen($str,$charset = 'UTF-8'){
	if (function_exists('mb_substr')) {
		$length=mb_strlen($str,$charset);
	} elseif (function_exists('iconv_substr')) {
		$length=iconv_strlen($str,$charset);
	} else {
		preg_match_all("/[x01-x7f]|[xc2-xdf][x80-xbf]|xe0[xa0-xbf][x80-xbf]|[xe1-xef][x80-xbf][x80-xbf]|xf0[x90-xbf][x80-xbf][x80-xbf]|[xf1-xf7][x80-xbf][x80-xbf][x80-xbf]/", $text, $ar);
		$length=count($ar[0]);
	}
	return $length;
}