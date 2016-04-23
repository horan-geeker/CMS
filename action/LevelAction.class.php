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
class LevelAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new LevelModel());
    }
    
    
    public function action(){
        //业务流程控制器
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
        parent::page($this->_model->getLevelTotal());
        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '等级列表');
        $this->_tpl->assign('allLevel', $this->_model->getAllLevelLimit());
    }
    
    
    private function add() {
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['level_name'])){
                Tool::alertBack('等级名称不得为空');
            }
            if(Validate::checkLength($_POST['level_name'], 2,'min')){
                Tool::alertBack('等级名称不得小于2位');
            }
            if(Validate::checkLength($_POST['level_name'], 20,'max')){
                Tool::alertBack('等级名称不得大于20位');
            }
            if(Validate::checkLength($_POST['level_info'], 200,'max')){
                Tool::alertBack('等级描述不得大于200位');
            }
            $this->_model->level_name = $_POST['level_name'];
            if($this->_model->getOneLevel()){
                Tool::alertBack('此等级名已经被使用');
            }
            $this->_model->level_info = $_POST['level_info'];
            $this->_model->addLevel()?Tool::alertLocation('新增成功', 'level.php?action=show'):Tool::alertBack('新增失败!');
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增等级');
    }
    
    
    private function update() {
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['level_name'])){
                Tool::alertBack('等级名称不得为空');
            }
            if(Validate::checkLength($_POST['level_name'], 2,'min')){
                Tool::alertBack('等级名称不得小于2位');
            }
            if(Validate::checkLength($_POST['level_name'], 20,'max')){
                Tool::alertBack('等级名称不得大于20位');
            }
            if(Validate::checkLength($_POST['level_info'], 200,'max')){
                Tool::alertBack('等级描述不得大于200位');
            }
            $this->_model->id = $_POST['id'];
            $this->_model->level_name = $_POST['level_name'];
            $this->_model->level_info = $_POST['level_info'];
            $this->_model->updateLevel()?Tool::alertLocation('修改成功', $_POST['prev_url']):Tool::alertBack('修改失败');
        }
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $_level = $this->_model->getOneLevel();
            is_object($_level)?true:Tool::alertBack('您查询的id有误！');
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('id', $_level->id);
            $this->_tpl->assign('level_name',$_level->level_name);
            $this->_tpl->assign('level_info', $_level->level_info);
            $this->_tpl->assign('update', true);
            $this->_tpl->assign('title', '修改等级');
        }else{
            Tool::alertBack('非法操作');
        }
    }
    
    
    private function del() {
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $this->_model->delLevel()?Tool::alertLocation('删除成功', PREV_URL):Tool::alertBack('删除失败');
        }else{
            Tool::alertBack('非法操作');
        }
        $this->_tpl->assign('delete', true);
        $this->_tpl->assign('title', '删除管理员');
    }
}



