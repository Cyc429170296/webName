<?php
if(!defined("IN_TG")){
	echo "error";
	exit();
}

$_mid = _data(_query("SELECT mid FROM tg_module"),'mid');
foreach($_mid as $key=>$value){
	$_tpl->assign('_data_'.$value,_all(_query("SELECT * FROM tg_article WHERE recom=1 AND mid=".$value)));
}
?>