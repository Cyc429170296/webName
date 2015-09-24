<?php include 'header.inc.php'; ?>
<?php include 'aside.inc.php'; ?>
<div id="main">
	<div class="map">
		管理首页 &gt;&gt; 栏目管理 &gt;&gt; <strong id="title"><?php echo $this->_arr['title'];?></strong>
	</div>
	<?php if ($this->_arr['show']) {?>
		<ol>
			<li><a href="javascript:void(0)" class="selected">一级栏目列表</a></li>
			<li><a href="menu.php?action=add&m=<?php echo $this->_arr['mid'];?>">新增一级栏目</a></li>
		</ol>
		<table cellspacing="0">
			<tr><th width='120'>编号</th><th width='180'>所属栏目</th><th width='180'>一级栏目</th><th width='180'>操作</th></tr>
			<?php foreach ($this->_arr['fir_menu'] as $key=>$value) { ?>
			<tr>
				<td><?php echo $value->pid?></td>
				<td><?php echo $this->_arr['module_name'];?></td>
				<td><span class='fir_nemu'><?php echo $value->menu_name?></span></td>
				<td>
					<a class='update dis' href='javascript:void(0)' pid="<?php echo $value->pid?>">修改</a> | <a class='del' href='javascript:void(0)' pid="<?php echo $value->pid?>" onclick="return confirm('你真的要删除这个栏目吗？') ? true : false">删除</a> |
					<a class='cancel disabled' href='javascript:void(0)'>取消</a>
				</td>
			</tr>
			<?php } ?>
		</table>
		
		<?php if ($this->_arr['fir_menu_flag']) {?>
			<ol>
				<li><a href="javascript:void(0);" class="selected">二级栏目列表</a></li>
				<li><a href="menu.php?action=add&m=<?php echo $this->_arr['mid'];?>&p=<?php echo $this->_arr['fir_menu'][0]->pid;?>"  class='add_sec_menu'>新增二级栏目</a></li>
				<li class='pull_down_box'>
					<select class='menu_list_sel sel' mid='<?php echo $this->_arr['mid'];?>'>
						<?php foreach ($this->_arr['fir_menu'] as $key=>$value) { ?>
							<option value='<?php echo $value->pid?>'><?php echo $value->menu_name?></option>
						<?php } ?>
						<option value='0'>全部显示</option>
					</select>
				</li>
			</ol>
		
			<table class='menu_list_table' cellspacing="0">
				<tr><th width='120'>编号</th><th width='180'>所属栏目</th><th width='180'>一级栏目</th><th width='180'>二级栏目</th><th width='180'>操作</th></tr>
				<?php if ($this->_arr['sec_menu_flag']) {?>
					<?php foreach ($this->_arr['sec_menu'] as $key=>$value) { ?>
					<tr>
						<td><?php echo $value->pid?></td>
						<td><?php echo $this->_arr['module_name'];?></td>
						<td><span class='fir_nemu'><?php echo $value->fir_nemu?></span></td>
						<td><span class='sec_nemu'><?php echo $value->sec_nemu?></span></td>
						<td>
							<a class='update dis' href='javascript:void(0)' pid="<?php echo $value->pid?>">修改</a> | <a class='del' href='javascript:void(0)' pid="<?php echo $value->pid?>" onclick="return confirm('你真的要删除这个栏目吗？') ? true : false">删除</a> |
							<a class='cancel disabled' href='javascript:void(0)'>取消</a>
						</td>
					</tr>
					<?php } ?>
				<?php } else { ?>
					<tr><td colspan='5'>当前栏目没有子栏目</td></tr>
				<?php } ?>
			</table>
		<?php } ?>
	<?php } ?>
	
	<?php if ($this->_arr['add']) {?>
		<?php if ($this->_arr['sec_menu']) {?>
			<ol class='sec_menu_hd'>
				<li><a href="menu.php?action=show&m=<?php echo $this->_arr['mid'];?>">二级栏目列表</a></li>
				<li><a href="javascript:void(0)" class='selected'>新增二级栏目</a></li>
				<li class='pull_down_box'>
					<select class='menu_add_sel sel'>
						<?php foreach ($this->_arr['fir_menu'] as $key=>$value) { ?>
							<option value='<?php echo $value->pid?>'><?php echo $value->menu_name?></option>
						<?php } ?>
					</select>
				</li>
			</ol>
			<form method="post" action="menu.php?action=add&m=<?php echo $this->_arr['mid'];?>">
				<input type='hidden' name='pid' class='hid' value='<?php echo $this->_arr['pid'];?>' />
				<table cellspacing="0" class="menu_sec_table">
					<tr><th width='120'>编号</th><th width='240'>所属栏目</th><th width='240'>一级栏目名称：</th><th width='240'>二级栏目名称：</th></tr>
					<?php foreach ($this->_arr['range'] as $key=>$value) { ?>
					<tr><td><?php echo $value?></td><td><?php echo $this->_arr['module_name'];?></td><td><span class='fir_nemu'><?php echo $this->_arr['menu_name'];?></span></td><td><input type="text" name="menus[]" class="text" /></td></tr>
					<?php } ?>
					<tr><td colspan='4'><input type="submit" name="send" value="新增栏目" class='send sub_btn' /> [ <a href="menu.php?action=show&m=<?php echo $this->_arr['mid'];?>">返回列表</a> ]</td></tr>
				</table>
			</form>
		<?php } else { ?>
			<ol>
				<li><a href="menu.php?action=show&m=<?php echo $this->_arr['mid'];?>">一级栏目列表</a></li>
				<li><a href="javascript:void(0)"  class="selected">新增一级栏目</a></li>
			</ol>
			<form method="post" action="menu.php?action=add&m=<?php echo $this->_arr['mid'];?>">
				<table cellspacing="0" class="menu_fir_table">
					<tr><th width='120'>编号</th><th width='240'>所属栏目</th><th width='240'>一级栏目名称：</th></tr>
					<?php foreach ($this->_arr['range'] as $key=>$value) { ?>
					<tr><td><?php echo $value?></td><td><?php echo $this->_arr['module_name'];?></td><td><input type="text" name="menus[]" class="text" /></td></tr>
					<?php } ?>
					<tr><td colspan='3'><input type="submit" name="send" value="新增栏目" class='send sub_btn' /> [ <a href="menu.php?action=show&m=<?php echo $this->_arr['mid'];?>">返回列表</a> ]</td></tr>
				</table>
			</form>
		<?php } ?>
	<?php } ?>
</div>
<script src='js/jquery.min.js' /></script>
<script src='js/global.js' /></script>
<script src='js/menu.js' /></script>
</body>
</html>