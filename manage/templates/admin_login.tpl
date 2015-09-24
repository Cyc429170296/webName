<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
<title>登录CMS后台管理系统</title>
<link rel="stylesheet" type="text/css" href="style/admin.css" />
<script type="text/javascript" src="js/admin_login.js"></script>
</head>
<body>

<form id="adminLogin" name="login" method="post" action="manage.php?action=login">
	<fieldset>
		<legend>登录CMS后台管理系统</legend>
		<label>账　号：<input type="text" name="admin_user" class="text" /></label>
		<label>密　码：<input type="password" name="admin_pass" class="text" /></label>
		<label>验证码：<input type="text" name="code" class="text" /></label>
		<label class="t">输入下图的字符，不区分大小写</label>
		<label><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" /></label>
		<input type="submit" value="登录" class="submit sub_btn" onclick="return checkLogin();" name="send" />
	</fieldset>
</form>




</body>
</html>