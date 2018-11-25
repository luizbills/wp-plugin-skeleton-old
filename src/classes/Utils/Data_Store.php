<?php

namespace {{namespace}}\Utils;

class Data_Store {
	protected $data = [];

	public function __construct ( $_values = [] ) {
		$values = array_merge( $this->get_defaults(), $_values );

		foreach ( $values as $key => $value) {
			$this->set( $key, $value );
		}

		$this->after_init();
	}
	
	protected function after_init () {}

	public function set ( $key, $value ) {
		$this->data[ $key ] = $value;
		return $this->data[ $key ];
	}

	public function get ( $key, $default = null ) {
		return isset( $this->data[ $key ] ) ? $this->data[ $key ] : $default;
	}

	public function has ( $key ) {
		return isset( $this->data[ $key ] );
	}

	public function delete ( $key ) {
		if ( isset( $this->data[ $key ] ) ) {
			unset( $this->data[ $key ] );
		}
	}

	public function get_defaults () {
		return [];
	}
}
