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
  <div class="panel-heading">广告管理</div>
  <div class="panel-body">
    	<?php if(isset($_GET['error'])):?>
      		<div class="alert alert-danger text-center" role="alert"><?php echo $_GET['error'];?></div>
      	<?php endif;?>
  		<!-- Table -->
  		<div class="table-responsive">
			<table class="table table-hover table-bordered">
			    <tr class="active">
			    	<th width="50">序号</th>
			    	<th width="200">名称</th>
			    	<th>链接</th>
			    	<th width="100">图片</th>
			    	<th width="100">状态</th>
			    	<th width="100">操作</th>
			    </tr>
			    <?php $index=0;foreach($adverts as $advert):?>
			    <tr>
			    	<td><?php echo ++$index;?></td>
			    	<td><?php echo $advert['name'];?></td>
			    	<td><?php echo $advert['url'];?></td>
			    	<td><img src="<?php echo U($advert['image_url'],'','');?>" width="64" height="64"/></td>
			    	<td><?php echo $status[$advert['status']];?></td>
			    	<td>
			    	<div class="dropdown">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					    操作
					    <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					    <li><a class="open-dialog" data-toggle="modal"  data-target="#addFormModal" href="<?php echo U('/admin/advert/edit/'.$advert['id'],'','')?>">编辑</a></li>
					    <li><a href="<?php echo U('/admin/advert/status/'.$advert['id'],'','')?>"><?php echo $advert['status']=='opened'?'关闭':'开放';?></a></li>
					    <li><a href="<?php echo U('/admin/advert/delete/'.$advert['id'],'','')?>">删除</a></li>
					  </ul>
					</div>
			    	</td>
			    </tr>
			    <?php endforeach;?>
			</table>
		</div>
		<?php echo $page;?>
  </div>
</div>
</div> <!-- /container -->

</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>