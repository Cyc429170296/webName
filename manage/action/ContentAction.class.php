<?php
	class ContentAction extends Action {
		
		//构造方法，初始化
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new ContentModel());
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
			$getParam = $this->_model->getParam();
			$num = 0;
			foreach($getParam as$key=>$value){
				if(!$value){
					$getParam->$key = '参数'.++$num;
				}
			}
			$this->_tpl->assign('getParam',$getParam);
			
			$_module = new MenuModel();
			$_module->mid = $this->_model->mid;
			$_module_name = $_module->getOneModule();
	
			if($_module_name->module_name == '下载中心'){
				$this->_tpl->assign('download',true);
			};
		}

		private function getMenu(){//获取没有子栏目的所有栏目
			$_getALLMenu = $this->_model->getAllMenu();
			$_len = count($_getALLMenu);
			//print_r ($_getALLMenu);
			$_delMenu = $this->_model->delMenu();
			//print_r ($_delMenu);
			foreach($_delMenu as$key=>$value){ 
				for($i = 0; $i < $_len; $i++){
					if($_getALLMenu[$i]->pid == $value->pid){
                        unset($_getALLMenu[$i]);
					}
				}
			}
			$this->_tpl->assign('getMenu',$_getALLMenu);
			$this->_tpl->assign('count',count($_getALLMenu));
		}
		//show
		private function show() {
			parent::page($this->_model->getContentTotal(),PAGE_SIZE);
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','内容列表');
			$_reg = '';
			if(isset($_GET['p']) && is_numeric($_GET['p'])){
                $_reg = 'AND r.pid='.$_GET['p'];
                $this->_tpl->assign('pid',$_GET['p']);
			}
			$this->_model->reg = $_reg;
			$this->_tpl->assign('AllContent',$this->_model->getAllContent());
			$this->getMenu();
		}
		
		//add
		private function add() {
			if (isset($_POST['send'])) {
				$_POST['recom'] = isset($_POST['recom']) ? 1 : 0;
				if (is_uploaded_file($_FILES["upfile"]['tmp_name'])){
					require ROOT_PATH.'/upload.php';
					$_POST['img_src'] = IMG;
				}
				$this->_model->userInfo = $_POST;
				$this->_model->addContent() ? '' : Tool::alertBack('很遗憾，修改内容失败！');
				Tool::alertLocation(null,'content.php?action=add&m='.$_GET['m']);
			}
			$this->_tpl->assign('title','新增内容');
			$this->_tpl->assign('type','add');
			$this->_tpl->assign('content_deal',true);
			$this->getMenu();
		}


		
		//update
		private function update() {
			if (isset($_POST['send'])) {
				$_POST['recom'] = isset($_POST['recom']) ? 1 : 0;
				if (is_uploaded_file($_FILES["upfile"]['tmp_name'])){
					require ROOT_PATH.'/upload.php';
					$_POST['img_src'] = IMG;
				}
				$this->_model->userInfo = $_POST;
				$this->_model->updateContent() ? '' : Tool::alertBack('很遗憾，修改内容失败！');
				Tool::alertLocation(null,'content.php?action=update&m='.$_GET['m'].'&id='.$_POST['id']);
			}
			if (isset($_GET['id'])) {
				$this->_model->id=$_GET['id'];
				//$this->_tpl->assign('id',$_GET['id']);
				$this->_tpl->assign('content_deal',true);
				$this->_tpl->assign('type','update');
				$this->_tpl->assign('title','修改内容');
				$this->_tpl->assign('getOneContent',$this->_model->getOneContent());
				$this->getMenu();
			}
		}
		
		//delete
		private function delete() {
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$_file = substr(ROOT_PATH,0,strlen(ROOT_PATH)-6).'upload/'.$_GET['del_img'];
				$this->_model->deleteContent() ? @unlink ($_file) : Tool::alertBack('很遗憾，删除内容失败！');
				Tool::alertLocation(null,'content.php?action=show&m='.$_GET['m']);
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>