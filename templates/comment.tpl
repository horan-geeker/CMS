<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" type="text/css" href="style/basic.css" />
    <link rel="stylesheet" type="text/css" href="style/comment.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><!--{webname}--></title>

    <script type="text/javascript" src="config/static.php?id={$id}&type=detail"></script>
</head>
<body>
{include file="header.tpl"}
<div id="comment">
    <h2>评论列表</h2>
    {if $AllComment}
    {foreach $AllComment(key,value)}
    <dl>
        <dt><img src="images/{@value->face}" alt="游客"/></dt>
        <dd><em>{@value->date} 发表</em> <span>[{@value->user}]</span></dd>
        <dd class="info">【{@value->manner}】{@value->content}</dd>
        <dd class="button"><a href="#">[0]支持</a> <a href="#"> [0]反对</a></dd>
    </dl>
    {/foreach}
    {else}
        <dl>
            <dd>此文档没有任何评论</dd>
        </dl>
    {/if}
    <div id="page">{$page}</div>
</div>
<div id="sidebar">
    <h2>热评文档</h2>
    <ul class="list-info">
        <li><span>06-12</span><a href="#">习近平签署第四十三号主席令</a></li>
        <li><span>04-30</span><a href="#">李克强答问结束 记者:加油</a></li>
        <li><span>07-22</span><a href="#">印尼警方击毙两名中国籍武装分子</a></li>
        <li><span>02-11</span><a href="#">广东落马领导庭审自辩:女儿收钱坑爹</a></li>
        <li><span>03-07</span><a href="#">李肇星在印度出席会议因"台独"问题离席</a></li>
        <li><span>03-12</span><a href="#">目击者回应"女子被骂中国猪"</a></li>
        <li><span>01-01</span><a href="#">上海两千人为阿迪达斯新鞋连夜排队</a></li>
    </ul>
</div>
<div class="comment">
    <h2><a href="comment.php?action=show&cid={$cid}" target="_blank">已有<span>220</span>人参与评论</a>最新评论</h2>
    <form method="post" action="comment.php?cid={$cid}&action=comment" name="comment">
        <p class="attitude">你对本文的看法:<input type="radio" name="manner" value="1" />支持
            <input type="radio" name="manner" value="0" />中立
            <input type="radio" name="manner" value="-1" />反对
        </p>
        <p><textarea name="content"></textarea></p>
        <p>验证码：<input type="text" name="checkcode" class="code" /><img class="imgcode" src="config/code.php" onclick="javascript:this.src='../config/code.php?tm='+Math.random();"/></p>
        <p class="red">请遵守互联网法规，对自己的言论负责</p>
        <br/>
        <p><input type="submit" value="提交评论" name="send" onclick="return checkComment();" /></p>
    </form>
</div>
{include file="footer.tpl"}

</body>
</html>



