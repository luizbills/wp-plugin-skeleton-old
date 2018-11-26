<?php

namespace {{namespace}};

class Demo extends Common\Abstract_Hooker {

	public function display_admin_notice () {
		$plugin_name = Config::get('PLUGIN_NAME');

		include_template_file( 'admin-notice.php', [
			'message' => "Plugin $plugin_name activated.",
			'class' => 'notice-success is-dismissible'
		] );
	}
}
