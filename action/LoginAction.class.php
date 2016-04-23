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
class LoginAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new ManageModel());
    }
    
    
    public function action(){
        //业务流程控制器
        switch ($_GET['action']){
            case 'login':
                $this->login();
                break;
            case 'logout':
                Validate::checkSession();
                $this->logout();
                break;
        }
    }
    
    
    private function login(){
        if(isset($_POST['send'])){
            //验证码验证
            if(Validate::checkLength($_POST['checkcode'], 4, 'equals')){
                Tool::alertBack('验证码必须是四位');
            }
            if(Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['checkcode'])){
                Tool::alertBack('验证码不正确');
            }
            if(Validate::checkNull($_POST['admin_user'])){
                Tool::alertBack('用户名不得为空');
            }
            if(Validate::checkLength($_POST['admin_user'], 2,'min')){
                Tool::alertBack('用户名不得小于2位');
            }
            if(Validate::checkLength($_POST['admin_user'], 20,'max')){
                Tool::alertBack('用户名不得大于20位');
            }
            if(Validate::checkNull($_POST['admin_pass'])){
                Tool::alertBack('密码不得为空');
            }
            if(Validate::checkLength($_POST['admin_pass'], 6,'min')){
                Tool::alertBack('密码不得小于6位');
            }
            
            $this->_model->admin_user=$_POST['admin_user'];
            $this->_model->admin_pass=sha1($_POST['admin_pass']);
            if(!!$_login = $this->_model->getLoginManage()){
                $_SESSION['admin']['admin_user'] = $_login->admin_user;
                $_SESSION['admin']['admin_level'] = $_login->level_name;
                //记录登录数据
                $this->_model->setLoginData();
                Tool::alertLocation('','admin.php');
            }else{
                Tool::alertBack('用户名密码错误');
            }
        }
    }
    
    
    
    private function logout(){
        Tool::unSession();
        Tool::alertLocation(null, 'admin_login.php');
    }
    
}