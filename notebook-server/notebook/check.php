<?php
require 'init.php';
//var_dump( $_REQUEST );
//var_dump( $_POST );
//var_dump( $_GET );

$user = $_POST[ 'username' ];
$pass = $_POST[ 'password' ];;

$result = array(
	'err' => null,
	'msg' => null
);

// 验证登录
if( $user == 'admin' && $pass == '123456' )
{
	//$_SESSION[ 'username' ] = $user;
	$_SESSION[ 'logged' ] = true;

	$result[ 'err' ] = 0;
	$result[ 'msg' ] = '登录成功!';
	$result[ 'chk' ] = $_SESSION[ 'logged' ];
}
else
{
	$result[ 'err' ] = 1;
	$result[ 'msg' ] = '帐号或密码错误!';
}

echo json_encode( $result );
