<?php
	//模型基类total
	class Model {
		//查找总记录模型
		protected function total($_sql) {
			$_db = DB::getDB();
			$_result = $_db->query($_sql);
			$_total = $_result->fetch_row();
			DB::unDB($_result, $_db);
			return $_total[0];
		}
		
		//查找单个数据模型
		protected function one($_sql) {
			$_db = DB::getDB();
			$_result = $_db->query($_sql);
			$_objects = $_result->fetch_object();
			DB::unDB($_result, $_db);
			return $_objects;
		}
		
		//查找多个数据模型
		protected function all($_sql) {
			$_db = DB::getDB();
			$_result = $_db->query($_sql);
			$_html = array();
			while (!!$_objects = $_result->fetch_object()) {
				$_html[] = $_objects;
			}
			DB::unDB($_result, $_db);
			return $_html;
		}
		
		
		//增删修模型
		protected function aud($_sql) {
			$_db = DB::getDB();
			$_db->query($_sql);
			$_affected_rows = $_db->affected_rows;
			$_result = null;
			DB::unDB($_result, $_db);
			return $_affected_rows;
		}
		
		protected function _insert_id($_sql){
			$_db = DB::getDB();
			$_db->query($_sql);
			$_mid = $_db->insert_id;
			$_result = null;
			DB::unDB($_result, $_db);
			return $_mid;
		}
	}
?>