<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="{$system[keyword]}">
<meta name="description" content="{$system[descript]}">
<title>{$system[webname]}</title>
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
			{foreach $nav(key,value)}
			<li><a href="article.php?m={@value[mid]}">{@value[module_name]}</a></li>
			{/foreach}
		</ul>	
	</div>
	<div class="banner">
		<ul class="pics">
			{foreach $banner(key,value)}
			<li><a href="javascript:void(0)"><img alt='{@value[title]}' src="upload/{@value[banner_src]}" width="1440" height="461" /></a></li>
			{/foreach}
		</ul>
		<a class="prev" href="javascript:void(0)"></a>
		<a class="next" href="javascript:void(0)"></a>
	</div>
