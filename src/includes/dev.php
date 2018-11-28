<?php

namespace {{namespace}};

use function {{namespace}}\functions\log_debug;
use {{namespace}}\Core\Config;

log_debug( 'Testing... works?' );
log_debug( Config::get_options() );
