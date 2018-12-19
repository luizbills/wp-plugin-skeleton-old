<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

function array_unset_keys ( &$arr, $keys ) {
	foreach ( $keys as $key ) {
		unset( $arr[ $key ] );
	}
}

function array_extract_key ( &$arr, $key ) {
	$value = null;
	if ( isset( $arr[ $key ] ) ) {
		$value = $arr[ $key ];
		unset( $arr[ $key ] );
	}
	return $value;
}
