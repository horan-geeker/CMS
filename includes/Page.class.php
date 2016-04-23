<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月25日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class Page{
    
    private $total;     //总条数
    private $pagesize;  //每页显示条数
    private $limit;
    private $page;      //当前页码
    private $pageNum;   //获取总页码
    private $url;       //获取当前php文件的url
    private $bothNum;   //分页栏两边保持的分页数
    
    
    public function __set($_key,$_value){
        $this->$_key = $_value;
    }
    
    public function __get($_key){
        return $this->$_key;
    }
    
    
    //构造方法
    public function __construct($_total,$_pagesize) {
        $this->total = $_total;
        $this->pagesize = $_pagesize;
        $this->pageNum = ceil($this->total/$this->pagesize);
        $this->page = $this->setPage();
        $this->limit = 'LIMIT '.($this->page-1)*$this->pagesize.','.$this->pagesize;
        $this->url = $this->setUrl();
        $this->bothNum = 3;
    }
    
    
    //获取当前页
    public function setPage(){
        if(!empty($_GET['page'])&&$_GET['page']>0){
            if($_GET['page']>$this->pageNum){
                return $this->pageNum;
            }else{
                return $_GET['page'];
            }
        }else{
            return 1;
        }
    }
    
    
    //首页
    private function first(){
        return '<a href="'.$this->url.'">首页</a>';
    }
    //上一页
    private function prev(){
        if($this->page==1){
            return '<span class="disable">上一页</span>';
        }
        return '<a href="'.$this->url.'&page='.($this->page-1).'">上一页</a>';
    }
    //下一页
    private function next(){
        if($this->page==$this->pageNum){
            return '<span class="disable">下一页</span>';
        }
        return '<a href="'.$this->url.'&page='.($this->page+1).'">下一页</a>';
    }
    //尾页
    private function last(){
        return '<a href="'.$this->url.'&page='.$this->pageNum.'">尾页</a>';
    }
    
    //获取地址
    private function setUrl(){
        $_url = $_SERVER['REQUEST_URI'];
        $_par = parse_url($_url);
        if(isset($_par['query'])){
            parse_str($_par['query'],$_query);
            unset($_query['page']);
            $_url = $_par['path'].'?'.http_build_query($_query);
        }
        return $_url;
    }
    
    
    //数字目录
    private function pageList(){
        //前序
        for($i=$this->bothNum;$i>=1;$i--){
            $_page = $this->page-$i;
            if($_page < 1){
                continue;
            }
            $_pagelist .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
        }
        //当前页码
        $_pagelist .= '<span class="me">'.$this->page.'</span>';
        //后序
        for($i=1;$i<=$this->bothNum;$i++){
            $_page = $this->page+$i;
            if($_page > $this->pageNum){
                break;
            }
            $_pagelist .= '<a href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
        }
        return $_pagelist;
    }
    
    
    //前端显示
    public function showpage() {
        $_page .= $this->first();
        $_page .= $this->prev();
        $_page .= $this->pageList();
        $_page .= $this->next();
        $_page .= $this->last();
        return $_page;
    }
}



