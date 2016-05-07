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
class DetailAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
    }

    
    //执行方法
    public function _action(){
        $this->getDetail();
    }
    
    
    //获取文档详细内容
    public function getDetail() {
        if (isset($_GET['id'])){
            parent::__construct($this->_tpl,new ContentModel());
            $this->_model->id = $_GET['id'];
            $_content = $this->_model->getOneContent();
            if(!$_content)Tool::alertBack('警告！不存在此文章');
            $this->_tpl->assign('id',$_content->id);
            $this->_tpl->assign('content_title',$_content->title);
            $this->_tpl->assign('author',$_content->author);
            $this->_tpl->assign('source',$_content->source);
            $this->_tpl->assign('date',$_content->date);
            $this->_tpl->assign('info',$_content->info);
            $this->_tpl->assign('tag',$_content->tag);
            $this->_tpl->assign('content',Tool::unHtmlString($_content->content));
            $this->getNav($_content->nav);
            if(IS_CACHE){
                $this->_tpl->assign('count','<script type="text/javascript">getContentCount();</script>');
                $this->_tpl->assign('commentCount','<script type="text/javascript">getCommentCount();</script>');
            }else{
                $this->_model->countContent();
                $this->_tpl->assign('count',$this->_model->getOneContent()->count);
                $comment = new CommentModel();
                $comment->cid = $_GET['id'];
                $this->_tpl->assign('commentCount',$comment->getCommentTotal());
            }
        }else{
            Tool::alertBack('非法操作');
        }
    }
    
    
    //获取前台显示的导航
    private function getNav($_id) {
            $_nav = new NavModel();
            $_nav->id = $_id;
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
        return ;
    }
}



