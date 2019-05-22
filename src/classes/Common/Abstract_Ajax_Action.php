<?php

namespace {{namespace}}\Common;

abstract class Abstract_Ajax_Action {
	use Hooker_Trait;
	
	abstract public function get_action_name ();

	public function add_hooks () {
		$this->add_action( 'wp_ajax_' . $this->get_action_name(), 'validate_request' );

		if ( $this->is_public() ) {
			$this->add_action( 'wp_ajax_nopriv_' . $this->get_action_name(), 'validate_request' );
		}
	}

	public function validate_request () {
		$this->validate_nonce();

		$method = $_SERVER['REQUEST_METHOD'];
		$callback = "handle_$method";

		if ( method_exists( $this,  $callback ) ) {
			$this->validate_nonce();
			$this->$callback();
		} else {
			$this->send_invalid_request_response();
		}
	}
	
	public function is_public () {
		return false;
	}

	public function handle_get () {
		$this->send_invalid_request_response();
	}
	
	public function handle_post () {
		$this->send_invalid_request_response();
	}
	
	public function handle_put () {
		$this->send_invalid_request_response();
	}
	
	public function handle_patch () {
		$this->send_invalid_request_response();
	}
	
	public function handle_delete () {
		$this->send_invalid_request_response();
	}
	
	public function send_invalid_request_response () {
		$this->send_json(
			null,
			__( 'Inválid request method.', '{{plugin_text_domain}}' ),
			405
		);
	}
	
	public function get_nonce_action () {
		return 'ajax_nonce_' . $this->get_action_name();
	}
	
	public function get_nonce_query_arg () {
		return '_ajax_nonce';
	}
	
	protected function validate_nonce () {
		\check_ajax_referer( $this->get_nonce_action(), $this->get_nonce_query_arg() );
	}

	protected function send_json ( $data, $error_message = '', $status_code = null ) {
		$response = [];

		if ( empty( $error_message ) ) {
			$status_code = $status_code ? $status_code : 200;
		} else {
			$status_code = $status_code ? $status_code : 400;
			$response['error_message'] = $error_message;
		}

		$response['success'] = $status_code >= 200 && $status_code < 300;
		$response['data'] = $data;
		$response['meta'] = [
			'status_code' => $status_code
		];

		\wp_send_json( $response, $status_code );
	}
}
