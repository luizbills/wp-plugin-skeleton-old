<?php

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;

function get_post ( $id, $post_type = 'post' ) {
	$post = \get_post( $id );
	if ( $post && $post_type === $post->post_type ) {
		return $post;
	}
	return false;
}

function user_has_role ( $role, $user_id = null ) {
	if ( empty( $user_id ) ) {
		$user_id = get_current_user_id();
	}

	$user = get_userdata( $user_id );

	if ( $user ) {
		/* works with Roles and Capabilities */
		return in_array( $role, (array) $user->roles ) || user_can( $user_id, $role );
	}

	return false;
}

function config_set ( $key, $value ) {
	return Config::get_options()->set( $key, $value );
}

function config_get ( $key, $default = null ) {
	return Config::get_options()->get( $key, $default );
}

function get_file_extension ( $path ) {
	return strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
}

function get_asset_url ( $file_path ) {
	return plugins_url( Config::get( 'ASSETS_DIR' ) . '/' . $file_path, Config::get('FILE') );
}

function get_template ( $template_path, $data = [] ) {
	ob_start();
	include Config::get( 'DIR' ) . '/' . Config::get( 'TEMPLATES_DIR' ) . '/' . $template_path;
	return ob_get_clean();
}

function include_template ( $template_path, $data = [] ) {
	echo get_template( $template_path, $data );
}

function create_path ( $path ) {
	if ( ! wp_mkdir_p( $path ) ) {
		throw new \Exception( "could not create $path" );
	}
	return false;
}

function slugify ( $text ) {
	$slug = remove_accents( $text ); // Convert to ASCII
	// Standard replacements
	$invalid = [
		' ' => '-',
		'_' => '-',
	];
	$slug = str_replace( array_keys( $invalid ), array_values( $invalid ), $slug );
	$slug = preg_replace( '/[^A-Za-z0-9-]/', '', $slug ); // Remove all non-alphanumeric except -
	$slug = preg_replace( '/-+/', '-', $slug ); // Replace any more than one - in a row
	$slug = preg_replace( '/-$/', '', $slug ); // Remove last - if at the end
	$slug = strtolower( $slug ); // Lowercase

	return $slug;
}

function snake_slugify ( $text ) {
	$snake_case = slugify( $text );
	$snake_case = str_replace( '-', '_', $snake_case );

	return $snake_case;
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

/* Internal Helpers */
function _log ( $args, $type = 'info' ) {
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
