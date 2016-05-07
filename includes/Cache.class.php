<?php 
/**
 * @author:Hejunwei
 * 
 * @version:1.0
 * 
 * @date:2016年4月10日
 * 
 * 版权所有 2015-2016 http://www.majialichen.com
 * 
 */

//静态页面局部动态刷新
class Cache{
    //设置不缓存的数组
    private $flag;
    
    public function __construct($_noCache){
        $this->flag = in_array(Tool::fileToTPL(),$_noCache);
    }
    
    
    public function _action(){
        switch ($_GET['type']){
            case 'detail':
                $this->detail();
                break;
            case 'list':
                $this->getListCount();
                break;
            case 'header':
                $this->top();
                break;
            case 'index':
                $this->index();
                break;
        }
    }
    
    
    //返回不缓存的布尔值
    public function noCache(){
        return $this->flag;
    }
    
    
    //统计点击量
    public function detail() {
        $_content = new ContentModel();
        $_content->id = $_GET['id'];
        $_content->countContent();
        $_count = $_content->getOneContent()->count;
        echo "
            function getContentCount(){
            document.write('$_count');
            };
        ";

        $comment = new CommentModel();
        $comment->cid = $_GET['id'];
        $count = $comment->getCommentTotal();
        echo "
            function getCommentCount(){
            document.write('$count');
        };
    ";
    }
    
    
    //统计点击量
    public function getListCount() {
        $_content = new ContentModel();
        $_content->id = $_GET['id'];
        $_count = $_content->getOneContent()->count;
        echo "
            function getContentCount(){
            document.write('$_count');
        };
    ";
    }
    
    //公共top栏登录状态判断
    public function top() {
        if(isset($_COOKIE['user'])){
            echo "
                function getHeader(){
                    document.write('{$_COOKIE['user']}, 您好！ <a href=\"register.php?action=logout\">退出</a>');
                }
            ";
        }else{
            echo "
                function getHeader(){
                    document.write('<a href=\"register.php?action=reg\" class=\"user\">注册 </a><a href=\"register.php?action=login\" class=\"user\">登录</a>');
                }
            ";
        }
    }
    
    
    //首页login栏登录状态判断
    public function index() {
        if ($_COOKIE['user'] && $_COOKIE['face']) {
			$_member .= '<h2>会员信息</h2>';
			$_member .= '<div class="welcome">您好，<strong>'.Tool::subStr($_COOKIE['user'],null,8,'utf-8').'</strong> 欢迎光临</div>';
			$_member .= '<div class="userInfo">';
			$_member .= '<img src="images/'.$_COOKIE['face'].'" alt="'.$_COOKIE['user'].'" />';
			$_member .= '<a href="###">个人中心</a>';
			$_member .= '<a href="###">我的评论</a>';
			$_member .= '<a href="register.php?action=logout">退出登录</a>';
			$_member .= '</div>';
		} else {
			$_member .= '<h2>会员登录</h2>';
			$_member .= '<form method="post" name="login" action="register.php?action=login">';
			$_member .= '<label>用户名：<input type="text" name="user" class="text" /></label>';
			$_member .= '<label>密　码：<input type="password" name="pass" class="text" /></label>';
			$_member .= '<p><a href="#">忘记密码？</a></p>';
			$_member .= '<label>验证码：<input type="text" name="checkcode" class="text code" /></label>';
			$_member .= '<img src="config/code.php" onclick="javascript:this.src="config/code.php?tm="+Math.random();" class="code"/>';
			$_member .= '<p><input type="submit" name="send" value="登录" onclick="return checkLogin();" class="submit" /> <a href="register.php?action=reg">注册会员</a></p>';
			$_member .= '</form>';
		}
        echo "
            function getLogin(){
                document.write('$_member');
            }
        ";
    }


}




