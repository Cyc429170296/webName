<?php
require dirname(__FILE__).'/init.inc.php';
global $_tpl;
if (isset($_SESSION['admin'])) Tool::alertLocation(null, 'admin.php');
$_tpl->display('admin_login.tpl');
?>