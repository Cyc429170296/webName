<?php
	//导航实体类
	class NavModel extends Model {
		//拦截器(__set)
		public function __set($_key, $_value) {
			$this->$_key = $_value;
		}
		
		//拦截器(__get)
		public function __get($_key) {
			return $this->$_key;
		}
		
		//查询所有 Nav
		public function getAllNav() {
			$_sql = "SELECT mid,module_name FROM tg_module ORDER BY mid ASC";
			return parent::all($_sql);
		}
	}
?>