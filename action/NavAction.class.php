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
class NavAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new NavModel());
    }
    
    
    public function action(){
        //业务流程控制器
        if(isset($_GET['action'])){
            switch ($_GET['action']){
                case 'show':
                    $this->show();
                    break;
                case 'showchild':
                    $this->showchild();
                    break;
                case 'sort':
                    $this->sort();
                    break;
                case 'addchild':
                    $this->addchild();
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
        parent::page($this->_model->getNavTotal());
        $this->_tpl->assign('show', true);
        $this->_tpl->assign('title', '导航列表');
        $this->_tpl->assign('allNav', $this->_model->getAllNav());
    }
    
    
    private function showchild() {
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            parent::page($this->_model->getChildNavTotal());
            $this->_tpl->assign('id',$this->_model->id);
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('prev_name',$_nav->nav_name);
            $this->_tpl->assign('showchild', true);
            $this->_tpl->assign('title', '子导航列表');
            $this->_tpl->assign('allChildNav', $this->_model->getChildNav());
        }
    }
    
    
    public function showNavFront(){
        $this->_tpl->assign('FrontNav',$this->_model->getFrontNav());
    }
    
    
    public function sort(){
        if(isset($_POST['send'])){
            $this->_model->sort = $_POST['sort'];
            if($this->_model->setNavSort())Tool::alertLocation(null, PREV_URL);
        }
    }
    
    
    private function addchild() {
        if(isset($_POST['send'])){
            $this->_model->pid=$_POST['id'];
            $this->add();
        }
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav)?true:Tool::alertBack('您查询的id有误！');
            $this->_tpl->assign('pid',$_nav->id);
            $this->_tpl->assign('id',$_nav->id);
            $this->_tpl->assign('addchild', true);
            $this->_tpl->assign('title', '增加子类导航');
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('prev_name',$_nav->nav_name);
            $this->_tpl->assign('allNav', $this->_model->getAllNav());
        }
    }
    
    
    private function add() {
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['nav_name'])){
                Tool::alertBack('导航名称不得为空');
            }
            if(Validate::checkLength($_POST['nav_name'], 2,'min')){
                Tool::alertBack('导航名称不得小于2位');
            }
            if(Validate::checkLength($_POST['nav_name'], 20,'max')){
                Tool::alertBack('导航名称不得大于20位');
            }
            if(Validate::checkLength($_POST['nav_info'], 200,'max')){
                Tool::alertBack('导航描述不得大于200位');
            }
            $this->_model->nav_name = $_POST['nav_name'];
            
            if($this->_model->pid){
                $returnUrl = "nav.php?action=showchild&id=".$this->_model->pid;
            }else{
                $returnUrl = "nav.php?action=show";
            }
            
            if($this->_model->getOneNav()){
                Tool::alertBack('此导航名已经被使用');
            }
            $this->_model->nav_info = $_POST['nav_info'];
            $this->_model->addNav()?Tool::alertLocation('新增成功', $returnUrl):Tool::alertBack('新增失败!');
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增导航');
        $this->_tpl->assign('prev_url',PREV_URL);
    }
    
    
    private function update() {
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['nav_name'])){
                Tool::alertBack('导航名称不得为空');
            }
            if(Validate::checkLength($_POST['nav_name'], 2,'min')){
                Tool::alertBack('导航名称不得小于2位');
            }
            if(Validate::checkLength($_POST['nav_name'], 20,'max')){
                Tool::alertBack('导航名称不得大于20位');
            }
            if(Validate::checkLength($_POST['nav_info'], 200,'max')){
                Tool::alertBack('导航描述不得大于200位');
            }
            $this->_model->id = $_POST['id'];
            $this->_model->nav_name = $_POST['nav_name'];
            $this->_model->nav_info = $_POST['nav_info'];
            $this->_model->updateNav()?Tool::alertLocation('修改成功', $_POST['prev_url']):Tool::alertBack('修改失败');
        }
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $_nav = $this->_model->getOneNav();
            is_object($_nav)?true:Tool::alertBack('您查询的id有误！');
            $this->_tpl->assign('prev_url',PREV_URL);
            $this->_tpl->assign('id', $_nav->id);
            $this->_tpl->assign('nav_name',$_nav->nav_name);
            $this->_tpl->assign('nav_info', $_nav->nav_info);
            $this->_tpl->assign('update', true);
            $this->_tpl->assign('title', '修改导航');
        }else{
            Tool::alertBack('非法操作');
        }
    }
    
    
    private function del() {
        if(isset($_GET['id'])){
            $this->_model->id=$_GET['id'];
            $this->_model->delNav()?Tool::alertLocation('删除成功', PREV_URL):Tool::alertBack('删除失败');
        }else{
            Tool::alertBack('非法操作');
        }
    }
}



