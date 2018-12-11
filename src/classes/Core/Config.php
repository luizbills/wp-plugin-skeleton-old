<?php
/**
 * @version 2.1.0
 */

namespace {{namespace}}\Core;

use Symfony\Component\Yaml\Yaml;
use {{namespace}}\Utils\Immutable_Data_Store;
use function {{namespace}}\functions\slugify;
use function {{namespace}}\functions\snake_slugify;

class Config {
	protected static $options = null;

	public static function get_options () {
		if ( null === self::$options ) {
			self::$options = new Immutable_Data_Store();
		}
		return self::$options;
	}

	public static function setup ( $MAIN_FILE ) {
		if ( ! null === self::$options ) return;

		$root = \dirname( $MAIN_FILE );
		$plugin_config = Yaml::parseFile( $root . '/plugin.yml' );
		$plugin_slug = slugify( $plugin_config['NAME'] );
		$plugin_prefix = snake_slugify( $plugin_slug ) . '_';
		$options = self::get_options();

		$options->set( 'SLUG', $plugin_slug );
		$options->set( 'PREFIX', $plugin_prefix );
		$options->set( 'MAIN_FILE', $MAIN_FILE );
		$options->set( 'ROOT_DIR', $root );

		foreach ( $plugin_config as $key => $value ) {
			$options->set( $key, $value );
		}
	}

	public static function set ( $key, $value ) {
		return self::get_options()->set( $key, $value );
	}

	public static function get ( $key, $default = null ) {
		if ( self::get_options()->has( $key ) ) {
			return self::get_options()->get( $key );
		} elseif ( null === $default ) {
			throw new Exception("not found \"$key\""); 
		}
		return $default;
	}
}
