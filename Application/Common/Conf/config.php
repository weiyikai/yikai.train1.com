<?php
return array(
	//'配置项'=>'配置值'
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'Index', // 默认操作名称
    define('APP_DEBUG',True), // 开启调试模式
    'URL_CASE_INSENSITIVE' => false,
    'URL_ROUTER_ON'=>true,//先在公共模块开启路由配置，接着去模块配置中设置路由规则
    //和配置有关的全局量
    'VIEW_URL_BASE'=>'',//同步链接view链接公共部分，方便移植
    'URL_MODEL' => 2,
    'URL_HTML_SUFFIX' => '',
    'site' => array(
        'name' => '出行无忧网火车票'
    ),
    'MODULE_ALLOW_LIST' => array('Home', 'Admin'),
    'LAYOUT_ON' => true

);