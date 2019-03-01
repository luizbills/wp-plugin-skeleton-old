<?php

namespace {{namespace}};

use {{namespace}}\Common\Hooker_Trait;
use {{namespace}}\functions as h;

class Base {
	use Hooker_Trait;

	public function add_hooks () {
		$this->add_action( 'foo', 'bar' );
	}
}
