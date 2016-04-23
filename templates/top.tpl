<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>top</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_top_nav.js"></script>
</head>
<body id="top">

<h1>LOGO</h1>
<ul>
	<li><a href="../templates/sidebar.html" target="sidebar" class="selected" id="nav1" onclick="admin_top_nav(1)">首页</a></li>
	<li><a href="../templates/content_manage.html" target="sidebar" id="nav2" onclick="admin_top_nav(2)">内容</a></li>
	<li><a href="../templates/user_manage.html" target="sidebar" id="nav3" onclick="admin_top_nav(3)">会员</a></li>
	<li><a href="../templates/system.html" target="sidebar" id="nav4" onclick="admin_top_nav(4)">系统</a></li>
</ul>

<p>您好，<strong>{$admin_user}</strong>[{$admin_level}] [<a href="../" target="_blank">去首页</a>] [<a href="admin_login.php?action=logout" target="_parent">退出</a>]</p>

</body>
</html>



