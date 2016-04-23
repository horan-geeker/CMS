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
//mysql的基本配置
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'cms');

//模板配置
define('TPL_DIR', ROOT_PATH.'/templates/');             //模板文件目录
define('TPL_DIR_C', ROOT_PATH.'/templates_c/');         //编译文件目录
define('CACHE', ROOT_PATH.'/cache/');                   //缓存目录
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);//关闭notice和warning和函数参数引用报错
ini_set('display_errors', 1);                           //报错开关


//系统配置
define('PAGE_SIZE', 10);                                //分页
define('ARTICLE_SIZE', 8);                              //前端文档分页
define('GPC', get_magic_quotes_gpc());                  //判断魔术引号是否开启
define('PREV_URL',$_SERVER['HTTP_REFERER']);            //上一页的地址
define('NAV_SIZE', 10);                                 //主导航显示个数
define('UPDIR','/uploads/');                            //上传主目录
date_default_timezone_set('Asia/Shanghai');             //时区设置
define('MARK', ROOT_PATH.'/images/yc.png');             //水印图片

