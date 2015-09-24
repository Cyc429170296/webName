<?php
	//模板实体类
	class ModuleModel extends Model {
		private $userInfo;
		private $sysInfo;
		private $mid;
		//拦截器(__set)
		public function __set($_key, $_value) {
			$this->$_key = $_value;
		}
		
		//拦截器(__get)
		public function __get($_key) {
			return $this->$_key;
		}
		
		public function getModule() {
			$_sql = "SELECT 
										* 
								FROM 
										tg_module";
			return parent::all($_sql);
		}
		
		public function deleteModule() {
			$_sql ="DELETE FROM 
												tg_module
										WHERE 
												mid='$this->mid'";
			return parent::aud($_sql);
		}
		
		public function addModule() {
			$_sql = "INSERT INTO 
										tg_module (
														module_tpl,
														module_det,
														module_name,
														module_same,
														param1,
														param2,
														param3
													) 
										VALUES (
														'{$this->userInfo[module_tpl]}',
														'{$this->userInfo[module_det]}',
														'{$this->userInfo[module_name]}',
														'{$this->userInfo[module_same]}',
														'{$this->userInfo[param1]}',
														'{$this->userInfo[param2]}',
														'{$this->userInfo[param3]}'
												)";
			return parent::_insert_id($_sql);
		}
		
		public function updateModule() {
			$_sql = "UPDATE 
										tg_module 
								  SET 
										module_tpl = '{$this->userInfo[module_tpl]}',
										module_det = '{$this->userInfo[module_det]}',
										module_name = '{$this->userInfo[module_name]}',
										module_same = '{$this->userInfo[module_same]}',
										param1 = '{$this->userInfo[param1]}',
										param2 = '{$this->userInfo[param2]}',
										param3 = '{$this->userInfo[param3]}'
										
							WHERE 
										mid = {$this->userInfo[mid]} 
								 LIMIT 
										1";
			return parent::aud($_sql);
		}
	}
?>