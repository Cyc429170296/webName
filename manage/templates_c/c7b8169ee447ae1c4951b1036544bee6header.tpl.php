<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS后台管理</title>
<link rel="stylesheet" type="text/css" href="style/admin.css" />
</head>
<body>
<div id='top'>
	<h1>LOGO</h1>
	<ul class='nav'>
		<li><a href="admin.php">系统设置</a></li>
		<?php foreach ($this->_arr['AllNav'] as $key=>$value) { ?>
		<li><a href="menu.php?m=<?php echo $value->mid?>"><?php echo $value->module_name?></a></li>
		<?php } ?>
	</ul>
	<p>
		您好，<strong><?php echo $this->_arr['admin_user'];?></strong> [ <a href="../" target="_blank">去首页</a> ] [ <a href="manage.php?action=logout" target="_parent">退出</a> ]
	</p>
</div>