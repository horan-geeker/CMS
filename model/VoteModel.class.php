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
class VoteModel extends Model
{

    private $id;
    private $title;
    private $info;
    private $state;
    private $count;
    private $vid;
    private $limit;

    public function __set($_key, $_value)
    {
        $this->$_key = Tool::sqlString($_value);
    }

    public function __get($_key)
    {
        return $this->$_key;
    }


    //获取投票主题总记录
    public function getVoteTotal()
    {
        $_sql = "SELECT count(*) FROM cms_vote WHERE vid=0";
        return parent::total($_sql);
    }

    //获取投票项目总记录
    public function getChildVoteTotal()
    {
        $_sql = "SELECT count(*) FROM cms_vote WHERE vid<>0";
        return parent::total($_sql);
    }


    public function getOneVote()
    {
        $_sql = "SELECT 
                            *
                        FROM 
                            cms_vote 
                        WHERE 
                            id='$this->id'
                        LIMIT 1
        ";
        return parent::one($_sql);
    }


    //查询所有等级
    public function getAllVote()
    {
        $_sql = "SELECT 
                        id,
                        title,
                        info,
                        state
                   FROM
                        cms_vote
                  WHERE
                        vid=0
               ORDER BY
                        date DESC
            ";
        return parent::all($_sql);
    }


    //查询所有子项目
    public function getAllChildVote()
    {
        $_sql = "SELECT
                        *
                   FROM
                        cms_vote
                  WHERE
                        vid='$this->vid'
               ORDER BY
                        date DESC
            ";
        return parent::all($_sql);
    }


    //新增投票
    public function addVote()
    {
        $_sql = "INSERT INTO 
                            cms_vote(
                                      title,
                                      info,
                                      date
                                       )
                              VALUES(
                                      '$this->title',
                                      '$this->info',
                                        NOW()
                                       )
            ";
        return parent::adu($_sql);
    }

    //新增投票子栏
    public function addVoteChild()
    {
        $_sql = "INSERT INTO 
                            cms_vote(
                                      title,
                                      info,
                                      vid,
                                      date
                                       )
                              VALUES(
                                      '$this->title',
                                      '$this->info',
                                      '$this->vid',
                                        NOW()
                                       )
            ";
        return parent::adu($_sql);
    }

    //修改等级
    public function updateVote()
    {
        $_sql = "UPDATE cms_vote SET 
                                        title='$this->title',
                                        info='$this->info'
                                 WHERE 
                                        id='$this->id' 
                                    LIMIT 1";
        return parent::adu($_sql);
    }


    //删除等级
    public function delVote()
    {
        $_sql = "DELETE FROM cms_vote WHERE id='$this->id' LIMIT 1";
        return parent::adu($_sql);
    }

}



