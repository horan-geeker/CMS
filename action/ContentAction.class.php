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
class ContentAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new ContentModel());
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
    
    
    //getPost,对add和update的post处理
    private function getPost(){
            if(Validate::checkNull($_POST['title']))Tool::alertBack('警告！标题不能为空');
            if(Validate::checkLength($_POST['title'], 2, 'min'))Tool::alertBack('警告！标题长度不得小于两位');
            if(Validate::checkLength($_POST['title'], 50, 'max'))Tool::alertBack('警告！标题长度不得大于50位');
            if(Validate::checkNull($_POST['nav']))Tool::alertBack('警告！必须选择一个栏目');
            if(Validate::checkLength($_POST['tag'],30,'max'))Tool::alertBack('警告！tag标签不能大于30位');
            if(Validate::checkLength($_POST['keyword'],30,'max'))Tool::alertBack('警告！关键字不能大于30位');
            if(Validate::checkLength($_POST['source'],30,'max'))Tool::alertBack('警告！文章来源不能大于30位');
            if(Validate::checkLength($_POST['author'],10,'max'))Tool::alertBack('警告！作者不能大于10位');
            if(Validate::checkLength($_POST['info'],200,'max'))Tool::alertBack('警告！内容摘要不能大于200位');
            if(Validate::checkNull($_POST['content']))Tool::alertBack('警告！详细内容不得为空');
            if(Validate::checkNum($_POST['count']))Tool::alertBack('警告！浏览次数必须是数字');
            if(Validate::checkNum($_POST['gold']))Tool::alertBack('警告！消费金币必须是数字');
            $this->_model->title = $_POST['title'];
            $this->_model->nav = $_POST['nav'];
            $this->_model->tag = $_POST['tag'];
            if(isset($_POST['attr'])){
                $this->_model->attr = implode(',', $_POST['attr']);
            }else{
                $this->_model->attr = '无属性';
            }
            $this->_model->keyword = $_POST['keyword'];
            $this->_model->thumb = $_POST['thumb'];
            $this->_model->info = $_POST['info'];
            $this->_model->content = $_POST['content'];
            $this->_model->comment = $_POST['comment'];
            $this->_model->count = $_POST['count'];
            $this->_model->gold = $_POST['gold'];
            $this->_model->color = $_POST['color'];
            $this->_model->sort = $_POST['sort'];
            $this->_model->readlimit = $_POST['readlimit'];
            $this->_model->source = $_POST['source'];
            $this->_model->author = $_POST['author'];
    }
    
    
    private function show() {
        $this->_tpl->assign('show',true);
        $this->_tpl->assign('title','文档列表');
        $this->nav();
        
        $_nav = new NavModel();
        if(empty($_GET['nav'])){
            $_id = $_nav->getAllNavChildId();
            $this->_model->nav = Tool::ArrToStr($_id, 'id');
        }else{
            $_nav->id = $_GET['nav'];
            if(!$_nav->getOneNav())Tool::alertBack('警告！类别参数错误');
            $this->_model->nav = $_nav->id;
        }
        parent::page($this->_model->getContentTotal());
        $_object = $this->_model->getListContent();
        $_object = Tool::subStr($_object, 'title', 20, 'utf-8');
        
        $this->_tpl->assign('searchContent',$_object);
    }
    
    
    private function add() {
        if(isset($_POST['send'])){
            $this->getPost();
            if($this->_model->addContent()){
                Tool::alertLocation('文档发布成功', '?action=show');
            }else{
                Tool::alertBack('文档发布失败');
            }
        }
        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增文章');
        $this->nav();
        $this->_tpl->assign('author',$_SESSION['admin']['admin_user']);
    }
    
    
    //显示checkbox中attr列表
    private function attr($_attr){
        $_allAttr = array('头条','推荐','加粗','跳转');
        $_attr = str_replace('，', ',', $_attr);
        $_attrArr = explode(',', $_attr);
        foreach ($_attrArr as $_key=>$_value){
            if($_value != '无属性'){
                $_html .= '<input type="checkbox" checked="checked" name=attr[] value="'.$_value.'"/>'.$_value;
            }
        }
        foreach (array_diff($_allAttr, $_attrArr) as $_value){
            $_html .= '<input type="checkbox" name=attr[] value="'.$_value.'"/>'.$_value;
        }
        $this->_tpl->assign('attr',$_html);
    }
    
    
    //显示option中导航列表
    private function nav($_n = 0) {
        $_nav = new NavModel();
        foreach ($_nav->getAllFrontNav() as $_object){
            $_html .= '<optgroup label="'.$_object->nav_name.'">';
            $_nav->id = $_object->id;
            if(!!$_childnav = $_nav->getAllChildNav()){
                foreach ($_childnav as $_object){
                    if($_n == $_object->id){
                        $_html .= '<option selected="selected" value="'.$_object->id.'">'.$_object->nav_name.'</option>';
                    }else{
                        $_html .= '<option value="'.$_object->id.'">'.$_object->nav_name.'</option>';
                    }
                }
            }
            $_html .= '</optgroup>';
        }
        $this->_tpl->assign('nav',$_html);
    }
    
    
    private function color($_color){
        $_colorArr = array(''=>'默认颜色','red'=>'红色','blue'=>'蓝色','orange'=>'橙色');
        foreach ($_colorArr as $_key=>$_value){
            if($_key == $_color) $_selected = 'selected="selected"';
                $_html .= '<option '.$_selected.' value="'.$_key.'" style="color:'.$_key.'">'.$_value.'</option>';
                $_selected ='';
        }
        $this->_tpl->assign('color',$_html);
    }
    
    
    //content sort
    private function sort($_sort){
        $_sortArr = array(0=>'默认排序',1=>'置顶一天',2=>'置顶一周',3=>'置顶一个月',4=>'置顶一年');
        foreach ($_sortArr as $_key=>$_value){
            if($_key == $_sort) $_selected = 'selected="selected"';
            $_html .= '<option '.$_selected.' value="'.$_key.'">'.$_value.'</option>';
            $_selected ='';
        }
        $this->_tpl->assign('sort',$_html);
    }
    
    
    //readlimit
    private function readlimit($_readlimit){
        $_readlimitArr = array(0=>'开发浏览',1=>'初级会员',2=>'中级会员',3=>'高级会员',4=>'VIP会员');
        foreach ($_readlimitArr as $_key=>$_value){
            if($_key == $_readlimit) $_selected = 'selected="selected"';
            $_html .= '<option '.$_selected.' value="'.$_key.'">'.$_value.'</option>';
            $_selected ='';
        }
        $this->_tpl->assign('readlimit',$_html);
    }
    
    
    //评论
    private function comment($_comment){
        $_commentArr = array(0=>'禁止评论',1=>'允许评论');
        foreach ($_commentArr as $_key=>$_value){
            if($_key == $_comment) $_checked = 'checked="checked"';
            $_html .= '<input type="radio" value="'.$_key.'" name="comment" '.$_checked.'/>'.$_value;
            $_checked ='';
        }
        $this->_tpl->assign('comment',$_html);
    }
    
    
    private function update(){
        if(isset($_POST['send'])){
            $this->_model->id = $_POST['id'];
            $this->getPost();
            if($this->_model->updateContent()){
                Tool::alertLocation('文档修改成功', '?action=show');
            }else{
                Tool::alertBack('文档修改失败');
            }
        }
        if(isset($_GET['id'])){
            $this->_tpl->assign('update',true);
            $this->_tpl->assign('title','修改文档');
            $this->_model->id = $_GET['id'];
            $_content = $this->_model->getOneContent();
            $this->_tpl->assign('id',$_content->id);
            if($_content){
                $this->_tpl->assign('content_title',$_content->title);
                $this->_tpl->assign('content_nav',$_content->nav);
                $this->nav($_content->nav);
                $this->attr($_content->attr);
                $this->color($_content->color);
                $this->sort($_content->sort);
                $this->comment($_content->comment);
                $this->readlimit($_content->readlimit);
                $this->_tpl->assign('tag',$_content->tag);
                $this->_tpl->assign('keyword',$_content->keyword);
                $this->_tpl->assign('thumb',$_content->thumb);
                $this->_tpl->assign('source',$_content->source);
                $this->_tpl->assign('author',$_content->author);
                $this->_tpl->assign('info',$_content->info);
                $this->_tpl->assign('content',$_content->content);
                $this->_tpl->assign('count',$_content->count);
                $this->_tpl->assign('gold',$_content->gold);
            }else{
                Tool::alertBack('不存在此文档');
            }
        }else{
            Tool::alertBack('非法操作');
        }
    }
    
    
    private function del() {
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            $this->_model->delContent()?Tool::alertLocation('文档删除成功', '?action=show'):Tool::alertBack('文档删除失败');;
        }else{
            Tool::alertBack('非法操作');
        }
    }
}



