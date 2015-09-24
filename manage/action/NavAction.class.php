<?php
	class NavAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new NavModel());
			$this->_action();
			//$this->_tpl->display('level.tpl');
		}
		
		//show nav
		private function _action() {
			$this->_tpl->assign('AllNav',$this->_model->getAllNav());
		}
	}
?>