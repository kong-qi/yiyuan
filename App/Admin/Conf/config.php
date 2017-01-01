<?php
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__JS__'     => WEB_URL.'/Public/'.MODULE_NAME.'/js', // 增加新的JS类库路径替换规则
        '__UPLOAD__' => WEB_ROOT.'/upload', // 增加新的上传路径替换规则
        '__CSS__' => WEB_URL.'/Public/'.MODULE_NAME.'/css', // 增加新的上传路径替换规则
        '__IMG__' => WEB_URL.'/Public/'.MODULE_NAME.'/images', // 增加新的上传路径替换规则


    ),
    'MORE_LANG'=>1,
    'ADV_LANMU'=>1,//栏目显示在广告位
    'PAGESIZE'=>'30',
    'INDEX_URL'=>'',
    'CHECK_YZM'=>'0',
     'URL_ROUTER_ON'   => false,
    'TMPL_ACTION_SUCCESS'=>'Layout:tips',
    'TMPL_ACTION_ERROR'=>'Layout:tips',
    'SYSTEM_NAME'=>'营销管理',
    'SYSTEM_V'=>'1.0',
    'SESSION_OPTIONS'         =>  array(
        'expire'              =>  24*3600                      //SESSION保存15天

    ),
    'DEFAULT_FILTER' => 'trim,htmlspecialchars'

);