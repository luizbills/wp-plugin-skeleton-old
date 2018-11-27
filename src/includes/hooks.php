<?php

namespace {{namespace}};

$demo = Config::set( '$demo', new Demo() );
$demo->add_action( 'admin_notices', 'display_admin_notice' );

// enqueue scripts (js and css)
$script_manager = Config::set( '$script_manager', new Utils\Script_Manager() );
$script_manager->enqueue_script( 'js/demo.js' );
