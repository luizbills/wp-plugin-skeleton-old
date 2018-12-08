<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

function remember_cache ( $key, $callback, $expire = 0 ) {
	$cached = get_transient( $key );
	if ( false !== $cached ) {
		return $cached;
	}
	$value = $callback();
	if ( ! is_wp_error( $value ) ) {
		set_transient( $key, $value, $expire );
	}
	return $value;
}

function forget_cache ( $key, $default = null ) {
	$cached = get_transient( $key );
	if ( false !== $cached ) {
		delete_transient( $key );
		return $cached;
	}
	return $default;
}