<?php

namespace {{namespace}};

use {{namespace}}\functions as h;

// examples: how to hook your plugins actions and filters
$demo = h\config_set( '$demo', new Demo() );
$demo->add_hooks();

// another example: how to enqueue javascript and css
$assets = h\assets(); // this returns a classes/Uitls/Asset_Manager instance

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
