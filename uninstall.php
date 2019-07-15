<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package TwisterMc\TWSearch
 */

namespace TwisterMc\TWSearch;

// If uninstall not called from WordPress, then exit.
if ( ! \defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if ( ! \current_user_can( 'delete_plugins' ) ) {
	exit;
}

$tw_search_theme_mods = [
	'twSearch_location',
	'twSearch_display',
	'twSearch_color',
];

foreach ( $tw_search_theme_mods as $tw_search_theme_mod ) {
	\remove_theme_mod( $tw_search_theme_mod );
}

\flush_rewrite_rules();
