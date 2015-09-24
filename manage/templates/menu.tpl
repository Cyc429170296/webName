{include file='header.inc.php'}
{include file='aside.inc.php'}
<div id="main">
	<div class="map">
		管理首页 &gt;&gt; 栏目管理 &gt;&gt; <strong id="title">{$title}</strong>
	</div>
	{if $show}
		<ol>
			<li><a href="javascript:void(0)" class="selected">一级栏目列表</a></li>
			<li><a href="menu.php?action=add&m={$mid}">新增一级栏目</a></li>
		</ol>
		<table cellspacing="0">
			<tr><th width='120'>编号</th><th width='180'>所属栏目</th><th width='180'>一级栏目</th><th width='180'>操作</th></tr>
			{foreach $fir_menu(key,value)}
			<tr>
				<td>{@value->pid}</td>
				<td>{$module_name}</td>
				<td><span class='fir_nemu'>{@value->menu_name}</span></td>
				<td>
					<a class='update dis' href='javascript:void(0)' pid="{@value->pid}">修改</a> | <a class='del' href='javascript:void(0)' pid="{@value->pid}" onclick="return confirm('你真的要删除这个栏目吗？') ? true : false">删除</a> |
					<a class='cancel disabled' href='javascript:void(0)'>取消</a>
				</td>
			</tr>
			{/foreach}
		</table>
		
		{if $fir_menu_flag}
			<ol>
				<li><a href="javascript:void(0);" class="selected">二级栏目列表</a></li>
				<li><a href="menu.php?action=add&m={$mid}&p={$fir_menu[0]->pid}"  class='add_sec_menu'>新增二级栏目</a></li>
				<li class='pull_down_box'>
					<select class='menu_list_sel sel' mid='{$mid}'>
						{foreach $fir_menu(key,value)}
							<option value='{@value->pid}'>{@value->menu_name}</option>
						{/foreach}
						<option value='0'>全部显示</option>
					</select>
				</li>
			</ol>
		
			<table class='menu_list_table' cellspacing="0">
				<tr><th width='120'>编号</th><th width='180'>所属栏目</th><th width='180'>一级栏目</th><th width='180'>二级栏目</th><th width='180'>操作</th></tr>
				{if $sec_menu_flag}
					{foreach $sec_menu(key,value)}
					<tr>
						<td>{@value->pid}</td>
						<td>{$module_name}</td>
						<td><span class='fir_nemu'>{@value->fir_nemu}</span></td>
						<td><span class='sec_nemu'>{@value->sec_nemu}</span></td>
						<td>
							<a class='update dis' href='javascript:void(0)' pid="{@value->pid}">修改</a> | <a class='del' href='javascript:void(0)' pid="{@value->pid}" onclick="return confirm('你真的要删除这个栏目吗？') ? true : false">删除</a> |
							<a class='cancel disabled' href='javascript:void(0)'>取消</a>
						</td>
					</tr>
					{/foreach}
				{else}
					<tr><td colspan='5'>当前栏目没有子栏目</td></tr>
				{/if}
			</table>
		{/if}
	{/if}
	
	{if $add}
		{if $sec_menu}
			<ol class='sec_menu_hd'>
				<li><a href="menu.php?action=show&m={$mid}">二级栏目列表</a></li>
				<li><a href="javascript:void(0)" class='selected'>新增二级栏目</a></li>
				<li class='pull_down_box'>
					<select class='menu_add_sel sel'>
						{foreach $fir_menu(key,value)}
							<option value='{@value->pid}'>{@value->menu_name}</option>
						{/foreach}
					</select>
				</li>
			</ol>
			<form method="post" action="menu.php?action=add&m={$mid}">
				<input type='hidden' name='pid' class='hid' value='{$pid}' />
				<table cellspacing="0" class="menu_sec_table">
					<tr><th width='120'>编号</th><th width='240'>所属栏目</th><th width='240'>一级栏目名称：</th><th width='240'>二级栏目名称：</th></tr>
					{foreach $range(key,value)}
					<tr><td>{@value}</td><td>{$module_name}</td><td><span class='fir_nemu'>{$menu_name}</span></td><td><input type="text" name="menus[]" class="text" /></td></tr>
					{/foreach}
					<tr><td colspan='4'><input type="submit" name="send" value="新增栏目" class='send sub_btn' /> [ <a href="menu.php?action=show&m={$mid}">返回列表</a> ]</td></tr>
				</table>
			</form>
		{else}
			<ol>
				<li><a href="menu.php?action=show&m={$mid}">一级栏目列表</a></li>
				<li><a href="javascript:void(0)"  class="selected">新增一级栏目</a></li>
			</ol>
			<form method="post" action="menu.php?action=add&m={$mid}">
				<table cellspacing="0" class="menu_fir_table">
					<tr><th width='120'>编号</th><th width='240'>所属栏目</th><th width='240'>一级栏目名称：</th></tr>
					{foreach $range(key,value)}
					<tr><td>{@value}</td><td>{$module_name}</td><td><input type="text" name="menus[]" class="text" /></td></tr>
					{/foreach}
					<tr><td colspan='3'><input type="submit" name="send" value="新增栏目" class='send sub_btn' /> [ <a href="menu.php?action=show&m={$mid}">返回列表</a> ]</td></tr>
				</table>
			</form>
		{/if}
	{/if}
</div>
<script src='js/jquery.min.js' /></script>
<script src='js/global.js' /></script>
<script src='js/menu.js' /></script>
</body>
</html>