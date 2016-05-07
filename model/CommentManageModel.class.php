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
class CommentManageModel extends Model{
    
    private $id;
    private $limit;
   
    
    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }

    //所有评论总量后台
    public function getCommentTotal(){
        $sql = "SELECT COUNT(*) FROM cms_comment";
        return parent::total($sql);
    }

    //所有评论后台
    public function getAdminComment(){
        $sql = "SELECT c.*,c.content full,ct.title FROM cms_comment c,cms_content ct WHERE c.cid=ct.id ORDER BY date DESC 
$this->limit";
        return parent::all($sql);
    }

    public function setPass(){
        $sql = "UPDATE cms_comment SET state=1 WHERE id='$this->id' LIMIT 1";
        return parent::adu($sql);
    }

    public function cancelPass(){
        $sql = "UPDATE cms_comment SET state=0 WHERE id='$this->id' LIMIT 1";
        return parent::adu($sql);
    }

    public function delete(){
        $sql = "DELETE FROM cms_comment WHERE id='$this->id' LIMIT 1";
        return parent::adu($sql);
    }

}



