<?php
/**
 * RegisterStyles config file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\RegisterStyles,
	Utility\UrlUtility,
	Utility\VersionUtility
};

return [
	RegisterStyles::class => [
		[
			'handle' => 'twSearch-css',
			'src'    => UrlUtility::get_plugin_resources_url() . 'css/tw-search-style.css',
			'deps'   => [
				'dashicons',
			],
			'ver'    => VersionUtility::get_plugin_version(),
		],
	],
];
