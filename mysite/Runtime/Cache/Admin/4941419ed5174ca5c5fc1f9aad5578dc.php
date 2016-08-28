<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>后台管理系统</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo get_static_url('Css/css.css');?>" />
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Css/iconfont/iconfont.css" />
    
<link rel="stylesheet" type="text/css" href="/Public/Css/croppic.css" />
<script type="text/javascript" src="/Public/Js/croppic.js"></script>
<script type="text/javascript" src="/Public/Js/upload.js"></script>
<script type="text/javascript" src="/Public/Js/jquery-form.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/Css/common.css" />
</head>

<body role="document">

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo U('/')?>">管理后台</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">基本管理</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo U('/admin/index/set')?>">基本资料</a></li>
                        <li><a href="<?php echo U('/admin/index/nav')?>">导航设置</a></li>
                        <li><a href="<?php echo U('/admin/index/accout')?>">账号密码</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">链接管理</a>
                    <ul class="dropdown-menu">
                        <li><a class="open-dialog" data-toggle="modal"  data-target="#addFormModal" href="<?php echo U('/admin/link/add')?>">链接新增</a></li>
                        <li><a href="<?php echo U('/admin/link/list')?>">链接列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">广告管理</a>
                    <ul class="dropdown-menu">
                        <li><a class="open-dialog" data-toggle="modal"  data-target="#addFormModal" href="<?php echo U('/admin/advert/add')?>">广告新增</a></li>
                        <li><a href="<?php echo U('/admin/advert/list')?>">广告列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">文章管理</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo U('/admin/post/list')?>">文章列表</a></li>
                        <li><a href="<?php echo U('/admin/post_type/list')?>">文章类型</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#contact">产品管理</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
	            <li><a href="<?php echo U('/admin/main/logout')?>"><?php echo $host['name']?>，欢迎您！退出</a></li>
          	</ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div id="main" class="main" >
    
<div class="container theme-showcase" role="main">
<div class="panel panel-default">
  <div class="panel-heading">基本资料</div>
  <div class="panel-body">
  		<form class="form-horizontal" method="post">
  		  <input type="hidden" name="id" value="<?php echo $host['id']?>" >
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">公司名称</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="请填写您的公司名称" required name="name" maxlength="32" value="<?php echo ($host['name']); ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">联系电话</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="请填写您的联系电话" required name="tel" maxlength="32" value="<?php echo ($host['tel']); ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">手机号码</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="请填写您的手机号码" required name="mobile" maxlength="11" value="<?php echo ($host['mobile']); ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">联系地址</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="请填写您的地址" required name="address" maxlength="64" value="<?php echo ($host['address']); ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">邮箱地址</label>
		    <div class="col-sm-10">
		      <input type="email" class="form-control" placeholder="请填写您的邮箱地址" required name="email" maxlength="32" value="<?php echo ($host['email']); ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">备案号吗</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="请填写您的备案号吗" required name="copyright" maxlength="32" value="<?php echo ($host['copyright']); ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">网站关键字</label>
		    <div class="col-sm-10">
		      <textarea rows = "5" class="form-control" placeholder="请填写您的网站关键字" required name="keyword" maxlength="256"><?php echo ($host['keyword']); ?></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">网站描述</label>
		    <div class="col-sm-10">
		      <textarea rows = "5" class="form-control" placeholder="请填写您的网站描述" required name="description" maxlength="256"><?php echo ($host['description']); ?></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Favicon</label>
		    <div class="col-sm-10" data-type = "favicon_url" class="img-add img-thumbnail" data-save-url = "<?php echo U('/admin/index/ajax_save_client','','')?>" data-width="32" data-height="32" data-upload-height="32" data-upload-width="32" data-flag="true">
		    	<?php if($host['favicon_url']):?>
		    		<img src="<?php echo ($host['favicon_url']); ?>" width="32" height="32" class="img-add"/>
		    	<?php else:?>
		    		<i class="iconfont img-add" id="favicon">&#xe65b;</i>
		    	<?php endif;?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Logo</label>
		    <div class="col-sm-10" data-type = "logo_url" class="img-add img-thumbnail" data-save-url = "<?php echo U('/admin/index/ajax_save_client','','')?>" data-width="100" data-height="100" data-upload-height="200" data-upload-width="200" data-flag="true">
		      	<?php if($host['logo_url']):?>
		    		<img src="<?php echo ($host['logo_url']); ?>" width="100" height="100" class="img-add"/>
		    	<?php else:?>
		    		<i class="iconfont img-add" id="logo">&#xe65b;</i>
		    	<?php endif;?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">电话图片</label>
		    <div class="col-sm-10" data-type = "contact_url" class="img-add img-thumbnail" data-save-url = "<?php echo U('/admin/index/ajax_save_client','','')?>" data-width="100" data-height="100" data-upload-height="200" data-upload-width="200" data-flag="true">
		      <?php if($host['contact_url']):?>
		    		<img src="<?php echo ($host['contact_url']); ?>" width="100" height="100" class="img-add"/>
		    	<?php else:?>
		    		<i class="iconfont img-add" id="contact">&#xe65b;</i>
		    	<?php endif;?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">二维码</label>
		    <div class="col-sm-10" data-type = "wechat_url" data-save-url = "<?php echo U('/admin/index/ajax_save_client','','')?>">
		    	<?php if($host['contact_url']):?>
		    		<img src="<?php echo ($host['contact_url']); ?>" width="100" height="100" class="img-add"/>
		    	<?php else:?>
		    		<i class="iconfont img-add" id="contact">&#xe65b;</i>
		    	<?php endif;?>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">保存确定</button>
		    </div>
		  </div>
		</form>
		<?php if($error):?>
      		<div class="alert alert-danger text-center" role="alert"><?php echo $error;?></div>
      	<?php endif;?>
  </div>
</div>
</div> <!-- /container -->
<form class="form-horizontal hidden" id="img-add-form" data-curl="<?php echo U('/admin/upload/img','','')?>">
   <div class="col-sm-9">
   	<input type="hidden"  class="" value="1" name="image_file"/>
   	<input type="file"  id="img-add-form-file" class="pointer" name="image" />
   	<input type="hidden" name="image" />
   </div>
</form>
<div id="upload-loading" style="position: absolute;left: 0px; right: 0px;top: 0px;background: rgba(0, 0, 0, 0.5);;width: 100%;height: 100%;z-index: 9999999; display:none;">
	<div class="upload-loading">
	  <div class="upload-loading-container container1">
	    <div class="circle1"></div>
	    <div class="circle2"></div>
	    <div class="circle3"></div>
	    <div class="circle4"></div>
	  </div>
	  <div class="upload-loading-container container2">
	    <div class="circle1"></div>
	    <div class="circle2"></div>
	    <div class="circle3"></div>
	    <div class="circle4"></div>
	  </div>
	  <div class="upload-loading-container container3">
	    <div class="circle1"></div>
	    <div class="circle2"></div>
	    <div class="circle3"></div>
	    <div class="circle4"></div>
	  </div>
	</div>
</div>
<script>
var croppicContainerModalOptions = {
		uploadUrl:'<?php echo U('/admin/upload/crop/img','','')?>',
		cropUrl:'<?php echo U('/admin/save/crop/img','','')?>',
		modal:false,
		imgEyecandyOpacity:0.4,
		loadPicture:'<?php echo $host['wechat_url']?U($host['wechat_url'],'',''):'';?>',
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
		onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
		onImgDrag: function(){ console.log('onImgDrag') },
		onImgZoom: function(){ console.log('onImgZoom') },
		onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
		onAfterImgCrop:function(that){
			if(that.status=='success'){
				$.post($('#'+$(this).attr('id')).attr('data-save-url'),{key:$('#'+$(this).attr('id')).attr('data-type'),value:that.url})
			}
		},
		onReset:function(that){
			console.log(that);
			$.post($('#'+$(this).attr('id')).attr('data-save-url'),{key:$('#'+$(this).attr('id')).attr('data-type'),value:''})
		},
		onError:function(errormessage){ console.log('onError:'+errormessage) }
}
var cropContainerModal = new Croppic('wechat', croppicContainerModalOptions);
</script>

</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>