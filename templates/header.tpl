<script type="text/javascript" src="config/static.php?type=header"></script>
<div id="top">
    {$header}
    <script type="text/javascript" src="js/text_adver.js"></script>
</div>
<div id="header">
    <h1><a href="###">hejunweimake</a></h1>
    <div class="adver">
        <script type="text/javascript" src="js/head_adver.js"></script>
    </div>
</div>
<div id="nav">
    <ul>
        <li><a href="./">首页</a></li>
        {if $FrontNav}
            {foreach $FrontNav(key,value)}
                <li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
            {/foreach}
        {/if}
    </ul>
</div>
<div id="search">
    <form action="search.php" method="get">
        <select name="type">
            <option select="selected" value="1">按标题搜索</option>
            <option value="2">按关键字搜索</option>
            <option value="3">全局查询</option>
        </select>
        <input type="text" name="q" class="text">
        <input type="submit" class="submit" value="搜索">
    </form>

    <strong>TAG标签：</strong>

    <ul>
        <li><a href="#">美女(3)</a></li>
        <li><a href="#">游戏(5)</a></li>
        <li><a href="#">基金(2)</a></li>
        <li><a href="#">音乐(3)</a></li>
        <li><a href="#">体育(2)</a></li>
        <li><a href="#">直播(2)</a></li>
        <li><a href="#">陕西(1)</a></li>
    </ul>
</div>



