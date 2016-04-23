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
	if(form.level_name.value.length<2 || form.level_name.value.length>20){
		alert('等级名不得小于2位不得大于20位');
		form.level_name.focus();
		return false;
	}
	if(form.level_info.value.length>200){
		alert('等级描述不得大于200位');
		form.level_info.focus();
		return false;
	}
	return true;
}


//验证add
function checkAddForm(){
	var form = document.add;
	if(form.level_name.value.length<2 || form.level_name.value.length>20){
		alert('等级名不得小于2位不得大于20位');
		form.level_name.focus();
		return false;
	}
	if(form.level_info.value.length>200){
		alert('等级描述不得大于200位');
		form.level_info.focus();
		return false;
	}
	return true;
};