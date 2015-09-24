<?php
	//内容实体类
	class ContentModel extends Model {
		private $mid;
		private $id;
		private $limit;
		private $reg;
		
		//拦截器(__set)
		public function __set($_key, $_value) {
			$this->$_key = $_value;
		}
		
		//拦截器(__get)
		public function __get($_key) {
			return $this->$_key;
		}


		public function getContentTotal() {
			$_sql = "SELECT 
										COUNT(*) 
								FROM 
										tg_article
								WHERE
										mid = '$this->mid'";
			return parent::total($_sql);
		}
		
		//查询单个内容
		public function getOneContent() {
			$_sql = "SELECT 
										*
								FROM 
										tg_article r,
										tg_menu l
							WHERE 
										id='$this->id' 
							AND 
										r.pid = l.pid
								LIMIT 
										1";
			return parent::one($_sql);
		}
		
		//查询所有内容
		public function getAllContent() {

			$_sql = "SELECT 
										l.menu_name as menu_name,
										r.id,
										r.title,
										r.img_src,
										r.content,
										r.param1,
										r.param2,
										r.param3,
										r.recom
								FROM 
								        tg_menu l,
										tg_article r
								WHERE
										r.mid = '$this->mid'
								AND 
										r.pid = l.pid
								$this->reg
								ORDER BY
										l.menu_name desc
								$this->limit";
			return parent::all($_sql);
		}
		
		//新增内容
		public function addContent() {
			$_sql = "INSERT INTO 
							tg_article(
											mid,
											pid,
											title,
											img_src,
											content,
											param1,
											param2,
											param3,
											recom,
											date
									) 
									VALUES (
											'$this->mid',
											'{$this->userInfo[pid]}',
											'{$this->userInfo[title]}',
											'{$this->userInfo[img_src]}',
											'{$this->userInfo[content]}',
											'{$this->userInfo[param1]}',
											'{$this->userInfo[param2]}',
											'{$this->userInfo[param3]}',
											'{$this->userInfo[recom]}',
											NOW()
									)";
			return parent::aud($_sql);
		}
		
		//修改内容
		public function updateContent() {
			$_sql = "UPDATE 
										tg_article
								  SET 
								  		pid = '{$this->userInfo[pid]}',
										title = '{$this->userInfo[title]}',
										img_src = '{$this->userInfo[img_src]}',
										content = '{$this->userInfo[content]}',
										param1 = '{$this->userInfo[param1]}',
										param2 = '{$this->userInfo[param2]}',
										param3 = '{$this->userInfo[param3]}',
										recom = '{$this->userInfo[recom]}',
										date = NOW()
							WHERE 
										id='{$this->userInfo[id]}' 
								 LIMIT 
										1";
			return parent::aud($_sql);
		}
		
		//删除内容
		public function deleteContent() {
			$_sql ="DELETE FROM 
												tg_article
										WHERE 
												id='$this->id' 
										LIMIT 1";
			return parent::aud($_sql);
		}
		
		public function getParam(){
			$_sql = "SELECT 
										param1,
										param2,
										param3
								FROM 
										tg_module
								WHERE
										mid='$this->mid'
								LIMIT 1";
			return parent::one($_sql);
		}

		public function getAllMenu(){
			$_sql = "SELECT 
										pid,
										menu_name
								FROM 
										tg_menu
								WHERE
										mid = '$this->mid'";
		
			return parent::all($_sql);
		}

		public function delMenu(){
			$_sql = "SELECT 
										DISTINCT  l.pid
								FROM 
										tg_menu r,
										tg_menu l
								WHERE
										l.mid = '$this->mid'
								AND
								  		l.pid = r.cid";
		
			return parent::all($_sql);
		}
	}
?>