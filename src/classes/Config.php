<?php

namespace {{namespace}};

use function {{namespace}}\functions\slugify;
use {{namespace}}\Utils\Immutable_Data_Store;
use Symfony\Component\Yaml\Yaml;

class Config extends Immutable_Data_Store {
	
	protected static $instance = null;
	
	protected function get_instance () {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public static function initialize ( $PLUGIN_FILE ) {
		$plugin_config = Yaml::parseFile( dirname( $PLUGIN_FILE ) . '/plugin.yml' );
		$plugin_name = $plugin_config['plugin_name'];
		$plugin_slug = slugify( $plugin_name );
		$plugin_prefix = \str_replace( '-', '_', $plugin_slug ) . '_';

		self::set( 'PLUGIN_NAME', $plugin_name );
		self::set( 'SLUG', $plugin_slug );
		self::set( 'PREFIX', $plugin_prefix );
		self::set( 'VERSION', $plugin_config['version'] );
		self::set( 'ASSETS_DIR', $plugin_config['assets_dir'] );
		self::set( 'TEMPLATES_DIR', $plugin_config['templates_dir'] );
		self::set( 'FILE', $PLUGIN_FILE );
		self::set( 'DIR', dirname( $PLUGIN_FILE ) );
	}
	
	public static function set ( $key, $value ) {
		self::get_instance()->set( $key, $value );
		return $value;
	}
	
	public static function get ( $key, $default = null ) {
		if ( self::get_instance()->has( $key ) ) {
			return self::get_instance()->get( $key )
		}
		return $default;
	}
}
