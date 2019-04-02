<?php

namespace {{namespace}}\functions;

// You must to create your own log handler
// see: https://github.com/luizbills/wp-plugin-skeleton/blob/master/src/classes/Simple_Logger_Handler.php

// logger constants
\add_action( 'plugins_loaded', function () {
	config_set( 'LOGGER_LEVEL_0', 'DEBUG' );
	config_set( 'LOGGER_LEVEL_1', 'INFO' );
	config_set( 'LOGGER_LEVEL_2', 'NOTICE' );
	config_set( 'LOGGER_LEVEL_3', 'WARNING' );
	config_set( 'LOGGER_LEVEL_4', 'ERROR' );
	config_set( 'LOGGER_LEVEL_5', 'CRITICAL' );
	config_set( 'LOGGER_LEVEL_6', 'ALERT' );
	config_set( 'LOGGER_LEVEL_7', 'EMERGENCY' );
} );

// logger helpers
function log_debug () {
	_log( \func_get_args(), 0 );
}

function log_info () {
	_log( \func_get_args(), 1 );
}

function log_notice () {
	_log( \func_get_args(), 2 );
}

function log_warn () {
	_log( \func_get_args(), 3 );
}

function log_error () {
	_log( \func_get_args(), 4 );
}

function log_critical () {
	_log( \func_get_args(), 5 );
}

function log_alert () {
	_log( \func_get_args(), 6 );
}

function log_emergency () {
	_log( \func_get_args(), 7 );
}

// Internal logger functions
function _log ( $args, $level ) {
	$is_enabled = \apply_filters( prefix( 'logger_enabled' ), \WP_DEBUG, $level );
	if ( $is_enabled ) { 
		$args = \is_array( $args ) ? $args : [ $args ];
		$message = '';
		foreach( $args as $arg ) {
			if ( null === $arg ) {
				$message .= 'Null';
			}
			elseif ($arg instanceof \DateTimeInterface) {
				$message .= $arg->format(\DateTime::RFC3339);
			}
			elseif ( \is_bool( $arg ) ) {
				$message .= $arg ? 'True' : 'False';
			}
			elseif ( ! \is_string( $arg ) ) {
				$message .= print_r( $arg, true );
			}
			else {
				$message .= $arg;
			}
			$message .= ' ';
		}
		\do_action( prefix( 'handle_log' ), $message, $level, \time() );
	}
}
