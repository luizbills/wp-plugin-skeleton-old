<?php
/**
 * @version 1.2.0
 */

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;

function config_set ( $key, $value ) {
	return Config::set( $key, $value );
}

function config_get ( $key, $default = null ) {
	return Config::get( $key, $default );
}

function prefix ( $string = '' ) {
	return Config::get( 'PREFIX' ) . $string;
}