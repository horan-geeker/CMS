window.onload=function(){
	var title = document.getElementById("title");
	var a = $('ul>li>a');
	for(i=0;i<a.length;i++){
		if(title.innerHTML == a[i].text)
			a[i].setAttribute('class','selected');
	}
};


function centerWindow(url,name,width,height){
	var left = (screen.width - width)/2;
	var top = (screen.height- height)/2-50;
	window.open(url,name,'width='+width+',height='+height+',top='+top+',left='+left);
};


//验证add content
function checkAddContent(){
	var form = document.content;
	if(form.title.value.length<2 || form.title.value.length>20){
		alert('标题不得小于2位不得大于20位');
		form.title.focus();
		return false;
	}
	if(form.nav.value == ''){
		alert('栏目不得为空');
		form.nav.focus();
		return false;
	}
	if(form.tag.value.length>30){
		alert('tag标签不得大于30位');
		form.tag.focus();
		return false;
	}
	if(form.keyword.value.length>30){
		alert('关键字不得大于30位');
		form.keyword.focus();
		return false;
	}
	if(form.source.value.length>30){
		alert('文章来源不得大于30位');
		form.source.focus();
		return false;
	}
	if(form.author.value.length>10){
		alert('作者名不得大于10位');
		form.tag.focus();
		return false;
	}
	if(form.info.value.length>200){
		alert('内容摘要不得大于200位');
		form.info.focus();
		return false;
	}
	if(CKEDITOR.instances.TextArea1.getData() == ''){
		alert('详细内容不得为空');
		CKEDITOR.instances.TextArea1.focus();
		return false;
	}
	if(isNaN(form.count.value)){
		alert('浏览次数必须是数字');
		form.count.focus();
		return false;
	}
	return true;
};
