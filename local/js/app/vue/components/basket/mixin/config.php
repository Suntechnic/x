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
		'currency',
		'x.izi',
	],
	'skip_core' => true,
];