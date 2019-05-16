<?php

namespace {{namespace}}\functions;

function value ( $value, $default = '' ) {
	$result = is_callable( $value ) ? call_user_func( $value ) : $value;
	return empty( $result ) ? $default : $result;
}

// returns a value of a global array if it exists or an empty string
// example: request_value( 'foo', 'post' ) returns $_POST['foo']
function request_value ( $key, $type = '' ) {
	if ( empty( $type ) ) $type = $_SERVER['REQUEST_METHOD'];
	$array = $GLOBALS[ '_' . strtoupper( $type ) ];
	return array_get( $array, $key, '' );
}

function throw_if ( $condition, $exception, ...$parameters ) {
	if ( $condition ) {
		if ( empty( $exception ) ) {
			$exception = \apply_filters( prefix( 'default_exception' ), \Exception::class, $parameters );
		}
		if ( ! empty( $parameters ) ) {
			$parameters = \apply_filters( prefix( 'exception_parameters' ), $parameters, $exception );
		}
		throw is_string( $exception ) ? new $exception( ...$parameters ) : $exception;
	}
	return $condition;
}

function maybe_define ( $key, $value = true ) {
	if ( ! defined( $key ) ) {
		define( $key, $value );
	}
}

function get_constant ( $key, $default = '' ) {
	if ( defined( $key ) ) {
		return constant( $key );
	}
	return $default;
}
