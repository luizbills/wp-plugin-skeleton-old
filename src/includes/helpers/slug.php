<?php

namespace {{namespace}}\functions;

function slugify ( $text ) {
	$slug = remove_accents( $text ); // Convert to ASCII
	// Standard replacements
	$invalid = [
		' ' => '-',
		'_' => '-',
	];
	$slug = str_replace( array_keys( $invalid ), array_values( $invalid ), $slug );
	$slug = preg_replace( '/[^A-Za-z0-9-]/', '', $slug ); // Remove all non-alphanumeric except -
	$slug = preg_replace( '/-+/', '-', $slug ); // Replace any more than one - in a row
	$slug = preg_replace( '/-$/', '', $slug ); // Remove last - if at the end
	$slug = strtolower( $slug ); // Lowercase
	return $slug;
}

function snake_slugify ( $text ) {
	$snake_case = slugify( $text );
	$snake_case = str_replace( '-', '_', $snake_case );
	return $snake_case;
}