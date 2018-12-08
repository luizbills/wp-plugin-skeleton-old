<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}};

use function {{namespace}}\functions\config_set;
use function {{namespace}}\functions\get_asset_url;
use {{namespace}}\Utils\Script_Manager;

// just an example
$demo = config_set( '$demo', new Demo() );
$demo->add_action( 'admin_notices', 'display_admin_notice' );

// another example: how to enqueue static scripts (javascript and css)
$script_manager = config_set( '$script_manager', new Script_Manager() );
$script_manager->add_global_script_dependency( 'jquery' );
$script_manager->enqueue_script( get_asset_url( 'js/demo.js' ) );
$script_manager->enqueue_style( get_asset_url( 'css/demo.css' ) );
