<?php
/**
 * RegisterScripts config file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\RegisterScripts,
	Utility\UrlUtility,
	Utility\VersionUtility
};

return [
	RegisterScripts::class => [
		[
			'handle' => 'twSearch-js',
			'src'    => UrlUtility::get_plugin_resources_url() . 'js/tw-search-scripts.js',
			'deps'   => [
				'jquery',
			],
			'ver'    => VersionUtility::get_plugin_version(),
		],
	],
];
