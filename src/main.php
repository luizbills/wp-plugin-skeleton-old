<?php
/*
Plugin Name: {{plugin_name}}
Description: {{plugin_description}}
Version: 1.0.0
Author: {{plugin_author}}
Author URI: {{plugin_author_uri}}

License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Text Domain: {{plugin_text_domain}}
Domain Path: /languages
*/

if ( ! defined( 'WPINC' ) ) die();

require_once 'vendor/autoload.php';

{{namespace}}\Plugin::run(__FILE__);