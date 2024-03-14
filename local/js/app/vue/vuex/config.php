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
		'ui.vue3.vuex',
		'x.vue.loader',
	],
	'skip_core' => true,
];