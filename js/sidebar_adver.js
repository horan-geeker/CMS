/**
 * Created by he on 5/7/2016.
 */
var sidebar=[];

sidebar[1]={
    'title':'新浪进军微博大战',
    'pic':'images/sidebar1.png',
    'link':'http://www.weibo.com',
};
sidebar[2]={
    'title':'腾讯开始团购系统',
    'pic':'images/sidebar2.png',
    'link':'http://www.qq.com',
};
sidebar[3]={
    'title':'百度开始进军文献',
    'pic':'images/sidebar3.png',
    'link':'http://www.baidu.com',
};
var i = Math.floor(Math.random()*3+1);
document.write('<a href="'+sidebar[i].link+'"><img src="'+sidebar[i].pic+'"/></a>');