<?php

namespace {{namespace}};

use {{namespace}}\functions as h;

// examples: how to hook your plugins actions and filters
$logger_handler = h\config_set( '$logger_handler', new Simple_Logger_Handler() );
$logger_handler->add_action( h\prefix( 'handle_log' ), 'handle_log', 10, 3 );

$demo = h\config_set( '$demo', new Demo() );
$demo->add_action( 'admin_notices', 'display_admin_notice' );

// another example: how to enqueue javascript and css
$assets = h\config_set( '$assets', new Utils\Asset_Manager() );

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
