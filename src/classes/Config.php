<?php

namespace {{namespace}};

use {{namespace}}\Utils\Immutable_Data_Store;
use Symfony\Component\Yaml\Yaml;
use function {{namespace}}\functions\slugify;
use function {{namespace}}\functions\snake_slugify;

class Config {
	protected static $options = null;

	public static function get_options () {
		if ( is_null( self::$options ) ) {
			self::$options = new Immutable_Data_Store();
		}
		return self::$options;
	}

	public static function setup ( $PLUGIN_FILE ) {
		if ( ! is_null( self::$options ) ) return;

		$options = self::get_options();
		$plugin_config = Yaml::parseFile( dirname( $PLUGIN_FILE ) . '/plugin.yml' );
		$plugin_slug = slugify( $plugin_config['PLUGIN_NAME'] );
		$plugin_prefix = snake_slugify( $plugin_slug ) . '_';

		foreach ( $plugin_config as $key => $value ) {
			$options->set( $key, $value );
		}

		$options->set( 'SLUG', $plugin_slug );
		$options->set( 'PREFIX', $plugin_prefix );
		$options->set( 'FILE', $PLUGIN_FILE );
		$options->set( 'DIR', dirname( $PLUGIN_FILE ) );
	}

	public static function set ( $key, $value ) {
		return self::get_options()->set( $key, $value );
	}

	public static function get ( $key, $default = null ) {
		if ( self::get_options()->has( $key ) ) {
			return self::get_options()->get( $key );
		}
		return $default;
	}
}
