<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="<?php echo $this->_arr['system'][keyword];?>">
<meta name="description" content="<?php echo $this->_arr['system'][descript];?>">
<title><?php echo $this->_arr['system'][webname];?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="head">
		<div class="middle">
			<a href=""  class="logo" ><img src="images/index_02.png" height="71" width="687" alt=""/></a>
			<div class="tel"><img src="images/dianhua_03.png" height="46" width="200" alt="" /></div>
		</div>
	</div>
	<div class="nav">
		<ul>
			<li><a href="/">网站首页</a></li>
			<?php foreach ($this->_arr['nav'] as $key=>$value) { ?>
			<li><a href="article.php?m=<?php echo $value[mid]?>"><?php echo $value[module_name]?></a></li>
			<?php } ?>
		</ul>	
	</div>
	<div class="banner">
		<ul class="pics">
			<?php foreach ($this->_arr['banner'] as $key=>$value) { ?>
			<li><a href="javascript:void(0)"><img alt='<?php echo $value[title]?>' src="upload/<?php echo $value[banner_src]?>" width="1440" height="461" /></a></li>
			<?php } ?>
		</ul>
		<a class="prev" href="javascript:void(0)"></a>
		<a class="next" href="javascript:void(0)"></a>
	</div>
