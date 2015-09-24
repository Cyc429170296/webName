<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS后台管理</title>
<link rel="stylesheet" type="text/css" href="style/admin.css" />
</head>
<body>
{include file='header.inc.php'}
{include file='aside.inc.php'}
<div id="main">
	<div class="map">
		管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
	</div>
	{if $show}
		<ol>
			<li><a href='javascript:void(0);' class='selected'>内容列表</a></li>
			{if $count}
			<li><a href='content.php?action=add&m={$mid}'>添加内容</a><li>
			{/if}
			<li class='pull_down_box'>
			   <select class='content_list_sel sel'>
			   		 <option value='all'>显示全部</option>
                 	{foreach $getMenu(key,value)}
                 		{if @value->pid==$pid}
                         <option value='{@value->pid}' selected>{@value->menu_name}</option>
                        {else}
                         <option value='{@value->pid}'>{@value->menu_name}</option>
                        {/if}
					{/foreach}
			   </select>
			</li>
		</ol>
		<table class='content_table' cellspacing="0">
			<tr>
				<th width='40'>编号</th>
				<th width='80'>所属栏目</th>
				<th width='180'>标题</th>
				<th width='180'>图片/文件</th>
				<th width='230'>内容</th>
				<th width='80'>{$getParam->param1}</th>
				<th width='80'>{$getParam->param2}</th>
				<th width='80'>{$getParam->param3}</th>
				<th width='50'>推荐首页</th>
				<th width='70'>操作</th>
			</tr>
			{if $count}
			{foreach $AllContent(key,value)}
			<tr>
				<td>{@value->id}</td>
				<td>{@value->menu_name}</td>
				<td>{@value->title}</td>
				<td>
					{if @value->img_src}
						{if $download}
							{@value->img_src}
						{else}
							<img src='../upload/{@value->img_src}' />
						{/if}
					{/if}
				</td>
				<td>mb_substr({@value->content},0,60,'utf-8')...</td>
				<td>{@value->param1}</td>
				<td>{@value->param2}</td>
				<td>{@value->param3}</td>
				<td>
					{if @value->recom}
					<input type='checkbox' disabled="disabled" checked />
					{else}
					<input type='checkbox' disabled="disabled" />
					{/if}
				</td>
				<td>
					<a href='content.php?action=update&m={$mid}&id={@value->id}'>修改</a> | 
					<a href='content.php?action=delete&m={$mid}&id={@value->id}&del_img={@value->img_src}' onclick="return confirm('你真的要删除这个内容吗？') ? true : false">删除</a>
				</td>
			</tr>
			{/foreach}
			{else}
			<tr><td colspan='10'>当前没有栏目,请先添加栏目</td></tr>
			{/if}
		</table>
		<div id="page">{$page}</div>
	{/if}
	{if $content_deal}
		<ol>
			<li><a href='content.php?action=show&m={$mid}'>内容列表</a></li>
			<li><a href='javascript:void(0);' class='selected'>{$title}</a><li>
		</ol>
		<script src='ckeditor/ckeditor.js'></script>
		<form action="content.php?action={$type}&m={$mid}" method="post" enctype="multipart/form-data">
			<input type='hidden' name='id' value='{$getOneContent->id}' />
			<input type='hidden' name='del_img' value='{$getOneContent->img_src}' />
			<table class='tb_update'>
				<tr>
					<td width='120'>所属栏目</td>
					<td width='400' class='tb_left'>
						<div class='ctr'>
					        <select name='pid'>
					   		{foreach $getMenu(key,value)}
					   			{if @value->pid==$getOneContent->pid}
                              		<option value='{@value->pid}' selected>{@value->menu_name}</option>
					   			{else}
					   				<option value='{@value->pid}'>{@value->menu_name}</option>
					   			{/if}
					   		{/foreach}
					   		</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>首页推荐</td>
					{if $getOneContent->recom}
					<td class='tb_left'><div class='ctr'><input type='checkbox' name='recom' value='{$getOneContent->recom}' checked /></div></td>
					{else}
					<td class='tb_left'><div class='ctr'><input type='checkbox' name='recom' value='{$getOneContent->recom}' /></div></td>
					{/if}
				</tr>
				<tr>
					<td>标题</td>
					<td class='tb_left'><input type='text' name='title' class='text' value='{$getOneContent->title}' /></td>
				</tr>
				<tr>
					<td>{$getParam->param1}</td>
					<td class='tb_left'><input type='text' name='param1' class='text' value='{$getOneContent->param1}' /></td>
				</tr>
				<tr>
					<td>{$getParam->param2}</td>
					<td class='tb_left'><input type='text' name='param2' class='text' value='{$getOneContent->param2}' /></td>
				</tr>
				<tr>
					<td>{$getParam->param3}</td>
					<td class='tb_left'><input type='text' name='param3' class='text' value='{$getOneContent->param3}' /></td>
				</tr>
				<tr>
					<td>图片/文件</td>
					<td class='tb_left'>
						{if $download}
							<input type='text' name='img_src' class='text' value='{$getOneContent->img_src}' /> 
						{else}
							<input type='text' name='img_src' class='text' value='{$getOneContent->img_src}' />  
							<input type='button' class='btn' value='浏览...' />
							<input type="file" name='upfile' class="file"/>
						{/if}
					</td>			
				</tr>
				<tr>
					<td colspan='2'>
						<!--<div class='content_hd'>内容</div>-->
						<textarea name='content'>
						{$getOneContent->content}
						</textarea>
						<script>
							CKEDITOR.replace('content',{ height: '500px'}) ;
							setTimeout(function(){global.hig();},1000)
						</script>
					</td>
				</tr>
				<tr><td colspan='2'><input type="submit" name="send" class="sub_btn" value="提交" /></td></tr>
			</table>
		</form>
	{/if}
</div>
<script src='js/jquery.min.js' /></script>
<script src='js/global.js' /></script>
<script src='js/menu.js' /></script>

</body>
</html>