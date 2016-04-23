<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月25日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class Validate{
    
    static function checkNull($_data) {
        return trim($_data)==''?true:false;
    }
    
    static function checkLength($_data,$_length,$_flag) {
        if($_flag == 'min'){
            return mb_strlen(trim($_data),'utf-8')<$_length?true:false;
        }elseif($_flag == 'max'){
            return mb_strlen(trim($_data),'utf-8')>$_length?true:false;
        }elseif($_flag == 'equals'){
            return mb_strlen(trim($_data),'utf-8')!=$_length?true:false;
        }else{
            Tool::alertBack('传值有误');
        }
    }
    
    static function checkEquals($_data,$_otherData) {
        return trim($_data) != trim($_otherData)?true:false;
    }
    
    static function checkSession() {
        if(!isset($_SESSION['admin'])){
            Tool::alertBack('非法登录');
        }
    }
    
    
    //判断数据是否为数字
    static function checkNum($_data) {
        if(!is_numeric($_data))return true;
        return false;
    }
    
    
    /**
     * _check_email邮箱格式验证
     * @param unknown $email
     * @return string|unknown
     */
    static function checkEmail($email){
        if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$email)){
            return true;
        }
    }
}



