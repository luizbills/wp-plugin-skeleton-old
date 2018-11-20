<?php

//echo 'ok';
echo getcwd(); exit();

$plugin_name = readline( 'Plugin Name (e.g. Awesome Plugin): ' );

$description = readline( 'Plugin Description (e.g. Just another plugin): ' );

$author = readline( 'Plugin Author (e.g. Luiz Bills): ' );

$author_uri = readline( 'Plugin Author URL (e.g. luizpb.com): ' );

$text_domain = readline( 'Plugin Text Domain (e.g. awesome-plugin): ' );

$namespace = readline( 'Plugin Namespace (e.g. luizbills\AwesomePlugin): ' );

$find = [
	'{{namespace}}',
	'{{composer_namespace}}',
	'{{plugin_name}}',
	'{{plugin_description}}',
	'{{plugin_author}}',
	'{{plugin_author_uri}}',
	'{{plugin_text_domain}}'
];

$replace = [
	$namespace,
	str_replace('\\', '\\\\', $namespace ),
	$plugin_name,
	$description,
	$author,
	$author_uri,
	$text_domain
];

$files = [
	'assets/js' => [
		'.gitkeep'
	],
	'assets/css' => [
		'.gitkeep'
	],
	'assets/images' => [
		'.gitkeep'
	],
	'classes' => [
		'Config.php',
		'Plugin.php',
	],
	'classes/Abstract' => [
		'.gitkeep'
	],
	'includes' => [
		'functions.php'
	],
	'languages' => [
		'.gitkeep'
	],
	'templates' => [
		'.gitkeep'
	],
];

foreach ( $files as $dir ) {

	//mkdir( $dir, )

}