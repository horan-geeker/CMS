<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月15日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */

require 'init.inc.php';
//载入tpl
global $_tpl;
//在执行php代码之前，如果有缓存文件则不用执行php，直接去打开cache
$_tpl->cache('detail.tpl');
$_detail = new DetailAction($_tpl);
$_detail->_action();
$_tpl->dispaly('detail.tpl');








