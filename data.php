<?php
if(!defined("IN_TG")){
	echo "error";
	exit();
}

$_mid = _data(_query("SELECT mid FROM tg_module"),'mid');
//$_data = array();
foreach($_mid as $key=>$value){
	//$_data[$value] = _all(_query("SELECT * FROM tg_article WHERE recom=1 AND mid=".$value));
	$_tpl->assign('_data_'.$value,_all(_query("SELECT * FROM tg_article WHERE recom=1 AND mid=".$value)));
}
/*$_result = _query($_sql." AND b.mid=1");
while(!!$_rows = _fetch_list($_result)){
	$data_1 = mb_substr($_rows['content'],0,162,'utf-8');
}
$_tpl->assign('data_1',$data_1.'......');

$_result = _query($_sql." AND b.mid=6");
while(!!$_rows = _fetch_list($_result)){
	$data_6 .= '<li><a href="download/'.$_rows['img_src'].'">'.$_rows['title'].'</a></li>'."\n";
}
$_tpl->assign('data_6',$data_6);

$_result = _query($_sql." AND b.mid=2");
while(!!$_rows = _fetch_list($_result)){
	$data_2 .= '<li><a href="article.php?m='.$_rows['mid'].'&p='.$_rows['pid'].'&d='.$_rows['id'].'" class="pic"><img alt="'.$_rows['title'].'" src="upload/'.$_rows['img_src'].'" /></a><div class="title"><a href="article.php?m='.$_rows['mid'].'&p='.$_rows['pid'].'&d='.$_rows['id'].'">'.$_rows['title'].'</a></div></li>'."\n";
}
$_tpl->assign('data_2',$data_2);*/
?>