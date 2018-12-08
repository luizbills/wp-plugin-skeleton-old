<?php
/**
 * @version 2.0.0
 */

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

// You must create your own log handler
// see: https://github.com/luizbills/wp-plugin-skeleton/blob/master/src/includes/hooks.php
function _handle_log ( $type, $message, $timestamp ) {
	do_action( Config::get( 'PREFIX' ) . 'handle_log', $message, $type, $timestamp );
}

function _is_logger_enabled () {
	$is_enabled = WP_DEBUG && defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG;
	return apply_filters( Config::get( 'PREFIX' ) . 'is_logger_enabled', $is_enabled );
}

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
	_handle_log( $message, $type, time() );
}
