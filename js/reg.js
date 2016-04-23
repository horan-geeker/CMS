//选择头像
function sface(){
	form = document.reg;
	var index = form.face.selectedIndex;
	form.faceimg.src = 'images/'+form.face.options[index].value;
}


//验证注册
function checkReg(){
	var form = document.reg;
	if(form.user.value==''||form.user.value.length<2||form.user.value.length>20){
		alert('用户名不得为空并且不能小于2位或大于20位');
		form.user.focus();
		return false;
	}
	if(/[<>\'\"\ \　]/.test(form.user.value)){
		alert("用户名包含非法字符！");
		form.user.focus();
		return false;
	}
	if(form.pass.value==''||form.pass.value.length<6){
		alert('密码不得为空并且不能小于6位');
		form.pass.value='';
		form.pass.focus();
		return false;
	}
	if(form.pass.value!=form.repass.value){
		alert('密码和密码确认不一致');
		form.pass.value='';
		form.repass.value='';
		form.pass.focus();
		return false;
	}
	//邮箱验证
	if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(form.email.value)){
		alert("邮箱格式不正确");
		form.email.value='';
		form.email.focus();
		return false;
	}
	if(form.checkcode.value.length!=4){
		alert('验证码必须是4位');
		form.checkcode.focus();
		return false;
	}
	return true;
};


function checkLogin(){
	var form = document.login;
	if(form.user.value==''||form.user.value.length<2||form.user.value.length>20){
		alert('用户名不得为空并且不能小于2位或大于20位');
		form.user.focus();
		return false;
	}
	if(/[<>\'\"\ \　]/.test(form.user.value)){
		alert("用户名包含非法字符！");
		form.user.focus();
		return false;
	}
	if(form.pass.value==''||form.pass.value.length<6){
		alert('密码不得为空并且不能小于6位');
		form.pass.value='';
		form.pass.focus();
		return false;
	}
	if(form.checkcode.value.length!=4){
		alert('验证码必须是4位');
		form.checkcode.focus();
		return false;
	}
	return true;
}