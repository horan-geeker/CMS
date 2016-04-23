<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月21日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class DB{
    //获取对象句柄
    static public function getDB(){
        //使用过程化操作数据库
        $_mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        //判断数据库连接是否正确
        if(mysqli_connect_errno()){
            exit("数据库连接错误".mysqli_connect_error());
        }
        //设置编码
        $_mysqli->set_charset('utf8');
        return $_mysqli;
    }
    
    //数据库关闭并清理
    static public function unDB(&$_result,&$_db){
        if(is_object($_result)){
            //清理结果集
            $_result->free();
            //销毁结果集对象
            $_result=null;
        }
        if(is_object($_db)){
            //关闭数据库
            $_db->close();
            //销毁对象句柄
            $_db = null;
        }
    }
    
}



