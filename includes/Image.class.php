<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年4月3日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */
class Image{
    
    private $path;  //图片地址
    private $width; //原图片宽
    private $height;//原图片高
    private $type;  //图片类型
    private $img;   //原图
    private $new_img;//构造好的新图
    
    
    public function __construct($_path){
        $this->path = $_SERVER['DOCUMENT_ROOT'].$_path;
        list($this->width,$this->height,$this->type) = getimagesize($this->path);
        $this->img = $this->getFromImg($this->path, $this->type);
        
    }
    
    //加载图片各种类型，返回图片资源句柄
    private function getFromImg($_path ,$_type) {
        switch ($_type){
            case 1:
                $_image = imagecreatefromgif($_path);
                break;
            case 2:
                $_image = imagecreatefromjpeg($_path);
                break;
            case 3:
                $_image = imagecreatefrompng($_path);
                break;
            default:
                Tool::alertBack('图片格式不正确');
        }
        return $_image;
    }
    
    
    //缩略图(百分比)
//     public function thumb($_per){
//         $new_width = $this->width * ($_per / 100);
//         $new_height = $this->height * ($_per / 100);
        
//         $this->new_img = imagecreatetruecolor($new_width, $new_height);
//         imagecopyresampled($this->new_img, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
//     }
    
    
    //缩略图(等比例)
//     public function thumb($new_width ,$new_height){
//         if($this->width < $this->height){
//             $new_width = ($new_height/$this->height)*$this->width;
//         }else{
//             $new_height = ($new_width/$this->width)*$this->height;
//         }
//         $this->new = imagecreatetruecolor($new_width, $new_height);
//         imagecopyresampled($this->new_img, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
//     }

    
    //固定长高容器图像,扩容填充，裁剪
    public function thumb($new_width = 0,$new_height = 0){
        
        if(empty($new_width)&&empty($new_height)){
            $new_width = $this->width;
            $new_height = $this->height;
        }
        
        if(!is_numeric($new_width) || !is_numeric($new_height)){
            $new_width = $this->width;
            $new_height = $this->height;
        }
        
        //创建一个容器
        $_n_w = $new_width;
        $_n_h = $new_height;
        
        //创建裁剪点
        $_cut_width = 0;
        $_cut_height = 0;
        
        if($this->width < $this->height){
            $new_width = ($new_height/$this->height)*$this->width;
        }else{
            $new_height = ($new_width/$this->width)*$this->height;
        }
        
        if($new_width < $_n_w){
            $r=$_n_w / $new_width;
            $new_width *= $r;
            $new_height *= $r;
            $_cut_height = ($new_height - $_n_h) / 2;
        }
        if($new_height < $_n_h){
            $r=$_n_h / $new_height;
            $new_width *= $r;
            $new_height *= $r;
            $_cut_height = ($new_width - $_n_w) / 2;
        }
        
        
        $this->new_img = imagecreatetruecolor($_n_w, $_n_h);
        imagecopyresampled($this->new_img, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
        
    }
    
    
    //水印
    public function watermark($new_width = 0,$new_height = 0){
        list($_water_width,$_water_height,$_water_type) = getimagesize(MARK);
		$_water = $this->getFromImg(MARK,$_water_type);
		
		if (empty($new_width) && empty($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		
		if (!is_numeric($new_width) || !is_numeric($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		
		if ($this->width > $new_width) { //通过指定长度，获取等比例的高度
			$new_height = ($new_width / $this->width) * $this->height;
		} else {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		
		if ($this->height > $new_height) { //通过指定高度，获取等比例长度
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_width = $this->width;
			$new_height = $this->height;
		}
		
		$_water_x = $new_width - $_water_width - 5;
		$_water_y = $new_height - $_water_height - 5;
		
		
		$this->new_img = imagecreatetruecolor($new_width,$new_height);
		imagecopyresampled($this->new_img,$this->img,0,0,0,0,$new_width,$new_height,$this->width,$this->height);
		if ($new_width > $_water_width && $new_height > $_water_height) {
			imagecopy($this->new_img,$_water,$_water_x,$_water_y,0,0,$_water_width,$_water_height);
		}
		imagedestroy($_water);
    }
    
    
    //对外输出
    public function out() {
        //将图片输出到原来的地址
        imagejpeg($this->new_img,$this->path);
        imagedestroy($this->img);
        imagedestroy($this->new_img);
    }
}


