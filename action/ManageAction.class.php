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
class ManageAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new ManageModel());
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
        parent::page($this->_model->getManageTotal());
        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '管理员列表');
        $this->_tpl->assign('allManage', $this->_model->getManage());
        
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
        $this->_tpl->assign('title', '新增管理员');
        $this->_tpl->assign('allLevel',$this->_model->getAllLevel());
    }
    
    
    private function update() {
        if(isset($_POST['send'])){
            if(trim($_POST['admin_pass']) == ''){
                $this->_model->admin_pass = $_POST['pass'];
            }else{
                if(Validate::checkLength($_POST['admin_pass'], 6,'min')){
                    Tool::alertBack('密码不得小于6位');
                }
                $this->_model->admin_pass=sha1($_POST['admin_pass']);
            }
            $this->_model->id=$_POST['id'];
            $this->_model->level=$_POST['level'];
            $this->_model->updateManage()?Tool::alertLocation('修改成功', $_POST['prev_url']):Tool::alertBack('修改失败');
        }
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $_manage = $this->_model->getOneLevel();
            is_object($_manage)?true:Tool::alertBack('您查询的id有误！');
        }else{
            Tool::alertBack('非法操作');
        }
        $this->_tpl->assign('prev_url',PREV_URL);
        $this->_tpl->assign('admin_user',$_manage->admin_user);
        $this->_tpl->assign('id', $_manage->id);
        $this->_tpl->assign('level', $_manage->level);
        $this->_tpl->assign('pass', $_manage->admin_pass);
        $this->_tpl->assign('update', true);
        $this->_tpl->assign('title', '修改管理员');
        $this->_tpl->assign('allLevel',$this->_model->getAllLevel());
    }
    
    
    private function del() {
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $this->_model->delManage()?Tool::alertLocation('删除成功', PREV_URL):Tool::alertBack('删除失败');
        }else{
            Tool::alertBack('非法操作');
        }
        $this->_tpl->assign('delete', true);
        $this->_tpl->assign('title', '删除管理员');
    }
}



