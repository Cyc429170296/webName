<?php
require_once dirname(__FILE__).'/init.inc.php';
Validate::checkSession();
global $_tpl;
new MenuAction($_tpl);   //入口
$_tpl->display('menu.tpl');
?>