<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月22日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class PermissionModel extends Model{
    
    private $id;
    private $name;
    private $info;
    private $limit;
   
    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    //权限新增
    public function addPermission(){
        $_sql = "INSERT INTO 
                            cms_permission(
                                          name,
                                          info
                                       )
                                VALUES(
                                        '$this->name',
                                        '$this->info'
                                       )
            ";
        return parent::adu($_sql);
    }

    public function getAllPermission()
    {
        $sql = "SELECT * FROM cms_permission";

        return parent::all($sql);
    }
}



