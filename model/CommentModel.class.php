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
class CommentModel extends Model{
    
    private $id;
    private $manner;
    private $content;
    private $cid;
    private $limit;

    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    
    public function addComment(){
        $_sql = "
                    INSERT INTO
                                cms_comment(
                                            user,
                                            manner,
                                            content,
                                            cid,
                                            date
                                )
                                    VALUES(
                                            '$this->user',
                                            '$this->manner',
                                            '$this->content',
                                            '$this->cid',
                                            NOW()
                               )
        ";

        return parent::adu($_sql);
    }

    //带limit的分页显示,且是审核通过的
    public function getComment() {
        $_sql = "SELECT 
                                            c.*,
											u.face 
								FROM 
											cms_comment c
						LEFT JOIN
											cms_user u
									ON
											c.user=u.user
							WHERE 
											c.cid='$this->cid'
                              AND           
                                            c.state=1
						  ORDER BY
						                c.date DESC 
										$this->limit";
        return parent::all($_sql);
    }

    //不带LIMIT的所有的
    public function getAllComment(){
        $_sql = "SELECT * FROM cms_comment WHERE cid='$this->cid'";
        return parent::all($_sql);
    }


    public function getCommentTotal(){
        $_sql = "SELECT COUNT(id) FROM cms_comment WHERE cid='$this->cid' $this->limit";
        return parent::total($_sql);
    }


    public function setAttitude($attitude){
        if($attitude=='sustain'){
            $sql = "UPDATE cms_comment SET sustain=sustain+1 WHERE id='$this->id' LIMIT 1";
        }
        if($attitude=='oppose'){
            $sql = "UPDATE cms_comment SET oppose=oppose+1 WHERE id='$this->id' LIMIT 1";
        }
        return parent::adu($sql);
    }
}



