<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\Core;

use function {{namespace}}\functions\include_template;
use function {{namespace}}\functions\config_get;

final class Plugin {

	const HAS_DEPENDENCIES = false;

	protected $_actived = false;
	protected static $_instance = null;

	public static function get_instance () {
		if ( null === self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public static function run () {
		return self::get_instance();
	}

	protected function __construct () {
		if ( self::HAS_DEPENDENCIES ) {
			\add_action( 'plugins_loaded', [ $this, 'start' ] );
		} else {
			$this->start();
		}
	}

	public function start () {
		if ( $this->_actived ) return;

		\add_action( 'init', [ $this, 'load_plugin_textdomain' ], 0 );

		if ( self::HAS_DEPENDENCIES && ! $this->check_dependencies() ) {
			\add_action( 'admin_notices', [ $this, 'print_missing_dependencies_error' ] );
			return;
		}

		$this->_actived = true;

		$this->_includes();

		\add_action( 'init', [ $this, 'do_init_hook_action' ] );
	}

	protected function _includes () {
		require_once config_get( 'DIR' ) . '/includes/index.php';
	}

	public function load_plugin_textdomain () {
		\load_plugin_textdomain( '{{plugin_text_domain}}', false, \dirname( \plugin_basename( config_get('FILE') ) ) . '/languages/' );
	}

	public function register_init_hook ( $callback, $priority = 10 ) {
		\add_action( $this->get_init_hook_action_name(), $callback, $priority );
	}

	public function do_init_hook_action () {
		\do_action( $this->get_init_hook_action_name(), $this );
	}

	protected function get_init_hook_action_name () {
		return config_get('PREFIX') . 'plugin_init';
	}

	public function is_active () {
		return $this->_actived;
	}

	protected function check_dependencies () {
		return false;
	}

	public function print_missing_dependencies_error () {
		$message = \esc_html__( 'Missing requirements for ', 'mitsp-forms' ) . config_get('PLUGIN_NAME');

		include_template( 'admin-notice.php', [
			'message' => $message,
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
