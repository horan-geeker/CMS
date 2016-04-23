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
class RegisterAction extends Action{
    
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
    }

    
    //执行方法
    public function _action(){
        switch ($_GET['action']){
            case 'reg':
                $this->reg();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                Tool::alertBack('非法操作');
        }
    }
    
    
    private function reg(){
        if(isset($_POST['send'])){
            //验证码验证
            if(Validate::checkLength($_POST['checkcode'], 4, 'equals')){
                Tool::alertBack('验证码必须是四位');
            }
            if(Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['checkcode'])){
                Tool::alertBack('验证码不正确');
            }
            if(Validate::checkNull($_POST['user'])){
                Tool::alertBack('用户名不得为空');
            }
            if(Validate::checkLength($_POST['user'], 2,'min')){
                Tool::alertBack('用户名不得小于2位');
            }
            if(Validate::checkLength($_POST['user'], 20,'max')){
                Tool::alertBack('用户名不得大于20位');
            }
            if(Validate::checkNull($_POST['pass'])){
                Tool::alertBack('密码不得为空');
            }
            if(Validate::checkLength($_POST['pass'], 6,'min')){
                Tool::alertBack('密码不得小于6位');
            }
            if(Validate::checkEquals($_POST['pass'], $_POST['repass'])){
                Tool::alertBack('确认密码不一致');
            }
            if(Validate::checkNull($_POST['email'])){
                Tool::alertBack('电子邮件不得为空');
            }
            if(Validate::checkEmail($_POST['email'])){
                Tool::alertBack('电子邮件格式不正确');
            }
            if(Validate::checkNull($_POST['question'])){
        
            }
            parent::__construct($this->_tpl,new UserModel());
            $this->_model->user = $_POST['user'];
            $this->_model->pass = sha1($_POST['pass']);
            $this->_model->email = $_POST['email'];
            $this->_model->face = $_POST['face'];
            $this->_model->state = 1;
            if($this->_model->checkUser())Tool::alertBack('用户名已存在');
            if($this->_model->checkEmail())Tool::alertBack('邮件已存在');
            if(Validate::checkNull($_POST['question']) || Validate::checkNull($_POST['answer'])){
                $this->_model->question = '';
                $this->_model->answer = '';
            }else{
                $this->_model->question = $_POST['question'];
                $this->_model->answer = $_POST['answer'];
            }
            $this->_model->time = time();
            if($this->_model->addUser()){
                setcookie('user',$this->_model->user,0);
                setcookie('face',$this->_model->face,0);
                Tool::alertLocation('恭喜你注册成功', './');
            }else{
                Tool::alertBack('注册失败');
            }
        }
        $this->_tpl->assign('reg',true);
        $this->_tpl->assign('optionFaceOne',range(1,9));
        $this->_tpl->assign('optionFaceTwo',range(10,24));
    }
    
    
    private function login(){
        parent::__construct($this->_tpl,new UserModel());
        if(isset($_POST['send'])){
            //验证码验证
            if(Validate::checkLength($_POST['checkcode'], 4, 'equals')){
                Tool::alertBack('验证码必须是四位');
            }
            if(Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['checkcode'])){
                Tool::alertBack('验证码不正确');
            }
            if(Validate::checkNull($_POST['user'])){
                Tool::alertBack('用户名不得为空');
            }
            if(Validate::checkLength($_POST['user'], 2,'min')){
                Tool::alertBack('用户名不得小于2位');
            }
            if(Validate::checkLength($_POST['user'], 20,'max')){
                Tool::alertBack('用户名不得大于20位');
            }
            if(Validate::checkNull($_POST['pass'])){
                Tool::alertBack('密码不得为空');
            }
            if(Validate::checkLength($_POST['pass'], 6,'min')){
                Tool::alertBack('密码不得小于6位');
            }
            $this->_model->user = $_POST['user'];
            $this->_model->pass = sha1($_POST['pass']);
            if(!!$_user = $this->_model->checkLogin()){
                if($_POST['remember']){
                    setcookie('user',$_user->user,time()+2600000);
                    setcookie('face',$_user->face,time()+2600000);
                }else{
                    setcookie('user',$_user->user,0);
                    setcookie('face',$_user->face,0);
                }
                $this->_model->id = $_user->id;
                $this->_model->time = time();
                $this->_model->setLaterTime();
                Tool::alertLocation(null, 'index.php');
            }else{
                Tool::alertBack('用户名密码错误');
            }
        }
        $this->_tpl->assign('login',true);
    }
    
    
    private function logout() {
        setcookie('user','');
        setcookie('face','');
        Tool::alertLocation(null, 'register.php?action=login');
    }
}



