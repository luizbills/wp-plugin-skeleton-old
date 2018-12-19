<?php
/**
 * @version 1.0.0
 */

use {{namespace}}\functions;

function str_after ( $subject, $search ) {
	return '' === $search ? $subject : \array_reverse( \explode( $search, $subject, 2 ) )[0];
}

function str_before ( $subject, $search ) {
	return '' === $search ? $subject : \explode( $search, $subject )[0];
}

function str_length ( $value, $encoding = null ) {
	if ( null !== $encoding ) {
		return \mb_strlen( $value, $encoding );
	}
	return \mb_strlen( $value );
}

function str_lower ( $value ) {
	return \mb_strtolower( $value, 'UTF-8' );
}

function str_upper ( $value ) {
	return \mb_strtoupper( $value, 'UTF-8' );
}

function str_slug ( $value, $separator = '-' ) {
	// TO DO
}

function str_starts_with ( $haystack, $needle ) {
	return \substr( $haystack, 0, \strlen( $needle ) ) === $needle;
}

function str_ends_with ( $haystack, $needle ) {
	return \substr( $haystack, -\strlen( $needle ) ) === $needle;
}
