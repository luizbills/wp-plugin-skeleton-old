<?php

namespace {{namespace}};

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

	protected function __construct () {
		if ( self::HAS_DEPENDENCIES ) {
			add_action( 'plugins_loaded', [ $this, 'start' ] );
		} else {
			$this->start();
		}

		register_activation_hook( Config::get('FILE'), [ $this, 'activation' ] );
		register_deactivation_hook( Config::get('FILE'), [ $this, 'deactivation' ] );
	}

	public function start () {
		if ( $this->_actived ) return;

		add_action( 'init', [ $this, 'load_plugin_textdomain' ], 0 );

		if ( self::HAS_DEPENDENCIES && ! $this->check_dependencies() ) {
			add_action( 'admin_notices', [ $this, 'print_missing_dependencies_error' ] );
			return;
		}

		$this->_actived = true;

		$this->_hooks();

		add_action( 'init', [ $this, 'do_init_hook_action' ], 0 );
	}

	protected function _hooks () {
		require_once Config::get( 'DIR' ) . '/includes/hooks.php';
	}

	public function load_plugin_textdomain () {
		load_plugin_textdomain( '{{plugin_text_domain}}', false, dirname( plugin_basename( Config::get('FILE') ) ) . '/languages/' );
	}

	public function register_init_hook ( $callback, $priority = 10 ) {
		add_action( $this->get_init_hook_action_name(), $callback, $priority );
	}

	public function do_init_hook_action () {
		do_action( $this->get_init_hook_action_name(), $this );
	}

	protected function get_init_hook_action_name () {
		return Config::get('PREFIX') . 'plugin_init';
	}

	public function activation () {
		if ( ! current_user_can( 'activate_plugins' ) ) return;
		// more info: https://codex.wordpress.org/Function_Reference/register_activation_hook/

		flush_rewrite_rules();
		//$this->set_option( 'version', Config::get('VERSION') );
	}

	public function deactivation () {
		if ( ! current_user_can( 'activate_plugins' ) ) return;
		// more info: https://codex.wordpress.org/Function_Reference/register_deactivation_hook/

		flush_rewrite_rules();
	}

	public function is_active () { return $this->_actived; }

	protected function check_dependencies () {
		return false;
	}

	public function print_missing_dependencies_error () {
		$message = esc_html__( 'Missing requirements for ', 'mitsp-forms' ) . Config::get('PLUGIN_NAME');

		include_template_file( 'admin-notice.php', [
			'message' => $message,
			'class' => 'error'
		] );
	}

	public function __clone () {
		_doing_it_wrong( __FUNCTION__, 'Cloning is forbidden.', '1.0.0' );
	}

	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, 'Unserializing instances of this class is forbidden.', '1.0.0' );
	}

	public static function run () {
		return self::get_instance();
	}
}
