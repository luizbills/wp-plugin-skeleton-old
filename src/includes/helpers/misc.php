<?php
/**
 * @version 1.2.0
 */

namespace {{namespace}}\functions;

function value ( $value, $default = '' ) {
	$result = is_callable( $value ) ? call_user_func( $value ) : $value;
	return empty( $result ) ? $default : $result;
}

// returns a value of a global array if it exists or an empty string
// example: request_value( 'PATH', 'server' ) returns $_SERVER['PATH']
function request_value ( $key, $type = 'get' ) {
	$array = $GLOBALS[ '_' . strtoupper( $type ) ];
	return array_get( $array, $key, '' );
}

function throw_if ( $condition, $exception, ...$parameters ) {
	if ( $condition ) {
		throw is_string( $exception ) ? new $exception( ...$parameters ) : $exception;
	}
	return $condition;
}
