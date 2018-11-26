<?php

namespace {{namespace}}\functions;

use {{namespace}}\Config;

function slugify ( $text ) {
	$sanitized_text = remove_accents( $text ); // Convert to ASCII
	// Standard replacements
	$invalid = [
		' ' => '-',
		'_' => '-',
	];
	$sanitized_text = str_replace( array_keys( $invalid ), array_values( $invalid ), $sanitized_text );
	$sanitized_text = preg_replace( '/[^A-Za-z0-9- ]/', '', $sanitized_text ); // Remove all non-alphanumeric except -
	$sanitized_text = preg_replace( '/-+/', '-', $sanitized_text ); // Replace any more than one - in a row
	$sanitized_text = preg_replace( '/-$/', '', $sanitized_text ); // Remove last - if at the end
	$sanitized_text = strtolower( $sanitized_text ); // Lowercase

	return $sanitized_text;
}

function get_asset_url ( $file_path ) {
	return plugins_url( Config::get( 'ASSETS_DIR' ) . '/' . $file_path, Config::get('FILE') );
}

function config_set ( $key, $value ) {
	return Config::get_options()->set( $key, $value );
}

function config_get ( $key, $default = null ) {
	return Config::get_options()->get( $key, $default );
}

function _log ( $data, $type ) {
	if ( defined( 'WP_DEBUG' ) && ! WP_DEBUG ) return;

	$data = is_array( $data ) ? $data : [ $data ];
	$message_parts = [];

	foreach( $data as $part ) {
		if ( is_object( $arg ) || is_array( $part ) ) {
			$message_parts[] = print_r( $part, true );
		} else {
			$message_parts[] = $part;
		}
	}

	$type = strtoupper( $type );
	$message = Config::get( 'FILE' ) . " $type: " . implode( ' ', $message_parts );
	
	error_log( $message );
}

function log_info () {
	_log( func_get_args(), 'info' );
}

function log_debug () {
	_log( func_get_args(), 'debug' );
}

function log_error () {
	_log( func_get_args(), 'error' );
}
