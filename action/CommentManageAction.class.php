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
class CommentManageAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl,new CommentManageModel);
    }
    
    
    public function _action(){
        //业务流程控制器
        if(isset($_GET['action'])){
            switch ($_GET['action']){
                case 'show':
                    $this->show();
                    break;
                case 'pass':
                    $this->pass();
                    break;
                case 'cancel':
                    $this->cancel();
                    break;
                case 'passall':
                    $this->passAll();
                    break;
                case 'delete':
                    $this->delete();
                    break;
            }
        }
    }

    public function show(){
        parent::page($this->_model->getCommentTotal());
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','评论列表');
        $object = $this->_model->getAdminComment();
        foreach($object as $value){
            if($value->state==0){
                $value->state = '未审核 | <a href="comment.php?action=pass&id='.$value->id.'">通过</a>';
            }else{
                $value->state = '已审核 | <a href="comment.php?action=cancel&id='.$value->id.'" class="red">取消</a>';
            }
            Tool::subStr($object,'content',20,'utf-8');
        }
        $this->_tpl->assign('AllComment',$object);
    }

    public function pass(){
        if(!isset($_GET['id'])){
            return Tool::alertBack('非法操作');
        }
        $this->_model->id = $_GET['id'];
        $this->_model->setPass();
        return Tool::alertLocation(null,PREV_URL);
    }

    public function cancel(){
        if(!isset($_GET['id'])){
            return Tool::alertBack('非法操作');
        }
        $this->_model->id = $_GET['id'];
        $this->_model->cancelPass();
        return Tool::alertLocation(null,PREV_URL);
    }

    public function passAll(){
        if(!isset($_POST['send'])){
            return Tool::alertBack('非法操作');
        }
        foreach ($_POST['checkbox'] as $key=>$value){
            $this->_model->id = $key;
            $this->_model->setPass();
        }
        return Tool::alertLocation(null,PREV_URL);
    }
    
    public function delete(){
        if(!isset($_GET['id'])){
            return Tool::alertBack('非法操作');
        }
        $this->_model->id = $_GET['id'];
        $this->_model->delete();
        return Tool::alertLocation(null,PREV_URL);
    }
}



