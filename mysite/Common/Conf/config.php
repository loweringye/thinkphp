<?php
return array(
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'thinkphp', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '888888', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PARAMS' =>  array(), // 数据库连接参数
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
	// 允许访问的模块列表
	'MODULE_ALLOW_LIST'    =>    array('Home','Admin','User'),
	// 设置禁止访问的模块列表
	'MODULE_DENY_LIST'      =>  array('Common','Runtime','Lib'),
	'DEFAULT_MODULE'     => 'Home', //默认模块
	'URL_CASE_INSENSITIVE'  =>  true,
    'URL_MODEL'          => '2', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session
    'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
    'DEFAULT_THEME'    =>    'Default',// 设置默认的模板主题
    'THEME_PATH'=>'View',
	'URL_HTML_SUFFIX'=>'html',
	'UPLOAD_DIR'=>"Public/upload",
	'_ROOT_'=>$_SERVER['DOCUMENT_ROOT'],
	'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(
		'api/xml' => 'Api/Xml/request',
		'api/json' => 'Api/Json/request',
		'web/spider' => 'Api/spider/request',
		'web/spider_content' => 'Api/spider/request_content',
		'web/spider_import' => 'Api/spider/request_import',
		'api/weixin' => 'Api/weixin/request',
		'api/jssdk' => 'Api/JSSDK/request',
	),
	SHOW_PAGE_TRACE=>false
);