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

	var all=document.getElementById("all");
	var checkboxs=$('input').toArray();
	all.onclick=function(){
		for(var i=0;i<checkboxs.length;i++){
			if(checkboxs[i].type=='checkbox'){
				checkboxs[i].checked=1;
			}
		}
	};
};


//验证update
function checkUpdateForm(){
	var form = document.update;
	if(form.admin_pass.value!=''){
		if(form.admin_pass.value.length<6){
			alert('密码不得小于6位');
			form.admin_pass.focus();
			return false;
		}
	}
	return true;
}


//验证add
function checkAddForm(){
	var form = document.add;
	if(form.admin_user.value.length<2 || form.admin_user.value.length>20){
		alert('用户名不得小于2位不得大于20位');
		form.admin_user.focus();
		return false;
	}
	if(form.admin_pass.value.length<6){
		alert('密码不得小于6位');
		form.admin_pass.focus();
		return false;
	}
	if(form.admin_pass.value != form.admin_repass.value){
		alert('两次输入密码不一致');
		form.admin_pass.focus();
		return false;
	}
	return true;
}