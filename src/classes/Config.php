<?php

namespace {{namespace}};

use function {{namespace}}\functions\slugify;
use Symfony\Component\Yaml\Yaml;

final class Config {

	const PREFIX_IMMUTABLE = 'const__';
	const PREFIX_MUTABLE = 'var__';

	protected static $data = [];

	protected function __construct () {}

	public static function setup ( $FILE ) {
		$plugin_config = Yaml::parseFile( dirname( $FILE ) . '/plugin.yml' );

		$plugin_name = $plugin_config['plugin_name'];
		$plugin_slug = slugify( $plugin_name );
		$plugin_prefix = \str_replace( '-', '_', $plugin_slug ) . '_';

		Config::set( 'PLUGIN_NAME', $plugin_name );
		Config::set( 'SLUG', $plugin_slug );
		Config::set( 'PREFIX', $plugin_prefix );
		Config::set( 'VERSION', $plugin_config['version'] );
		Config::set( 'ASSETS_DIR', $plugin_config['assets_dir'] );
		Config::set( 'TEMPLATES_DIR', $plugin_config['templates_dir'] );
		Config::set( 'FILE', $_FILE );
		Config::set( 'DIR', dirname( $_FILE ) );
	}

	public static function set ( $key, $value, $immutable = true ) {
		$prefix = $immutable ? self::PREFIX_IMMUTABLE : self::PREFIX_MUTABLE;
		$_key = $prefix . $key;

		if ( isset( self::$data[ self::PREFIX_IMMUTABLE . $key ] ) ) {
			throw new \Error( "Config $key has already been declared" );
		}
		self::$data[ $_key ] = $value;

		return $value;
	}

	public static function get ( $key, $default = null ) {
		$value = $default;
		if ( isset( self::$data[ self::PREFIX_IMMUTABLE . $key ] ) ) {
			$value = self::$data[ self::PREFIX_IMMUTABLE . $key ];
		}
		if ( isset( self::$data[ self::PREFIX_MUTABLE . $key ] ) ) {
			$value = self::$data[ self::PREFIX_MUTABLE . $key ];
		}
		return $value;
	}
}