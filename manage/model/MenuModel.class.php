<?php
	//栏目实体类
	class MenuModel extends Model {
		private $mid;
		private $pid;
		private $reg;//制定某个栏目下的二级栏目
		private $menu_name;
		//拦截器(__set)
		public function __set($_key, $_value) {
			$this->$_key = $_value;
		}
		
		//拦截器(__get)
		public function __get($_key) {
			return $this->$_key;
		}
		
		//查询单个栏目
		public function getOneModule() {
			$_sql = "SELECT 
										module_name 
								FROM 
										tg_module									
							WHERE 
										mid=$this->mid
								LIMIT 
										1";
			return parent::one($_sql);
		}
		
		public function getOneMenu() {
			$_sql = "SELECT 
										menu_name 
								FROM 
										tg_menu									
							WHERE 
										pid=$this->pid
								LIMIT 
										1";
			return parent::one($_sql);
		}
		
		public function getFirMenu() {
			$_sql = "SELECT 
										pid,menu_name
								FROM
										tg_menu
								WHERE
										mid = $this->mid
								AND    
       								    cid =0";
			return parent::all($_sql);
			
		}
	
		//查询所有栏目
		public function getSecMenu() {
			$_sql = "SELECT 
										l.menu_name as fir_nemu,
										r.mid,
										r.menu_name as sec_nemu,
										r.pid
								FROM 
										tg_menu r,
										tg_menu l
								WHERE
										l.mid = $this->mid
								AND    
       								    l.pid = r.cid
								$this->reg
							ORDER BY
										l.menu_name desc";
			return parent::all($_sql);
		}
		
		public function getPid() {
			$_sql = "SELECT 
										cid		
								FROM 
										tg_menu
								WHERE
										mid = $this->mid
								AND	
										cid <> 0";
			return parent::one($_sql);
		}
		
		//新增栏目
		public function addMenu() {
			$_sql = "INSERT INTO 
												tg_menu (
																				mid,
																				menu_name,
																				cid,
																				date
																		) 
														VALUES (
																				'$this->mid',
																				'$this->menu_name',
																				'$this->cid',
																				NOW()
																		)";
			return parent::aud($_sql);
		}
		
		//修改栏目
		public function updateMenu() {
			$_sql = "UPDATE 
										tg_menu 
								  SET 
										menu_name='$this->menu_name'
							WHERE 
										pid='$this->pid' 
								 LIMIT 
										1";
			return parent::aud($_sql);
		}
		
		//删除栏目
		public function deleteMenu() {
			$_sql ="DELETE FROM 
												tg_menu 
										WHERE 
												pid='$this->pid' 
										OR
												cid='$this->pid'";
			return parent::aud($_sql);
		}
		
	}
?>