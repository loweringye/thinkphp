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
    <link rel="stylesheet" type="text/css" href="<?php echo get_static_url('css/css.css');?>" />
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Css/iconfont/iconfont.css" />
    
<script type="text/javascript" src="/Public/Js/upload.js"></script>
<script type="text/javascript" src="/Public/Js/jquery-form.js"></script>
<script type="text/javascript" src="/Public/Js/jquery-form.js"></script>
<script type="text/javascript" src="/Public/Js/jquery-form.js"></script>
<script type="text/javascript" src="/Public/Js/ueditor/ueditor-config.js"></script>
<script type="text/javascript" src="/Public/Js/ueditor/ueditor-all.js"></script>

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
  <div class="panel-heading">
 	<div class="pull-left">文章<?php echo !empty($post['id'])?'编辑':'新增';?></div>
  	<div class="pull-left">
  		<a href="<?php echo U('/admin/post/list')?>"><span class="glyphicon glyphicon-arrow-left pull-left" aria-hidden="true"></span><span class="pull-left">返回</span></a>
  	</div>
  	<div class="clearfix"></div> 
  </div>
  <div class="panel-body">
		<form class="form-horizontal" method="post" action="<?php echo U('/admin/post/add','','')?>" id="save-form">
		  <input type="hidden" name="id" value="<?php echo $post['id']?>" >
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" placeholder="请填写您的标题" required name="name" maxlength="32" value="<?php echo $post['name']?>">
		    </div>
		  </div>
		  <div class="form-group">
			  <label for="inputEmail3" class="col-sm-2 control-label">分类</label>
			  <div class="col-sm-10">
				  <select class="form-control" required name="type_id">
				  	<?php foreach($post_types as $type):?>
				  	<option value="<?php echo ($type['id']); ?>" <?php echo $post['type_id']==$type['id']?'selected':'';?>><?php echo ($type['name']); ?></option>
				  	<?php endforeach;?>
				  </select>
			  </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">上传图片</label>
		    <div class="col-sm-10" data-type = "image_url" class="img-add img-thumbnail" data-width="64" data-height="64" data-upload-height="100" data-upload-width="100" data-flag="true" data-input-name="image_url">
		  		<?php if($post['image_url']):?>
		    		<img src="<?php echo ($post['image_url']); ?>" width="64" height="64" class="img-add"/>
		    	<?php else:?>
		    		<i class="iconfont img-add">&#xe617;</i>
		    	<?php endif;?>
		    </div>
		  </div>
		  <div class="form-group">
			  <label for="inputEmail3" class="col-sm-2 control-label">内容</label>
			  <div class="col-sm-10">
				 <textarea id="content" style="width:$('input').width();" name="content"><?php echo ($post['content']); ?></textarea>
			  </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">保存确定</button>
		    </div>
		  </div>
		</form>
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
  		<?php if(isset($_GET['error'])):?>
      		<div class="alert alert-danger text-center" role="alert"><?php echo $_GET['error'];?></div>
      	<?php endif;?>
  </div>
</div>
</div> <!-- /container -->
<script>
$(function (){
	var ue = UE.getEditor('content');
	$("#save-btn").click(function (){
		$("#save-form input[type='submit']").click();
	});
})
</script>

</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>