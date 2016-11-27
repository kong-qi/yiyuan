<?php
return array(
	//'配置项'=>'配置值'
    'WEB_URL'=>"http://".$_SERVER['HTTP_HOST'].substr($_SERVER['SCRIPT_NAME'],0,strpos($_SERVER['SCRIPT_NAME'],"/")),
    'WEB_ROOT'=>str_replace("\\","/",dirname(str_replace("Common\\Conf","",dirname(__FILE__))))."/",
    'TMPL_TEMPLATE_SUFFIX'  =>  '.html',
    'SITE_NAME'=>'网站管理系统',
    'URL_MODEL'=>2,
    'DEFAULT_TIMEZONE'      =>  'Etc/GMT-7',
    'UPLOAD'=>WEB_ROOT."/upload",
    'UPLOAD_URL'=>"/upload",
    'FILE_PAGES'=>'20',
    'NOTTHING'=>'没有数据',
    'THUMBS_TRUE'=>1,
    'THUMBS_SMALL'=>array(
        '400x300'=>array(
            'max_width' => 600,
            'max_height' => 450
        )
    ),

    'URL_CASE_INSENSITIVE' =>true,
    'SHOW_PAGE_TRACE' =>0,
    'LOAD_EXT_CONFIG' => 'db',
    'MODULE_ALLOW_LIST' => array('Admin'),//去掉Home
    'TMPL_L_DELIM'          =>  '{{ ',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          =>  ' }}',            // 模板引擎普通标签结束标记


    
    
);