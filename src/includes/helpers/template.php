<?php
/**
 * @version 2.0.1
 */

namespace {{namespace}}\functions;

function get_template ( $template_path, $data = [] ) {
	$template_path = config_get( 'ROOT_DIR' ) . '/' . config_get( 'TEMPLATES_DIR' ) . '/' . $template_path;
	$template_string = \file_get_contents( $template_path );
	return render_template_string( $template_string, $data );
}

function include_template ( $template_path, $data = [] ) {
	echo get_template( $template_path, $data );
}

// An safe and simple template engine
// see: https://github.com/luizbills/wp-plugin-skeleton/blob/master/src/templates/admin-notice.php
function render_template_string ( $string, $data = [] ) {
	$result = $string;
	$matches = null;
	$regex = '/{{(.*?)}}/';
	$find = [];
	$replace = [];

	if ( preg_match_all( $regex, $string, $matches ) ) {
		foreach ( $matches[0] as $index => $variable ) {
			$key = trim( $matches[1][ $index ] );
			$find[] = $variable;
			$replace[] = isset( $data[ $key ] ) ? esc_html( $data[ $key ] ) : '';
		}
	}

	if ( count( $find ) > 0 ) {
		$result = str_replace( $find, $replace, $result );
	}

	return $result;
}