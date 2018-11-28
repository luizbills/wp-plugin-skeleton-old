<?php

namespace {{namespace}};

use {{namespace}}\Core\Config;
use function {{namespace}}\functions\include_template_file;

class Demo extends Common\Abstract_Hooker {

	public function display_admin_notice () {
		$plugin_name = Config::get('PLUGIN_NAME');

		include_template_file( 'admin-notice.php', [
			'message' => "Plugin $plugin_name activated.",
			'class' => 'notice-success is-dismissible'
		] );
	}
}
