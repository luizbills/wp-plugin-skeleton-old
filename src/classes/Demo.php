<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}};

use {{namespace}}\functions as h;

class Demo extends Common\Abstract_Hooker {

	public function add_hooks () {
		$this->add_action( 'admin_notices', 'display_admin_notice' );
	}

	public function display_admin_notice () {
		$plugin_name = h\config_get( 'NAME' );

		h\include_template( 'admin-notice.php', [
			'message' => "Plugin $plugin_name activated.",
			'class' => 'notice-success is-dismissible'
		] );
	}
}
