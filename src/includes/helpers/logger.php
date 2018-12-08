<?php

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;

function log_info () {
	_log( func_get_args(), 'info' );
}

function log_debug () {
	_log( func_get_args(), 'debug' );
}

function log_error () {
	_log( func_get_args(), 'error' );
}

/* Internal Helpers */
function _log ( $args, $type ) {
	if ( ! _is_logger_enabled() ) return;
	$args = is_array( $args ) ? $args : [ $args ];
	$message = '';
	foreach( $args as $arg ) {
		if ( null === $arg ) {
			$message .= 'Null';
		}
		elseif ( is_bool( $arg ) ) {
			$message .= $arg ? 'True' : 'False';
		}
		elseif ( ! is_string( $arg ) ) {
			$message .= print_r( $arg, true );
		} else {
			$message .= $arg;
		}
		$message .= ' ';
	}
	_handle_log( $type, $message, time() );
}

function _handle_log ( $type, $message, $timestamp ) {
	$type = strtoupper( $type );
	$plugin_slug = Config::get( 'SLUG' );
	// default log handler
	error_log( "$plugin_slug.$type: $message" );
}

function _is_logger_enabled () {
	return WP_DEBUG && defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG;
}