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
class LevelModel extends Model{
    
    private $id;
    private $level_name;
    private $level_info;
    private $limit;
   
    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    
    
    //获取等级总记录
    public function getLevelTotal(){
        $_sql = "SELECT count(*) FROM cms_level";
        return parent::total($_sql);
    }
    
    
    public function getOneLevel(){
        $_sql = "SELECT id,
                            level_name,
                            level_info 
                        FROM 
                            cms_level 
                        WHERE 
                            id='$this->id'
                        OR
                            level_name='$this->level_name'
                        LIMIT 1
        ";
        return parent::one($_sql);
    }
    
    
    //查询所有等级
    public function getAllLevel() {
        $_sql = "SELECT 
                        id,
                        level_name,
                        level_info
                   FROM
                        cms_level
               ORDER BY
                        id DESC
            ";
        return parent::all($_sql);
    }
    
    
    //查询所有等级带limit
    public function getAllLevelLimit() {
        $_sql = "SELECT
                        id,
                        level_name,
                        level_info
                   FROM
                        cms_level
               ORDER BY
                        id DESC
                $this->limit
            ";
        return parent::all($_sql);
    }
    
    
    //新增等级
    public function addLevel(){
        $_sql = "INSERT INTO 
                            cms_level(
                                        level_name,
                                        level_info
                                       )
                                VALUES(
                                        '$this->level_name',
                                        '$this->level_info'
                                       )
            ";
        return parent::adu($_sql);
    }
    
    //修改等级
    public function updateLevel() {
        $_sql = "UPDATE cms_level SET 
                                        level_name='$this->level_name',
                                        level_info='$this->level_info'
                                 WHERE 
                                        id='$this->id' 
                                    LIMIT 1";
        return parent::adu($_sql);
    }
    
    
    //删除等级
    public function delLevel() {
        if(parent::adu("select id from cms_manage where level='$this->id'")){
            Tool::alertBack('此等级名称正在被占用，请撤销后再删除');
        }
        $_sql = "DELETE FROM cms_level WHERE id='$this->id' LIMIT 1";
        return parent::adu($_sql);
    }
    
}



