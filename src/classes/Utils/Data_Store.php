<?php

namespace {{namespace}};

abstract class Data_Store {
	protected $data = [];

	public function __construct ( $_values = [] ) {
		$values = array_merge( $this->get_defaults(), $_values );

		foreach ( $values as $key => $value) {
			$this->set( $key, $value );
		}

		$this->init();
	}
	
	protected function init () {}

	public function set ( $key, $value ) {
		$this->data[ $key ] = $value;
	}

	public function get ( $key ) {
		return isset( $this->data[ $key ] ) ? $this->data[ $key ] : '';
	}

	public function has ( $key ) {
		return isset( $this->data[ $key ] );
	}

	public function delete ( $key ) {
		if ( isset( $this->data[ $key ] ) ) {
			unset ( $this->data[ $key ] );
		}
	}

	public function get_defaults () {
		return [];
	}
}
