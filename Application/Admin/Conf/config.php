<?php
return array(

	//资源列表
	'TMPL_PARSE_STRING'=>array(
		'__PUBLIC__'=> __ROOT__.'/Public',
		'__JS__'=> __ROOT__.'/Public/'.MODULE_NAME.'/js',
        '__PLUG__'=> __ROOT__.'/Public/'.MODULE_NAME.'/plug',
		'__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
		'__IMAGES__'=> __ROOT__.'/Public/'.MODULE_NAME.'/images',
		'__PLUG__'=> __ROOT__.'/Public/Plug',
		'__FILES__'=> __ROOT__.'/Uploads'
	),
    //SESSION前缀
    'SESSION_PREFIX'=>'Admin',
	//伪静态后缀
	'URL_HTML_SUFFIX'=>'',
	//默认分页
	'PAGE_SIZE'=>10,
	//积分抽取比列
	'JI_FEN'=>100,
	//抽税比列
	'SHUI'=>0.06,
	//自定义success和error的提示页面模板
	'TMPL_ACTION_SUCCESS'=>'Common:dispatch_jump',
	'TMPL_ACTION_ERROR'=>'Common:dispatch_jump',

);