<?php 
$_sql = "SELECT * FROM tg_article as a,tg_menu as b where a.recom=1 AND a.pid=b.pid";
$_result = _query($_sql." AND b.mid=1");
while(!!$_rows = _fetch_list($_result)){
	$data_1 = mb_substr($_rows['content'],0,162,'utf-8');
}
$_tpl->assign('data_1',$data_1.'......');

$_result = _query($_sql." AND b.mid=6");
while(!!$_rows = _fetch_list($_result)){
	$data_6 .= '<li><a href="download/'.$_rows['img_src'].'">'.$_rows['title'].'</a></li>';
}
$_tpl->assign('data_6',$data_6);

$_result = _query($_sql." AND b.mid=2");
while(!!$_rows = _fetch_list($_result)){
	$data_2 .= '<li><a href="article.php?m='.$_rows['mid'].'&p='.$_rows['pid'].'&d='.$_rows['id'].'" class="pic"><img alt="'.$_rows['title'].'" src="upload/'.$_rows['img_src'].'" /></a><div class="title"><a href="article.php?m='.$_rows['mid'].'&p='.$_rows['pid'].'&d='.$_rows['id'].'">'.$_rows['title'].'</a></div></li>';
}
$_tpl->assign('data_2',$data_2);
?>