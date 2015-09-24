<?php 
	//设置utf-8编码
	header("Content-Type:text/html;charset=utf-8");
	if(!defined("IN_TG")){
		echo "error";
		exit();
	}
	//网站根目录
	define('ROOT_PATH',dirname(__FILE__));
	
	//引入配置信息
	require ROOT_PATH.'/config/proFile.inc.php';
	
	//缓存机制
	require 'cache.inc.php';
	
	//引入模板类
	require ROOT_PATH.'/includes/Templates.class.php';
	
	//实例化模板类
	$_tpl = new Templates();
	
	//引入公共文件
	require ROOT_PATH.'/includes/common.inc.php';
?>