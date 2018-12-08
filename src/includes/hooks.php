<?php
/**
 * @version 1.0.0
 */

namespace {{namespace}};

use function {{namespace}}\functions\config_get;
use function {{namespace}}\functions\config_set;
use function {{namespace}}\functions\get_asset_url;
use {{namespace}}\Utils\Script_Manager;

$prefix = config_get( 'PREFIX' );

// examples: how to hook your plugins actions and filters
$logger = config_set( '$logger', new Logger() );
$logger->add_action( $prefix . 'is_logger_enabled', 'is_enabled' );
$logger->add_action( $prefix . 'handle_log', 'handle_log', 10, 3 );

$demo = config_set( '$demo', new Demo() );
$demo->add_action( 'admin_notices', 'display_admin_notice' );

// another example: how to enqueue javascript and css
$script_manager = config_set( '$script_manager', new Script_Manager() );
$script_manager->add_global_script_dependency( 'jquery' );
$script_manager->enqueue_script( get_asset_url( 'js/demo.js' ) );
$script_manager->enqueue_style( get_asset_url( 'css/demo.css' ) );
