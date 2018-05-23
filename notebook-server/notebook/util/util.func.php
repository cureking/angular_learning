<?php
/**
 * 页面跳转
 * @param string $url 需要跳转到的目标页面
 */
function redirect( $url )
{
	header( "Location: $url" );
	exit();
}

/**
 * 获取 REQUEST 指定数据
 * @param string $name
 * @param array  $source
 * @return string | null
 */
function request( $name, $source = null )
{
	$source = empty( $source ) ? $_REQUEST : $source;
	return isset( $source[ $name ] ) ? $source[ $name ] : null;
}

/**
 * 获取 POST 指定数据
 * @param string $name
 * @param array  $source
 * @return string | null
 */
function post( $name, $source = null )
{
	$source = empty( $source ) ? $_POST : $source;
	return isset( $source[ $name ] ) ? $source[ $name ] : null;
}

function success( $msg, $other_data = null )
{
	err( $msg, 0, $other_data );
}

/**
 * 向浏览器端返回错误提示
 * @param string $msg
 * @param int    $err_id
 * @param array  $other_data
 */
function err( $msg, $err_id = 1, $other_data = null )
{
	if( !is_string( $msg ) )
	{
		$msg = '';
	}

	$error = array(
		'err' => $err_id,
		'msg' => $msg
	);

	if( is_array( $other_data ) )
	{
		$error = array_merge_recursive( $error, $other_data );
	}

	echo json_encode( $error );
	die();
}