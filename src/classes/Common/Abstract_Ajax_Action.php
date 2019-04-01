<?php

namespace {{namespace}}\Common;

abstract class Abstract_Ajax_Action {
	use Hooker_Trait;

	public function add_hooks () {
		$this->add_action( 'wp_ajax_' . $this->get_action_name(), 'validate_request' );

		if ( $this->is_public() ) {
			$this->add_action( 'wp_ajax_nopriv_' . $this->get_action_name(), 'validate_request' );
		}
	}

	abstract public function get_action_name ();

	abstract public function callback ();
	
	public function get_accepted_methods () {
		return [ 'GET', 'POST' ];
	}
	
	public function get_nonce_action () {
		return 'ajax_nonce_' . $this->get_action_name();
	}
	
	public function get_nonce_query_arg () {
		return null; // default is _ajax_nonce or _wpnonce
	}

	public function is_public () {
		return false;
	}
	
	public function validate_nonce () {
		check_ajax_referer( $this->get_nonce_action() );
	}
	
	public function validate_request () {
		$this->validate_nonce();
		
		if ( ! in_array( $_SERVER['REQUEST_METHOD'], $this->get_accepted_methods() ) ) {
			$this->send_json( [], 405 );
		}
		
		$this->callback();
	}
	
	protected function send_json ( $data, $code = 200 ) {
		if ( $code >= 300 || $code < 200 ) {
			\wp_send_json_error( $data, $code );
		} else {
			\wp_send_json_success( $data, $code );
		}
	}
}
