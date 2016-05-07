<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月23日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class Tool{
    
    //将当前文件转换成tpl文件名
    static public function fileToTPL(){
        $_str = explode('/', $_SERVER['SCRIPT_NAME']);
        $_str = explode('.', $_str[count($_str)-1]);
        return $_str[0];
    }
    
    
    //弹窗跳转
    static public function alertLocation($_info,$_url){
        if(empty($_info)){
            header('Location:'.$_url);
            exit();
        }else{
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
            exit();
        }
    }
    
    
    //弹窗跳回
    static public function alertBack($_info){
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
        exit();
    }


    //弹窗关闭
    static public function alertClose($_info){
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        echo "<script type='text/javascript'>alert('$_info');close();</script>";
        exit();
    }
    
    
    //弹窗赋值并关闭（上传专用）
    static public function alertOpenerClose($_info, $_path){
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        echo "<script type='text/javascript'>alert('$_info');</script>";
        echo "<script type='text/javascript'>opener.document.content.thumb.value='$_path';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
        echo "<script type='text/javascript'>window.close();</script>";
        exit();
    }
    
    //清理session
    static public function unSession() {
        if(session_start()){
            session_destroy();
        }
    }
    
    
    //sql语句转义
    static function sqlString($_data){
        if(!GPC){
            if(is_array($_data)){
                return $_data;
            }
            else{
                return addslashes($_data);
            }
        }else{
            return $_data;
        }
    }
    
    //html过滤，既可以转换数组也解决了对象数组的转换
    static function htmlString($_data){
        if(is_array($_data)){
            foreach ($_data as $_key=>$_value){
                $_string[$_key]=Tool::htmlString($_value);
            }
        }elseif (is_object($_data)){
            foreach ($_data as $_key=>$_value){
                $_string->$_key=Tool::htmlString($_value);
            }
        }
        else{
            $_string = htmlspecialchars($_data);
        }
        return $_string;
    }
    
    
    //将html字符串翻转换为html标签
    static function unHtmlString($_data){
        return htmlspecialchars_decode($_data);
    }
    
    
    //对对象数组中的长字符串截取部分,放入原对象的成员里
    static public function subStr($_object,$_field,$_length,$_encode) {
        if($_object){
            if(is_array($_object)){
                foreach ($_object as $_value){
                    if(mb_strlen($_value->$_field,$_encode)>$_length){
                        $_value->$_field=mb_substr($_value->$_field, 0,$_length,$_encode).'...';
                    }
                }
            }else{
                return mb_substr($_object, 0, $_length, $_encode);
            }
        }
    }


    //调整date格式
    static function formatDate($object){
        if(is_array($object)){
            foreach ($object as $value){
                Tool::formatDate($value);
            }
        }
        $object->date = date('m-d',strtotime($object->date));
    }
    
    
    //将对象数组转换成字符串并且去掉最后的逗号
    static function ArrToStr($_objects ,$_field) {
        if($_objects){
            foreach ($_objects as $_value){
                    $_id .= $_value->$_field.',';
            }
            return substr($_id , 0,strlen($_id)-1);
        }
    }
}



