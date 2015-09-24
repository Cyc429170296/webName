{include file='header.inc.php'}
	{include file='aside.inc.php'}
	    <div class="about_right">
	    		<div class="info pro">
	    			<ul class='pro_list'>
					{if count($article_list)}
					{foreach $article_list(key,value)}
				    	<li>
							<a href="article.php?m={@value[mid]}&p={@value[pid]}&d={@value[id]}"><img alt="{@value[title]}" src="upload/{@value[img_src]}" /></a>
							<div class="title"><a href="article.php?m={@value[mid]}&p={@value[pid]}&d={@value[id]}">{@value[title]}</a></div>
						</li>
					{/foreach}
					{/if}
					 </ul>
				    <div class='num'>
						{$page_num}
                    </div>
	    		</div>
	    	</div>
		</div> 
	</div>
</div>
{include file='footer.inc.php'}

