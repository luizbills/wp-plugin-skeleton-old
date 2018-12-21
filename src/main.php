<?php
/*
Plugin Name: {{plugin_name}}
Version: {{plugin_version}}
Description: {{plugin_description}}
Author: {{plugin_author}}
Author URI: {{plugin_author_uri}}

Text Domain: {{plugin_text_domain}}
Domain Path: /languages

License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'WPINC' ) ) die();

require_once 'vendor/autoload.php';
require_once 'includes/helpers.php';

{{namespace}}\Core\Config::setup( __FILE__ );

require_once 'includes/boot.php';

{{namespace}}\Core\Plugin::run();
