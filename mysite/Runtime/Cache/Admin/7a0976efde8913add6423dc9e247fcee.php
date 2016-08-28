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
  <div class="panel-heading">账号密码</div>
  <div class="panel-body">
  		<form class="form-horizontal" method="post">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">网站账号</label>
		    <div class="col-sm-10">
		      	<input type="text" class="form-control" value="<?php echo ($host['code']); ?>" disabled>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">新的密码</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" placeholder="请填写您的新的密码" required name="password">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">确认密码</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" placeholder="请填写您的新的确认密码" required name="re_password">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">保存修改</button>
		    </div>
		  </div>
		</form>
		<?php if($error):?>
      		<div class="alert alert-danger text-center" role="alert"><?php echo $error;?></div>
      	<?php endif;?>
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