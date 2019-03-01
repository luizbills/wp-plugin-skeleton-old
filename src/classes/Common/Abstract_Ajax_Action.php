<?php

namespace {{namespace}}\Common;

abstract class Abstract_Ajax_Action {
	use Hooker_Trait;

	public function add_hooks () {
		$this->add_action( 'wp_ajax_' . $this->get_action_name(), 'callback' );

		if ( $this->is_public() ) {
			$this->add_action( 'wp_ajax_nopriv_' . $this->get_action_name(), 'callback' );
		}
	}

	abstract public function get_action_name ();

	abstract public function callback ();

	public function is_public () {
		return false;
	}
}
