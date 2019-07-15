<?php
/**
 * Template partial for displaying tw-search-form.
 *
 * Could probably use a little more accessibility work.
 *
 * @package TwisterMc\TWSearch\Infrastructure
 */

namespace TwisterMc\TWSearch\Infrastructure;

/**
 * Exit early if directly accessed via URL.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tw_search_color = \get_theme_mod( 'twSearch_color' );

if ( empty( $tw_search_color ) ) {
	$tw_search_color = 'dark';
}

?>

<div class="twSearchPopup">

	<div class="twSearchBg twSearchBg-<?php echo \esc_attr( $tw_search_color ); ?>" tabindex="-1"></div>

	<div class="twSearchContent" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-description"
		 aria-modal="true">

		<h1 id="dialog-title" class="screen-reader-text">
			<?php \esc_html_e( 'Site Search Dialog', 'tw-search' ); ?>
		</h1>

		<p id="dialog-description" class="screen-reader-text">
			<?php \esc_html_e( 'Enter your search phrase to search this site.', 'tw-search' ); ?>
		</p>

		<div class="twSearchFormWrapper twSearchFormWrapper-<?php echo \esc_attr( $tw_search_color ); ?>">
			<form role="search" method="get" action="<?php echo \esc_url( \home_url( '/' ) ); ?>">
				<div class="twSearchForm">

					<label for="twSearchInput" class="screen-reader-text">
						<?php \esc_attr_e( 'Input your search term and press enter.', 'tw-search' ); ?>
					</label>
					<input type="search" id="twSearchInput" name="s" class="twSearchBox"
						   value="<?php echo \get_search_query(); ?>"
						   placeholder="<?php \esc_attr_e( 'input search string and hit enter', 'tw-search' ); ?>">

					<div class="twSearchFormControls">
						<button type="button" class="twSearchClose"
								aria-label="<?php \esc_attr_e( 'Cancel', 'tw-search' ); ?>">
							<?php \esc_html_e( 'Cancel', 'tw-search' ); ?>
						</button>
						<input type="submit" class="twSearchButton"
							   value="<?php \esc_attr_e( 'Search', 'tw-search' ); ?>">
					</div>

					<div class="twSearchBoxDesc" aria-hidden="true" role="presentation" tabindex="-1">
						<?php \esc_attr_e( 'input search string and hit enter', 'tw-search' ); ?>
					</div>
				</div>
			</form>

		</div>

	</div>

</div>
