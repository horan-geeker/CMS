<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月16日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
session_start();

header('Content-Type:text/html;charset=utf-8');
//根目录
define('ROOT_PATH',dirname(__FILE__));

//引入配置信息
require ROOT_PATH.'/config/profile.inc.php';


//自动加载类
function __autoload($_className){
    if(substr($_className, -6) == 'Action'){
        require_once ROOT_PATH.'/action/'.$_className.'.class.php';
    }elseif(substr($_className, -5) == 'Model'){
        require_once ROOT_PATH.'/model/'.$_className.'.class.php';
    }else{
        require_once ROOT_PATH.'/includes/'.$_className.'.class.php';
    }
}

//设置不缓存的数组
$_cache = new Cache(array('code','upload','static','register'));

global $_tpl;
$_tpl = new Templates();


//cache
require 'common.inc.php';

