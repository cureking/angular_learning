<?php

require_once 'util/util.func.php';
require_once 'db.php';

header( "Access-Control-Allow-Origin:*" );
header( 'Access-Control-Allow-Methods:POST' );
header( 'Access-Control-Allow-Headers:x-requested-with,content-type' );

$api = request( 'api' );
$file_name = "./api/api_{$api}.php";

if( file_exists( $file_name ) )
{
	include $file_name;

	$action = post( 'action' );

	if( function_exists( $action ) )
	{
		call_user_func( $action, $_POST );
	}
}
