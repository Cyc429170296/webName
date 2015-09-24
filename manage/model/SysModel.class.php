<?php
	//系统设置实体类
	class SysModel extends Model {
		private $sysInfo;
		private $userInfo;
		private $id;
		//拦截器(__set)
		public function __set($_key, $_value) {
			$this->$_key = $_value;
		}
		
		//拦截器(__get)
		public function __get($_key) {
			return $this->$_key;
		}
		
		//获取系统信息
		public function getSysInfo() {
			$_sql = "SELECT * FROM tg_system LIMIT 1";
			return parent::all($_sql);
		}
		
			//修改系统信息
		public function updateSysInfo() {
			$_sql = "UPDATE 
										tg_system 
								SET 
										webname = '{$this->sysInfo[webname]}',
										keyword = '{$this->sysInfo[keyword]}',
										descript = '{$this->sysInfo[descript]}',
										article_list_num = '{$this->sysInfo[article_list_num]}',
										pics_list_num = '{$this->sysInfo[pics_list_num]}'
								WHERE
										id = 1
								LIMIT 
										1";
			return parent::aud($_sql);
		}
		
		public function getUserInfo() {
			$_sql = "SELECT 
										* 
								FROM 
										tg_user";
			return parent::all($_sql);
		}
		
		public function updateUserInfo() {
			$_sql = "UPDATE 
										tg_user
								 SET 
										user_name = '{$this->userInfo[user_name]}',
										user_address = '{$this->userInfo[user_address]}',
										user_qq = '{$this->userInfo[user_qq]}',
										user_tel = '{$this->userInfo[user_tel]}',
										user_phone = '{$this->userInfo[user_phone]}',
										user_email = '{$this->userInfo[user_email]}'
								WHERE
										id = {$this->userInfo[id]}
								LIMIT
										1";
			return parent::aud($_sql);
		}

		public function getBanner() {
			$_sql = "SELECT 
										banner_src,
										title,
										recom 
								FROM 
										tg_banner
								WHERE
										id = $this->id";
			return parent::one($_sql);
		}

		public function updateBanner() {
			$_sql = "UPDATE 
										tg_banner
								 SET 
										banner_src = '{$this->userInfo[textfield]}',
										title = '{$this->userInfo[title]}',
										time = NOW(),
										recom = '{$this->userInfo[recom]}'
								WHERE
										id = {$this->userInfo[banner_id]}
								LIMIT
										1";
			return parent::aud($_sql);

		}

	}
?>