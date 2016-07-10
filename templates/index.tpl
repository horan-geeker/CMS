<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" type="text/css" href="style/basic.css"/>
    <link rel="stylesheet" type="text/css" href="style/index.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><!--{webname}--></title>

    <script type="text/javascript" src="js/reg.js"></script>
    <script type="text/javascript" src="config/static.php?type=index"></script>
</head>
<body>
{include file="header.tpl"}

<div id="user">
    {if $cache}
        {$member}
    {else}
        {if $login}
            <h2>会员登录</h2>
            <form method="post" action="register.php?action=login" name="login">
                <label>用户名：<input type="text" name="user" class="text"/></label>
                <label>密　码：<input type="password" name="pass" class="text"/></label>
                <p><a href="#">忘记密码？</a></p>
                <label>验证码：<input type="text" name="checkcode" class="text code"/></label>
                <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();"
                     class="code"/>
                <p>
                    <input type="submit" name="send" value="登录" class="submit" onclick="return checkLogin();"/>
                    <a href="register.php?action=reg">注册会员</a>
                </p>
            </form>
        {else}
            <h2>会员信息</h2>
            <div class="welcome">您好 <strong>{$userName}</strong>，欢迎光临</div>
            <div class="userInfo">
                <img src="images/{$userFace}" alt="{$userName}"/>
                <a href="#">个人中心</a>
                <a href="#">我的评论</a>
                <a href="register.php?action=logout">退出登录</a>
            </div>
        {/if}
    {/if}

    <div class="rec_user">
        <h3>最近登录的会员<span>---------------------------------------</span></h3>
        {if $ALLLaterUser}
            {foreach $ALLLaterUser(key,value)}
                <dl>
                    <dt><img src="images/{@value->face}" alt="{@value->user}"/></dt>
                    <dd>{@value->user}</dd>
                </dl>
            {/foreach}
        {/if}
    </div>
</div>
<div id="news">
    <h3><a href="detail.php?id={$NewTopId}">{$NewTopTitle}</a></h3>
    <p>
        {$NewTopInfo}
        <a href="detail.php?id={$NewTopId}">[查看全文]</a>
    </p>
    <p class="link">
        {foreach $OtherNewTop(key,value)}
            <a href="detail.php?id={@value->id}">{@value->title}</a>
            　|　
        {/foreach}
    </p>
    <ul class="list-info">
        {foreach $NewList(key,value)}
            <li><span>{@value->date}</span><a href="detail.php?id={@value->id}">{@value->title}</a></li>
        {/foreach}
    </ul>
</div>
<div id="pic">
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="scriptmain" name="scriptmain" codebase="http://download.macromedia.com/pub/shockwave/cabs/
	flash/swflash.cab#version=6,0,29,0" width="24%" height="193">
        <param name="movie" value="images/lbxml.swf">
        <param name="quality" value="high">
        <param name="scale" value="noscale">
        <param name="LOOP" value="false">
        <param name="menu" value="false">
        <param name="wmode" value="transparent">
        <embed src="images/lbxml.swf" width="24%" height="193" loop="false" quality="high" pluginspage="http://www
		.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" salign="T" name="scriptmain"
               menu="false" wmode="transparent">
    </object>
</div>
<div id="rec">
    <h2>特别推荐</h2>
    <ul class="list-info">
        {foreach $getNewRecList(key,value)}
            <li><span>{@value->date}</span><a href="detail.php?id={@value->id}">{@value->title}</a></li>
        {/foreach}
    </ul>
</div>
<div id="sidebar-right">
    <div class="adver">
        <script type="text/javascript" src="js/sidebar_adver.js"></script>
    </div>
    <div class="hot">
        <h2>本月焦点</h2>
        <ul class="list-info">
            {foreach $getMonthHotList(key,value)}
                <li><span>{@value->date}</span><a href="detail.php?id={@value->id}">{@value->title}</a></li>
            {/foreach}
        </ul>
    </div>
    <div class="comm">
        <h2>本月评论</h2>
        <ul class="list-info">
            {foreach $getMonthHotComment(key,value)}
                <li><span>{@value->date}</span><a href="detail.php?id={@value->id}">{@value->title}</a></li>
            {/foreach}
        </ul>
    </div>
    <div class="vote">
        <h2>调查评论</h2>
        <h3>{$frontVoteTitle}</h3>
        <form action="index.php" method="post">
            {foreach $frontVoteItems(key,value)}
            <label><input type="radio" name="vote" value="{@value->id}"/>{@value->title}</label>
            {/foreach}
            <p>
                <input type="submit" value="投票" name="send"/>
                <input type="button" value="查看" name=""/>
            </p>
        </form>
    </div>
</div>

<div id="picnews">
    <h2>图文资讯</h2>
    {foreach $getPicList(key,value)}
        <dl>
            <dt><a href="detail.php?id={@value->id}"><img src="{@value->thumb}" alt="title"/></a></dt>
            <dd><a href="detail.php?id={@value->id}">{@value->title}</a></dd>
        </dl>
    {/foreach}
</div>

<div id="newslist">
    {foreach $FourNav(key,value)}
        <div class="{@value->class}">
            <h2><a href="list.php?id={@value->id}" target="_blank">更多</a>{@value->nav_name}</h2>
            <ul class="list-info">
                {for @value->list(key,value)}
                    <li><span>{@value->date}</span><a href="detail.php?id={@value->id}">{@value->title}</a></li>
                {/for}
            </ul>
        </div>
    {/foreach}
</div>

{include file="footer.tpl"}

</body>
</html>



