<?php 
	global $_tpl;
	$_aside = "<dt>管理首页</dt>\n　　　　";
	if(isset($_GET['m']) && is_numeric($_GET['m'])){
		$_aside .= "<dd><a href='menu.php?m=".$_GET['m']."'>栏目管理</a></dd>\n　　　　　";
		$_aside .= "<dd><a href='content.php?m=".$_GET['m']."'>内容管理</a></dd>\n　　　　";
	}else{
		$_aside .= "<dd><a href='admin.php?action=1'>系统设置</a></dd>\n　　　　";
		$_aside .= "<dd><a href='admin.php?action=2'>用户信息</a></dd>\n　　　　";
		$_aside .= "<dd><a href='admin.php?action=3'>轮播图片</a></dd>\n　　　　";
		$_aside .= "<dd><a href='javascript:void(0);'>友情链接</a></dd>\n　　　　";
		$_aside .= "<dd><a href='module.php'>页面设置</a></dd>\n　　　　";
		$_aside .= "<dd><a href='javascript:void(0);'>管理员管理</a></dd>\n　　　　";
	}
	$_tpl->assign('aside',$_aside);
	$_tpl->create('aside.tpl');
?>