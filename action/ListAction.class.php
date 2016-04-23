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
class ListAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
    }

    
    //执行方法
    public function _action(){
        $this->getNav();
        $this->getListContent();
    }
    
    
    //获取前台列表显示
    private function getListContent(){
        if(isset($_GET['id'])){
            parent::__construct($this->_tpl,new ContentModel());
            
            $_nav = new NavModel();
            $_nav->id = $_GET['id'];
            $_pid = $_nav->getNavChildpid();
            if($_pid){
                $this->_model->nav = Tool::ArrToStr($_pid, 'id');
            }else{
                $this->_model->nav = $_nav->id;
            }
            parent::page($this->_model->getContentTotal(),ARTICLE_SIZE);
            $_object = $this->_model->getListContent();
            
            //对简介的缩略
            if($_object){
                $_object = Tool::subStr($_object, 'info', 120, 'utf-8');
                $_object = Tool::subStr($_object, 'title', 30, 'utf-8');
                if(IS_CACHE){
                    foreach ($_object as $_value){
                        $_value->count = '<script type="text/javascript"">getContentCount();</script>';
                    }
                }
            }
            $this->_tpl->assign('allListContent',$_object);
            
        }else{
            Tool::alertBack('警告！非法操作');
        }
    }
    
    
    //获取前台显示的导航
    private function getNav() {
        if(isset($_GET['id'])){
            $_nav = new NavModel();
            $_nav->id = $_GET['id'];
            if(!!$_navInfo = $_nav->getOneNav()){
                if(empty($_navInfo->p_id)){
                    //主导航id，name
                    $_navMain = "<a href='list.php?id=".$_navInfo->id."'>".$_navInfo->nav_name."</a>";
                }else{
                    $_navMain = "<a href='list.php?id=".$_navInfo->p_id."'>".$_navInfo->p_nav_name."</a>"
                                ." > <a href='list.php?id=".$_navInfo->id."'>".$_navInfo->nav_name."</a>";
                }
                $this->_tpl->assign('navMain',$_navMain);
                //子导航集
                $this->_tpl->assign('childNav',$_nav->getAllChildNav());
            }
        }else{
            Tool::alertBack('非法操作');
        }
        return ;
    }
}



