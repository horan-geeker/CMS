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
class UserAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl,new UserModel());
    }


    //业务流程控制器
    public function _action(){
        if(isset($_GET['action'])){
            switch ($_GET['action']){
                case 'show':
                    $this->show();
                    break;
                case 'add':
                    $this->add();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'delete':
                    $this->del();
                    break;
                default:
                    Tool::alertBack('非法操作');
            }
        }else{
            Tool::alertBack('非法操作');
        }
    }


    private function show() {
        parent::page($this->_model->getUserTotal());
        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '会员列表');
        $_object = $this->_model->getAllUser();
        foreach ($_object as $_value){
            switch ($_value->state){
                case 0:
                    $_value->state = '封杀的会员';
                    break;
                case 1:
                    $_value->state = '待审核的会员';
                    break;
                case 2:
                    $_value->state = '初级会员';
                    break;
                case 3:
                    $_value->state = '中级会员';
                    break;
                case 4:
                    $_value->state = '高级会员';
                    break;
                case 5:
                    $_value->state = 'VIP会员';
                    break;
            }
        }
        $this->_tpl->assign('allUser', $_object);

    }


    private function add() {
        if(isset($_POST['send'])){
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
            if(Validate::checkEquals($_POST['admin_pass'], $_POST['admin_repass'])){
                Tool::alertBack('两次输入的密码不一致！');
            }
            $this->_model->admin_user = $_POST['admin_user'];
            if($this->_model->getOneManage()){
                Tool::alertBack('此用户名已经被使用');
            }
            $this->_model->admin_pass = sha1($_POST['admin_pass']);
            $this->_model->level = $_POST['level'];
            $this->_model->addManage()?Tool::alertLocation('新增成功', 'manage.php?action=show'):Tool::alertBack('新增失败!');
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增会员');
        $this->_tpl->assign('allLevel',$this->_model->getAllLevel());
    }


    private function update() {
        if(isset($_POST['send'])){
            $this->_model->id=$_POST['id'];
            if(trim($_POST['pass']) != ''){
                if(Validate::checkLength($_POST['pass'], 6,'min'))Tool::alertBack('密码不得小于6位');
                $this->_model->pass=sha1($_POST['pass']);
            }else{
                $_user = $this->_model->getOneUser();
                $this->_model->pass = $_user->pass;
            }
            $this->_model->email=$_POST['email'];
            $this->_model->state=$_POST['level'];
            $this->_model->face=$_POST['face'];
            $this->_model->question=$_POST['question'];
            $this->_model->answer=$_POST['answer'];
            $this->_model->updateUser()?Tool::alertLocation(null, 'user.php?action=show'):Tool::alertBack('修改失败');
        }
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $_user = $this->_model->getOneUser();
            is_object($_user)?true:Tool::alertBack('您查询的id有误！');
        }else{
            Tool::alertBack('非法操作');
        }
        $this->_tpl->assign('prev_url',PREV_URL);
        $this->_tpl->assign('id', $_user->id);
        $this->_tpl->assign('username', $_user->user);
        $this->_tpl->assign('email', $_user->email);
        $this->_tpl->assign('facesrc', $_user->face);
        $this->_tpl->assign('face', $this->face($_user->face));
        $this->_tpl->assign('level', $_user->state);
        $this->_tpl->assign('question', $this->question($_user->question));
        $this->_tpl->assign('answer', $_user->answer);
        $this->_tpl->assign('update', true);
        $this->_tpl->assign('title', '修改会员');
    }


    private function del() {
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $this->_model->delUser()?Tool::alertLocation(null, PREV_URL):Tool::alertBack('删除失败');
        }else{
            Tool::alertBack('非法操作');
        }
    }


    private function face($_face){
        for($i=1;$i<=24;$i++){
            if($i<10)$i='0'.$i;
            if($_face==$i.'.gif'){
                $_html .= '<option value="'.$i.'.gif" selected="selected" name="face">'.$i.'.gif</option>';
            }else{
                $_html .= '<option value="'.$i.'.gif" name="face">'.$i.'.gif</option>';
            }
        }
        return $_html;
    }


    private function question($_question){
        if($_question == '您父亲的姓名'){
            $_html = '<option value="">没有任何安全问题</option>';
            $_html .= '<option selected="selected">您父亲的姓名</option>';
            $_html .= '<option>您母亲的职业</option>';
            $_html .= '<option>您配偶的出生地</option>';
        }
        elseif($_question == '您母亲的职业'){
            $_html = '<option value="">没有任何安全问题</option>';
            $_html .= '<option>您父亲的姓名</option>';
            $_html .= '<option selected="selected">您母亲的职业</option>';
            $_html .= '<option>您配偶的出生地</option>';
        }
        elseif($_question == '您配偶的出生地'){
            $_html = '<option value="">没有任何安全问题</option>';
            $_html .= '<option>您父亲的姓名</option>';
            $_html .= '<option>您母亲的职业</option>';
            $_html .= '<option selected="selected">您配偶的出生地</option>';
        }else{
            $_html = '<option value="">没有任何安全问题</option>';
            $_html .= '<option>您父亲的姓名</option>';
            $_html .= '<option>您母亲的职业</option>';
            $_html .= '<option>您配偶的出生地</option>';
        }
        return $_html;
    }
    
}



