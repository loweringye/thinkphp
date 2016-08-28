<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>后台管理系统登陆</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo get_static_url('Css/login.css');?>" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.jCs"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">后台管理系统登陆</h2>
        <label for="inputEmail" class="sr-only">登陆账号</label>
        <input type="text" name ="code" id="inputCode" class="form-control" placeholder="登陆账号" required autofocus>
        <label for="inputPassword" class="sr-only">登陆密码</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="登陆密码" required>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">确定登陆</button>
      </form>
      <?php if($error):?>
      	<div class="alert alert-danger text-center" role="alert"><?php echo $error;?></div>
      <?php endif;?>

    </div> <!-- /container -->

  </body>
</html>