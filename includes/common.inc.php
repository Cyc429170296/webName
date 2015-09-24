<?php
	if(!defined("IN_TG")){
		echo "error";
		exit();
	}

	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 'On');

	//$start_time=_runtime();
	//define("start_time",_runtime());
	//$GLOBALS["start_time"]=_runtime();
	
	//引入函数库
	require ROOT_PATH.'/includes/global.func.php';
	require ROOT_PATH.'/includes/mysql.func.php';

	//创建数据库连接
	_connect();
	
	//选择一款数据库
	_select_db();
	
	//选择一款字符集
	_set_names();
	
	//设置导航;
	$_tpl->assign('nav',_all(_query("SELECT mid,module_name FROM tg_module")));
	
	//设置banner;
	$_tpl->assign('banner',_all(_query("SELECT banner_src,title FROM tg_banner where recom=1")));

	//设置页面参数;
	if(!!$_system = _fetch_array("SELECT * FROM tg_system LIMIT 1")){
		$_tpl->assign('system',$_system);
	}
	
	//设置用户信息;
	$_tpl->assign('user',_all(_query("SELECT * FROM tg_user")));
?>