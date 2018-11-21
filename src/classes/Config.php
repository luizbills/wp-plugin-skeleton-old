<?php

namespace {{namespace}};

use function {{namespace}}\functions\slugify;
use {{namespace}}\Utils\Immutable_Data_Store;
use Symfony\Component\Yaml\Yaml;

class Config extends Immutable_Data_Store {

	protected static $instance = null;

	public function get_instance () {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function initialize ( $PLUGIN_FILE ) {
		$config = self::get_instance();

		$plugin_config = Yaml::parseFile( dirname( $PLUGIN_FILE ) . '/plugin.yml' );
		$plugin_name = $plugin_config['plugin_name'];
		$plugin_slug = slugify( $plugin_name );
		$plugin_prefix = \str_replace( '-', '_', $plugin_slug ) . '_';

		$config->set( 'PLUGIN_NAME', $plugin_name );
		$config->set( 'SLUG', $plugin_slug );
		$config->set( 'PREFIX', $plugin_prefix );
		$config->set( 'VERSION', $plugin_config['version'] );
		$config->set( 'ASSETS_DIR', $plugin_config['assets_dir'] );
		$config->set( 'TEMPLATES_DIR', $plugin_config['templates_dir'] );
		$config->set( 'FILE', $PLUGIN_FILE );
		$config->set( 'DIR', dirname( $PLUGIN_FILE ) );
	}
}
