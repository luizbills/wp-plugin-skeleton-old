<?php

namespace {{namespace}};

use {{namespace}}\functions as h;

// init the loggers
$logger_handler = h\config_set( '$logger_handler', new Simple_Logger_Handler() );
$logger_handler->add_hooks();

// check plugin dependencies
$deps = h\config_set( '$deps', new Plugin_Dependencies() );
$deps->add_hooks();

// plugin state hooks
$_FILE = h\config_get( 'MAIN_FILE' );
register_activation_hook( $_FILE, __NAMESPACE__ . '\on_plugin_activated' );
function on_plugin_activated () {
	h\log_info( 'plugin activated' );
}

register_deactivation_hook( $_FILE, __NAMESPACE__ . '\on_plugin_deactivated' );
function on_plugin_deactivated () {
	h\log_info( 'plugin deactivated' );
}

register_uninstall_hook( $_FILE, __NAMESPACE__ . '\on_plugin_uninstalled' );
function on_plugin_uninstalled () {
	h\log_info( 'plugin uninstalled' );
}
