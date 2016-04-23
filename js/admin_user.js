//选择头像
function sface(){
	form = document.update;
	var index = form.face.selectedIndex;
	form.faceimg.src = '../images/'+form.face.options[index].value;
}


//验证
function checkUpdate(){
	var form = document.update;
	//邮箱验证
	if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(form.email.value)){
		alert("邮箱格式不正确");
		form.email.value='';
		form.email.focus();
		return false;
	}
	return true;
};
