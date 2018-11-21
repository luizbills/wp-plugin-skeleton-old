<?php

namespace {{namespace}}\Utils;

use {{namespace}}\Utils\Abstract_Data_Store;

class Immutable_Data_Store extends Abstract_Data_Store {

	public function set ( $key, $value ) {
		if ( $this->has( $key ) ) {
			throw new \Exception( "key \"$key\" already assigned" );
		}
		parent::set( $key, $value );
	}

	public function delete ( $key ) {
		throw new \Exception( 'Can not delete keys' );
	}
}

