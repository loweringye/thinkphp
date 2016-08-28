<?php
namespace Lib\Post;
class Api{
	public function request(){
		try{
		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			
			curl_setopt($ch, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$headers = array(
				//'User-Agent: PHP-SOAP/5.3.10',
				//'Accept-Encoding: gzip, deflate',
				//'Content-Type: application/xml; charset=utf-8',
				//'Content-Encoding: gzip',
				//'Content-Length: '.strlen($result['content'])
				"Content-Type: text/xml; charset=UTF-8",
				"Content-Encoding: UTF-8"
			);
			// Execute request, store response and HTTP response code
			$response_content = curl_exec($ch);
			curl_close($ch);
			$result = simplexml_load_string($response_content);
				
		}catch(Exception $e){
		  //todo 异常 日志
		}	
	}
	/**
	 * 并行查询
	 */
	function multi_request($targets = array()){
		$mh = curl_multi_init();
		$res = array() ;
		foreach ($targets as $key => $param) {
			if(!empty($param)){
				$conn[$key]=curl_init($param['url']);
				curl_setopt($conn[$key], CURLOPT_TIMEOUT, 30);
				curl_setopt($conn[$key], CURLOPT_RETURNTRANSFER,1);
				//curl_setopt($conn[$key], CURLOPT_HEADER,1);
				curl_setopt($conn[$key], CURLOPT_VERBOSE, '1');
				//curl_setopt($conn[$key], CURLOPT_ENCODING, 'gzip');
				curl_setopt($conn[$key], CURLOPT_HTTPHEADER,$param['headers']);
				//curl_setopt($conn[$key], CURLOPT_POST, 1);
				//curl_setopt($conn[$key], CURLOPT_POSTFIELDS,$param['content']);
				curl_multi_add_handle ($mh,$conn[$key]);
			}
		}
		$l = 1;
		$m = 1;
		do {
			$mrc = curl_multi_exec($mh,$active);
			//echo $l++ . "loop1..\n";
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);
		while ($active and $mrc == CURLM_OK) {
			if (curl_multi_select($mh) != -1) {
				do {
					$mrc = curl_multi_exec($mh, $active);
					//echo $m++ . "loop2..\n";
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
		}
		foreach ($targets as $key => $param) {
			if(!empty($param)){
				$content=curl_multi_getcontent($conn[$key]);
				curl_close($conn[$key]);
				//response
			}
		}
		curl_multi_close($mh);
		return $res;
	}
						
	/**
	 * 请求xml
	 */
	function request_xml($params){
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<ProfitRequest>';
		$xml .= $this->array_to_xml($params);
		$xml .= '</ProfitRequest>';
		return $xml;
	}
	/**
	 * 将数组转换成xml字符串
	 */
	function array_to_xml($params){
		$xml = '';
		foreach ($params as $key => $value) {
			if (is_array($value)) {
				if (!is_numeric($key)) {
					$xml = $xml."<".$key.">";
				}
				$xml = $xml . $this->array_to_xml($value);
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
	/**
	 * xml对象转换为数组
	 */
	public function process_attributes($item){
		$result = array();
		if (is_object($item)) {
			$result = get_object_vars($item);
			if (empty($result)) {
				return (string)$item;
			}elseif (count($result)==1 && isset($result['@attributes'])) {
				foreach ($result['@attributes'] as $k => $v) {
					$result[$k] = $v;
				}
				unset($result['@attributes']);
				$result['txt'] = (string)$item;
				return $result;
			}else{
				if (isset($result['@attributes'])) {
					foreach ($result['@attributes'] as $k => $v) {
						$result[$k] = $v;
					}
					unset($result['@attributes']);
				}
				foreach ($result as $key => $value) {
					if(count($item->$key)==1){
						$result[$key] = $item->$key;
					}
				}
			}
		}elseif (is_array($item)) {
			if (isset($item['@attributes'])) {
				foreach ($item['@attributes'] as $k => $v) {
					$item[$k] = $v;
				}
				unset($item['@attributes']);
			}
			$result = $item;
		}else{
			return $item;
		}
		foreach ($result as $key => $val) {
			$result[$key] = $this->process_attributes($val);
		}
		return $result;
	}
}