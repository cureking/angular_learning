<?php
function add_user( $data_array )
{
	global $conn;

	$data = array();
	$data[ 'username' ] = post( 'username', $data_array );
	$data[ 'password' ] = post( 'password', $data_array );
	$data[ 'repass' ] = post( 'repass', $data_array );
	$data[ 'gender' ] = post( 'gender', $data_array );
	$data[ 'birthday' ] = post( 'birthday', $data_array );
	$data[ 'nickname' ] = post( 'nickname', $data_array );
	$data[ 'email' ] = post( 'email', $data_array );
	$data[ 'hobby' ] = post( 'hobby', $data_array );

	if( empty( $data[ 'username' ] ) )
	{
		err( '帐号不能为空' );
	}

	if( empty( $data[ 'password' ] ) || $data[ 'password' ] != $data[ 'repass' ] )
	{
		err( '密码不能为空，且必须与确认密码一致' );
	}

	if( !empty( $data[ 'birthday' ] )
		&& !preg_match( '/^\d{4}-\d{2}-\d{2}$/', $data[ 'birthday' ] ) )
	{
		err( '生日日期格式不正确' );
	}

	$data[ 'cdate' ] = time();

	// 插入帐号表
	$sql = insert_sql( 'sn_user', array(
		'username' => $data[ 'username' ],
		'password' => $data[ 'password' ],
		'cdate'    => time()
	) );

	$rs = mysqli_query( $conn, $sql );
	if( !$rs ) err( mysqli_error( $conn ) );

	// 插入个人信息表
	$sql = insert_sql( 'sn_userinfo', array(
		'username' => $data[ 'username' ],
		'nickname' => $data[ 'nickname' ],
		'email'    => $data[ 'email' ],
		'gender'   => $data[ 'gender' ],
		'birthday' => $data[ 'birthday' ],
		'hobby'    => $data[ 'hobby' ],
		'udate'    => time()
	) );

	$rs = mysqli_query( $conn, $sql );
	if( !$rs ) err( mysqli_error( $conn ) );

	// 提示操作成功
	success( '帐号注册成功' );
}