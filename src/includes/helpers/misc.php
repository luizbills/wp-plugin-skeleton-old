<?php
/**
 * @version 1.0.2
 */

namespace {{namespace}}\functions;

function value ( $value, $default = '' ) {
	$result = is_callable( $value ) ? call_user_func( $value ) : $value;
	return empty( $result ) ? $default : $result;
}

function throw_if ( $condition, $exception, ...$parameters ) {
	if ( $condition ) {
		throw is_string( $exception ) ? new $exception( ...$parameters ) : $exception;
	}
	return $condition;
}
