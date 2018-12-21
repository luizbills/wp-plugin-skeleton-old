<?php
/**
 * @version 1.0.3
 */

namespace {{namespace}}\Core;

use {{namespace}}\functions as h;
use {{namespace}}\Common\Abstract_Hooker;

final class Plugin extends Abstract_Hooker {

	protected $actived = false;
	protected static $instance = null;

	public static function get_instance () {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function run () {
		return self::get_instance();
	}

	protected function __construct () {
		if ( $this->has_dependencies() ) {
			$this->add_action( 'plugins_loaded', 'start' );
		} else {
			$this->start();
		}
	}

	public function start () {
		if ( $this->actived ) return;

		$this->add_action( 'init', 'load_plugin_textdomain', 0 );

		if ( $this->has_dependencies() && ! $this->check_dependencies() ) {
			$this->add_action( 'admin_notices', 'print_missing_dependencies_error' );
			return;
		}

		$this->actived = true;

		$this->includes();

		$this->add_action( 'init', 'do_init_hook_action' );
	}

	protected function includes () {
		require_once h\config_get( 'ROOT_DIR' ) . '/includes/index.php';
	}

	public function load_plugin_textdomain () {
		\load_plugin_textdomain(
			'{{plugin_text_domain}}',
			false,
			\dirname( \plugin_basename( h\config_get( 'MAIN_FILE' ) ) ) . '/languages/'
		);
	}

	public function register_init_hook ( $callback, $priority = 10 ) {
		\add_action( $this->get_init_hook_action_name(), $callback, $priority );
	}

	public function do_init_hook_action () {
		\do_action( $this->get_init_hook_action_name(), $this );
	}

	protected function get_init_hook_action_name () {
		return h\config_get('PREFIX') . 'plugin_init';
	}

	public function is_active () {
		return $this->actived;
	}

	public function has_dependencies () {
		return \apply_filters( h\prefix( 'has_dependencies' ), false );
	}

	public function check_dependencies () {
		return \apply_filters( h\prefix( 'check_dependencies' ), false );
	}

	public function print_missing_dependencies_error () {
		$message = \__( 'Missing requirements for %1$s.', '{{plugin_text_domain}}' );
		$message = sprintf( $message, '<b>' . h\config_get( 'NAME' ) . '</b>' );

		h\include_template( 'admin-notice.php', [
			'message' => \apply_filters( h\prefix( 'missing_dependencies_error_message' ), $message ),
			'class' => 'error'
		] );
	}

	public function __clone () {
		\_doing_it_wrong( __FUNCTION__, 'Cloning is forbidden.', '1.0.0' );
	}

	public function __wakeup () {
		\_doing_it_wrong( __FUNCTION__, 'Unserializing instances of this class is forbidden.', '1.0.0' );
	}
}
