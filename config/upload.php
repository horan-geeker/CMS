<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月31日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
require substr(dirname(__FILE__),0,-7).'/init.inc.php';
if(isset($_POST['send'])){
    $_fileupload = new FileUpload('pic');
    $_path = $_fileupload->getPath();
    $_img = new Image($_path);
    $_img->thumb(150,100);
//     $_img->watermark(600,0);
    $_img->out();
    Tool::alertOpenerClose('图片上传成功', $_path);
}else{
    Tool::alertBack('文件过大或其他错误');
}
