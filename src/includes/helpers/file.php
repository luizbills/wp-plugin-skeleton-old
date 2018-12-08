<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}}\functions;

use {{namespace}}\Core\Config;

function get_file_extension ( $path ) {
	return strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
}

function create_path ( $path ) {
	if ( ! wp_mkdir_p( $path ) ) {
		throw new \Exception( "could not create $path" );
	}
	return false;
}

function get_asset_url ( $file_path ) {
	return plugins_url( Config::get( 'ASSETS_DIR' ) . '/' . $file_path, Config::get('FILE') );
}