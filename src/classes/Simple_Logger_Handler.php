<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}};

use {{namespace}}\functions as h;

class Simple_Logger_Handler extends Common\Abstract_Hooker {

	public function handle_log ( $message, $type, $timestamp ) {
		if ( ! $this->is_enabled() ) return;

		$type = \strtoupper( $type );
		$plugin_slug = h\config_get( 'SLUG' );

		\error_log( "$plugin_slug.$type: $message" );
	}

	public function is_enabled () {
		return WP_DEBUG && \defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG;
	}
}