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

function array_head ( $arr ) {
	return $arr[0]
}

function array_tail ( $arr ) {
	return \array_slice( $arr, 1 );
}

function array_divide ( $arr ) {
	return [ \array_keys( $arr ), \array_values( $arr ) ];
}
