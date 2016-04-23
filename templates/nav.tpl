<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/admin_nav.js"></script>
</head>
<body id="main">
<div class="map">
<br/>
　内容管理　>>　管理员管理　>>　<strong id="title">{$title}</strong>
</div>

<ul>
	<li><a href="nav.php?action=show">导航列表</a></li>
	<li><a href="nav.php?action=add">新增导航</a></li>
	{if $update}
	<li><a href="nav.php?action=update&id={$id}">修改导航</a></li>
	{/if}
	{if $addchild}
	<li><a href="nav.php?action=addchild&id={$id}">新增子导航</a></li>
	{/if}
	{if $showchild}
	<li><a href="nav.php?action=showchild&id={$id}">子导航列表</a></li>
	{/if}
</ul>
{if $show}
<form action="?action=sort" method="post">
<table class="tb" cellspacing="0">
	<tr><th>编号</th><th>导航名称</th><th>导航描述</th><th>子类导航</th><th>排序</th><th>操作</th></tr>
	{if $allNav}
	{foreach $allNav(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->nav_name}</td>
		<td>{@value->nav_info}</td>
		<td><a href="nav.php?action=showchild&id={@value->id}">查看</a> | <a href="nav.php?action=addchild&id={@value->id}">增加子类</a>
		<td><a href="nav.php?action=update&id={@value->id}">修改</a> |
		 <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('确定要删除吗？')">删除</a>
		 </td>
		 <td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"/></td>
	</tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send" style="cursor:pointer"/></td></tr>
	{else}
	<tr><td colspan="6">对不起，没有任何数据</td></tr>
	{/if}
</table>
</form>
<div id="page">{$page}</div>
{/if}
{if $showchild}
<form action="?action=sort" method="post">
<table class="tb" cellspacing="0">
	<tr><th>编号</th><th>导航名称</th><th>导航描述</th><th>操作</th><th>排序</th></tr>
	{if $allChildNav}
	{foreach $allChildNav(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->nav_name}</td>
		<td>{@value->nav_info}</td>
		<td><a href="nav.php?action=update&id={@value->id}">修改</a> |
		 <a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('确定要删除吗？')">删除</a></td>
		<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"/></td>
	</tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td><input type="submit" value="排序" name="send" style="cursor:pointer"/></td></tr>
	{else}
	<tr><td colspan="5">对不起，没有任何数据</td></tr>
	{/if}
	<tr><td colspan="5">本类属于<strong>{$prev_name}</strong> [ <a href="nav.php?action=addchild&id={$id}">继续增加子类</a> ] [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
</table>
</form>
<div id="page">{$page}</div>
{/if}
{if $update}
<form method="post" action="?action=update" name="add">
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="{$prev_url}" name="prev_url" />
<table cellspacing="0" class="tb left">
	<tr><td>导航名称：<input type="text" name="nav_name" value="{$nav_name}" class="text" /></td></tr>	
	<tr><td><span class="nav_info_text">导航描述：</span><textarea name="nav_info">{$nav_info}</textarea></td></tr>	
	<tr>
    	<td>
    		<input type="submit" name="send" value="修改导航" class="submit" onclick="return checkForm();" /> [ <a href="{$prev_url}">返回列表</a> ] 
		</td>
	</tr>
</table>
</form>
{/if}
{if $add}
<form method="post" action="?action=add" name="add">
<table cellspacing="0" class="tb left">
	<tr><td>导航名称：<input type="text" name="nav_name" class="text" /></td></tr>	
	<tr><td><span class="nav_info">导航描述：</span><textarea name="nav_info"></textarea></td></tr>	
	<tr>
    	<td>
    		<input type="submit" name="send" value="新增导航" class="submit" onclick="return checkForm();" /> [ <a href="{$prev_url}">返回列表</a> ] 
		</td>
	</tr>
</table>
</form>
{/if}
{if $addchild}
<form method="post" action="?action=addchild" name="add">
<table cellspacing="0" class="tb left">
	<input type="hidden" name="id" value="{$id}" />
	<input type="hidden" name="pid" value="{$pid}" />
	<tr><td>上 级 导 航：<strong>{$prev_name}</strong></td></tr>
	<tr><td>子导航名称：<input type="text" name="nav_name" class="text" /></td></tr>	
	<tr><td><span class="nav_info">子导航描述：</span><textarea name="nav_info"></textarea></td></tr>	
	<tr>
    	<td>
    		<input type="submit" name="send" value="新增子导航" class="submit" onclick="return checkForm();" /> [ <a href="{$prev_url}">返回列表</a> ] 
		</td>
	</tr>
</table>
</form>
{/if}
{if $delete}
删除
{/if}

