<?php
/**
 *
 * Boots up all the information necessary to output the footer part of the document.
 *
 * @package inLine
 *
 */
 
add_action( 'inline_footer', 'inline_footer_structure_start', 3 );
/**
 *
 * This function outputs the beginning structure of the inLine footer.
 *
 * We add a low priority to this action to make sure that it fires before anything else in the inline_footer hook.
 *
 * @since 1.0
 *
 */
function inline_footer_structure_start() {

	echo '<footer id="footer">';
	echo '<div class="wrap">';

}

//add_action( 'inline_credits', 'inline_do_credits' );
/**
 *
 * This function outputs the credits to the inLine theme.
 *
 * @since 1.0
 *
 */
function inline_do_credits() {

	?>
	<p class="credit"><a href="http://inline.thomasgriffinmedia.com/" target="_blank"><?php _e( 'Powered by the inLine Minimal WordPress Theme', 'inline' ); ?></a></p>
	<?php

}

add_action( 'inline_footer', 'inline_do_footer' );
/**
 *
 * This function outputs all the content contained within the inLine footer. 
 *
 * The following hooks are included in this action:
 *
 * inline_credits, inline_top_jump
 *
 * @since 1.0
 *
 */
function inline_do_footer() {

		do_action( 'inline_credits' );

}

add_action( 'wp_footer', 'inline_do_footer_scripts', 11 );
/**
 *
 * This function outputs the HTML in the Theme Options page for the Footer Scripts area.
 *
 * @since 1.0
 *
 */
function inline_do_footer_scripts() {

	global $inline_options;

	if ( $inline_options['inline_footer_scripts'] != '' ) {
		echo html_entity_decode( $inline_options['inline_footer_scripts'], ENT_QUOTES );
	}

}

add_action( 'inline_footer', 'inline_footer_structure_end', 20 );
/**
 *
 * This function outputs the beginning structure of the inLine footer.
 *
 * We add a high priority to this action to make sure that it fires after everything else in the inline_footer hook.
 *
 * @since 1.0
 *
 */
function inline_footer_structure_end() {

	echo '</div><!--end #footer .wrap-->';
	echo '</footer><!--end #footer-->';

}

add_action( 'inline_after_wireframe', 'inline_structure_end' );
/**
 *
 * This function outputs the ending structure of the inLine theme.
 *
 * The following hooks are included in this action:
 *
 * wp_footer, inline_after_html
 *
 * @since 1.0
 *
 */
function inline_structure_end() {

	echo '</section><!--end #wrapper-->';
	wp_footer(); // Output this so plugins and other people don't get in a tizzy
	echo '</body><!--end body-->';

	do_action( 'inline_after_html' );

}
