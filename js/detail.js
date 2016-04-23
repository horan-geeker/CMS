//验证评论
function checkComment(){
	var form = document.comment;
	if(form.content.value==''||form.content.value.length<2||form.user.content.length>255){
		alert('评论内容不得为空并且不能小于2位或大于255位');
		form.content.focus();
		return false;
	}
	if(form.checkcode.value.length!=4){
		alert('验证码必须是4位');
		form.checkcode.focus();
		return false;
	}
	return true;
};
