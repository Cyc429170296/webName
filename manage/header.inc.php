<?php 
	require_once dirname(__FILE__).'/init.inc.php';
	global $_tpl;
	new NavAction($_tpl); 
	$_tpl->assign('admin_user',$_SESSION['admin']['admin_user']);
	$_tpl->create('header.tpl');
?>