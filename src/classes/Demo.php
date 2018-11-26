<?php

namespace {{namespace}};

class Hooker_Demo extends Common\Abstract_Hooker {

	public function display_admin_notice () {
		?>
		<div class="notice notice-success is-dismissible">
			<p>Plugin <?php echo Config::get('PLUGIN_NAME'); ?> activated.</p>
		</div>
		<?php
	}
}
