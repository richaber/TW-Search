<?php
/**
 * Plugin config file.
 *
 * @package TwisterMc\TWSearch
 */

namespace TwisterMc\TWSearch;

use TwisterMc\TWSearch\{
	Plugin,
	Infrastructure\RegisterScripts,
	Infrastructure\RegisterStyles,
	Infrastructure\EnqueueScripts,
	Infrastructure\EnqueueStyles,
	Infrastructure\LoadPluginTextDomain,
	Infrastructure\DialogView,
	Infrastructure\WpNavMenuItems,
	Infrastructure\Admin\CustomizeControlsEnqueueScripts,
	Infrastructure\Admin\CustomizerMagnifyingGlass,
	Infrastructure\Admin\CustomizeRegister
};

/**
 * Classes that should be added to the dependencies container.
 * Those that implement HookableInterface will be instantiated when the hook that calls them is run.
 */
return [
	Plugin::class => [
		'dependencies' => [
			CustomizeControlsEnqueueScripts::class,
			CustomizeRegister::class,
			RegisterScripts::class,
			RegisterStyles::class,
			EnqueueScripts::class,
			EnqueueStyles::class,
			CustomizerMagnifyingGlass::class,
			LoadPluginTextDomain::class,
			DialogView::class,
			WpNavMenuItems::class,
		],
	],
];
