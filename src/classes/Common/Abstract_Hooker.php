<?php

namespace {{namespace}}\Common;

abstract class Abstract_Hooker {

	protected function call_hook_function ( $hook_function, $hook, $callback, $priority = 10, $arguments = 1 ) {
		if ( ! is_callable( $callback ) ) {
			$callback = [ $this, $callback ];
		}
		$hook_function( $hook, $callback, $priority, $arguments );
	}

	public function add_action ( $hook, $callback, $priority = 10, $arguments = 1 ) {
		$this->call_hook_function( __FUNCTION__, $hook, $callback, $priority, $arguments );
	}

	public function remove_action ( $hook, $callback, $priority = 10, $arguments = 1 ) {
		$this->call_hook_function( __FUNCTION__, $hook, $callback, $priority, $arguments );
	}

	public function add_filter ( $hook, $callback, $priority = 10, $arguments = 1 ) {
		$this->call_hook_function( __FUNCTION__, $hook, $callback, $priority, $arguments );
	}

	public function remove_filter ( $hook, $callback, $priority = 10, $arguments = 1 ) {
		$this->call_hook_function( __FUNCTION__, $hook, $callback, $priority, $arguments );
	}
}
