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
class Action{
    protected $_tpl;
    protected $_model;
    
    protected function __construct(&$_tpl,&$_model = null){
        $this->_tpl=$_tpl;
        $this->_model=$_model;
    }
    
    protected function page($total,$_pagesize = PAGE_SIZE) {
        $_page = new Page($total,$_pagesize);
        $this->_model->limit = $_page->limit;
        $this->_tpl->assign('page',$_page->showpage());
        //前端显示的分页序号，注意与id无关
        $this->_tpl->assign('num',($_page->page-1)*$_pagesize);
    }
}



