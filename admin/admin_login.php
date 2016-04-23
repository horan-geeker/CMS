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
$_login = new LoginAction($_tpl);
$_login->action();
//下边的方法返回里编译好的html代码
if(isset($_SESSION['admin'])){
    Tool::alertLocation(null, 'admin.php');
}
$_tpl->dispaly('admin_login.tpl');



