<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/admin_login.js"></script>
</head>
<body id="main">

<form method="post" name="login" id="adminLogin" action="?action=login">
	<fieldset>
		<legend>登录CMS内容管理系统</legend>
		<label>账　户：<input type="text" name="admin_user" class="text" /></label>
		<label>密　码：<input type="password" name="admin_pass" class="text" /></label>
		<label>验证码：<input type="text" name="checkcode" class="text" name="checkcode"/></label>
		<label class="t">输入下图的字符（不区分大小写）</label>
		<label><img src="../config/code.php" onclick="javascript:this.src='../config/code.php?tm='+Math.random();"/></label>
		<input type="submit" value="登录" class="submit" onclick="return checkLogin()" name="send"></input>
	</fieldset>
</form>

</body>
</html>