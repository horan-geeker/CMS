<script type="text/javascript" src="config/static.php?type=header"></script>
<div id="top">
	<?php echo $this->_vars['header'];?>
	<a href="#" class="adv">这里可以放置文字广告1</a>
	<a href="#" class="adv">这里可以放置文字广告2</a>
</div>
<div id="header">
	<h1><a href="###">hejunweimake</a></h1>
	<div class="adver">
		<a href="#"><img src="images/adver.png" alt="advertisment" /></a>
	</div>
</div>
<div id="nav">
	<ul>
		<li><a href="./">首页</a></li>
		<?php if($this->_vars['FrontNav']){?>
		<?php foreach($this->_vars['FrontNav'] as $key=>$value){?>
		<li><a href="list.php?id=<?php echo $value->id;?>"><?php echo $value->nav_name;?></a></li>
		<?php }?>
		<?php }?>
	</ul>
</div>
<div id="search">
	<form>
		<select name="search">
			<option select="selected">按标题搜索</option>
			<option>按关键字搜索</option>
			<option>全局查询</option>
		</select>
		<input type="text" name="keyword" class="text" />
		<input type="submit" name="send" class="submit" value="搜索" />
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



