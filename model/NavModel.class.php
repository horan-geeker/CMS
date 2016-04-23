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
class NavModel extends Model{
    
    private $id;
    private $nav_name;
    private $nav_info;
    private $pid;
    private $sort;
    private $limit;
   
    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    
    
    //前台显示主导航
    public function getFrontNav(){
        $_sql = "SELECT
                        id,
                        nav_name
                    FROM
                        cms_nav
                    WHERE
                        pid=0
                    ORDER BY
                        sort ASC
                   LIMIT 
                        0,".NAV_SIZE."
        ";
        return parent::all($_sql);
    }
    
    
    public function getNavChildpid(){
        $_sql = "SELECT
                        id
                    FROM
                        cms_nav
                    WHERE
                        pid='$this->id'
        ";
        return parent::all($_sql);
    }
    
    
    //
    public function getAllNavChildId(){
        $_sql = "SELECT
                        id
                   FROM
                        cms_nav
                  WHERE
                        pid<>0
        ";
        return parent::all($_sql);
    }
    
    
    //前台显示主导航不带limit
    public function getAllFrontNav(){
        $_sql = "SELECT
                        id,
                        nav_name
                    FROM
                        cms_nav
                    WHERE
                        pid=0
                    ORDER BY
                        sort ASC
        ";
        return parent::all($_sql);
    }
    
    
    //获取导航总记录
    public function getNavTotal(){
        $_sql = "SELECT count(*) FROM cms_nav WHERE pid=0";
        return parent::total($_sql);
    }
    
    
    //获取子导航总记录
    public function getChildNavTotal(){
        $_sql = "SELECT count(*) FROM cms_nav WHERE pid='$this->id'";
        return parent::total($_sql);
    }
    
    
    //查询单个导航
    public function getOneNav(){
        $_sql = "SELECT 
                        n1.id,
                        n1.nav_name,
                        n1.nav_info,
                        n2.id p_id,
                        n2.nav_name p_nav_name
                   FROM
                        cms_nav n1
              LEFT JOIN
                        cms_nav n2
                     ON
                        n1.pid=n2.id
                  WHERE
                        n1.id='$this->id'
                     OR
                        n1.nav_name='$this->nav_name'
                  LIMIT 1
        ";
        return parent::one($_sql);
    }
    
    
    //查询所有导航带limit
    public function getAllNav() {
        $_sql = "SELECT
                        id,
                        nav_name,
                        nav_info,
                        sort
                   FROM
                        cms_nav
                  WHERE
                        pid=0
               ORDER BY
                        sort ASC
                $this->limit
            ";
        return parent::all($_sql);
    }
    
    
    //查询所有子导航带limit
    public function getChildNav() {
        $_sql = "SELECT
                        id,
                        nav_name,
                        nav_info,
                        sort
                   FROM
                        cms_nav
                  WHERE
                        pid='$this->id'
               ORDER BY
                        sort ASC
                    $this->limit
        ";
        return parent::all($_sql);
    }
    
    
    //查询所有子导航带limit
    public function getAllChildNav() {
        $_sql = "SELECT
                        id,
                        nav_name,
                        nav_info,
                        sort
                    FROM
                        cms_nav
                    WHERE
                        pid='$this->id'
                    ORDER BY
                        sort ASC
        ";
        return parent::all($_sql);
    }
    
    //新增导航
    public function addNav(){
        $_sql = "INSERT INTO
                   cms_nav(
                              nav_name,
                              nav_info,
                              pid,
                              sort
                            )
                      VALUES(
                            '$this->nav_name',
                            '$this->nav_info',
                            '$this->pid',
                            ".parent::nextId('cms_nav')."
                            )
        ";
        return parent::adu($_sql);
    }
    
    
    //修改导航
    public function updateNav() {
        $_sql = "UPDATE cms_nav SET
                                    nav_name='$this->nav_name',
                                    nav_info='$this->nav_info'
                              WHERE
                                    id='$this->id'
                                    LIMIT 1
        ";
        return parent::adu($_sql);
    }
    
    
    //导航排序
    public function setNavSort(){
        foreach ($this->sort as $_key=>$_value){
            if(!is_numeric($_value))continue;
            $_sql .= "UPDATE cms_nav SET sort='$_value' WHERE id='$_key';";
        }
        
        return parent::multi($_sql);
    }
    
    
    //删除导航
    public function delNav() {
        $_sql = "DELETE FROM cms_nav WHERE id='$this->id' LIMIT 1";
        return parent::adu($_sql);
    }
}



