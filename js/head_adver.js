/**
 * Created by he on 5/7/2016.
 */
/**
 * Created by He on 2016/5/3.
 */
var header=[];

header[1]={
    'title':'新浪进军微博大战',
    'pic':'images/header1.png',
    'link':'http://www.weibo.com',
};
text[2]={
    'title':'腾讯开始团购系统',
    'pic':'images/header2.png',
    'link':'http://www.qq.com',
};
text[3]={
    'title':'百度开始进军文献',
    'pic':'images/header3.png',
    'link':'http://www.baidu.com',
};
var i = Math.floor(Math.random()*3+1);
document.write('<a href="'+header[i].link+'"><img src="'+header[i].src+'"/>'+header[i].title+'</a>');