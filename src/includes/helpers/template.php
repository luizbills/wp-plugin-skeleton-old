<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;

function get_template ( $template_path, $data = [] ) {
	\ob_start();
	include Config::get( 'DIR' ) . '/' . Config::get( 'TEMPLATES_DIR' ) . '/' . $template_path;
	return \ob_get_clean();
}

function include_template ( $template_path, $data = [] ) {
	echo get_template( $template_path, $data );
}