<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>user</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/admin_user.js"></script>
</head>
<body id="main">

<div class="map">
<br/>
　管理首页　>>　会员管理　>>　<strong id="title">{$title}</strong>
</div>

<ul>
	<li><a href="user.php?action=show">会员列表</a></li>
	<li><a href="../register.php?action=reg" target="_blank">新增会员</a></li>
	{if $update}
	<li><a href="user.php?action=update&id={$id}">修改会员</a></li>
	{/if}
</ul>



{if $show}
<table class="tb" cellspacing="0">
	<tr><th>编号</th><th>用户名</th><th>电子邮件</th><th>状态</th><th>操作</th></tr>
	{if $allUser}
	{foreach $allUser(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->user}</td>
		<td>{@value->email}</td>
		<td>{@value->state}</td>
		<td><a href="user.php?action=update&id={@value->id}">修改</a> |
		 <a href="user.php?action=delete&id={@value->id}" onclick="return confirm('确定要删除吗？')">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">对不起，没有任何数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>
{/if}


{if $update}
<form method="post" action="?action=update" name="update">
<table cellspacing="0" class="tb left">
	<tr><th><strong>修改会员信息</strong></th></tr>
	<tr><td>用  户  名 ：<input type="text" name="user" value="{$username}" class="text" readonly="readonly" /> <span class="red">[不可更改]</span></td></tr>
	<tr><td>密 　   码 ：<input type="password" name="pass" class="text" /> <span class="red">[留空则不修改]</span> (*密码不得小于6位)</td></tr>
	<tr><td>电子邮件：<input type="text" name="email" class="text" value="{$email}"> <span class="red">[必填]</span> (*每个电子邮件只能注册一个ID)</td></tr>
			<tr><td>选择头像：<select name="face" onchange="sface()">
					{$face}
				</select>
			</td></tr>
			<tr><td><img src="../images/{$facesrc}" class="face" alt="01.gif" name="faceimg"/></td></tr>
			<tr><td>安全问题：<select name="question">
					{$question}
				</select>
			</td></tr>
			<tr><td>问题答案：<input type="text" name="answer" class="text" value="{$answer}"/></td></tr>
			<tr><td>会员等级：<input type="text" name="level" class="text" value="{$level}"/></td></tr>
			<tr><td><input type="submit" name="send" value="修改会员" class="submit" onclick="return checkUpdate();" /></td></tr>
	<input type="hidden" value="{$id}" name="id" />
	<input type="hidden" value="{$prev_url}" name="prev_url" />
</table>
</form>
{/if}


</body>
</html>