<?php

namespace {{namespace}};

use {{namespace}}\functions as h;
use {{namespace}}\Utils\Asset_Manager;

$prefix = h\config_get( 'PREFIX' );

// examples: how to hook your plugins actions and filters
$logger = h\config_set( '$logger', new Logger() );
$logger->add_action( $prefix . 'is_logger_enabled', 'is_enabled' );
$logger->add_action( $prefix . 'handle_log', 'handle_log', 10, 3 );

$demo = h\config_set( '$demo', new Demo() );
$demo->add_action( 'admin_notices', 'display_admin_notice' );

// another example: how to enqueue javascript and css
$assets = h\config_set( '$assets', new Asset_Manager() );

// add your JavaScript and CSS assets
$assets->add( h\get_asset_url( 'js/demo.js' ), [
	'in_admin' => true, // enqueue in admin
] );
$assets->add( h\get_asset_url( 'css/demo.css' ), [
	'in_admin' => false, // enqueue in frontend (default)
] );
// for more options see: classes/Uitls/Asset_Manager->get_defaults();

// optional: add your JavaScript or CSS requirements
// $assets->add_global_dependency( 'jquery', 'js' );

// hook your assets
$assets->register_hooks();