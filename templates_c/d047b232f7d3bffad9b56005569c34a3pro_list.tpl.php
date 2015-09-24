<?php include 'header.inc.php'; ?>
	<?php include 'aside.inc.php'; ?>
	    <div class="about_right">
	    		<div class="info pro">
	    			<ul class='pro_list'>
					<?php if(count($this->_arr['article_list'])){ ?>
					<?php foreach ($this->_arr['article_list'] as $key=>$value) { ?>
				    	<li>
							<a href="article.php?m=<?php echo $value[mid]?>&p=<?php echo $value[pid]?>&d=<?php echo $value[id]?>"><img alt="<?php echo $value[title]?>" src="upload/<?php echo $value[img_src]?>" /></a>
							<div class="title"><a href="article.php?m=<?php echo $value[mid]?>&p=<?php echo $value[pid]?>&d=<?php echo $value[id]?>"><?php echo $value[title]?></a></div>
						</li>
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
</div>
<?php include 'footer.inc.php'; ?>

