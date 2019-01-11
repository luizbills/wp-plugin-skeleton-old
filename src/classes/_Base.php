<?php

namespace {{namespace}};

use {{namespace}}\Common\Abstract_Hooker;
use {{namespace}}\functions as h;

class Base extends Abstract_Hooker {
	public function add_hooks () {
		$this->add_action( 'foo', 'bar' );
	}
}
