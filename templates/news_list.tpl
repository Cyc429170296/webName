{include file='header.inc.php'}
	{include file='aside.inc.php'}
	    <div class="about_right">
	    		
	    		<div class="info news">
	    			<ul class='news_list'>
					{if count($article_list)}
						{if $module_en_name=='Download Center'}
							{foreach $article_list(key,value)}
								<li><a href="download/{@value[img_src]}">{@value[title]}</a></li>
							{/foreach}
						{else}
							{foreach $article_list(key,value)}
								<li><a href="article.php?m={@value[mid]}&p={@value[pid]}&d={@value[id]}"><span>[{@value[date]}]</span>{@value[title]}</a></li>
							{/foreach}
						{/if}
					{/if}
				    </ul>
				    <div class='num'>
						{$page_num}
                    </div>
	    		</div>
	    	</div>
		</div>
	</div>
{include file='footer.inc.php'}

