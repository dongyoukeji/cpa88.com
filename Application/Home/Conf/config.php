<?php
return array(

	//剪短路由配置
	'URL_ROUTER_ON'   => true, //开启路由

	'URL_ROUTE_RULES' => array( //定义路由规则
		'/^notice'							=>'Notice/index?cid=:1',
		'/^notice\/(\d+)$/'				=>'Notice/index?cid=:1',
		'/^notice\/(\d+)\/(\w+)$/'		=>'Notice/index?cid=:1&q=:2',
		'/^details\/(\d+)$/'				=>'Private/detail?pid=:1',
		'/^details\/(\d+)\/(\d+)$/'		=>'Private/detail?pid=:1&p=:2',
		'/^notices\/(\d+)$/'				=>'Notice/details?id=:1',
		'/^product\/(\d+)$/'       		=> 'product/details?id=:1',
		'/^private'						=> 'Private/index',
		'login'							=>'index/login',
		'register'						    =>'Index/register',
		'logout'							=>'Private/logout',
		'about'		 					=> 'About/index',

		'/^my_product\/(\d+)$/'					=>'Private/mlist?t=:1',
		'/^my_product\/(\d+)\/(\w+)$/'			=>'Private/mlist?t=:1&tt=:2',
		'/^my_product\/(\w+)$/'					=>'Private/mlist?q=:1',
		'my_product'						    	=>'Private/mlist',

		'/^product\/(\d+)$/' 					=>'Product/index?t=:1',
		'/^pro_details\/(\d+)$/'				=>'Product/details?id=:1',
		'/^product\/(\d+)\/(\w+)$/' 			=>'Product/index?t=:1&tt=:2',
		'/^product\/(\d+)\/(\w+)\/(\w+)$/' 	=>'Product/index?t=:1&tt=:2&q=:3',
		'/^product\/(\d+)\/(\d+)\/(\w+)\/(\w+)$/' =>'Product/index?t=:1&tt=:2&q=:3&p=:4',

	),
	//数据库缓存
	'DB_SQL_BUILD_CACHE' => true,
	'DATA_CACHE_TIME'=>60,
	'DB_SQL_BUILD_LENGTH' => 20, // SQL缓存的队列长度

	//静态缓存
	'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
	'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
		'*'=>array('{$_SERVER.REQUEST_URI|MD5}'),
	),
	//加载标签库打开
	'TAGLIB_LOAD'               => true,
	'APP_AUTOLOAD_PATH'         =>'@.TagLib',
	'APP_AUTOLOAD_PATH' => '@.TagLib',
	'TAGLIB_BUILD_IN' => 'Cx,TagLibCustom',

	//资源列表
	'TMPL_PARSE_STRING'=>array(
		'__JS__'=> __ROOT__.'/Public/'.MODULE_NAME.'/js',
		 '__PLUG__'=> __ROOT__.'/Public/Plug',
		'__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
		'__IMAGES__'=> __ROOT__.'/Public/'.MODULE_NAME.'/images',
		'__FILES__'=> __ROOT__.'/Uploads/files'
	),
);