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
class CommentAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl,new CommentModel);
    }
    
    
    public function _action(){
        //业务流程控制器
        if(isset($_GET['action'])){
            switch ($_GET['action']){
                case 'comment':
                    $this->addComment();
                    break;
                case 'show':
                    $this->showComment();
                    break;
            }
        }
    }
    
    
    private function addComment() {
        if(isset($_POST['send'])){
            if(isset($_COOKIE['user'])){
                $this->_model->user = $_COOKIE['user'];
            }else{
                $this->_model->user = '游客';
            }
            $this->_model->manner = $_POST['manner'];
            if(Validate::checkNull($_POST['content']))Tool::alertBack('内容不得为空');
            if(Validate::checkLength($_POST['content'],255,'max'))Tool::alertBack('内容过长，超过255个字符');
            if(Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['checkcode'])){
                Tool::alertBack('验证码不正确');
            }
            $this->_model->content = $_POST['content'];
            $this->_model->cid = $_GET['cid'];
            $this->_model->addComment()?Tool::alertLocation('评论成功','comment.php?action=show&cid='.$this->_model->cid):Tool::alertLocation('评论失败','comment.php?cid='.$this->_model->cid);
        }
    }


    private function showComment(){
        if(isset($_GET['cid'])){
            $this->_model->cid = $_GET['cid'];
            parent::page($this->_model->getCommentTotal());
            $object = $this->_model->getComment();
            foreach ($object as $value){
                switch ($value->manner){
                    case -1:
                        $value->manner = '反对';
                        break;
                    case 0:
                        $value->manner = '中立';
                        break;
                    case 1:
                        $value->manner = '支持';
                        break;
                }
                if(empty($value->face)){
                    $value->face = '00.gif';
                }
            }
            $this->_tpl->assign('cid',$this->_model->cid);
            $this->_tpl->assign('AllComment',$object);
        }else{
            Tool::alertBack('非法操作');
        }
    }
}



