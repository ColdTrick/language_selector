<?php 

$entity = elgg_extract('entity', $vars);

echo elgg_view_field([
	'#type' => 'fieldset',
	'fields' => [
		[
			'#type' => 'number',
			'#label' => elgg_echo('language_selector:admin:settings:min_completeness'),
			'name' => 'params[min_completeness]',
			'value' => $entity->min_completeness ?: 30,
			'max' => 100,
		],
		[
			'#type' => 'checkbox',
			'#label' => elgg_echo('language_selector:admin:settings:show_in_header'),
			'name' => 'params[show_in_header]',
			'checked' => (bool) $entity->show_in_header,
			'switch' => true,
			'value' => 1,
		],
		[
			'#type' => 'checkbox',
			'#label' => elgg_echo('language_selector:admin:settings:show_images'),
			'name' => 'params[show_images]',
			'checked' => (bool) $entity->show_images,
			'switch' => true,
			'value' => 1,
		],
	],
]);
