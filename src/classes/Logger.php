<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}};

use function {{namespace}}\functions\config_get;

class Logger extends Common\Abstract_Hooker {

	public function handle_log ( $message, $type, $timestamp ) {
		$type = strtoupper( $type );
		$plugin_slug = config_get( 'SLUG' );

		error_log( "$plugin_slug.$type: $message" );
	}

	public function is_enabled ( $is_enabled ) {
		return WP_DEBUG && defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG;
	}
}
