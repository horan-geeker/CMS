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
Validate::checkSession();
global $_tpl;
//入口
$_level = new LevelAction($_tpl);
$_level->action();
$_tpl->dispaly('level.tpl');




