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
class UserModel extends Model{
    
    private $id;
    private $user;
    private $pass;
    private $email;
    private $face;
    private $question;
    private $answer;
    private $state;
    private $time;
    private $limit;
   
    public function __set($_key,$_value){
        $this->$_key = Tool::sqlString($_value);
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    

    //新增会员（会员注册）
    public function addUser(){
        $_sql = "INSERT INTO
                     cms_user(
                            user,
                            pass,
                            email,
                            face,
                            question,
                            answer,
                            state,
                            time,
                            date
                            )
                        VALUES(
                            '$this->user',
                            '$this->pass',
                            '$this->email',
                            '$this->face',
                            '$this->question',
                            '$this->answer',
                            '$this->state',
                            '$this->time',
                            NOW()
                            )
        ";
        return parent::adu($_sql);
    }
    
    //登录验证
    public function checkLogin(){
        $_sql = "SELECT
                        id,
                        user,
                        pass,
                        face
                   FROM
                        cms_user
                  WHERE
                        user='$this->user'
                    AND
                        pass='$this->pass'
                  LIMIT 
                        1
        ";
        return parent::one($_sql);
    }
    
    
    //获取6条最近登录的会员
    public function getLatestUser(){
        $_sql = "SELECT
                        user,
                        face
                FROM
                        cms_user
            ORDER BY
                        time DESC
                LIMIT
                        0,6
        ";
        return parent::all($_sql);
    }
    
    
    //注册和登录时，更新最近的时间戳
    public function setLaterTime(){
        $_sql = "UPDATE cms_user SET
                                    time='$this->time'
                              WHERE
                                    id='$this->id'
                              LIMIT 1
        ";
        return parent::adu($_sql);
    }
    
    
    public function checkUser(){
        $_sql = "SELECT
                        id
                    FROM
                        cms_user
                    WHERE
                        user='$this->user'
                    LIMIT 1
        ";
        return parent::one($_sql);
    }
    
    
    //
    public function checkEmail(){
        $_sql = "SELECT
                        id
                   FROM
                        cms_user
                  WHERE
                        email='$this->email'
                  LIMIT 1
        ";
        return parent::one($_sql);
    }
    
    
    //前台显示所有用户带limit
    public function getAllUser(){
        $_sql = "SELECT
                        id,
                        user,
                        email,
                        state
                    FROM
                        cms_user
                    ORDER BY
                        date DESC 
                    $this->limit
        ";
        return parent::all($_sql);
    }
    
    
    //获取用户总记录
    public function getUserTotal(){
        $_sql = "SELECT count(*) FROM cms_user";
        return parent::total($_sql);
    }
    
    

    
    //查询单个会员
    public function getOneUser(){
        $_sql = "SELECT 
                        id,
                        user,
                        pass,
                        email,
                        face,
                        question,
                        answer,
                        state
                   FROM
                        cms_user
                  WHERE
                        id='$this->id'
                  LIMIT 1
        ";
        return parent::one($_sql);
    }
    
    
    //修改导航
    public function updateUser() {
        $_sql = "UPDATE cms_user SET
                                    pass='$this->pass',
                                    email='$this->email',
                                    face='$this->face',
                                    question='$this->question',
                                    answer='$this->answer',
                                    state='$this->state'
                              WHERE
                                    id='$this->id'
                                    LIMIT 1
        ";
        return parent::adu($_sql);
    }
    

    //删除导航
    public function delUser() {
        $_sql = "DELETE FROM cms_user WHERE id='$this->id' LIMIT 1";
        return parent::adu($_sql);
    }
}



