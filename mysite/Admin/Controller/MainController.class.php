<?php
namespace Admin\Controller;
class MainController extends \Common\Controller\ControllerController {
	function _initialize(){
		$this->initialize();
	}
	/**
	 * 登陆
	 */
    public function login(){
        $model_client = new \Common\Model\ClientModel();
        $validate = $model_client::$validate;
    	$error = '';
    	if(IS_POST){
    		if (!$model_client->validate($validate)->create()){
    			$error = $model_client->getError();
    		}else{
    			session('admin_login',true);
    			$this->redirect('/admin');
    		}
    	}
    	$this->assign('error',$error);
        $this->display();
    }
    /**
     * 退出
     */
    function logout(){
    	session('admin_login',null);
    	$this->redirect('/admin');
    }
    /**
     * 上传图片
     */
    function upload_img(){
    	$path = C('UPLOAD_DIR')."/images/";; //图片路径
    	$flag = !empty($_POST['flag'])?true:false; //是否裁剪图片
    	$height = !empty($_POST['height'])?$_POST['height']:'600';
    	$width = !empty($_POST['width'])?$_POST['width']:'360';
    	
    	if (!file_exists($path)) {
    		mkdir($path, 0777, true);
    	}
    	
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     4*1024*1024 ;// 设置附件上传大小
    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$upload->rootPath  =     $path; // 设置附件上传根目录
    	$upload->saveName  =     'time'; //
    	// 上传文件
    	$info   =   $upload->upload();
    	if(!$info) {// 上传错误提示错误信息
    		$error = $upload->getError();
    		$result = array(
    				'status' => 'false',
    				'message'=>$error
    		);
    		echo json_encode($result);
    		exit;
    	}
    	$image_url = $path.$info['image']['savepath'].$info['image']['savename'];
    	if($flag){
	    		$image = new \Think\Image(); 
				$image->open($image_url);
/* 				$width = $image->width(); // 返回图片的宽度
				$height = $image->height(); // 返回图片的高度
				$type = $image->type(); // 返回图片的类型
				$mime = $image->mime(); // 返回图片的mime类型
				$size = $image->size(); // 返回图片的尺寸数组 0 图片宽度 1 图片高度 */
				$image->crop($width, $height)->save($image_url);
    	}
    	$result = array(
    		'status' => 'true',
    		'url' => U($image_url,'',''),
    	);
    	$this->ajaxReturn($result,'json');
    }
    /**
     * crop 上传图片
     */
    function upload_crop_img(){
    	/*
    	 *	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
    	 */
    	$imagePath = C('UPLOAD_DIR')."/temp/".date('Y-m-d').'/';
    	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
    	$temp = explode(".", $_FILES["img"]["name"]);
    	$extension = end($temp);
    	
    	if (!file_exists($imagePath)) {
    		mkdir($imagePath, 0777, true);
    	}
    	
    	//Check write Access to Directory
    	if(!is_writable($imagePath)){
    		$response = Array(
    				"status" => 'error',
    				"message" => 'Can`t upload File; no write Access'
    				);
    		print json_encode($response);
    		return;
    	}
    	
    	if ( in_array($extension, $allowedExts))
    	{
    		if ($_FILES["img"]["error"] > 0)
    		{
    			$response = array(
    					"status" => 'error',
    					"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
    			);
    		}
    		else
    		{
    				
    			$filename = $_FILES["img"]["tmp_name"];
    			list($width, $height) = getimagesize( $filename );
    	
    			move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);
    	
    			$response = array(
    					"status" => 'success',
    					"url" => U($imagePath.$_FILES["img"]["name"],'',''),
    					"width" => $width,
    					"height" => $height
    			);
    	
    		}
    	}
    	else
    	{
    		$response = array(
    				"status" => 'error',
    				"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
    		);
    	}
    	print json_encode($response);
    }
    /**
     * crop 保存图片
     */
    function save_crop_img(){
    	/*
    	 *	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
    	 */
    	$imgUrl = $_POST['imgUrl'];
    	// original sizes
    	$imgInitW = $_POST['imgInitW'];
    	$imgInitH = $_POST['imgInitH'];
    	// resized sizes
    	$imgW = $_POST['imgW'];
    	$imgH = $_POST['imgH'];
    	// offsets
    	$imgY1 = $_POST['imgY1'];
    	$imgX1 = $_POST['imgX1'];
    	// crop box
    	$cropW = $_POST['cropW'];
    	$cropH = $_POST['cropH'];
    	// rotation angle
    	$angle = $_POST['rotation'];
    	 
    	$jpeg_quality = 100;
    	 
    	$output_filename = C('UPLOAD_DIR')."/images/".date('Y-m-d').'/'.time();
    	 
    	// uncomment line below to save the cropped image in the same location as the original image.
    	//$output_filename = dirname($imgUrl). "/croppedImg_".rand();
    	$imgUrl = C('_ROOT_'). $imgUrl;
    	$what = getimagesize($imgUrl);
    	 
    	switch(strtolower($what['mime']))
    	{
    		case 'image/png':
    			$img_r = imagecreatefrompng($imgUrl);
    			$source_image = imagecreatefrompng($imgUrl);
    			$type = '.png';
    			break;
    		case 'image/jpeg':
    			$img_r = imagecreatefromjpeg($imgUrl);
    			$source_image = imagecreatefromjpeg($imgUrl);
    			error_log("jpg");
    			$type = '.jpeg';
    			break;
    		case 'image/gif':
    			$img_r = imagecreatefromgif($imgUrl);
    			$source_image = imagecreatefromgif($imgUrl);
    			$type = '.gif';
    			break;
    		default: die('image type not supported');
    	}
    	//Check write Access to Directory
    	 
    	if(!is_writable(dirname($output_filename))){
    		$response = Array(
    				"status" => 'error',
    				"message" => 'Can`t write cropped File'
    				);
    	}else{
    		 
    		// resize the original image to size of editor
    		$resizedImage = imagecreatetruecolor($imgW, $imgH);
    		imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
    		// rotate the rezized image
    		$rotated_image = imagerotate($resizedImage, -$angle, 0);
    		// find new width & height of rotated image
    		$rotated_width = imagesx($rotated_image);
    		$rotated_height = imagesy($rotated_image);
    		// diff between rotated & original sizes
    		$dx = $rotated_width - $imgW;
    		$dy = $rotated_height - $imgH;
    		// crop rotated image to fit into original rezized rectangle
    		$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
    		imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
    		imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
    		// crop image into selected area
    		$final_image = imagecreatetruecolor($cropW, $cropH);
    		imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
    		imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
    		// finally output png image
    		//imagepng($final_image, $output_filename.$type, $png_quality);
    		imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
    		$response = Array(
    				"status" => 'success',
    				"url" => U($output_filename.$type,'',''),
    				);
    	}
    	print json_encode($response);
    }
}