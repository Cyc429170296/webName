<?php
	if (!defined('IN_TG')) {
		exit('Access Defined!');
	}

	/*链接数据库*/
	function _connect(){
		//global 表示全局变量的意思，意图是将此变量在函数外部也能访问
		global $_conn;
		if(!$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD)){
			exit("数据库链接错误");
		} 
	}
	
	/*选择数据表*/
	function _select_db(){
		if(!mysql_select_db(DB_NAME)){
			exit("找不到指定的数据库");
		} 
	}
	
	/*设置字符集*/
	function _set_names(){
		if(!mysql_query("SET NAMES UTF8")){
			exit("字符集错误");
		} 
	}

	
	/*sql语句*/
	function _query($_sql){
		if(!$_result = mysql_query($_sql)){
			exit("SQL执行错误");
		} 
		return $_result;
	}
	
	/*sql返回数据*/
	function _fetch_array($_sql){
		return mysql_fetch_assoc(_query($_sql));
	}
	
	function _fetch_list($_result){
		return mysql_fetch_assoc($_result);
	}
	
	function _all($_result){
		$_arr = array();
		while(!!$_rows = _fetch_list($_result)){
			$_arr[] = $_rows;
		}
		return $_arr;
	}
	
	function _data($_result,$_param){
		$_arr = array();
		while(!!$_rows = _fetch_list($_result)){
			$_arr[] = $_rows[$_param];
		}
		return $_arr;
	}
	
	function _free_result($_result){
		mysql_free_result($_result);
	}
	
	function _fetch_all($_result){
		return mysqli_fetch_all($_result, MYSQLI_ASSOC);
	}
	
	function _insert_id(){
		return mysql_insert_id();
	}
	
	/*sql返回数据*/
	function _affected_rows(){
		return mysql_affected_rows();
	}
	
	/*查看字段是否重复*/
	function _is_repeat($_sql,$_info){
		if(_fetch_array($_sql)){
			_alert_back($_info);
		} 
	}
	
	/*关闭数据库*/
	function _close(){
		if(!mysql_close()) {
			exit('关闭异常');
		}
	}
	
?>