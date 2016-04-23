<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/admin_manage.js"></script>
</head>
<body id="main">

<div class="map">
<br/>
　管理首页　>>　设置网站导航　>>　<strong id="title">{$title}</strong>
</div>

<ul>
	<li><a href="manage.php?action=show">管理员列表</a></li>
	<li><a href="manage.php?action=add">新增管理员</a></li>
	{if $update}
	<li><a href="manage.php?action=update&id={$id}">修改管理员</a></li>
	{/if}
</ul>



{if $show}
<table class="tb" cellspacing="0">
	<tr><th>编号</th><th>用户名</th><th>等级</th><th>登陆次数</th><th>最近登录IP</th><th>最近登录时间</th><th>操作</th></tr>
	{if $allManage}
	{foreach $allManage(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->admin_user}</td>
		<td>{@value->level_name}</td>
		<td>{@value->login_count}</td>
		<td>{@value->last_ip}</td>
		<td>{@value->last_time}</td>
		<td><a href="manage.php?action=update&id={@value->id}">修改</a> |
		 <a href="manage.php?action=delete&id={@value->id}" onclick="return confirm('确定要删除吗？')">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="7">对不起，没有任何数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>
{/if}


{if $update}
<form method="post" action="?action=update" name="update">
<input type="hidden" value="{$level}" id="level" name="level" />
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="{$pass}" name="pass" />
<input type="hidden" value="{$prev_url}" name="prev_url" />
<table cellspacing="0" class="tb left">
	<tr><td>用户名： <input type="text" name="admin_user" readonly="readonly" value="{$admin_user}" class="text" /></td></tr>	
	<tr><td>密　码： <input type="password" name="admin_pass" class="text" /></td></tr>	
	<tr>
		<td>
		等　级： <select name="level">
				{foreach $allLevel(key,value)}	
					<option value="{@value->id}">{@value->level_name}</option>
				{/foreach}
			</select>
		</td>
	</tr>	
	<tr>
    	<td>
    		<input type="submit" name="send" value="修改管理员" class="submit" onclick="return checkUpdateForm()"/> [ <a href="{$prev_url}">返回列表</a> ] 
		</td>
	</tr>
</table>
</form>
{/if}


{if $add}
<form method="post" action="?action=add" name="add">
<table  class="tb left">
	<tr><td>用&nbsp 户 名： <input type="text" name="admin_user" class="text" />(*不得小于2位)</td></tr>	
	<tr><td>密　　码： <input type="password" name="admin_pass" class="text" />(*不得小于6位)</td></tr>	
	<tr><td>确认密码： <input type="password" name="admin_repass" class="text" /></td></tr>	
	<tr>
		<td>
		等　　级： <select name="level">
				{foreach $allLevel(key,value)}	
					<option value="{@value->id}">{@value->level_name}</option>
				{/foreach}
			</select>
		</td>
	</tr>	
	<tr>
    	<td>
    		<input type="submit" name="send" value="新增管理员" class="submit" onclick="return checkAddForm();"/> [ <a href="manage.php?action=show">返回列表</a> ] 
		</td>
	</tr>
</table>
</form>
{/if}


{if $delete}
删除
{/if}

</body>
</html>