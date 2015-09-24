{include file='header.inc.php'}
	{include file='aside.inc.php'}
	    <div class="about_right">
	    		<div class="info news_det">
	    			<h5 class='title'>{$article[title]}</h5>
                    <div class='message'>发布时间：{$article[date]}</div>
			        <div class='message_box'>
						{$article[content]}
					</div>
				   <div class="bbs">
	                    <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare" style="padding:10px 0 0;float:right;">
	                        <span class="bds_more" style=" line-height:15px;">分享给好友：</span>
	                        <a href="#" title="分享到QQ空间" class="bds_qzone"></a>
	                        <a href="#" title="分享到新浪微博" class="bds_tsina"></a>
	                        <a href="#" title="分享到腾讯微博" class="bds_tqq"></a>
	                        <a href="#" title="分享到人人网" class="bds_renren"></a>
	                        <a href="#" title="分享到百度搜藏" class="bds_baidu"></a>
	                        <a href="#" title="分享到豆瓣网" class="bds_douban"></a>
	                        <a href="#" title="分享到搜狐微博" class="bds_tsohu"></a>
	                        <a href="#" title="分享到我的淘宝" class="bds_taobao"></a>
	                    </div>
                        <script src="js/share.js" type="text/javascript" id="bdshare_js" data="type=tools">
                        </script>
                    </div>
				    <div class='other'>
					    {$other}
                     </div>
	    		</div>
	    	</div>
		</div>
	</div>
{include file='footer.inc.php'}

