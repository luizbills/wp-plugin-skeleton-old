<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}};

use function {{namespace}}\functions\include_template;
use function {{namespace}}\functions\config_get;

class Demo extends Common\Abstract_Hooker {

	public function display_admin_notice () {
		$plugin_name = config_get( 'NAME' );

		include_template( 'admin-notice.php', [
			'message' => "Plugin $plugin_name activated.",
			'class' => 'notice-success is-dismissible'
		] );
	}
}
