<?php

return array(
	//'配置项'=>'配置值'
	
	//允许访问的模块列表
	'MODULE_ALLOW_LIST'    	=>  array('Home','Admin'),
	// 设置禁止访问的模块列表
	//'MODULE_DENY_LIST'      =>  array('Common','Runtime','Tool'),
	//默认模块
	'DEFAULT_MODULE'     	=> 'Home',
	//URL模式
    'URL_MODEL'          	=> '2',
	//是否开启session
    'SESSION_AUTO_START' 	=> true,
	//URL地址不区分大小写
	'URL_CASE_INSENSITIVE'  =>  true,	
	//显示条数
	'PAGE_SIZE'				=>10,
	'DOMAIN'					=>'/',
	//加载扩展配置文件
	'LOAD_EXT_CONFIG' =>'db,extend,qq',
	
	//加载自定义类库(带命名空间)
	'AUTOLOAD_NAMESPACE' =>array(
		'Space'=>'@.Tool',
		),

	//默认上传配置
    'DEFAULT_UPLOAD_CONFIG'=>array(
        'IMAGE_SIZE'=>1024*1024*26,
        'FILES_SIZE'=>1024*1024*250,
		'FILES_EXT'=>array('x-zip-compressed','txt','png','jpg','png','jpeg','octet-stream','apk'),
        'IMAGES' => './Uploads/images/', 	// 增加新的图片上传路径
        'FILES' => './Uploads/files/', 		// 增加新的文件上传路径
    ),

	// 关闭字段缓存
	'DB_FIELDS_CACHE'		=>false,

	/* 日志设置 */
	'LOG_RECORD' => false, // 默认不记录日志
	'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误

	'DB_SQL_LOG' => false, // SQL执行日志记录
	'LOG_FILE_SIZE' => 2097152,	// 日志文件大小限制
	'LOG_EXCEPTION_RECORD' => false, // 是否记录异常信息日志
);
