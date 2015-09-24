{include file='header.inc.php'}
	<div class="contant">
		<div class="tit">
			<h3 class="t title1"><a href="article.php?m=1" class="more">+MORE</a> 关于我们 <span>· About Us</span></h3>
			<h3 class="t title2"><a href="article.php?m=6" class="more">+MORE</a> 下载中心 <span>· Download Center</span></h3>
			<h3 class="t title3"><a href="article.php?m=7" class="more">+MORE</a> 联系我们 <span>· Contact Us</span></h3>
		</div>
		<div class="contant_box">
		<div class="top">
			<div class="top1">
				{mb_substr($_data_1[0][content],0,162,'utf-8')}......
			</div>
			<div class="top2">
				<ul>
					{foreach $_data_6(key,value)}
					<li><a href="download/{@value[img_src]}">{@value[title]}</a></li>
					{/foreach}
				</ul>
			</div>
			<div class="top3">
				联系人：{$user[0][user_name]}<br />
				电　话：{$user[0][user_tel]}<br />
				手　机：{$user[0][user_phone]}<br />
				邮　箱：{$user[0][user_email]}<br />
				地　址：{$user[0][user_address]}
			</div>
		</div>
		<div class="pic">
			<h3 class="t pro_title"><a href="article.php?m=2" class="more">+MORE</a> 产品中心 <span>·  Products</span><em></em></h3>
			<div class="picMarquee">
				<ul class="picList pro_list">
					{foreach $_data_2(key,value)}
					<li>
						<a href="article.php?m={@value[mid]}&p={@value[pid]}&d={@value[id]}" class="pic"><img alt="{@value[title]}" src="upload/{@value[img_src]}" /></a>
						<div class="title"><a href="article.php?m={@value[mid]}&p={@value[pid]}&d={@value[id]}">{@value[title]}</a></div>
					</li>
					{/foreach}
				</ul>
			</div>
		</div>
		</div>
	</div>
{include file='footer.inc.php'}