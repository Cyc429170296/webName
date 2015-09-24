<?php 
	class Templates{
		private $_arr = array();
		private $_config = array();
		public function __construct(){
			if(!is_dir(CACHE) || !is_dir(TPL_DIR) || !is_dir(TPL_C_DIR)){
				exit('ERROR:模板不存在，请手动设置');
			}
		}
		public function display($_file){
			$_tplFile = TPL_DIR.'/'.$_file;
			if(!file_exists($_tplFile)){
				exit("ERROR:模板不存在");
			}
			$_praFile = TPL_C_DIR.'/'.md5($_file).$_file.'.php';
			//生成缓存文件
			$_cacheFile = CACHE.'/'.md5($_file).$_file.'.html';
			//当第二次运行相同文件的时候，直接载入缓存文件，避开编译
			/*if(IS_CACHE){
				//缓存文件和编译文件都要存在
				if(file_exists($_cacheFile) && file_exists($_praFile)){
					//判断模板文件是否修改过，判断编译文件是否修改过
					if(filemtime($_praFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_praFile)){
						//载入缓存文件;
						include $_cacheFile;
						return;
					}
				}
			}*/
			if(!file_exists($_praFile) || filemtime($_praFile) < filemtime($_tplFile)){
				require_once ROOT_PATH.'/includes/Parser.class.php';
				$_pra = new Parser($_tplFile);
				$_pra->compile($_praFile);
			}
			include $_praFile;
		
			/*if(IS_CACHE){
				//获取缓冲区内的数据,并且创建缓存文件
				file_put_contents($_cacheFile,ob_get_contents());
				//青春缓冲区
				ob_end_clean();
				//载入缓存文件
				include $_cacheFile;
			}*/
		}	
		
		public function assign($_val,$_value){
			$this->_arr[$_val] = $_value;
		}
		
		public function create($_file){
			$_tplFile = TPL_DIR.'/'.$_file;
			if(!file_exists($_tplFile)){
				exit("ERROR:模板不存在");
			};
			$_praFile = TPL_C_DIR.'/'.md5($_file).$_file.'.php';

			if(!file_exists($_praFile) || filemtime($_praFile) < filemtime($_tplFile)){
				require_once ROOT_PATH.'/includes/Parser.class.php';
				$_pra = new Parser($_tplFile);
				$_pra->compile($_praFile);
			}
			include $_praFile;
		}
	}
?>