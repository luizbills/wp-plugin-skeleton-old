<?php

namespace {{namespace}};

$demo = Config::set( 'demo_instance', new Demo() );
$demo->add_action( 'admin_notices', 'display_admin_notice' );
