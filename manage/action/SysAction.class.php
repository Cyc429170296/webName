<?php
	class SysAction extends Action {	
		//构造方法，初始化
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new SysModel());
			$this->_action();
		}

		//action
		private function _action() {
			//Validate::checkSession();
			switch ($_GET['action']) {
				case '2' :
					$this->sys_userinfo();
					break;
				case '3' :
					$this->sys_banner();
					break;
				case '1' :
				default :
					$this->sys_set();
					break;
			}
		}
		
		//系统设置
		private function sys_set() {
			if(isset($_POST['send'])) {
				$this->_model->sysInfo = $_POST;
				$this->_model->updateSysInfo() ? '' : Tool::alertBack('很遗憾,修改失败');
			}
			$this->_tpl->assign('sys_set',true);
			$this->_tpl->assign('getSysInfo',$this->_model->getSysInfo());	
		}
		
		//用户信息
		private function sys_userinfo() {
			if (isset($_POST['send'])) {
				$this->_model->userInfo = $_POST['user_info'];
				echo $this->_model->updateUserInfo();
				exit;
			}
			$this->_tpl->assign('sys_userinfo',true);
			$this->_tpl->assign('getUserInfo',$this->_model->getUserInfo());
		}
		
		//banner设置
		private function sys_banner() {
			$this->_model->id = 1;
			if(isset($_POST['id'])){
				$this->_model->id = $_POST['id'];
				$getBanner = $this->_model->getBanner();
				$json_string= json_encode($getBanner);
				echo $json_string;
				exit;
			}
			if (isset($_POST['send'])) {
				$_POST['recom'] = isset($_POST['recom']) ? 1 : 0;
				if (is_uploaded_file($_FILES["upfile"]['tmp_name'])){
					require ROOT_PATH.'/upload.php';
					$_POST['textfield'] = IMG;
				}
				$this->_model->userInfo = $_POST;
				$this->_model->updateBanner() ? '' : Tool::alertBack('很遗憾,修改失败');
				$this->_model->id = $_POST[banner_id];
			}
			$this->_tpl->assign('mid',$this->_model->id);
			$this->_tpl->assign('getBanner',$this->_model->getBanner());
			$this->_tpl->assign('sys_banner',true);
		}	
	}
?>