<?php
/**
 * File: db.php
 * User: AoSnow
 * Date: 2017-12-13 16:11
 */

define( 'DB_HOST', '127.0.0.1' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', 'aosnow' );

$conn = @mysqli_connect( DB_HOST, DB_USER, DB_PASS );
!$conn && die( 'connect error.' );
mysqli_set_charset( $conn, 'utf8' );
mysqli_select_db( $conn, 'ds_notebook' );

function insert_sql( $tbl, $source )
{
	$files = array_keys( $source );
	$values = array_values( $source );

	//explode(); = split
	//implode(); = join
	$files = '(' . implode( ',', $files ) . ')';
	$values = '(\'' . implode( '\',\'', $values ) . '\')';

	return "INSERT INTO {$tbl} {$files} VALUES {$values}";
}
