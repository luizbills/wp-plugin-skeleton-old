<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\Common;

abstract class Abstract_Ajax_Action extends Abstract_Hooker {
	public function add_hooks () {
		$this->add_action( 'wp_ajax_' . $this->get_action_name(), 'callback' );
		
		if ( $this->is_public() ) {
			$this->add_action( 'wp_ajax_nopriv_' . $this->get_action_name(), 'callback' );
		}
	}

	public function callback () {
		// this should be implemented
		\wp_send_json_error(
			[
				'error' => 'Callback not implemented'
			],
			400
		);
	}
	
	public function get_action_name () {
		// this should be implemented
		return '';
	}
	
	public function is_public () {
		return false;
	}
}
