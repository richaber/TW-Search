<?php
/**
 * EnqueueStyles config file.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

use TwisterMc\TWSearch\{
	Infrastructure\EnqueueStyles,
	Utility\UrlUtility,
	Utility\VersionUtility
};

return [
	EnqueueStyles::class => [
		[
			'handle' => 'twSearch-css',
		],
	],
];
