<?php
	session_start();//开始session
	
	header("Content-Type:text/html;charset=utf-8");//设置utf-8编码
	
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 'On');
	
	define('ROOT_PATH',dirname(__FILE__));//网站根目录
	
	require substr(ROOT_PATH,0,strlen(ROOT_PATH)-6).'/config/proFile.inc.php';//引入配置信息
	
	require ROOT_PATH.'/cache.inc.php';//缓存机制
	
	//require ROOT_PATH.'/includes/Templates.class.php';//引入模板类
	
	function __autoload($_className) {//实例化模板类
		if (substr($_className, -6) == 'Action') {
			require ROOT_PATH.'/action/'.$_className.'.class.php';
		} elseif (substr($_className, -5) == 'Model') {
			require ROOT_PATH.'/model/'.$_className.'.class.php';
		} else {
			require ROOT_PATH.'/includes/'.$_className.'.class.php';
		}
	}
	$_tpl = new Templates();
?>