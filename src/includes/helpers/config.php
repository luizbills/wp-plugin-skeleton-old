<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;

function config_set ( $key, $value ) {
	return Config::get_options()->set( $key, $value );
}

function config_get ( $key, $default = null ) {
	return Config::get_options()->get( $key, $default );
}