<?php
require_once dirname(__FILE__).'/init.inc.php';
Validate::checkSession();
global $_tpl;
new ModuleAction($_tpl); 
$_tpl->display('module.tpl');
?>