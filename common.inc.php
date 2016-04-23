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
//前台是否开启缓冲区
define('IS_CACHE', false);
global $_tpl,$_cache;
if(IS_CACHE && !$_cache->noCache()){
    ob_start();
    $_tpl->cache(Tool::fileToTPL().'.tpl');
}
$_nav = new NavAction($_tpl);
$_nav->showNavFront();

if(IS_CACHE){
    $_tpl->assign('header', '<script type="text/javascript">getHeader();</script>');
}else{
    if(isset($_COOKIE['user'])){
        $_tpl->assign('header', $_COOKIE['user'].', 您好！ <a href="register.php?action=logout">退出</a>');
    }else{
        $_tpl->assign('header','<a href="register.php?action=reg" class="user">注册 </a><a href="register.php?action=login" class="user">登录</a>');
    }
}