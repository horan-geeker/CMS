<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月31日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class FileUpload{
    
    private $error;     //错误标志
    private $maxsize;   //可上传文件最大值
    private $type;      //文件类型
    private $typeArr = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');		//类型合集
	private $path;      //目录路径
	private $today;     //今天目录
	private $name;      //文件名
	private $tmp;       //临时文件
	private $linkpath;  //新文件路径,注意是网站的目录不是系统的目录
	private $linktoday;   //今天时间的目录
	
    
    public function __construct($_file) {
        $this->error = $_FILES[$_file]['error'];
        $this->type = $_FILES[$_file]['type'];
        $this->path = ROOT_PATH.UPDIR;
        $this->linktoday = date('Ymd').'/';
        $this->today = $this->path.$this->linktoday;
        $this->name = $_FILES[$_file]['name'];
        $this->tmp = $_FILES[$_file]['tmp_name'];
        $this->checkError();
        $this->checkType();
        $this->checkDir();
        $this->moveUpload();
    }
    
    
    //返回路径，对外接口
    public function getPath(){
        $_path = $_SERVER['SCRIPT_NAME'];
        //拿上上一级的目录名，也就是上一级的目录
        $_dir = dirname(dirname($_path));
        //判断是不是根目录，转义反斜杠
        if($_dir == '\\')$_dir='/';
        $this->linkpath = $_dir.$this->linkpath;
        return $this->linkpath;
    }
    
    
    //移动临时文件到新路径
    private function moveUpload(){
        if(is_uploaded_file($this->tmp)){
            if(!move_uploaded_file($this->tmp, $this->setNewName())){
                Tool::alertBack('上传失败');
            }
        }else{
            Tool::alertBack('临时文件不存在');
        }
    }
    
    
    //设置新文件名
    private function setNewName(){
        $_nameArr = explode('.', $this->name);
        $_postfix = $_nameArr[count($_nameArr)-1];
        $_newname = date('YmdHis').mt_rand(100,1000).'.'.$_postfix;
        $this->linkpath = UPDIR.$this->linktoday.$_newname;
		return $this->today.$_newname;
    }
    
    
    
    //验证目录
    private function checkDir(){
        if(!is_dir($this->path) || !is_writeable($this->path)){
            if(!mkdir($this->path)){
                Tool::alertBack('创建主目录失败');
            }
        }
        if(!is_dir($this->today) || !is_writeable($this->today)){
            if(!mkdir($this->today)){
                Tool::alertBack('创建子目录失败');
            }
        }
    }
    
    //验证类型
    private function checkType(){
        if(!in_array($this->type,$this->typeArr)){
            Tool::alertBack('上传类型不正确');
        }
    }
    
    
    //验证错误
    private function checkError() {
        if($this->error!=0){
            switch ($this->error){
                case 1:
                    Tool::alertBack('上传值超过了约定值大小');
                    break;
                case '2':
                    Tool::alertBack('上传值超过了2M');
                    break;
                case '3':
                    Tool::alertBack('只有部分文件被上传');
                    break;
                case '4':
                    Tool::alertBack('文件未被上传');
                    break;
                default:
                    Tool::alertBack('未知错误');
                    break;
            }
        }
    }
}



