<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

function array_head ( $arr ) {
	return $arr[0]
}

function array_tail ( $arr ) {
	return \array_slice( $arr, 1 );
}

function array_divide ( $arr ) {
	return [ \array_keys( $arr ), \array_values( $arr ) ];
}

function array_get ( $arr, $key, $default = null ) {
	$value = $default;
	if ( isset( $arr[ $key ] ) ) {
		$value = $arr[ $key ];
	}
	return $value;
}

function array_pull ( &$arr, $key, $default = null ) {
	$value = array_get( $arr, $key, $default );
	unset( $arr[ $key ] );
	return $value;
}

function array_forget ( &$arr, $keys ) {
	foreach ( (array) $keys as $key ) {
		if ( isset( $arr[ $key ] ) ) {
			unset( $arr[ $key ] );
		}
	}
	return $arr;
}

function array_only ( &$arr, $keys ) {
    return \array_intersect_key( $arr, \array_flip( (array) $keys ) );
}

function wrap ( $value ) {
	if ( is_null( $value ) ) {
	    return [];
	}
	return is_array($value) ? $value : [ $value ];
}
