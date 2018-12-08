<?php
/**
 * @version 2.0.0
 */

namespace {{namespace}}\Utils;

class Immutable_Data_Store extends Data_Store {

	public function set ( $key, $value ) {
		if ( $this->has( $key ) ) {
			throw new \Exception( "key \"$key\" already assigned" );
		}
		return parent::set( $key, $value );
	}

	public function clear ( $key ) {
		throw new \Exception( 'Can not delete keys' );
	}
}

