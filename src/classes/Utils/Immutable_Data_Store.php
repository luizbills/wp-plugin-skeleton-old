<?php
/**
 * @version 2.0.1
 */

namespace {{namespace}}\Utils;

use {{namespace}}\functions as h;

class Immutable_Data_Store extends Data_Store {

	public function set ( $key, $value ) {
		h\throw_if( $this->has( $key ), \Exception::class, "key \"$key\" already assigned" );
		return parent::set( $key, $value );
	}

	public function clear ( $key ) {
		throw new \Exception( 'Can not delete keys' );
	}
}

