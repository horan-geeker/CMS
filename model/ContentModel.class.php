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
class ContentModel extends Model{
    
    private $id;
    private $title;
    private $nav;
    private $tag;
    private $attr;
    private $keyword;
    private $thumb;
    private $info;
    private $content;
    private $comment;
    private $count;
    private $gold;
    private $sort;
    private $readlimit;
    private $color;
    private $source;
    private $author;
    private $limit;
   
    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    
    
    //获取单一文档
    public function getOneContent(){
        $_sql = "SELECT
                        *
                  FROM
                        cms_content
                 WHERE
                        id='$this->id'
            ";
        return parent::one($_sql);
    }
    
    
    //获取文档列表,子类父类通用
    public function getListContent(){
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
                        c.nav IN ($this->nav)
               ORDER BY 
                        c.date DESC
                    $this->limit;
            ";
        return parent::all($_sql);
    }
    
    
    //获取文档总记录
    public function getContentTotal(){
        $_sql = "SELECT 
                        COUNT(*) 
                   FROM 
                        cms_content c,
                        cms_nav n
                  WHERE 
                        c.nav=n.id
                    AND
                        c.nav IN ($this->nav)
            ";
        return parent::total($_sql);
    }
    
    
    
    //新增文档
    public function addContent(){
        $_sql = "INSERT INTO 
                            cms_content(
                                        title,
                                        nav,
                                        tag,
                                        attr,
                                        keyword,
                                        thumb,
                                        info,
                                        content,
                                        comment,
                                        count,
                                        gold,
                                        sort,
                                        readlimit,
                                        color,
                                        source,
                                        author,
                                        date
                                       )
                                VALUES(
                                        '$this->title',
                                        '$this->nav',
                                        '$this->tag',
                                        '$this->attr',
                                        '$this->keyword',
                                        '$this->thumb',
                                        '$this->info',
                                        '$this->content',
                                        '$this->comment',
                                        '$this->count',
                                        '$this->gold',
                                        '$this->sort',
                                        '$this->readlimit',
                                        '$this->color',
                                        '$this->source',
                                        '$this->author',
                                        NOW()
                                       )
            ";
        return parent::adu($_sql);
    }
    
    //修改文档
    public function updateContent() {
        $_sql = "UPDATE
                            cms_content
                    SET
                            title='$this->title',
                            nav='$this->nav',
                            tag='$this->tag',
                            attr='$this->attr',
                            keyword='$this->keyword',
                            thumb='$this->thumb',
                            info='$this->info',
                            content='$this->content',
                            comment='$this->comment',
                            count='$this->count',
                            gold='$this->gold',
                            sort='$this->sort',
                            readlimit='$this->readlimit',
                            color='$this->color',
                            source='$this->source',
                            author='$this->author',
                            date=NOW()
                   WHERE
                            id='$this->id'
            ";
        return parent::adu($_sql);
    }
    
    
    //删除文章
    public function delContent() {
        $_sql = "DELETE FROM cms_content WHERE id='$this->id' LIMIT 1";
        return parent::adu($_sql);
    }
    
    
    //累计访问量
    public function countContent(){
        $_sql = "UPDATE cms_content SET count=count+1 WHERE id='$this->id' LIMIT 1";
        return parent::adu($_sql);
    }
    
}



