<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

function value ( $value, $default = '' ) {
	$result = is_callable( $value ) ? $value() : $value;
	return empty( $result ) ? $default : $result;
}

function throw_if ( $condition, $exception, ...$parameters ) {
	if ( $condition ) {
		throw is_string( $exception ) ? new $exception( ...$parameters ) : $exception;
	}
	return $condition;
}
