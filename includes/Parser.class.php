<?php 
	class Parser{
		private $_tpl;
		public function __construct($_tplFile){
			if(!$this->_tpl = file_get_contents($_tplFile)){
				exit('ERROR:模板文件读取错误');
			}
		}
		private function parVar(){
			$_patten = '/\{\$([\w]+)((\[|\]|\w)*)\}/';
			if(preg_match($_patten,$this->_tpl)){
				$this->_tpl = preg_replace($_patten,"<?php echo \$this->_arr['$1']$2;?>",$this->_tpl);
			}
		}
		private function parVarDeal(){
			$_patten = '/\{([\w\(]*)\$([\w]+)([\[\w\'\,\])\,\-]*)\}/';
			if(preg_match($_patten,$this->_tpl)){
				$this->_tpl = preg_replace($_patten,"<?php echo $1\$this->_arr['$2']$3;?>",$this->_tpl);
			}
		}
		private function parIf(){
			$_pattenIf = '/\{if\s+([\w\(]*)\$(\w+)([\=\'\"\)\w\s]+)\}/';
			$_pattenEndIf = '/\{\/if\}/';
			if(preg_match($_pattenIf,$this->_tpl)){
				if(preg_match($_pattenEndIf,$this->_tpl)){
					$this->_tpl = preg_replace($_pattenIf,"<?php if($1\$this->_arr['$2']$3){ ?>",$this->_tpl);
					$this->_tpl = preg_replace($_pattenEndIf,"<?php } ?>",$this->_tpl);
					$_pattenElse = '/\{else\}/';
					if(preg_match($_pattenElse,$this->_tpl)){
						$this->_tpl = preg_replace($_pattenElse,"<?php }else{ ?>",$this->_tpl);
					}
				}
			}
		}
		private function parInclude(){
			$_patten = '/\{include\s+file=[\"\']([\w\.\-\/]+)[\"\']\}/';
			if(preg_match($_patten,$this->_tpl,$_file)){
				if(!file_exists(ROOT_PATH.'/'.$_file[1]) || empty($_file[1])){
					exit('ERROE:文件为空或者不存在');
				}else{
					$this->_tpl = preg_replace($_patten,"<?php include '$1'; ?>",$this->_tpl);
				}
			}
		}
		//解析foreach语句
		private function parForeach() {
			$_pattenForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
			$_pattenEndForeach = '/\{\/foreach\}/';
			$_pattenVar = '/\{@([\w]+)([\w\[\]\-\>]*)\}/';
			if (preg_match($_pattenForeach,$this->_tpl)) {
				if (preg_match($_pattenEndForeach,$this->_tpl)) {
					$this->_tpl = preg_replace($_pattenForeach,"<?php foreach (\$this->_arr['$1'] as \$$2=>\$$3) { ?>",$this->_tpl);
					$this->_tpl = preg_replace($_pattenEndForeach,"<?php } ?>",$this->_tpl);
					if (preg_match($_pattenVar,$this->_tpl)) {
						$this->_tpl = preg_replace($_pattenVar,"<?php echo \$$1$2?>",$this->_tpl);
					}
				} else {
					exit('ERROR：foreach语句必须有结尾标签！');
				}
			}
		}
		
		private function parCommon(){
			$_patten = '/\{#\}(.*)\{#\}/';
			if(preg_match($_patten,$this->_tpl)){
				$this->_tpl = preg_replace($_patten,"<?php /* $1 */?>",$this->_tpl);
			}
		}
		
		private function parConfig(){
			$_patten = '/<!--\{(\w+)\}-->/';
			if(preg_match($_patten,$this->_tpl)){
				$this->_tpl = preg_replace($_patten,"<?php echo \$this->_config['$1'];?>",$this->_tpl);
			}
		}
		
		public function compile($_praFile){
			$this->parVar();
			$this->parVarDeal();
			$this->parIf();
			$this->parInclude();
			$this->parForeach();
			$this->parCommon();
			$this->parConfig();
			if(!file_put_contents($_praFile,$this->_tpl)){
				exit('ERROR:编译文件生成错误');
			}
		}
	}
?>