<?php

namespace {{namespace}}\Utils;

use {{namespace}}\Config;

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
		foreach ( $scripts as $args ) {
			if ( $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				wp_enqueue_script(
					$args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['in_footer']
				);
			}
		}

		foreach ( $styles as $args ) {
			if ( $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				wp_enqueue_style(
					$args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['media']
				);
			}
		}
	}

	public function admin_enqueue_scripts () {
		foreach ( $scripts as $args ) {
			if ( ! $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				wp_enqueue_script(
					$args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['in_footer']
				);
			}
		}

		foreach ( $styles as $args ) {
			if ( ! $args['in_admin'] ) continue;

			if ( is_null( $args['condition'] ) || call_user_func( $args['condition'] ) ) {
				wp_enqueue_style(
					$args['handle'],
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

		if ( empty( $args['handle'] ) ) {
			$args['handle'] = basename( $args['src'], $suffix[ $type ] );
		}

		if ( 'script' === $type ) {
			$this->scripts[] = $args;
		} elseif ( 'style' === $type ) {
			$this->styles[] = $args;
		}
	}

	protected function get_script_defaults () {
		$defaults = $this->get_defaults();
		$defaults['in_footer'] = true;
		return $defaults;
	}


	protected function get_style_defaults () {
		$defaults = $this->get_defaults();
		$defaults['media'] = 'all';
		return $defaults;
	}
	
	protected function get_defaults () {
		return [
			'handle' => '',
			'src' => '',
			'deps' => $this->global_dependencies,
			'version' => Config::get( 'VERSION' ),
			'in_admin' => false,
			'condition' => null
		];
	}
}
