<?php 
	define("IN_TG",true);
	//初始化
	require dirname(__FILE__).'/init.inc.php';
	require ROOT_PATH.'/language.php';
	global $_tpl;
	
	if(!isset($_GET['m']) || !is_numeric($_GET['m'])){
		$_GET['m'] = 1;
	}
	
	$_mid = $_GET['m'];

	$_param = _fetch_array('select param1,param2,param3,module_det from tg_module where mid='.$_mid);

	$_param ? $_tpl->assign('param',$_param) : $_mid = 1;//避免m是数字但数据库找不到数据而报错
	
	function Module(){
		global $_mid,$_tpl;
		$_module = _fetch_list( _query('select module_tpl,module_det,module_name from tg_module where mid='.$_mid));
		$_tpl->assign('module_name',$_module['module_name']);
		$_tpl->assign('module_en_name',language($_module['module_name']));
		if($_module['module_det']){
			if(isset($_GET['d']) && is_numeric($_GET['d'])){
				$_tpl->display($_module['module_det']);
				return;
			}
		}
		$_tpl->display($_module['module_tpl']);
	}

	$_flag = $two_flag = true;
	$fir_menu = _all(_query("SELECT pid,menu_name FROM tg_menu where mid=".$_mid." AND cid=0"));
	
	if(!count($fir_menu)){//echo '没数据,请添加侧栏栏目数据';
		Module();
		exit;
	}
	
	$_all_pid = _data(_query("SELECT pid FROM tg_menu where mid=".$_mid),'pid');
	if(isset($_GET['p']) && is_numeric($_GET['p']) && in_array($_GET['p'],$_all_pid)){
		$_pid = $_GET['p']; 
	}else{
		$sec_flag = _fetch_array("SELECT pid FROM tg_menu WHERE mid=".$_mid." AND cid<>0 LIMIT 1");
		$_pid = $sec_flag ? $sec_flag['pid'] : $fir_menu[0]['pid'];
	}
	
	$_rows = _fetch_array("SELECT cid FROM tg_menu where pid=".$_pid);
	$_cid = $_rows['cid'] ? $_rows['cid'] : $_pid;
	foreach($fir_menu as $p_list) {
		$class = '';
		$href = 'javascript:;';
		$active = '';
		if($_pid){
			if($_cid == $p_list['pid']){
				$class = 'class="cu"';
				$active = 'class="active"';		
			}
		}else{
			if($_flag){
				$class = 'class="cu"';
				$active = 'class="active"';
				$_flag = false;
			}
		}
		$sec_menu = _all(_query("SELECT pid,cid,menu_name FROM tg_menu where cid=".$p_list['pid']));
		if(!count($sec_menu)){
			$href="article.php?m=".$_mid."&p=".$p_list['pid'];
		}
		$side_list .= '<li '.$active.'><h2><a href="'.$href.'" >'.$p_list['menu_name'].'</a></h2>';
		
		if(count($sec_menu)){
			$side_list .= '<ul class="ej">';
			foreach($sec_menu as $c_list){
				if($p_list['pid'] == $c_list['cid']){
					$class = '';
					if($_pid){
						if($c_list['pid'] == $_pid){
							$class = 'class="cu"';
						}
					}else{
						if($two_flag){
							$class = 'class="sec_cu"';
							$c_flag = $c_list['pid']; 
							$two_flag = false;
						}
					}
					$side_list .= '<li><a '.$class.' href="article.php?m='.$_mid.'&p='.$c_list['pid'].'" >'.$c_list['menu_name'].'</a></li>';
				}
			}
			$side_list .= '</ul>';
		}
		$side_list .= '</li>';
	}

	$_tpl->assign('side_list',$side_list);
	
	
	/*内容*/
	if(!empty($_GET['d']) && is_numeric($_GET['d'])){
		$_sql = "SELECT * FROM tg_article where pid=".$_pid." AND id=".$_GET['d'];
	}else{
		$_sql = "SELECT * FROM tg_article where pid=".$_pid;
	}
	
	global $_system;
	_page($_sql,$_system['pics_list_num']);
	
	$_article = _all(_query($_sql." LIMIT $_pageabsolute,".$_system['pics_list_num']));
	
	if(!count($_article)){//echo '没数据,请添加右边内容数据';
		Module();
		exit;
	}
	_paging($_pid,2);
	$_tpl->assign('page_num',$page_num);
	$_tpl->assign('article_list',$_article);
	$_tpl->assign('article',$_article[0]);
	
	if(isset($_GET['d']) && is_numeric($_GET['d'])){
		$pos = _query("SELECT id,pid,title FROM tg_article where pid=".$_pid);
		$pos_arr = array(); 
		$_all_id = array();
		while(!!$_rows = _fetch_list($pos)){
			array_push($pos_arr,$_rows);
			array_push($_all_id,$_rows['id']);
		}
		
		$_index = array_keys($_all_id,$_GET['d']);
		$_index = $_index[0];
		$str = "m=".$_mid.'&p='.$_pid;

		if(count($_all_id) > 1){
			if($_index == 0){
				$other = "<h3>下一篇：<a href='article.php?".$str."&d=".$pos_arr[$_index + 1]['id']."'>".$pos_arr[$_index + 1]['title']."</a></h3>";	
			}else if($_index == count($_all_id) - 1){
				$other = "<h3>上一篇：<a href='article.php?".$str."&d=".$pos_arr[$_index - 1]['id']."'>".$pos_arr[$_index - 1]['title']."</a></h3>";
			}else{
				$other = "<h3>上一篇：<a href='article.php?".$str."&d=".$pos_arr[$_index - 1]['id']."'>".$pos_arr[$_index - 1]['title']."</a></h3>";
				$other .=  "<h3>下一篇：<a href='article.php?".$str."&d=".$pos_arr[$_index + 1]['id']."'>".$pos_arr[$_index + 1]['title']."</a></h3>";
			}
		}
		$_tpl->assign('other',$other);
	}	
	Module();	
?>