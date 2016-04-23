<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月26日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
require substr(dirname(__FILE__),0,-7).'/init.inc.php';
//下边的方法返回里编译好的html代码
$_vc = new ValidateCode();
$_vc->doimg();
$_SESSION['checkcode'] = $_vc->getCode();



