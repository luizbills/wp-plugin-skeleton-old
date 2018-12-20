<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

function str_after ( $string, $search ) {
	return '' === $search ? $string : \array_reverse( \explode( $search, $string, 2 ) )[0];
}

function str_before ( $string, $search ) {
	return '' === $search ? $string : \explode( $search, $string )[0];
}

function str_length ( $string, $encoding = null ) {
	if ( null !== $encoding ) {
		return \mb_strlen( $string, $encoding );
	}
	return \mb_strlen( $string );
}

function str_lower ( $string ) {
	return \mb_strtolower( $string, 'UTF-8' );
}

function str_upper ( $string ) {
	return \mb_strtoupper( $string, 'UTF-8' );
}

function str_slug ( $string, $separator = '-' ) {
	// TO DO
}

function str_starts_with ( $string, $search ) {
	return \substr( $string, 0, \strlen( $search ) ) === $search;
}

function str_ends_with ( $string, $search ) {
	return \substr( $string, -\strlen( $search ) ) === $search;
}
