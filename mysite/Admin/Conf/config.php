<?php
return array(
	//'配置项'=>'配置值'
	 'URL_ROUTER_ON'   => true,
     'URL_ROUTE_RULES'=>array(
	  		'main/login' => 'Admin/Main/login',
     		'main/logout' => 'Admin/Main/logout',
     		'index/set' => 'Admin/Index/index',
     		'index/nav' => 'Admin/Index/nav',
     		'index/ajax_save_client' => 'Admin/Index/ajax_save_client',
     		'index/aacout' => 'Admin/Index/aacout',
     		'upload/crop/img'=>'Admin/Main/upload_crop_img',
     		'save/crop/img'=>'Admin/Main/save_crop_img',
     		'upload/img'=>'Admin/Main/upload_img',
     		'link/add' => 'Admin/Link/edit',
     		'link/edit/:id' => 'Admin/Link/edit',
     		'link/list' => 'Admin/Link/index',
     		'link/status/:id' => 'Admin/Link/status',
     		'link/delete/:id' => 'Admin/Link/delete',
     		'advert/add' => 'Admin/Advert/edit',
     		'advert/edit/:id' => 'Admin/Advert/edit',
     		'advert/list' => 'Admin/Advert/index',
     		'advert/status/:id' => 'Admin/Advert/status',
     		'advert/delete/:id' => 'Admin/Advert/delete',
     		
     		'post/add' => 'Admin/Post/edit',
     		'post/edit/:id' => 'Admin/Post/edit',
     		'post/list' => 'Admin/Post/index',
     		'post/status/:id' => 'Admin/Post/status',
     		'post/delete/:id' => 'Admin/Post/delete',
     		
     		'post_type/add' => 'Admin/PostType/edit',
     		'post_type/edit/:id' => 'Admin/PostType/edit',
     		'post_type/list' => 'Admin/PostType/index',
     		'post_type/status/:id' => 'Admin/PostType/status',
     		'post_type/delete/:id' => 'Admin/PostType/delete',
      ),
);