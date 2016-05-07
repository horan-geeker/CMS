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
　管理首页　>>　内容管理　>>　<strong id="title">{$title}</strong>
</div>

<ul>
	<li><a href="comment.php?action=show">评论列表</a></li>
</ul>



{if $show}
<form action="?action=passall" method="post">
<table class="tb" cellspacing="0">
	<tr><th>编号</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批量审核</th><th>操作</th></tr>
	{if $AllComment}
	{foreach $AllComment(key,value)}
		<input type="hidden" name="ids" value="[{@value->id}]" />
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td title="{@value->full}">{@value->content}</td>
		<td>{@value->user}</td>
		<td>{@value->title}</td>
		<td>{@value->state}</td>
		<td><input type="checkbox" name="checkbox[{@value->id}]"/></td>
		<td><a href="comment.php?action=delete&id={@value->id}" onclick="return confirm('确定要删除吗？')">删除</a></td>
	{/foreach}
		</tr>

		<tr><td></td><td></td><td></td><td></td><td></td><td>
				<input type="button" name="checkall" id="all" value="全选"/>
				<input type="submit" value="批审" name="send" style="cursor:pointer"/>
			</td></tr>
	{else}
	<tr><td colspan="7">对不起，没有任何数据</td></tr>
	{/if}
</table>
</form>
<div id="page">{$page}</div>
{/if}


</body>
</html>