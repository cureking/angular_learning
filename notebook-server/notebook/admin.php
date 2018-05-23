<?php
require 'init.php';
require 'chk_login.func.php';
require 'util.func.php';

require 'db.php';

if( !chk_login() )
{
	redirect( 'login.php' );
}

$user = 'root2';
$pass = 'aosnow';
$time = time();

//$userinfo = array(
//	'root'   => array(
//		'gender' => '1',
//		'header' => '1.gif',
//		'email'  => 'root@yeah.net',
//		'udate'  => ''
//	),
//	'root2'  => array(
//		'gender' => '0',
//		'header' => '2.gif',
//		'email'  => 'root2@yeah.net',
//		'udate'  => ''
//	),
//	'aosnow' => array(
//		'gender' => '1',
//		'header' => '1.gif',
//		'email'  => 'aosnow@yeah.net',
//		'udate'  => ''
//	)
//);
//
//// 遍历插入
//foreach( $userinfo as $username => $data )
//{
//	// 如果时间值为空，用当前时间替代
//	if( empty( $data[ 'udate' ] ) )
//	{
//		$data[ 'udate' ] = time();
//	}
//
//	$files = array_keys( $data );
//	$values = array_values( $data );
//
//	array_unshift( $files, 'username' );
//	array_unshift( $values, $username );
//
//	//explode(); = split
//	//implode(); = join
//	$files = '(' . implode( ',', $files ) . ')';
//	$values = '(\'' . implode( '\',\'', $values ) . '\')';
//
//	var_dump( $files );
//	var_dump( $values );
//
//	$sql = "INSERT INTO sn_userinfo
//			{$files}
//			VALUES
//			{$values}";
//	$rs = mysqli_query( $conn, $sql );
//	var_dump( mysqli_error( $conn ) );
//}

// 插入数据
//$sql = "INSERT INTO sn_user
//		(username,password,`cdate`)
//		VALUES
//		('$user','$pass','$time')";

// 查找全部
//$sql = "SELECT * FROM sn_user";

// 查找排序
//$sql = "SELECT * FROM sn_user ORDER BY cdate DESC";

// 查找排序和限制数量
//$sql = "SELECT * FROM sn_user ORDER BY cdate DESC LIMIT 0,10";

// 查找排序和限制数量
//$sql = "SELECT count(*) AS size FROM sn_user ORDER BY cdate DESC LIMIT 0,10";

// 查找条件
$sql = "SELECT 
u.*,ui.gender,ui.email
FROM sn_user AS u
LEFT JOIN sn_userinfo AS ui ON ui.username=u.username
WHERE u.username='aosnow'";
//$sql = "SELECT id FROM sn_user WHERE username='aosnow' AND password='aosnow'";
$rs = mysqli_query( $conn, $sql );

// 查询结果数量
var_dump( mysqli_num_rows( $rs ) );

// 遍历集合
while( $row = mysqli_fetch_assoc( $rs ) )
{
	var_dump( $row );
	var_dump( date( 'Y-m-d H:i:s', $row[ 'cdate' ] ) );
	echo '<hr>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>admin - index</title>
</head>
<body>
	<?php
	echo( mysqli_error( $conn ) );
	?>
</body>
</html>