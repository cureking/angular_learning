<?php
function get_list( $data_array )
{
	global $conn;

	// 读取评论列表
	$sql = "SELECT c.*,u.nickname AS logged_nickname
			FROM sn_comment c
			LEFT JOIN sn_userinfo u
			ON c.username=u.username
			ORDER BY udate DESC
			LIMIT 0,10";
	$rs = mysqli_query( $conn, $sql );
	if( !$rs ) err( mysqli_error( $conn ) );

	// 处理登录状态对应的用户名字
	$result = mysqli_fetch_all( $rs, MYSQLI_ASSOC );
	$result = array_map( 'parse_nickname', $result );

	echo json_encode( $result );
}

function parse_nickname( &$item )
{
	if( strlen( $item[ 'username' ] ) > 0 )
	{
		// 已登录用户
		$item[ 'nickname' ] = $item[ 'logged_nickname' ];
	}

	// 删除数组元素
	unset( $item[ 'loged_nickname' ] );

	return $item;
}

function add( $data_array )
{
	global $conn;

	$data = array();
	$data[ 'username' ] = post( 'username', $data_array );
	$data[ 'nickname' ] = post( 'nickname', $data_array );
	$data[ 'content' ] = post( 'content', $data_array );

	if( empty( $data[ 'username' ] ) )
	{
		// 若帐号为空，则代表游客评论
		$data[ 'username' ] = '';
	}

	if( empty( $data[ 'username' ] ) )
	{
		// 未登录用户
		if( empty( $data[ 'nickname' ] ) )
		{
			// 若昵称为空，则自动生成游客名称
			$data[ 'nickname' ] = '游客' . rand( 10000, 99999 );
		}
	}
	else
	{
		// 已登录用户
		$data[ 'nickname' ] = '';
	}

	if( empty( $data[ 'content' ] ) || strlen( $data[ 'content' ] ) < 10 )
	{
		err( '评论内容不能少于10个字符。' );
	}

	// 插入评论表
	$data[ 'udate' ] = time();
	$sql = insert_sql( 'sn_comment', $data );

	$rs = mysqli_query( $conn, $sql );
	if( !$rs ) err( mysqli_error( $conn ) );

	success( '评论提交成功', array( 'item' => $data ) );
}