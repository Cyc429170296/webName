//验证登录
function checkLogin() {
	var fm = document.login,
	    admin_user = fm.admin_user.value,
	    admin_pass = fm.admin_pass.value,
	    code = fm.code.value;
	
	if (admin_user == '' || admin_user.length < 2 || admin_user.length > 20) {
		alert('警告：用户名不得为空并且不得小于两位并且不得大于20位！');
		fm.admin_user.focus();
		return false;
	}
	if (admin_pass == '' || admin_pass.length < 6 ) {
		alert('警告：密码不得为空并且不得小于六位！');
		fm.admin_pass.focus();
		return false;
	}
	if (code.length != 4) {
		alert('警告：验证码必须为四位数！');
		fm.code.focus();
		return false;
	}
	return true;
}