<?php include 'header.inc.php'; ?>
	<?php include 'aside.inc.php'; ?>
	    <div class="about_right">
	    		
	    		<div class="info news">
	    			<ul class='news_list'>
					<?php if(count($this->_arr['article_list'])){ ?>
						<?php if($this->_arr['module_en_name']=='Download Center'){ ?>
							<?php foreach ($this->_arr['article_list'] as $key=>$value) { ?>
								<li><a href="download/<?php echo $value[img_src]?>"><?php echo $value[title]?></a></li>
							<?php } ?>
						<?php }else{ ?>
							<?php foreach ($this->_arr['article_list'] as $key=>$value) { ?>
								<li><a href="article.php?m=<?php echo $value[mid]?>&p=<?php echo $value[pid]?>&d=<?php echo $value[id]?>"><span>[<?php echo $value[date]?>]</span><?php echo $value[title]?></a></li>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				    </ul>
				    <div class='num'>
						<?php echo $this->_arr['page_num'];?>
                    </div>
	    		</div>
	    	</div>
		</div>
	</div>
<?php include 'footer.inc.php'; ?>

