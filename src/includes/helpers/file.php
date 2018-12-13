<?php
/**
 * @version 1.0.2
 */

namespace {{namespace}}\functions;

use function {{namespace}}\functions\config_get;

function get_file_extension ( $path ) {
	return \strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
}

function create_path ( $path ) {
	$result = \wp_mkdir_p( $path );
	if ( ! $result ) {
		throw new \Exception( "could not create $path" );
	}
	return $result;
}

function get_asset_url ( $file_path ) {
	return \plugins_url( config_get( 'ASSETS_DIR' ) . '/' . $file_path, config_get('MAIN_FILE') );
}
