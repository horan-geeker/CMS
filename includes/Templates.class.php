<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月14日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */

class Templates{
    //通过一个数组动态接受可选的多个变量
    private $_vars = array();
    private $_config = array();
    
    //创建构造方法验证几个目录是否存在
    public function __construct(){
        if(!is_dir(TPL_DIR) || !is_dir(TPL_DIR_C) || !is_dir(CACHE)){
            exit('模板目录或编译目录或缓存目录不存在，请添加');
        }
        

        $_sxe = simplexml_load_file(ROOT_PATH.'/config/profile.xml');
        $_tagLib = $_sxe->xpath('/root/taglib');
        foreach ($_tagLib as $_tag){
            $this->_config["$_tag->name"] = $_tag->value;
        }
    }
    
    //assign()方法，用于注入变量
    public function assign($_var,$_value){
        //$_var用于!!!模板!!!里的变量名如{name}，$_value用于值
        if(isset($_var)&&!empty($_var)){
            $this->_vars[$_var] = $_value;
        }else{
            exit('请设置模板变量');
        }
    }
    
    
    //直接跳转到缓存文件
    public function cache($_file){
        //设置模板路径
        $_tplFile = TPL_DIR.$_file;
        if(!file_exists($_tplFile)){
            exit('ERROR 模板文件不存在');
        }
        //是否在路径中加入参数
        if(!empty($_SERVER['QUERY_STRING']))$_file .= $_SERVER['QUERY_STRING'];
        //编译文件路径
        $_parPath = TPL_DIR_C.md5($_file).$_file."php";
        //缓存文件路径
        $_cacheFile = CACHE.md5($_file).".html";
        //判断是否存在或模板是否更新过
        if(!file_exists($_parPath) || filemtime($_parPath)<=filemtime($_tplFile)){
            //引入模板解析类
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parFile = new Parser($_tplFile);
            $_parFile->compile($_parPath);
        }
        //当第二次运行相同文件的时候，直接载入缓存文件
        if( IS_CACHE&&
            file_exists($_cacheFile)&&
            filemtime($_parPath)<=filemtime($_cacheFile)){
                include $_cacheFile;
                exit();
        }
    }
    
    
    //display方法
    public function dispaly($_file) {
        $_tpl = $this;
        //设置模板路径
        $_tplFile = TPL_DIR.$_file;
        if(!file_exists($_tplFile)){
            exit('ERROR 模板文件不存在');
        }
        //是否在路径中加入参数
        if(!empty($_SERVER['QUERY_STRING']))$_file .= $_SERVER['QUERY_STRING'];
        //编译文件路径
        $_parPath = TPL_DIR_C.md5($_file).$_file."php";
        //缓存文件路径
        $_cacheFile = CACHE.md5($_file).".html";
        //判断是否存在或模板是否更新过
        if(!file_exists($_parPath) || filemtime($_parPath)<=filemtime($_tplFile)){
            //引入模板解析类
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parFile = new Parser($_tplFile);
            $_parFile->compile($_parPath);
        }
        //载入编译文件       
        //在调用该方法的文件里导入编译好的文件
        include $_parPath;
        
        if(IS_CACHE){
            //获取缓冲区内容,并且创建缓存文件
            file_put_contents($_cacheFile, ob_get_contents());
            //清除缓冲区(清除了编译文件加载的内容)
            ob_end_clean();
            //载入缓存文件
            include $_cacheFile;
        }
    }
    
    //创建create方法，用于分离的模块解析并合并在主要文件中
    public function create($_file){
        //设置模板路径
        $_tplFile = TPL_DIR.$_file;
        if(!file_exists($_tplFile)){
            exit('ERROR 模板文件不存在');
        }
        //编译文件路径
        $_parPath = TPL_DIR_C.md5($_file)."$_file";
        //判断是否存在或模板是否更新过
        if(!file_exists($_parPath) || filemtime($_parPath)<=filemtime($_tplFile)){
            //引入模板解析类
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parFile = new Parser($_tplFile);
            $_parFile->compile($_parPath);
        }
        //载入编译文件
        include $_parPath;
    }
}


