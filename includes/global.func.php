<?php
if(!defined("IN_TG")){
	echo "error";
	exit();
}

function _runtime(){
	//$m_time = explode(' ',microtime());
	//return ($m_time[0] + $m_time[1]); 
}


function _alert_back($_info){
	echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
	exit();
}

function _alert_close($_info){
	echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
	exit();
}

function _code($_width = 75,$_height = 25,$_rand_count = 4,$flag = false){
	//$_rand_count = 4;
	$_rand = "";
	for($i = 0;$i < $_rand_count;$i++){
		$_rand.= dechex(mt_rand(0,15));
	}
	$_SESSION["code"]=$_rand;


	//绘画
	header('Content-Type:image/png');
	//$_width=75;
	//$_height=25;

	//创建区域
	$img=imagecreatetruecolor($_width,$_height);

	//定义填充颜色
	$imgcolor=imagecolorallocate($img,255,255,255);


	//填充图像
	imagefill($img,0,0,$imgcolor);

	//定义边框颜色，要在填充颜色后面
	//$flag=false;
	if($flag){
		$imgstylecolor=imagecolorallocate($img,0,0,0);
		imagerectangle($img,0,0,$_width-1,$_height-1,$imgstylecolor);
	}

	//绘制线条
	for($i = 0;$i < 6;$i++){
		$_rand_color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		imageline($img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rand_color);
	}

	//绘制雪花
	for($i = 0;$i < 100;$i++){
		$_rand_color = imagecolorallocate($img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
		imagestring($img,1,mt_rand(0,$_width),mt_rand(0,$_height),"*",$_rand_color);
	}

	//绘制输入文本
	for($i = 0;$i < $_rand_count;$i++){
		$_rand_color = imagecolorallocate($img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,180));
		imagestring($img,5,$i*$_width/$_rand_count+mt_rand(1,10),mt_rand(0,$_height/2),$_SESSION["code"][$i],$_rand_color);
	}


	//输出图像
	imagepng($img);


	//销毁图像
	imagedestroy($img);
}

function _get_xml($_xmlfile){
	$_html = array();
	if(file_exists($_xmlfile)){
		$_xml = file_get_contents($_xmlfile);
		preg_match_all('/<vip>(.*)<\/vip>/s',$_xml,$_dom);
		//preg_match_all('/<id>(.*)<\/id>/s',$_dom[1][0],$_id);
		//print_r ($_id);
		foreach($_dom[1] as $_value){//$_value 相当于<id></id>……<url></url>这一串字符串
			preg_match_all('/<id>(.*)<\/id>/s',$_value,$_id);
			preg_match_all('/<username>(.*)<\/username>/s',$_value,$_username);
			preg_match_all('/<sex>(.*)<\/sex>/s',$_value,$_sex);
			preg_match_all( '/<face>(.*)<\/face>/s', $_value, $_face);
			preg_match_all('/<email>(.*)<\/email>/s',$_value,$_email);
			preg_match_all('/<url>(.*)<\/url>/s',$_value,$_url);
		}
		$_html['id'] = $_id[1][0];
		$_html['username'] = $_username[1][0];
		$_html['sex'] = $_sex[1][0];
		$_html['face'] = $_face[1][0];
		$_html['email'] = $_email[1][0];
		$_html['url'] = $_url[1][0];
		
	}else{
		exit('文件不存在');
	}
	return $_html;
}

function _set_xml($_filexml,$_clear){
	$_fp = @fopen('new.xml','w');
	if(!$_fp){
		exit('系统错误,文件不存在');
	}
	flock($_fp,LOCK_EX);
	
	$_string = "<?xml version=\'1.01'\ encoding=\'utf-8\'?>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "<vip>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "\t<id>".$_clear['id']."</id>\r\n";		
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "\t<username>".$_clear['username']."</username>\r\n";		
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "\t<sex>".$_clear['sex']."</sex>\r\n";		
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "\t<face>".$_clear['face']."</face>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "\t<email>".$_clear['email']."</email>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "\t<url>".$_clear['url']."</url>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	
	$_string = "</vip>";
	fwrite($_fp,$_string,strlen($_string));
	
	flock($_fp,LOCK_UN);
}

function _ubb($_string){
	$_string = nl2br($_string);
	$_string = preg_replace('/\[size=(.*)\](.*)\[\/size\]/U','<span style="font-size:\1">\2</span>',$_string);
	$_string = preg_replace('/\[b\](.*)\[\/b\]/U','<strong>\1</strong>',$_string);
	$_string = preg_replace('/\[u\](.*)\[\/u\]/U','<span style="text-decoration:underline">\1</span>',$_string);
	$_string = preg_replace('/\[i\](.*)\[\/i\]/U','<em>\1</em>',$_string);
	$_string = preg_replace('/\[s\](.*)\[\/s\]/U','<span style="text-decoration:line-through">\1</span>',$_string);
	$_string = preg_replace('/\[color=(.*)\](.*)\[\/color\]/U','<span style="color:\1">\2</span>',$_string);
	$_string = preg_replace('/\[url\](.*)\[\/url\]/U','<a href="\1" title="\1">\1</a>',$_string);
	$_string = preg_replace('/\[email\](.*)\[\/email\]/U','<a href="\1" title="\1">\1</a>',$_string);
	$_string = preg_replace('/\[img\](.*)\[\/img\]/U','<img src="\1" alt="\1" />',$_string);
	$_string = preg_replace('/\[flash\](.*)\[\/flash\]/U','<embed style="width:480px;height:400px;" src="\1" />',$_string);
	return $_string;
}

function _sha1_uniqid(){
	return sha1(uniqid(rand(),true));
}

function _check_code($_first_code,$_end_code){
	if($_first_code != $_end_code){
		_alert_back("验证码错误");
	}
}

function _mysql_string($_string){
		if (!get_magic_quotes_gpc()) {
		if (is_array($_string)) {
			foreach ($_string as $_key => $_value) {
				$_string[$_key] = _mysql_string($_value);   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
			}
		} else {
			$_string = mysql_real_escape_string($_string);
		}
	} 
	return $_string;
}

function _location($_info,$_url){
	if(!empty($_info)){
		echo "<script type='text/javascript'>alert('$_info');window.location.href = '$_url'</script>";
		exit();
	}else{
		header('Location:'.$_url);
		//header("Location:$_url");
	}
}

function _login_state(){
	if(isset($_COOKIE['username'])){
		_alert_back('登录状态无法进行本操作！');
	}
}


function _unsetcookies(){
	setcookie('username','',time()-1);
	setcookie('uniqid','',time()-1);
	_session_destroy();
	_location(null,'index.php');
}


function _session_destroy() {
	//if (session_start()) {
		session_destroy();
	//}
}

/**
 * _paging分页函数
 * @param $_type
 * @return 返回分页
 */
function _page($_sql,$_size){
	global $_pagesize,$_num,$_pagenumber,$_pageabsolute,$_page;
	//@$_page 表示当前页
	//@$_pageabsolute 表示在数据库中从第几条提取数据
	//@$_pagenumber 表示有几页
	//@$_num 表示有几条数据 在数据库中
	//@$_pagesize 表示要显示几条数据
	$_pagesize = $_size;
	$_num = mysql_num_rows(_query($_sql));
	$_pagenumber = ceil($_num / $_pagesize);

	if(!isset($_GET['page']) || $_GET['page']<= 1 || !is_numeric($_GET['page'])){
		$_page = 1;
	}else{
		$_page = intval($_GET['page']);
	}

	if($_page > $_pagenumber){
		$_page = $_pagenumber;
	}

	if($_num == 0){
		$_page = 1;
	}

	$_pageabsolute = ($_page-1) * $_pagesize;

}



function _paging($article_id,$_type = 1){
	global $_page,$_pagenumber,$_num,$page_num;
	$str = 'm='.$_GET['m'].'&p='.$article_id;
	if($_type == 1){
		
		$page_num .= "<ul>";
			for($i = 0;$i < $_pagenumber;$i++){
				if($_page == ($i+1)){
					$page_num .= "<a class='cu' href='?".$str."&page=".($i+1)."'>". ($i+1) ."</a>"; 
				}else{
					$page_num .= "<a href='?".$str."page=".($i+1)."'>". ($i+1) ."</a>"; 
				}
			}			
	}else{
		$page_num .= "$_page/$_pagenumber 页 &nbsp;|&nbsp; ";
		$page_num .= "共<strong>$_num</strong>个数据 &nbsp;|&nbsp; ";
			if($_page == 1){
				$page_num .= "首页 &nbsp;|&nbsp; ";
				$page_num .= "上一页 &nbsp;|&nbsp; ";
			}else{
				$page_num .= '<a href="'.$_SERVER['SCRIPT_NAME'].'?'.$str.'&page=1">首页</a> &nbsp;|&nbsp; ';
				$page_num .= '<a href="?'.$str.'&page='.($_page-1).'">上一页</a> &nbsp;|&nbsp; ';
			}
			if($_page == $_pagenumber){
				$page_num .= "下一页 &nbsp;|&nbsp; ";
				$page_num .= "尾页";
			}else{
				$page_num .= '<a href="?'.$str.'&page='.($_page+1).'">下一页</a> &nbsp;|&nbsp; ';
				$page_num .= '<a href="?'.$str.'&page='.$_pagenumber.'">尾页</a>';
			}				
	}	
}

/*限定字符长度*/
function _limit_length($_string,$_length=20){
	if(mb_strlen($_string,"utf-8") > $_length){
		return mb_substr($_string,0,$_length,"utf-8").'...';
	}
	return $_string;

}


function _html($_string){
	if(is_array($_string)){
		foreach($_string as $_key => $_value){
			//$_string[$_key] = htmlspecialchars($_value);
			$_string[$_key] = _html($_value);
		}
	}else{
		$_string = htmlspecialchars($_string);
	}
	return $_string;
}

function _check_login_uniqid($_sql_uniqid,$_cookie_uniqid){
	if($_sql_uniqid != $_cookie_uniqid){
			_alert_back("唯一标识符错误");
	}
}


function _time($_nowtime,$_pretime,$_time){
	if($_nowtime - $_pretime < $_time){
		_alert_back("阁下请先休息一会儿,在发帖");
	}
}



?>