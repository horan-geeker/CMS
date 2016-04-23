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
        $this->login();
        $this->latestUser();
    }
    
    
    //最近登录的会员
    private function latestUser(){
        $_user = new UserModel();
        $this->_tpl->assign('ALLLaterUser',$_user->getLatestUser());
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
}



