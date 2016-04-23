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
class ManageModel extends Model{
    
    private $id;
    private $admin_user;
    private $admin_pass;
    private $level;
    private $limit;
   
    
    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    
    
    //设置管理员登录统计
    public function setLoginData(){
        $_sql = "UPDATE cms_manage SET 
                                        login_count=login_count+1,
                                        last_ip='{$_SERVER['REMOTE_ADDR']}',
                                        last_time=NOW()
                                 WHERE admin_user='$this->admin_user'
                                 LIMIT 1
                ";
        return parent::adu($_sql);
    }
    
    
    public function getAllLevel(){
        $_sql = "SELECT id,level_name FROM cms_level ORDER BY id ASC";
        return parent::all($_sql);
    }
    
    //获取管理员总记录
    public function getManageTotal(){
        $_sql = "SELECT count(*) FROM cms_manage";
        return parent::total($_sql);
    }
    
    
    //两用的一个方法，可查id也可查admin_user
    public function getOneManage(){
        $_sql = "SELECT     
                        id,
                        admin_user,
                        admin_pass,
                        level 
                   FROM 
                        cms_manage 
                  WHERE 
                        id='$this->id' 
                     OR
                        admin_user='$this->admin_user'
                    LIMIT 1";
        return parent::one($_sql);
    }
    
    
    //查询所有管理员
    public function getManage() {
        $_sql = "SELECT m.id,
                        m.admin_user,
                        m.login_count,
                        m.last_ip,
                        m.last_time,
                        l.level_name
                   FROM
                        cms_manage as m,
                        cms_level as l
                  WHERE
                        l.id = m.level
               ORDER BY
                        m.id DESC
                  $this->limit
            ";
        return parent::all($_sql);
    }
    
    
    //验证管理员登录
    public function getLoginManage(){
        $_sql = "SELECT 
                        m.admin_user,
                        l.level_name
                   FROM
                        cms_manage m,
                        cms_level l
                  WHERE
                        m.admin_user='$this->admin_user'
                    AND
                        m.admin_pass='$this->admin_pass'
                    AND
                        m.level=l.id
                  LIMIT 1
            ";
        return parent::one($_sql);
    }
    
    //新增管理员
    public function addManage(){
        $_sql = "INSERT INTO 
                            cms_manage(
                                        admin_user,
                                        admin_pass,
                                        level,
                                        reg_time
                                       )
                                VALUES(
                                        '$this->admin_user',
                                        '$this->admin_pass',
                                        '$this->level',
                                         NOW()            
                                       )
            ";
        return parent::adu($_sql);
    }
    
    //修改管理员
    public function updateManage() {
        $_sql = "UPDATE cms_manage SET 
                                        admin_pass='$this->admin_pass',
                                        level='$this->level'
                                 WHERE 
                                        id='$this->id' 
                                    LIMIT 1";
        return parent::adu($_sql);
    }
    
    
    //删除管理员
    public function delManage() {
        $_sql = "DELETE FROM cms_manage WHERE id='$this->id' LIMIT 1";
        return parent::adu($_sql);
    }
    
}



