<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>level</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/admin_level.js"></script>
</head>
<body id="main">

<div class="map">
<br/>
　管理首页　>>　等级管理　>>　<strong id="title">{$title}</strong>
</div>

<ul>
	<li><a href="level.php?action=show">等级列表</a></li>
	<li><a href="level.php?action=add">新增等级</a></li>
	{if $update}
	<li><a href="level.php?action=update&id={$id}">修改等级</a></li>
	{/if}
</ul>



{if $show}
<table class="tb" cellspacing="0">
	<tr><th>编号</th><th>等级名称</th><th>等级描述</th><th>操作</th></tr>
	{if $allLevel}
	{foreach $allLevel(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->level_name}</td>
		<td>{@value->level_info}</td>
		<td><a href="level.php?action=update&id={@value->id}">修改</a> |
		 <a href="level.php?action=delete&id={@value->id}" onclick="return confirm('确定要删除吗？')">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="4">对不起，没有任何数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>
{/if}


{if $update}
<form method="post" action="?action=update" name="update">
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="{$prev_url}" name="prev_url" />
<table cellspacing="0" class="tb left">
	<tr><td>等级名称：<input type="text" name="level_name" value="{$level_name}" class="text" /></td></tr>	
	<tr><td><span class="level_info_text">等级描述：</span><textarea name="level_info">{$level_info}</textarea></td></tr>	
	<tr>
    	<td>
    		<input type="submit" name="send" value="修改等级" class="submit" onclick="return checkUpdateForm();" /> [ <a href="{$prev_url}">返回列表</a> ] 
		</td>
	</tr>
</table>
</form>
{/if}


{if $add}
<form method="post" action="?action=add" name="add">
<table cellspacing="0" class="tb left">
	<tr><td>等级名称：<input type="text" name="level_name" class="text" /></td></tr>	
	<tr><td><span class="level_info">等级描述：</span><textarea name="level_info"></textarea></td></tr>	
	<tr>
    	<td>
    		<input type="submit" name="send" value="新增等级" class="submit" onclick="return checkAddForm();" /> [ <a href="level.php?action=show">返回列表</a> ] 
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