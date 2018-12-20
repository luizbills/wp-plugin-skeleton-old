<?php
/**
 * @version 1.3.0
 */

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;
use {{namespace}}\Utils\Asset_Manager;

function config_set ( $key, $value ) {
	return Config::set( $key, $value );
}

function config_get ( $key, $default = null ) {
	return Config::get( $key, $default );
}

function prefix ( $string = '' ) {
	return Config::get( 'PREFIX' ) . $string;
}

function assets ( $string = '' ) {
	$assets = Config::get( '$assets', false );
	if ( false === $assets ) {
		$assets = Config::set( '$assets', new Asset_Manager() );
		$assets->add_hooks();
	}
	return $assets;
}
