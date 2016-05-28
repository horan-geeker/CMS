<?php
	class SystemAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new SystemModel());
		}
		
		//action
		public function _action() {
			$this->show();
		}
		
		
		//show
		private function show() {
			if (isset($_POST['send'])) {
				$this->_model->webname = $_POST['webname'];
				$this->_model->page_size = $_POST['page_size'];
				$this->_model->article_size = $_POST['article_size'];
				$this->_model->nav_size = $_POST['nav_size'];
				$this->_model->updir = $_POST['updir'];
				$this->_model->ro_time = $_POST['ro_time'];
				$this->_model->ro_num = $_POST['ro_num'];
				$this->_model->adver_text_num = $_POST['adver_text_num'];
				$this->_model->adver_pic_num = $_POST['adver_pic_num'];
				if ($this->_model->setSystem()) {
					
					$_br = "\r\n";
					$_tab = "\t";
					
					$_profile = '<?php'.$_br;
					
					
					$_profile .= $_tab."//系统配置文件".$_br;
					$_profile .= $_tab."define('WEBNAME','{$this->_model->webname}');".$_br;
					$_profile .= $_tab."define('PAGE_SIZE',{$this->_model->page_size});".$_br;
					$_profile .= $_tab."define('ARTICLE_SIZE',{$this->_model->article_size});".$_br;
					$_profile .= $_tab."define('NAV_SIZE',{$this->_model->nav_size});".$_br;
					$_profile .= $_tab."define('UPDIR','{$this->_model->updir}');".$_br;
					
					$_profile .= $_br;
					
					$_profile .= $_tab."//轮播器配置".$_br;
					$_profile .= $_tab."define('RO_TIME',{$this->_model->ro_time});".$_br;
					$_profile .= $_tab."define('RO_NUM',{$this->_model->ro_num});".$_br;
					
					$_profile .= $_br;
					
					$_profile .= $_tab."//广告服务".$_br;
					$_profile .= $_tab."define('ADVER_TEXT_NUM',{$this->_model->adver_text_num});".$_br;
					$_profile .= $_tab."define('ADVER_PIC_NUM',{$this->_model->adver_pic_num});".$_br;
					
					$_profile .= $_tab."//不可修改的项目".$_br;
					
					$_profile .= $_br;
					
					$_profile .= $_tab."//数据库配置文件".$_br;
					$_profile .= $_tab."define('DB_HOST','localhost');".$_br;
					$_profile .= $_tab."define('DB_USER','root');".$_br;
					$_profile .= $_tab."define('DB_PASS','yangfan');".$_br;
					$_profile .= $_tab."define('DB_NAME','cms');".$_br;
					$_profile .= $_tab."define('DB_PORT',3306);".$_br;
					
					$_profile .= $_br;
					$_profile .= $_tab."define('GPC',get_magic_quotes_gpc());".$_br;
					$_profile .= $_tab."define('PREV_URL',\$_SERVER[\"HTTP_REFERER\"]);".$_br;
					
					$_profile .= $_br;
					$_profile .= $_tab."//模板配置信息".$_br;
					$_profile .= $_tab."define('TPL_DIR',ROOT_PATH.'/templates/');".$_br;
					$_profile .= $_tab."define('TPL_C_DIR',ROOT_PATH.'/templates_c/');".$_br;
					$_profile .= $_tab."define('CACHE',ROOT_PATH.'/cache/');".$_br;
					$_profile .= $_tab."define('MARK',ROOT_PATH.'/images/yc.png');".$_br;
					
					
					
					$_profile .= '?>'.$_br;
					
					if (!file_put_contents('../config/profile.inc.php', $_profile)) {
						Tool::alertBack('警告：生成配置文件失败！');
					}
					
					Tool::alertLocation('恭喜，修改配置文件成功！','system.php');
				} else {
					Tool::alertBack('很遗憾，修改配置文件失败！');
				}
			}
			$_object = $this->_model->getSystem();
			$this->_tpl->assign('webname',$_object->webname);
			$this->_tpl->assign('page_size',$_object->page_size);
			$this->_tpl->assign('article_size',$_object->article_size);
			$this->_tpl->assign('nav_size',$_object->nav_size);
			$this->_tpl->assign('updir',$_object->updir);
			$this->_tpl->assign('ro_time',$_object->ro_time);
			$this->_tpl->assign('ro_num',$_object->ro_num);
			$this->_tpl->assign('adver_text_num',$_object->adver_text_num);
			$this->_tpl->assign('adver_pic_num',$_object->adver_pic_num);
		}
		
	}
?>