<?php

namespace {{namespace}};

class Demo extends Common\Abstract_Hooker {

	public function display_admin_notice () {
		?>
		<div class="notice notice-success is-dismissible">
			<p>Plugin <?php echo Config::get('PLUGIN_NAME'); ?> activated.</p>
		</div>
		<?php
	}
}
