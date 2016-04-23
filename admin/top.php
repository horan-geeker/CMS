<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月20日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
//获取当前目录的长度加上/为6个，可以利用函数保证兼容
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
$_tpl->assign('admin_user', $_SESSION['admin']['admin_user']);
$_tpl->assign('admin_level', $_SESSION['admin']['admin_level']);
$_tpl->dispaly('top.tpl');



