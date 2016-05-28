<?php
	class MainAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl); 
		}
		
		//action
		public function action() {
			if ($_GET['action'] == 'delCache') {
				$this->delCache();
			}
			$this->cacheNum();
		}
		
		
		//计算缓存目录的文件
		private function cacheNum() {
			$_dir = ROOT_PATH.'/cache/';
			$_num=sizeof(scandir($_dir));
			$this->_tpl->assign('cacheNum',$_num-2);
		}
		
		//清理缓存
		private function delCache() {
			$_dir = ROOT_PATH.'/cache/';
			if(!$_dh = @opendir($_dir)) return;
		    while (false !== ($_obj = readdir($_dh))) {
		       if($_obj=='.' || $_obj=='..') continue;
		       @unlink($_dir.'/'.$_obj);
		    }
			closedir($_dh);
			Tool::alertLocation('恭喜，缓存清理完毕！','main.php');
		}
		
	}
?>