<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月24日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class Model{
    
    
    //执行多条sql语句
    protected function multi($_sql){
        $_db = DB::getDB();
        $_db->multi_query($_sql);
        DB::unDB($_result=null,$_db);
        return true;
    }
    
    
    //查找总记录模型
    protected function total($_sql){
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_total= $_result->fetch_row();
        DB::unDB($_result, $_db);
        return $_total[0];
    }
    
    
    //查找单个数据模型
    protected function one($_sql){
        $_db = DB::getDB();
        $_result = $_db->query($_sql);
        $_object = $_result->fetch_object();
        DB::unDB($_result, $_db);
        return Tool::htmlString($_object);
    }
    
    //查询所有管理员
    protected function all($_sql){
        //连接数据库并设置编码
        $_db = DB::getDB();
        //获取结构集
        $_result = $_db->query($_sql);
        //result和db都可以free和close但是他们构成的对象只能按地址传去清理或在本页清理
        $_html = array();
        while(!!$_objects = $_result->fetch_object()){
            $_html[] = $_objects;
        }
        DB::unDB($_result, $_db);
        
        return Tool::htmlString($_html);
    }
    
    
    //增删改模型
    protected function adu($_sql){
        $_db = DB::getDB();
        $_db->query($_sql);
        $_affect_rows = $_db->affected_rows;
        DB::unDB($_result=null, $_db);
        return $_affect_rows;
    }
    
    //验证用户
    protected function check_user($_user, $_pass, $_table_user, $_table_pass, $_table){
        $_sql = "SELECT id FROM "
                                .$_table.
                        "WHERE ".$_table_user."='".$_user."' AND ".$_table_pass."='".$_pass."'";
    }


    //查找下一个id
    public function nextId($_table) {
        $_sql = "SHOW TABLE STATUS LIKE '$_table'";
        $_object = $this->one($_sql);
        return $_object->Auto_increment;
    }
}



