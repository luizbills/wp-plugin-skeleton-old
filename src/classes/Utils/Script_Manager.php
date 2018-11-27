<?php

namespace {{namespace}}\Utils;

use {{namespace}}\Config;
use function {{namespace}}\functions\get_asset_url;

class Script_Manager {

	protected $global_script_dependencies = [];
	protected $global_style_dependencies = [];
	protected $scripts = [];
	protected $styles = [];

	public function __construct () {
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_enqueue_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
	}

	public function frontend_enqueue_scripts () {
		foreach ( $this->scripts as $args ) {
			if ( $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				$is_plugin_asset = false !== strpos( $args['src'], get_asset_url( '' ) );

				wp_enqueue_script(
					$is_plugin_asset ? $args['prefix'] . $args['handle'] : $args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['in_footer']
				);
			}
		}

		foreach ( $this->styles as $args ) {
			if ( $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				$is_plugin_asset = false !== strpos( $args['src'], get_asset_url( '' ) );

				wp_enqueue_style(
					$is_plugin_asset ? $args['prefix'] . $args['handle'] : $args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['media']
				);
			}
		}
	}

	public function admin_enqueue_scripts () {
		foreach ( $this->scripts as $args ) {
			if ( ! $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				$is_plugin_asset = false !== strpos( $args['src'], get_asset_url( '' ) );

				wp_enqueue_script(
					$is_plugin_asset ? $args['prefix'] . $args['handle'] : $args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['in_footer']
				);
			}
		}

		foreach ( $this->styles as $args ) {
			if ( ! $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				$is_plugin_asset = false !== strpos( $args['src'], get_asset_url( '' ) );

				wp_enqueue_style(
					$is_plugin_asset ? $args['prefix'] . $args['handle'] : $args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['media']
				);
			}
		}
	}

	public function enqueue_script ( $src, $args = [] ) {
		$args['src'] = $src;
		$this->enqueue( 'script', $args );
	}

	public function enqueue_style ( $src, $args = [] ) {
		$args['src'] = $src;
		$this->enqueue( 'style', $args );
	}

	public function add_global_script_dependency ( $handle ) {
		$this->global_script_dependencies[] = $handle;
	}

	public function add_global_style_dependency ( $handle ) {
		$this->global_script_dependencies[] = $handle;
	}

	protected function enqueue ( $type, $args ) {
		$get_defaults = "get_${type}_defaults";
		$suffix = [
			'script' => '.js',
			'style' => '.css'
		];
		$args = array_merge( $this->$get_defaults(), $args );

		if ( empty( $args['deps'] ) ) {
			$args['deps'] = [];
		}

		if ( empty( $args['handle'] ) ) {
			$args['handle'] = basename( $args['src'], $suffix[ $type ] );
		}

		if ( 'script' === $type ) {
			$args['deps'] = array_merge( $args['deps'], $this->global_script_dependencies );
			$this->scripts[] = $args;
		} elseif ( 'style' === $type ) {
			$args['deps'] = array_merge( $args['deps'], $this->global_style_dependencies );
			$this->styles[] = $args;
		}
	}

	protected function get_script_defaults () {
		$defaults = $this->get_defaults();
		$defaults['in_footer'] = true;
		$defaults['deps'] = [];
		return $defaults;
	}


	protected function get_style_defaults () {
		$defaults = $this->get_defaults();
		$defaults['media'] = 'all';
		$defaults['deps'] = [];
		return $defaults;
	}

	protected function get_defaults () {
		return [
			'handle' => '',
			'src' => '',
			'version' => Config::get( 'VERSION' ),
			'in_admin' => false,
			'condition' => null,
			'prefix' => Config::get( 'PREFIX' ),
		];
	}
}
