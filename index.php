<?php 
	define("IN_TG",true);
	//引入公共文件
	require dirname(__FILE__).'/init.inc.php';
	require ROOT_PATH.'/data.php';
	global $_tpl;
	$_tpl->display('index.tpl');	
?>