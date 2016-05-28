<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月24日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class IndexAction extends Action{
    
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
    }

    
    //执行方法
    public function _action(){
        if(isset($_POST['send'])){
            $this->postVote();
        }
        $this->login();
        $this->latestUser();
        $this->showList();
    }
    
    
    //最近登录的会员
    private function latestUser(){
        $_user = new UserModel();
        $this->_tpl->assign('ALLLaterUser',$_user->getLatestUser());
    }


    //显示首页所有的文档列表
    private function showList(){
        parent::__construct($this->_tpl,new ContentModel());
        //获取最新的一条头条
        $object = $this->_model->getOneTop();
        Tool::formatDate($object);
        $this->_tpl->assign('NewTopTitle',$object->title);
        $this->_tpl->assign('NewTopInfo',$object->info);
        $this->_tpl->assign('NewTopId',$object->id);
        //获取最新的其他几条
        $object = $this->_model->getOtherTop();
        Tool::formatDate($object);
        $this->_tpl->assign('OtherNewTop',$object);
        //最新的8条
        $object = $this->_model->getNewList();
        Tool::formatDate($object);
        $this->_tpl->assign('NewList',$object);
        //推荐
        $object = $this->_model->getNewRecList();
        Tool::formatDate($object);
        $this->_tpl->assign('getNewRecList',$object);
        //点击量
        $object = $this->_model->getMonthHotList();
        Tool::formatDate($object);
        $this->_tpl->assign('getMonthHotList',$object);
        //评论量
        $object = $this->_model->getMonthHotComment();
        Tool::formatDate($object);
        $this->_tpl->assign('getMonthHotComment',$object);
        //图文
        $object = $this->_model->getPicList();
        $this->_tpl->assign('getPicList',$object);

        //中间的四快内容
        $nav = new NavModel();
        $object = $nav->getFourNav();
        $content = new ContentModel();
        $i=1;
        foreach ($object as $value){
            switch ($i){
                case 1:
                    $value->class = 'list top';
                    break;
                case 2:
                    $value->class = 'list right top';
                    break;
                case 3:
                    $value->class = 'list';
                    break;
                case 4:
                    $value->class = 'list right';
                    break;
            }
            $i++;
            $this->_model->nav = $value->id;
            $navContent = $this->_model->getNavContent();
            $value->list = $navContent;
        }
        $this->_tpl->assign('FourNav',$object);
        $this->getVote();
    }


    private function login() {
        if($_COOKIE['user']){
            $this->_tpl->assign('login',false);
            $this->_tpl->assign('userName',Tool::subStr($_COOKIE['user'], null, 8, 'utf-8'));
            $this->_tpl->assign('userFace',$_COOKIE['face']);
        }else{
            $this->_tpl->assign('login',true);
        }
        if(IS_CACHE){
            $this->_tpl->assign('cache',true);
            $this->_tpl->assign('member','<script type="text/javascript">getLogin();</script>');
        }
    }

    private function getVote(){
        $vote = new VoteModel();
        $frontVote = $vote->getOneFrontVote();
        $this->_tpl->assign('frontVoteTitle',$frontVote->title);
        $vote->vid = $frontVote->id;
        $this->_tpl->assign('frontVoteItems',$vote->getAllChildVote());
    }

    private function postVote(){
        $vote = new VoteModel();
        $vote->id = $_POST['vote'];
        $vote->setVoteCount();
    }
}



