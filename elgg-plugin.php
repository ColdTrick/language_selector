<?php

use ColdTrick\LanguageSelector\Bootstrap;

require_once(dirname(__FILE__) . '/lib/functions.php');

return [
	'bootstrap' => Bootstrap::class,
	
	'actions' => [
		'language_selector/change' => [],
	],
	
	'settings' => [
		'show_in_header' => true,
		'autodetect' => true,
		'show_images' => true,
		'min_completeness' => 30,
	],
];
