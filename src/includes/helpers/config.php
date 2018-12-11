<?php
/**
 * @version 1.0.1
 */

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;

function config_set ( $key, $value ) {
	return Config::set( $key, $value );
}

function config_get ( $key, $default = null ) {
	return Config::get( $key, $default );
}
