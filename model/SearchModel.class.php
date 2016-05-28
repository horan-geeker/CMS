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
class SearchModel extends Model{
    
    private $q;
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

    //获取文档总记录
    public function searchTitleContentTotal(){
        $_sql = "SELECT 
                        COUNT(*) 
                   FROM 
                        cms_content c,
                        cms_nav n
                  WHERE 
                        c.nav=n.id
                    AND
                        c.title LIKE '%$this->q%'
            ";
        return parent::total($_sql);
    }

    //获取文档列表,子类父类通用
    public function searchTitleContent(){
        $_sql = "SELECT 
                        c.id,
                        c.title,
                        c.date,
                        c.info,
                        c.thumb,
                        c.attr,
                        c.count,
                        c.nav,
                        n.nav_name
                  FROM 
                        cms_content c,
                        cms_nav n
                        
                  WHERE
                        c.nav=n.id
                    AND
                        c.title LIKE '%$this->q%'
               ORDER BY 
                        c.date DESC
                    $this->limit;
            ";
        return parent::all($_sql);
    }

    //获取文档总记录
    public function searchKeywordContentTotal(){
        $_sql = "SELECT 
                        COUNT(*) 
                   FROM 
                        cms_content c,
                        cms_nav n
                  WHERE 
                        c.nav=n.id
                    AND
                        c.keyword LIKE '%$this->q%'
            ";
        return parent::total($_sql);
    }

    //获取文档列表,子类父类通用
    public function searchKeywordContent(){
        $_sql = "SELECT 
                        c.id,
                        c.title,
                        c.keyword,
                        c.date,
                        c.info,
                        c.thumb,
                        c.attr,
                        c.count,
                        c.nav,
                        n.nav_name
                  FROM 
                        cms_content c,
                        cms_nav n
                        
                  WHERE
                        c.nav=n.id
                    AND
                        c.keyword LIKE '%$this->q%'
               ORDER BY 
                        c.date DESC
                    $this->limit;
            ";
        return parent::all($_sql);
    }
}



