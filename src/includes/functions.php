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
	$sanitized_text = preg_replace( '/[^A-Za-z0-9-\. ]/', '', $sanitized_text ); // Remove all non-alphanumeric except .
	$sanitized_text = preg_replace( '/\.(?=.*\.)/', '', $sanitized_text ); // Remove all but last .
	$sanitized_text = preg_replace( '/-+/', '-', $sanitized_text ); // Replace any more than one - in a row
	$sanitized_text = str_replace( '-.', '.', $sanitized_text ); // Remove last - if at the end
	$sanitized_text = strtolower( $sanitized_text ); // Lowercase

	return $sanitized_text;
}

function get_asset_url ( $file_path ) {
	return plugins_url( Config::get( 'ASSETS_DIR' ) . '/' . $file_path, Config::get('FILE') );
}

function log () {
	if ( defined( 'WP_DEBUG' ) && ! WP_DEBUG ) return;

	$message_parts = [];

	foreach( func_get_args() as $arg ) {
		if ( is_object( $arg ) || is_array( $arg ) ) {
			$message_parts[] = print_r( $arg, true );
		} else {
			$message_parts[] = $arg;
		}
	}

	$message = implode( ' ', $message_parts );
	error_log( Config::get('FILE') . 'notice: ' . $message );
}