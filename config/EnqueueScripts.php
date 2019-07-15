<?php
/**
 * EnqueueScripts config file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\EnqueueScripts,
	Utility\UrlUtility,
	Utility\VersionUtility
};

return [
	EnqueueScripts::class => [
		[
			'handle' => 'twSearch-js',
		],
	],
];
