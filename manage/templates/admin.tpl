{include file='header.inc.php'}
{include file='aside.inc.php'}
<div id="main">
	<div class='infos_box'></div>
	{if $sys_set}
	管理首页 &gt;&gt; 系统设置
	<form name='sys_set' class='sys_set' action='admin.php?action=1' method='post'>
		<table>
		{foreach $getSysInfo(key,value)}
			<tr><td width='200'>·网　站　名　称：</td><td><input type="text" name="webname" class="text" value="{@value->webname}" /></td></tr>
			<tr><td>·文章每页列表数：</td><td><input type="text" name="article_list_num" class="text list_num" value="{@value->article_list_num}" /></td></tr>
    		<tr><td>·图片每页列表数：</td><td><input type="text" name="pics_list_num" class="text list_num" value="{@value->pics_list_num}" /></td></tr>
			<tr><td><lable>·网 站 关 键 字：</lable></td><td><textarea name="keyword">{@value->keyword}</textarea></td></tr>
			<tr><td><lable>·网　站　描　述：</lable></td><td><textarea name="descript">{@value->descript}</textarea></td></tr>
			<tr><td colspan='2'><input type="submit" name='send' value="修改系统设置" class="sub_btn sys_set_submit" /></td></tr>
		{/foreach}
		</table>
	</form>
	{/if}
	
	{if $sys_userinfo}
		管理首页 &gt;&gt; 用户信息
		<form name='sys_userinfo' class='sys_userinfo' action='admin.php?action=2' method='post'>
			<table>
				<tr>
					<th width='100'>联 系 人：</th>
					<th width='115'>联系人姓名：</th>
					<th width='260'>联系人地址：</th>
					<th width='115'>联系人QQ：</th>
					<th width='120'>联系人电话：</th>
					<th width='120'>联系人手机：</th>
					<th width='150'>联系人邮箱：</th>
					<th width='100'>操作：</th>
				</tr>
				{foreach $getUserInfo(key,value)}
				<tr>
					<td>联 系 人{@value->id}：</td>
					<td><input type="text" name="user_name" class="text" value="{@value->user_name}" /></td>
					<td><input type="text" name="user_address" class="text user_address" value="{@value->user_address}" /></td>
					<td><input type="text" name="user_qq" class="text" value="{@value->user_qq}" /></td>
					<td><input type="text" name="user_tel" class="text" value="{@value->user_tel}" /></td>
					<td><input type="text" name="user_phone" class="text" value="{@value->user_phone}" /></td>
					<td><input type="text" name="user_email" class="text user_email" value="{@value->user_email}" /></td>
					<td><a class='update' href='javascript:void(0)'>提交修改</a></td>
				</tr>
				{/foreach}
			</table>
		</form>
	{/if}
	{if $sys_banner}
		管理首页 &gt;&gt; 轮播图片
		<form class='sys_banner' action="admin.php?action=3" method="post" enctype="multipart/form-data">
			<input type='hidden' name='banner_id' class='banner_id' value='{$mid}' />
			<input type='hidden' name='del_img' class='del_img' value='{$getBanner->banner_src}' />
			<table>
				<tr>
					<th width='100'>轮播图片</th>
					<th width='400'>图片</th>
					<th width='100'>标题</th>
					<th width='400'>修改图片</th>
					<th width='80'>推荐首页</th>
				</tr>
				<tr>
					<td>
						<select class='banner_sel'>
							<option value='1'>轮播图片1：</option>
							<option value='2'>轮播图片2：</option>
							<option value='3'>轮播图片3：</option>
							<option value='4'>轮播图片4：</option>
						</select>
					</td>
					<td><img src='../upload/{$getBanner->banner_src}' class='banner_img'></td>
					<td><input type='text' name='title' class='txt title' value='{$getBanner->title}' /></td>
					<td>
						 <input type='text' name='textfield' class='txt' value='{$getBanner->banner_src}' />  
						 <input type='button' class='btn' value='浏览...' />
						 <input type="file" name='upfile' class="file"/>
					</td>
					<td>
						{if $getBanner->recom}
						<input type='checkbox' name='recom' class='recom' value='{$getBanner->recom}' checked />
						{else}
						<input type='checkbox' name='recom' class='recom' value='{$getBanner->recom}' />
						{/if}
					</td>
				</tr>
				<tr><td colspan='4'><input type="submit" name="send" class="sub_btn" value="上传" /></td></tr>
			</table>
		</form>
	{/if}
</div>
<script src='js/jquery.min.js' /></script>
<script src='js/global.js' /></script>
<script src='js/sys.js' /></script>
</body>
</html>