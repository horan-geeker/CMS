//验证登录
function checkLogin(){
	var form = document.login;
	if(form.admin_user.value==''||form.admin_user.value.length<2||form.admin_user.value.length>20){
		alert('用户名不得为空并且不能小于2位或大于20位');
		form.admin_user.focus();
		return false;
	}
	if(form.admin_pass.value==''||form.admin_pass.value.length<6){
		alert('密码不得为空并且不能小于6位');
		form.admin_pass.value='';
		form.admin_pass.focus();
		return false;
	}
	if(form.checkcode.value.length!=4){
		alert('验证码必须是4位');
		form.checkcode.focus();
		return false;
	}
	return true;
}