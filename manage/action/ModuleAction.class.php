<?php
	class ModuleAction extends Action {	
		//构造方法，初始化
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new ModuleModel());
			$this->_action();
		}

		//action
		private function _action() {
			//Validate::checkSession();
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
				default :
					$this->show();
					break;
			}
		}
		

		private function show() {
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('getModule',$this->_model->getModule());
		}
		
		private function delete() {
			if (isset($_POST['send'])) {
				$this->_model->mid = $_POST['mid'];
				echo $this->_model->deleteModule();
				exit;
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
		private function add() {
			if (isset($_POST['send'])) {
				$this->_model->userInfo = $_POST['user_info'];
				echo $this->_model->addModule();
				exit;
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
		private function update() {
			if (isset($_POST['send'])) {
				$this->_model->userInfo = $_POST['user_info'];
				echo $this->_model->updateModule();
				exit;
			}
		}
	}
?>