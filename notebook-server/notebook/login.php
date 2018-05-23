<?php
require 'init.php';
require 'chk_login.func.php';
require 'util/util.func.php';

if( chk_login() )
{
	//	var_dump( $_SESSION );
	//	exit();
	redirect( 'admin.php' );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login</title>
</head>
<body>
	<form action="check.php?rnd=187341" method="post">
		<input type="text" id="username" name="username" placeholder="用户名" value="admin">
		<input type="password" id="password" name="password" placeholder="密码" value="123456">
		<button>立即登录</button>
	</form>
</body>
</html>