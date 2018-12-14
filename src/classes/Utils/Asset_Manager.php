<?php
/**
 * @version 1.3.0
 */

namespace {{namespace}}\Utils;

use function {{namespace}}\functions\get_asset_url;
use function {{namespace}}\functions\config_get;
use function {{namespace}}\functions\get_file_extension;
use function {{namespace}}\functions\snake_slugify;

class Asset_Manager {

	protected $global_dependencies = [];
	protected $enqueued = [];

	public function register_hooks () {
		\add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	public function add ( $source, $args = [] ) {
		$type = get_file_extension( $source );

		$args = \array_merge( $this->get_defaults(), $args );
		$args['src'] = $source;

		if ( empty( $args['handle'] ) ) {
			$args['handle'] = $args['prefix'] . \basename( $args['src'], ".$type" );
		}

		if ( empty( $args['deps'] ) ) {
			$args['deps'] = [];
		}

		$args['deps'] = \array_merge( $args['deps'], $this->get_global_dependencies( $type ) );

		if ( empty( $this->enqueued[ $type ] ) ) {
			$this->enqueued[ $type ] = [];
		}
		$this->enqueued[ $type ][] = $args;

		\do_action( config_get( 'PREFIX' ) . 'added_asset', $args, $type );
	}

	public function get_enqueued ( $type = 'js' ) {
		if ( empty( $this->enqueued[ $type ] ) ) {
			$this->enqueued[ $type ] = [];
		}
		return $this->enqueued[ $type ];
	}

	public function add_global_dependency ( $handle, $type = 'js' ) {
		if ( empty( $this->global_dependencies[ $type ] ) ) {
			$this->global_dependencies[ $type ] = [];
		}
		$this->global_dependencies[ $type ][] = $handle;

		\do_action( config_get( 'PREFIX' ) . 'added_global_asset_dependency', $handle );
	}

	public function get_global_dependencies ( $type = 'js' ) {
		if ( empty( $this->global_dependencies[ $type ] ) ) {
			$this->global_dependencies[ $type ] = [];
		}
		return $this->global_dependencies[ $type ];
	}

	public function enqueue_assets () {
		$in_admin = is_admin();
		$prefix = config_get( 'PREFIX' );

		foreach ( $this->get_enqueued( 'js' ) as $args ) {
			if ( $in_admin !== $args['in_admin'] ) continue;

			if ( ! \is_callable( $args['condition'] ) || \call_user_func( $args['condition'] ) ) {
				\wp_enqueue_script(
					$args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['in_footer']
				);

				$script_data = apply_filters( $prefix . 'localize_script_data', [], $args );

				if ( ! empty( $script_data ) ) {
					$script_data_name = snake_slugify( $args['handle'] ) . '_ajax_data';
					$script_data_name = apply_filters( $prefix . 'localize_script_name', $script_data_name, $args );

					\wp_localize_script(
						$args['handle'],
						$script_data_name,
						$script_data
					);
				}
			}
		}

		foreach ( $this->get_enqueued( 'css' ) as $args ) {
			if ( $in_admin !== $args['in_admin'] ) continue;

			if ( ! \is_callable( $args['condition'] ) || \call_user_func( $args['condition'] ) ) {
				\wp_enqueue_style(
					$args['handle'],
					$args['src'],
					$args['deps'],
					$args['version'],
					$args['media']
				);
			}
		}
	}

	public function get_defaults () {
		return [
			'version' => config_get( 'VERSION' ),
			'in_footer' => true,
			'media' => 'all',
			'in_admin' => false,
			'condition' => null,
			'prefix' => config_get( 'PREFIX' ),
		];
	}
}
