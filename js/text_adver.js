/**
 * Created by He on 2016/5/3.
 */
var text = [];

text[1] = {
	'title': '新浪进军微博大战',
	'link': 'http://www.weibo.com',
};
text[2] = {
	'title': '腾讯开始团购系统',
	'link': 'http://www.qq.com',
};
text[3] = {
	'title': '百度开始进军文献',
	'link': 'http://www.baidu.com',
};
text[4] = {
	'title': '淘宝开始做云手机',
	'link': 'http://www.taobao.com',
};
text[5] = {
	'title': '360开始做安全',
	'link': 'http://www.360.cn',
};

var i = Math.floor(Math.random() * 5 + 1);
document.write('<a href="' + text[i].link + '">' + text[i].title + '</a> 　');
var j = Math.floor(Math.random() * 5 + 1);
while (1) {
	if (j != i) {
		document.write('<a href="' + text[j].link + '">' + text[j].title + '</a>');
		break;
	} else {
		j = Math.floor(Math.random() * 5 + 1);
	}
}
