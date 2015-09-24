<?php
	class MenuAction extends Action {
		
		//构造方法，初始化
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new MenuModel());
			$this->_action();
		}
		
		//action
		private function _action() {
			$this->_init();
			switch ($_GET['action']) {
				case 'add' :
					$this->add();
					break;
				case 'update' :
					$this->update();
					break;
				case 'delete' :
					$this->delete();
					break;
				case 'show' :
				default:
					$this->show();
					break;
			}
		}
		private function _init(){
			if(!isset($_GET['m']) || !is_numeric($_GET['m'])){
				$this->_model->mid = 1;
			}else{
				$this->_model->mid = $_GET['m'];
			}
			$this->_tpl->assign('mid',$this->_model->mid);
			$fir_menu = $this->_model->getFirMenu();
			$this->_tpl->assign('fir_menu',$fir_menu);
			if($fir_menu){
				$this->_tpl->assign('fir_menu_flag',true);
			}
			$this->_tpl->assign('module_name',$this->_model->getOneModule()->module_name);

		}
		//show
		private function show() {
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','栏目列表');
			if(isset($_GET['p']) && is_numeric($_GET['p'])){
				$this->_model->mid = $_GET['m'];
				$this->_model->reg =$_GET['p'] ? "AND l.pid = ".$_GET['p'] : '';
				$secMenu = $this->_model->getSecMenu();
				$arr = array('data' => $secMenu);
				$json_string= json_encode($arr);
				echo $json_string;
				exit;
			}
			$cid = $this->_model->getPid()->cid;
			$this->_model->reg = $cid ? "AND l.pid = ".$cid : '';
			$sec_menu = $this->_model->getSecMenu();
			$this->_tpl->assign('sec_menu',$sec_menu);
			if($sec_menu){
				$this->_tpl->assign('sec_menu_flag',true);
			}
		}
		
		//add
		private function add() {
			//$_num = 0;
			if (isset($_POST['send'])) {
				//$str = 'm='.$this->_model->mid;
				/*if(isset($_POST['pid']) && is_numeric($_POST['pid'])){
					$this->_model->cid = $_POST['pid'];
					//$str .= '&p='.$_POST['pid'];
				}else{
					$this->_model->cid = 0;
				}*/
				$this->_model->cid = isset($_POST['pid']) && is_numeric($_POST['pid']) ? $_POST['pid'] : 0;
				foreach($_POST['menus'] as $key=>$value){
					if($value){
						$this->_model->menu_name = $value;
						$this->_model->addMenu();// ? ++$_num : 0;
					}
				}
				//Tool::alertLocation('恭喜你，新增'.$_num.'个栏目成功！','menu.php?action=add&'.$str);
			}
			$this->_tpl->assign('range',range(1,6));
			if(isset($_GET['p'])){
				$this->_tpl->assign('sec_menu',true);
				$this->_model->pid = $_GET['p'];
				$this->_tpl->assign('pid',$_GET['p']);
				$this->_tpl->assign('menu_name',$this->_model->getOneMenu()->menu_name);
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增栏目');
		}
		
		//update
		private function update() {
			if (isset($_GET['p'])) {
				$this->_model->pid = $_GET['p'];
				$this->_model->menu_name = trim($_POST['menu_name']);
				echo $this->_model->updateMenu();
				exit;
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
		//delete
		private function delete() {
			if (isset($_GET['p'])) {
				$this->_model->pid = $_GET['p'];
				echo $this->_model->deleteMenu();
				exit;
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>