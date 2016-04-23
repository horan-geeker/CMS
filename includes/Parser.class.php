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

class Parser{
    
    private $_tpl;
    
    public function __construct($_tplFile){
        if(!$this->_tpl = file_get_contents($_tplFile)){
            exit('ERROR 模板文件读取错误');
        }
    }
    
    //解析普通变量
    private function parVal(){
        $_pattern = '/\{\$([\w]+)\}/';
        if(preg_match($_pattern, $this->_tpl)){
            $this->_tpl = preg_replace($_pattern, "<?php echo \$this->_vars['\\1'];?>", $this->_tpl);
        }
    }
    
    //解析if语句
    private function parIf(){
        $_patternIf = '/{if\s+\$([\w]+)\}/';
        $_patternEndif =  '/{\/if\}/';
        
        $_patternElse = '/\{else\}/';
        
        if(preg_match($_patternIf, $this->_tpl)){
            if(preg_match($_patternEndif, $this->_tpl)){
                //替换if条件开头
                $this->_tpl = preg_replace($_patternIf, "<?php if(\$this->_vars['$1']){?>", $this->_tpl);
                //替换if结尾的大括号
                $this->_tpl = preg_replace($_patternEndif, "<?php }?>", $this->_tpl);
                //匹配else
                if(preg_match($_patternElse, $this->_tpl)){
                    $this->_tpl = preg_replace($_patternElse, "<?php }else{?>", $this->_tpl);
                }
            }else{
                echo 'if语句没有关闭';
            }
        }
    }
    
    //解析foreach
    private function parFor(){
        $_pattern = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
        $_patternVar = '/\{@([\w]+)([\w\-\>\+]*)\}/';
        $_patternEnd = '/\{\/foreach\}/';
        if(preg_match($_pattern, $this->_tpl)){
            if(preg_match($_patternEnd, $this->_tpl)){    
                $this->_tpl = preg_replace($_pattern, "<?php foreach(\$this->_vars['$1'] as \$$2=>\$$3){?>", $this->_tpl);
                $this->_tpl = preg_replace($_patternEnd, "<?php }?>", $this->_tpl);
                if(preg_match($_patternVar, $this->_tpl)){
                    $this->_tpl = preg_replace($_patternVar, "<?php echo $$1$2;?>", $this->_tpl);
                }
            }else{
                exit('foreach语句没有结束');
            }
        }
    }
    
    //解析include语句
    private function parInclude(){
        $_pattern = '/\{include\s+file=\"([\w\.\-\/]+)\"\}/';
        if(preg_match_all($_pattern, $this->_tpl,$_file)){
            foreach ($_file[1] as $_value){
                if(!file_exists('templates/'.$_value)){
                    exit('包含文件出错');
                }
            }
            $this->_tpl = preg_replace($_pattern, "<?php \$_tpl->create('$1')?>", $this->_tpl);
        }
    }
    
    //解析注释
    private function parCommon(){
        $_pattern = '/\{#\}(.*)\{#\}/';
         if(preg_match($_pattern, $this->_tpl)){
             $this->_tpl = preg_replace($_pattern, "<?php /* $1 */?>", $this->_tpl);
         }
    }
    
    //解析系统变量
    private function parConfig(){
        $_pattern = '/<!--\{([\w]+)\}-->/';
        if(preg_match($_pattern, $this->_tpl)){
            $this->_tpl = preg_replace($_pattern, "<?php echo \$this->_config['$1']?>", $this->_tpl);
            
        }
    }
    
    //对外公共方法
    public function compile($_parPath){
        
        //解析模板内容
        $this->parVal();
        $this->parIf();
        $this->parCommon();
        $this->parFor();
        $this->parInclude();
        $this->parConfig();
        
        //生成编译文件
        if(!file_put_contents($_parPath, $this->_tpl)){
            exit('ERROR 编译文件出错');
        }
        
    }
}



