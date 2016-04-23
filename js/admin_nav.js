window.onload=function(){
	var level = document.getElementById("level");
	if(level){
		var option = document.getElementsByTagName("option");
		option[level.value-1].setAttribute('selected','selected');
	}
	
	var title = document.getElementById("title");
	var a = $('ul>li>a');
	for(i=0;i<a.length;i++){
		if(title.innerHTML == a[i].text)
			a[i].setAttribute('class','selected');
	}
};


//前端字段提交验证
function checkForm(){
	var form = document.add;
	if(form.nav_name.value==''||form.nav_name.value.length<2||form.nav_name.value.length>20){
		alert('导航名不得为空并且不能小于2位或大于20位');
		form.nav_name.focus();
		return false;
	}
	if(form.nav_info.value==''||form.nav_info.value.length>200){
		alert('导航描述不得为空并且不能大于200位');
		form.nav_info.value='';
		form.nav_info.focus();
		return false;
	}
	return true;
};