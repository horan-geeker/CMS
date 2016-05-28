<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>content</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/admin_content.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">

<div class="map">
<br/>
　内容管理　>>　查看文档列表　>>　<strong id="title">{$title}</strong>
</div>

<ul>
	<li><a href="content.php?action=show">文档列表</a></li>
	<li><a href="content.php?action=add">新增文档</a></li>
	{if $update}
	<li><a href="content.php?action=update&id={$id}">修改文档</a></li>
	{/if}
</ul>



{if $show}
<table class="tb" cellspacing="0">
	<tr><th>编号</th><th>标题</th><th>属性</th><th>文档类别</th><th>浏览次数</th><th>发布时间</th><th>操作</th></tr>
	{if $searchContent}
	{foreach $searchContent(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td><a href="../detail.php?id={@value->id}" title="{@value->title}" target="_blank">{@value->title}</a></td>
		<td>{@value->attr}</td>
		<td><a href="?action=show&nav={@value->nav}">{@value->nav_name}</a></td>
		<td>{@value->count}</td>
		<td>{@value->date}</td>
		<td><a href="content.php?action=update&id={@value->id}">修改</a> |
		 <a href="content.php?action=delete&id={@value->id}" onclick="return confirm('确定要删除吗？')">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="7">对不起，没有任何数据</td></tr>
	{/if}
</table>
<form action="?" method="get">
<div id="page">
	{$page}
	<input type="hidden" name="action" value="show" />
	<select name="nav" class="select">
		<option value="0">默认全部</option>
		{$nav}
	</select>
	<input value="查询" type="submit" />
</div>
</form>
{/if}


{if $add}
<form method="post" action="?action=add" name="content">
<table cellspacing="0"  class="tb content">
	<tr><th><strong>发布一条新文档</strong></th></tr>
	<tr><td>文档标题：<input type="text" class="text" name="title"/>(*不能小于2位大于30位)</td></tr>
	<tr><td>栏　　目：<select name="nav">
			<option value="">请选择一个栏目类别</option>
			{$nav}
		</select></td>
	</tr>
	<tr><td>定义属性：
		<input type="checkbox" name="attr[]" value="头条" />头条
		<input type="checkbox" name="attr[]" value="推荐" />推荐
		<input type="checkbox" name="attr[]" value="加粗" />加粗
		<input type="checkbox" name="attr[]" value="跳转" />跳转
		</td></tr>
	<tr><td>标　　签：<input type="text" class="text" name="tag"/>(*每个标签用，隔开 不能大于30位)</td></tr>
	<tr><td>关 键 字 ：<input type="text" class="text" name="keyword"/>(*每个关键字用，隔开 不能大于30位)</td></tr>
	<tr><td>缩 略 图 ：<input type="text" class="text" name="thumb" readonly="readonly"/>
				   <input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','400','200')"/>
				   (*缩略图必须是jpg,png,gif,并且在2M大小内)
				   <img name="pic" style="display:none" />
	</td></tr>
	<tr><td>文章来源：<input type="text" class="text" name="source"/>(*不能大于30位)</td></tr>
	<tr><td>作　　者：<input type="text" class="text" name="author" value="{$author}"/>(*不能大于10位)</td></tr>
	<tr><td>内容摘要：<textarea name="info"></textarea>(*不能大于200位)</td></tr>
	<tr><td><textarea id="TextArea1" name="content" class="ckeditor"></textarea></td></tr>
	<tr><td>评论选项：<input type="radio" value="1" name="comment" checked="checked"/>允许评论
					<input type="radio" value="0" name="comment"/>禁止评论
  &nbsp&nbsp浏览次数：<input type="text" name="count" value="100" class="text small" />
  &nbsp&nbsp消费金币：<input type="text" name="gold" value="100" class="text small" />
	</td></tr>
	<tr><td>文档排序：<select name="sort">
						<option value="0">默认排序</option>
						<option value="1">置顶一天</option>
						<option value="2">置顶一周</option>
						<option value="3">置顶一月</option>
						<option value="4">置顶一年</option>
					</select>
      
	</td></tr>
	<tr><td>阅读权限：<select name="readlimit">
						<option value="0">开放浏览</option>
						<option value="1">初级会员</option>
						<option value="2">中级会员</option>
						<option value="3">高级会员</option>
						<option value="4">VIP会员</option>
					</select>
	</td></tr>
	<tr><td>标题颜色：<select name="color">
						<option value="">默认颜色</option>
						<option style="color:red;" value="red">红色</option>
						<option style="color:blue;" value="blue">蓝色</option>
						<option style="color:orange;" value="orange">橙色</option>
					</select>
	</td></tr>
	<tr><td><input type="submit" value="发布文档" name="send" onclick="return checkAddContent()"/>
			<input type="reset" value="重置"/></td></tr>
</table>
</form>
{/if}


{if $update}
<form method="post" action="?action=update" name="content">
	<input type="hidden" name="id" value="{$id}" />
<table cellspacing="0"  class="tb content">
	<tr><th><strong>发布一条新文档</strong></th></tr>
	<tr><td>文档标题：<input type="text" class="text" name="title" value="{$content_title}"/>(*不能小于2位大于30位)</td></tr>
	<tr><td>栏　　目：<select name="nav">
			<option value="">请选择一个栏目类别</option>
			{$nav}
		</select></td>
	</tr>
	<tr><td>定义属性：{$attr}
		</td></tr>
	<tr><td>标　　签：<input type="text" class="text" name="tag" value="{$tag}"/>(*每个标签用，隔开 不能大于30位)</td></tr>
	<tr><td>关 键 字 ：<input type="text" class="text" name="keyword" value="{$keyword}"/>(*每个关键字用，隔开 不能大于30位)</td></tr>
	<tr><td>缩 略 图 ：<input type="text" class="text" name="thumb" value="{$thumb}" readonly="readonly"/>
				   <input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','400','200')"/>
				   (*缩略图必须是jpg,png,gif,并且在2M大小内)
				   <img name="pic" src="{$thumb}" style="display:block" />
	</td></tr>
	<tr><td>文章来源：<input type="text" class="text" name="source" value="{$source}"/>(*不能大于30位)</td></tr>
	<tr><td>作　　者：<input type="text" class="text" name="author" value="{$author}"/>(*不能大于10位)</td></tr>
	<tr><td>内容摘要：<textarea name="info">{$info}</textarea>(*不能大于200位)</td></tr>
	<tr><td><textarea id="TextArea1" name="content" class="ckeditor">{$content}</textarea></td></tr>
	<tr><td>评论选项：{$comment}
  &nbsp&nbsp浏览次数：<input type="text" name="count" value="{$count}" class="text small" />
  &nbsp&nbsp消费金币：<input type="text" name="gold" value="{$gold}" class="text small" />
	</td></tr>
	<tr><td>文档排序：<select name="sort">
						{$sort}
					</select>
      
	</td></tr>
	<tr><td>阅读权限：<select name="readlimit">
						{$readlimit}
					</select>
	</td></tr>
	<tr><td>标题颜色：<select name="color">
						{$color}
					</select>
	</td></tr>
	<tr><td><input type="submit" value="修改文档" name="send" onclick="return checkAddContent()"/>
			<input type="reset" value="重置"/></td></tr>
</table>
</form>
{/if}


{if $delete}
删除
{/if}

</body>
<script>

</script>
</html>