<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS后台管理</title>
<link rel="stylesheet" type="text/css" href="style/admin.css" />
</head>
<body>
<?php include 'header.inc.php'; ?>
<?php include 'aside.inc.php'; ?>
<div id="main">
	<div class='infos_box'></div>
	<?php if ($this->_arr['show']) {?>
		管理首页 &gt;&gt; 页面设置
		<ol class='add_module'><li><a class='selected' href='javascript:void(0);'>添加模板</a></li></ol>
		<form name='sys_module' class='sys_module' action='admin.php?action=3' method='post'>
			<table class='module_table'>
				<tr>
					<th width='120'>编　号：</th>
					<th width='120'>导 航 名：</th>
					<th width='120'>模 板 名：</th>
					<th width='120'>内 页 名：</th>
					<th width='120'>页面属性1</th>
					<th width='120'>页面属性2</th>
					<th width='120'>页面属性3</th>
					<th width='120'>相同页面</th>
					<th width='120'>操作：</th>
				</tr>
				<?php foreach ($this->_arr['getModule'] as $key=>$value) { ?>
				<tr mid=<?php echo $value->mid?>>
					<td><?php echo $value->mid?></td>
					<td><input type="text" name="module_name" class="text" value="<?php echo $value->module_name?>" /></td>
					<td><input type="text" name="module_tpl" class="text" value="<?php echo $value->module_tpl?>" /></td>
					<td><input type="text" name="module_det" class="text" value="<?php echo $value->module_det?>" /></td>
					<td><input type="text" name="param1" class="text" value="<?php echo $value->param1?>" /></td>
					<td><input type="text" name="param2" class="text" value="<?php echo $value->param2?>" /></td>
					<td><input type="text" name="param3" class="text" value="<?php echo $value->param3?>" /></td>
					<td><input type="text" name="module_same" class="text" value="<?php echo $value->module_same?>" /></td>
					<td>
						<a class='module_update' href='javascript:void(0)'>提交修改</a>
						<a class='module_del' href='javascript:void(0)'>删除</a>
					</td>
				</tr>
				<?php } ?>
			</table>
		</form>
	<?php } ?>
</div>
<script src='js/jquery.min.js' /></script>
<script src='js/global.js' /></script>
<script src='js/sys.js' /></script>
</body>
</html>