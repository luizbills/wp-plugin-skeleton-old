<?php
/**
 * Based on https://github.com/stevegrunwell/wp-cache-remember/tree/v1.1.1
 */

namespace {{namespace}}\functions;

function remember_cache ( $key, $callback, $expire = 0 ) {
	if ( \apply_filters( prefix( 'remember_cache_disabled' ), false, $key ) ) {
		log_info( "function remember_cache disabled for $key" );
		return $callback();
	}
	
	$key_suffix = \apply_filters( prefix( 'remember_cache_key_suffix' ), '_' . config_get( 'VERSION' ), $key );
	
	$transient_key .= $key_suffix;
	
	$cached = \get_transient( $transient_key );
	if ( false !== $cached ) {
		return $cached;
	}
	$value = $callback();
	if ( ! \is_wp_error( $value ) ) {
		\set_transient( $transient_key, $value, $expire );
	}

	return $value;
}

function forget_cache ( $key, $default = null ) {
	$cached = \get_transient( $key );
	if ( false !== $cached ) {
		\delete_transient( $key );
		return $cached;
	}
	return $default;
}
