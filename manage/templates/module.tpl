{include file='header.inc.php'}
{include file='aside.inc.php'}
<div id="main">
	<div class='infos_box'></div>
	{if $show}
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
				{foreach $getModule(key,value)}
				<tr mid={@value->mid}>
					<td>{@value->mid}</td>
					<td><input type="text" name="module_name" class="text" value="{@value->module_name}" /></td>
					<td><input type="text" name="module_tpl" class="text" value="{@value->module_tpl}" /></td>
					<td><input type="text" name="module_det" class="text" value="{@value->module_det}" /></td>
					<td><input type="text" name="param1" class="text" value="{@value->param1}" /></td>
					<td><input type="text" name="param2" class="text" value="{@value->param2}" /></td>
					<td><input type="text" name="param3" class="text" value="{@value->param3}" /></td>
					<td><input type="text" name="module_same" class="text" value="{@value->module_same}" /></td>
					<td>
						<a class='module_update' href='javascript:void(0)'>提交修改</a>
						<a class='module_del' href='javascript:void(0)'>删除</a>
					</td>
				</tr>
				{/foreach}
			</table>
		</form>
	{/if}
</div>
<script src='js/jquery.min.js' /></script>
<script src='js/global.js' /></script>
<script src='js/sys.js' /></script>
</body>
</html>