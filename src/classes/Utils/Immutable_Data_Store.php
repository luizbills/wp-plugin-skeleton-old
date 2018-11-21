<?php

namespace {{namespace}};

use {{namespace}}\Utils\Data_Store;

class Immutable_Data_Store extends Data_Store {

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
