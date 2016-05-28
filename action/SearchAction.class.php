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
class SearchAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new SearchModel());
    }
    
    
    public function action(){
        //业务流程控制器
        if(isset($_GET['type'])){
            if(empty($_GET['q'])){
                Tool::alertBack('搜索关键字不得为空');
            }
            switch ($_GET['type']){
                case '1':
                    $this->searchTitle();
                    break;
                case '2':
                    $this->keyword();
                    break;
                case '3':
                    $this->tag();
                    break;
                default:
                    Tool::alertBack('非法操作');
            }
        }else{
            Tool::alertBack('非法操作');
        }
    }
    
    
    private function searchTitle() {
        parent::page($this->_model->searchTitleContentTotal());
        $this->_model->q = $_GET['q'];
        $search = $this->_model->searchTitleContent();
        foreach ($search as $value){
            $value->title = str_replace($_GET['q'],'<span style="color:red">'.$_GET['q'].'</span>',$value->title);
        }
        $this->_tpl->assign('searchContent', $search);
    }
    
    
    private function keyword() {
        parent::page($this->_model->searchKeywordContentTotal());
        $this->_model->q = $_GET['q'];
        $search = $this->_model->searchKeywordContent();
        foreach ($search as $value){
            $value->title = str_replace($_GET['q'],'<span style="color:red">'.$_GET['q'].'</span>',$value->title);
        }
        $this->_tpl->assign('searchContent', $search);
    }
    
    
    private function tag() {
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



