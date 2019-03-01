<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}};

use {{namespace}}\functions as h;
use {{namespace}}\Common\Hooker_Trait;

class Demo {
	use Hooker_Trait;

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
