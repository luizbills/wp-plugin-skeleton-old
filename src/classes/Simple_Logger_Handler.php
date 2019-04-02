<?php

namespace {{namespace}};

use {{namespace}}\functions as h;
use {{namespace}}\Common\Hooker_Trait;

class Simple_Logger_Handler {
	use Hooker_Trait;

	public function add_hooks () {
		$this->add_filter( h\prefix( 'logger_enabled' ), 'is_enabled', 10, 2 );
		$this->add_action( h\prefix( 'handle_log' ), 'handle_log', 10, 3 );
	}
	
	public function is_enabled ( $result, $level ) {
		// check the $level variable to ingore some messages
		return WP_DEBUG && \defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG;
	}

	public function handle_log ( $message, $level, $timestamp ) {
		$level_label = config_get( "LOGGER_LEVEL_$level" );
		$plugin_slug = h\config_get( 'SLUG' );
		
		// most simple wordpress log example
		\error_log( "$plugin_slug.$level_label: $message" );
	}
}
