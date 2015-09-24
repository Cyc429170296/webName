<?php 
	//语言转换
	function language($str){
		$language_arr=array(
			'关于我们'=>'About Us',
			'品牌陈列'=>'Brand Display',
			'业务选择'=>'Business Choice',
			'项目展示'=>'Project Display',
			'成功案例'=>'Success Case',
			'下载中心'=>'Download Center',
			'联系我们'=>'Contact Us',
		);
		return $language_arr[$str];
	}
?>