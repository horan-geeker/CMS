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
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
if(isset($_SESSION['admin'])){
    Tool::alertLocation(null,'admin.php');
}else{
    Tool::alertLocation(null,'admin_login.php');
}



