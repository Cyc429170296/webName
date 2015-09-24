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
	<div class="map">
		管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title"><?php echo $this->_arr['title'];?></strong>
	</div>
	<?php if ($this->_arr['show']) {?>
		<ol>
			<li><a href='javascript:void(0);' class='selected'>内容列表</a></li>
			<?php if ($this->_arr['count']) {?>
			<li><a href='content.php?action=add&m=<?php echo $this->_arr['mid'];?>'>添加内容</a><li>
			<?php } ?>
			<li class='pull_down_box'>
			   <select class='content_list_sel sel'>
			   		 <option value='all'>显示全部</option>
                 	<?php foreach ($this->_arr['getMenu'] as $key=>$value) { ?>
                 		<?php if ($value->pid==$this->_arr['pid']) {?>
                         <option value='<?php echo $value->pid?>' selected><?php echo $value->menu_name?></option>
                        <?php } else { ?>
                         <option value='<?php echo $value->pid?>'><?php echo $value->menu_name?></option>
                        <?php } ?>
					<?php } ?>
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
				<th width='80'><?php echo $this->_arr['getParam']->param1;?></th>
				<th width='80'><?php echo $this->_arr['getParam']->param2;?></th>
				<th width='80'><?php echo $this->_arr['getParam']->param3;?></th>
				<th width='50'>推荐首页</th>
				<th width='70'>操作</th>
			</tr>
			<?php if ($this->_arr['count']) {?>
			<?php foreach ($this->_arr['AllContent'] as $key=>$value) { ?>
			<tr>
				<td><?php echo $value->id?></td>
				<td><?php echo $value->menu_name?></td>
				<td><?php echo $value->title?></td>
				<td>
					<?php if ($value->img_src) {?>
						<?php if ($this->_arr['download']) {?>
							<?php echo $value->img_src?>
						<?php } else { ?>
							<img src='../upload/<?php echo $value->img_src?>' />
						<?php } ?>
					<?php } ?>
				</td>
				<td><?php echo mb_substr($value->content,0,60,'utf-8')?>...</td>
				<td><?php echo $value->param1?></td>
				<td><?php echo $value->param2?></td>
				<td><?php echo $value->param3?></td>
				<td>
					<?php if ($value->recom) {?>
					<input type='checkbox' disabled="disabled" checked />
					<?php } else { ?>
					<input type='checkbox' disabled="disabled" />
					<?php } ?>
				</td>
				<td>
					<a href='content.php?action=update&m=<?php echo $this->_arr['mid'];?>&id=<?php echo $value->id?>'>修改</a> | 
					<a href='content.php?action=delete&m=<?php echo $this->_arr['mid'];?>&id=<?php echo $value->id?>&del_img=<?php echo $value->img_src?>' onclick="return confirm('你真的要删除这个内容吗？') ? true : false">删除</a>
				</td>
			</tr>
			<?php } ?>
			<?php } else { ?>
			<tr><td colspan='10'>当前没有栏目,请先添加栏目</td></tr>
			<?php } ?>
		</table>
		<div id="page"><?php echo $this->_arr['page'];?></div>
	<?php } ?>
	<?php if ($this->_arr['content_deal']) {?>
		<ol>
			<li><a href='content.php?action=show&m=<?php echo $this->_arr['mid'];?>'>内容列表</a></li>
			<li><a href='javascript:void(0);' class='selected'><?php echo $this->_arr['title'];?></a><li>
		</ol>
		<script src='ckeditor/ckeditor.js'></script>
		<form action="content.php?action=<?php echo $this->_arr['type'];?>&m=<?php echo $this->_arr['mid'];?>" method="post" enctype="multipart/form-data">
			<input type='hidden' name='id' value='<?php echo $this->_arr['getOneContent']->id;?>' />
			<input type='hidden' name='del_img' value='<?php echo $this->_arr['getOneContent']->img_src;?>' />
			<table class='tb_update'>
				<tr>
					<td width='120'>所属栏目</td>
					<td width='400' class='tb_left'>
						<div class='ctr'>
					        <select name='pid'>
					   		<?php foreach ($this->_arr['getMenu'] as $key=>$value) { ?>
					   			<?php if ($value->pid==$this->_arr['getOneContent']->pid) {?>
                              		<option value='<?php echo $value->pid?>' selected><?php echo $value->menu_name?></option>
					   			<?php } else { ?>
					   				<option value='<?php echo $value->pid?>'><?php echo $value->menu_name?></option>
					   			<?php } ?>
					   		<?php } ?>
					   		</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>首页推荐</td>
					<?php if ($this->_arr['getOneContent']->recom) {?>
					<td class='tb_left'><div class='ctr'><input type='checkbox' name='recom' value='<?php echo $this->_arr['getOneContent']->recom;?>' checked /></div></td>
					<?php } else { ?>
					<td class='tb_left'><div class='ctr'><input type='checkbox' name='recom' value='<?php echo $this->_arr['getOneContent']->recom;?>' /></div></td>
					<?php } ?>
				</tr>
				<tr>
					<td>标题</td>
					<td class='tb_left'><input type='text' name='title' class='text' value='<?php echo $this->_arr['getOneContent']->title;?>' /></td>
				</tr>
				<tr>
					<td><?php echo $this->_arr['getParam']->param1;?></td>
					<td class='tb_left'><input type='text' name='param1' class='text' value='<?php echo $this->_arr['getOneContent']->param1;?>' /></td>
				</tr>
				<tr>
					<td><?php echo $this->_arr['getParam']->param2;?></td>
					<td class='tb_left'><input type='text' name='param2' class='text' value='<?php echo $this->_arr['getOneContent']->param2;?>' /></td>
				</tr>
				<tr>
					<td><?php echo $this->_arr['getParam']->param3;?></td>
					<td class='tb_left'><input type='text' name='param3' class='text' value='<?php echo $this->_arr['getOneContent']->param3;?>' /></td>
				</tr>
				<tr>
					<td>图片/文件</td>
					<td class='tb_left'>
						<?php if ($this->_arr['download']) {?>
							<input type='text' name='img_src' class='text' value='<?php echo $this->_arr['getOneContent']->img_src;?>' /> 
						<?php } else { ?>
							<input type='text' name='img_src' class='text' value='<?php echo $this->_arr['getOneContent']->img_src;?>' />  
							<input type='button' class='btn' value='浏览...' />
							<input type="file" name='upfile' class="file"/>
						<?php } ?>
					</td>			
				</tr>
				<tr>
					<td colspan='2'>
						<!--<div class='content_hd'>内容</div>-->
						<textarea name='content'>
						<?php echo $this->_arr['getOneContent']->content;?>
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
	<?php } ?>
</div>
<script src='js/jquery.min.js' /></script>
<script src='js/global.js' /></script>
<script src='js/menu.js' /></script>

</body>
</html>