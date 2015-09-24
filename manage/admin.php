<?php
require_once dirname(__FILE__).'/init.inc.php';
Validate::checkSession();
global $_tpl;
new SysAction($_tpl); 
$_tpl->display('admin.tpl');
?>