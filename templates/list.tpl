<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/list.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><!--{webname}--></title>
</head>
<body>
{include file="header.tpl"}
<div id="list">
	<h2>当前位置 > {$navMain}</h2>
	{if $allListContent}
	{foreach $allListContent(key,value)}
	<script type="text/javascript" src="config/static.php?id={@value->id}&type=list"></script>
	<dl>
		<dt><a href="detail.php?id={@value->id}" target="_blank"><img src="{@value->thumb}" alt="{@value->title}" /></a></dt>
		<dd>[<strong>{@value->nav_name}</strong>] <a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></dd>
		<dd>日期：{@value->date} 阅读量：{@value->count} 好评：0</dd>
		<dd>{@value->info}</dd>
	</dl>
	{/foreach}
	{else}
	<p class="none">没有任何数据</p>
	{/if}
	<div id="page">{$page}</div>
</div>
<div id="sidebar">
	<div class="nav">
    	<h2>子栏目列表</h2>
    	{if $childNav}
    	{foreach $childNav(key,value)}
    	<strong><a href="list.php?id={@value->id}">{@value->nav_name}</a></strong>
    	{/foreach}
    	{else}
    	<span>该栏目没有子类</span>
    	{/if}
    </div>
    <div class="right">
	<h2>本类推荐</h2>
		<ul class="list-info">
			{foreach $NavRec(key,value)}
				<li><span>{@value->date}</span><a href="detail.php?id={@value->id}">{@value->title}</a></li>
			{/foreach}
		</ul>
	</div>
	<div class="right">
	<h2>本类最新</h2>
    	<ul class="list-info">
    		{foreach $NavHot(key,value)}
			<li><span>{@value->date}</span><a href="detail.php?id={@value->id}">{@value->title}</a></li>
			{/foreach}
    	</ul>
	</div>
</div>
{include file="footer.tpl"}

</body>
</html>



