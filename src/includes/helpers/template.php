<?php
/**
 * An safe and simple template engine (only replacement of variables)
 * see: https://github.com/luizbills/wp-plugin-skeleton/blob/master/src/templates/admin-notice.php
 *
 * @version 2.2.0
 */

namespace {{namespace}}\functions;

function render_template ( $template_path, $data = [], $echo = false ) {
	$template_base_path = config_get( 'ROOT_DIR' ) . '/' . config_get( 'TEMPLATES_DIR' );
	$template_path =  "$template_base_path/$template_path";
	$template_string = \file_get_contents( $template_path );
	$result = render_template_string( $template_string, $data );
	if ( $echo ) {
		echo $result;
	}
	return $result;
}

function include_template ( $template_path, $data = [] ) {
	render_template( $template_path, $data, true );
}

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
			$escape = '!' !== $key[0];

			if ( ! $escape ) {
				$key[0] = ' ';
				$key = trim( $key );
			}

			if ( isset( $data[ $key ] ) ) {
				$replace[] = $escape ? esc_html( $data[ $key ] ) : $data[ $key ];
			} else {
				$replace[] = '';
			}
		}
	}

	if ( count( $find ) > 0 ) {
		$result = str_replace( $find, $replace, $result );
	}

	return $result;
}
