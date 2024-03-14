<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

return [
	'css' => 'dist/s.css',
	'js' => 'dist/s.js',
	'rel' => [
		'main.polyfill.core',
		'x.vue.components.ui',
		'x.izi',
		'currency',
		'app.vue.components.basket.minimal',
		'app.vue.components.basket.side',
	],
	'skip_core' => true,
];