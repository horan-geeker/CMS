window.onload=function(){
	var title = document.getElementById("title");
	var a = $('ul>li>a');
	for(i=0;i<a.length;i++){
		if(title.innerHTML == a[i].text)
			a[i].setAttribute('class','selected');
	}
};


//验证update
function checkUpdateForm(){
	var form = document.update;
	if(form.title.value.length<2 || form.vote_name.value.length>20){
		alert('名称不得小于2位不得大于20位');
		form.title.focus();
		return false;
	}
	if(form.info.value.length>200){
		alert('描述不得大于200位');
		form.vote_info.focus();
		return false;
	}
	return true;
}


//验证add
function checkAddForm(){
	var form = document.add;
	if(form.vote_name.value.length<2 || form.vote_name.value.length>20){
		alert('等级名不得小于2位不得大于20位');
		form.vote_name.focus();
		return false;
	}
	if(form.vote_info.value.length>200){
		alert('等级描述不得大于200位');
		form.vote_info.focus();
		return false;
	}
	return true;
}