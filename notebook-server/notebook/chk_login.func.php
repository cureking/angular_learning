<?php

/**
 * 验证当前访问的用户是否已登录
 * File: chk_login.func.hphp
 * User: AoSnow
 * Date: 2017-12-12 16:45
 */
function chk_login( $user = null )
{
	return isset( $_SESSION[ 'logged' ] ) && $_SESSION[ 'logged' ];
}