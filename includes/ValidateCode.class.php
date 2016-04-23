<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年3月26日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
//验证码类
class ValidateCode{
        
    private $charset = 'ABCDEFGHKMNPRSTUVWXYZabcdefghkmnpqrstuvwxyz23456789';
    private $codeLen = 4;
    private $code;
    private $width = 130;
    private $height = 50;
    private $img;
    private $font;
    private $fontsize = 20;
    private $fontcolor;
    
    public function __construct(){
        $this->font = ROOT_PATH.'/font/elephant.ttf';
    }
    
    //生成随机码
    public function createCode(){
        $_len = strlen($this->charset)-1;
        for($i=0;$i<$this->codeLen;$i++){
            $this->code .= $this->charset[mt_rand(0,$_len)];
        }
        return $this->code;
    }
    
    
    //生成背景
    private function createBg() {
        
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img,mt_rand(157,255),mt_rand(157,255),mt_rand(157,255));
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
        
    }
    
    //生成文字
    private function createFont(){
        //字体向右的x坐标
        $x = $this->width/$this->codeLen;
        $y = $this->height/1.4;
        for($i=0;$i<$this->codeLen;$i++){
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img, $this->fontsize, mt_rand(-30,30), $x*$i+mt_rand(1,5), $y, $this->fontcolor, $this->font, $this->code[$i]);
        }
    }
    
    
    //生成干扰线元素,干扰点元素
    private function createLine(){
        //设置干扰线的元素1.操作图 2.设置两个点的坐标，两点确定一条线 3.颜色
        for($i=0;$i<6;$i++)
        {
            $color = imagecolorallocate($this->img, mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(1,$this->width),mt_rand(1,$this->height),mt_rand(1,$this->width),mt_rand(1,$this->height),$color);
        }
        
        //设置干扰点
        for($i=0;$i<200;$i++){
            $pointcolor=imagecolorallocate($this->img,mt_rand(50,200),mt_rand(50,200),mt_rand(50,200));
            imagesetpixel($this->img,mt_rand(1,$this->width-1),mt_rand(1,$this->height-1),$pointcolor);
        }
    }
    
    
    private function output() {
        header( 'content-type: image/png' );//指定图片类型
        imagepng( $this->img );//输出图片
        imagedestroy( $this->img );//释放资源
    }
    
    public function getCode(){
        return strtolower($this->code);
    }
    
    //对外生成
    public function doimg() {
        $this->createBg();
        $this->createLine();
        $this->createCode();
        $this->createFont();
        $this->output();
    }
}

