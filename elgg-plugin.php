<?php

use ColdTrick\LanguageSelector\Bootstrap;

return [
	'bootstrap' => Bootstrap::class,
	
	'actions' => [
		'language_selector/change' => [
			'access' => 'public',
		],
	],
	
	'settings' => [
		'show_in_header' => true,
		'show_images' => true,
		'min_completeness' => 30,
	],
];
