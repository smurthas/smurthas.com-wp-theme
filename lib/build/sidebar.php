<?php
/**
 *
 * Boots up all the information necessary to output the sidebar parts of the document.
 *
 * All of the main sidebar mumbo jumbo is on the top (including structures). All of the alternate sidebar stuff is on the bottom.
 *
 * @package inLine
 *
 */
 
add_action( 'inline_sidebar', 'inline_sidebar_structure_start', 3 );
/**
 *
 * This function outputs the beginning structure of the inLine main sidebar.
 *
 * We add a low priority to this action to make sure that it fires before anything else in the inline_sidebar hook.
 *
 * @since 1.0
 *
 */
function inline_sidebar_structure_start() {

	do_action( 'inline_before_main_sidebar' );
	echo '<div id="sidebar">';
	echo '<div class="sidebar widget-area">';
	do_action( 'inline_before_main_sidebar_widgets' );

}

add_action( 'inline_sidebar', 'inline_do_sidebar' );
/**
 *
 * This function outputs the main inLine sidebar.
 *
 * @since 1.0
 *
 */
function inline_do_sidebar() {

	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Sidebar One' ) ) {
		echo '<div class="widget text-widget">';
			echo '<h3 class="widget-title">';
				_e( 'Primary Sidebar Area', 'inline' );
			echo '</h3>';
			echo '<p>';
				printf( __( 'This is the primary sidebar area. Go to your <a href="%s">Widgets Panel</a> and start dragging in widgets to make the sidebar active.', 'inline' ), admin_url( 'widgets.php' ) );
			echo '</p>';
		echo '</div><!--end .text-widget-->';
	}

}

add_action( 'inline_sidebar', 'inline_sidebar_structure_end', 20 );
/**
 *
 * This function outputs the ending structure of the inLine main sidebar.
 *
 * We add a high priority to this action to make sure that it fires after anything else in the inline_sidebar hook.
 *
 * @since 1.0
 *
 */
function inline_sidebar_structure_end() {

	do_action( 'inline_after_main_sidebar_widgets' );
	echo '</div><!--end .sidebar-->';
	echo '</div><!--end #sidebar-->';
	do_action( 'inline_after_main_sidebar' );

}

add_action( 'inline_sidebar_alt', 'inline_sidebar_alt_structure_start', 3 );
/**
 *
 * This function outputs the beginning structure of the inLine alternate sidebar.
 *
 * We add a low priority to this action to make sure that it fires before anything else in the inline_sidebar_alt hook.
 *
 * @since 1.0
 *
 */
function inline_sidebar_alt_structure_start() {

	do_action( 'inline_before_sidebar_alt' );
	echo '<div id="sidebar-alt">';
	echo '<div class="sidebar widget-area">';
	do_action( 'inline_before_sidebar_alt_widgets' );

}

add_action( 'inline_sidebar_alt', 'inline_do_sidebar_alt' );
/**
 *
 * This function outputs the main inLine sidebar.
 *
 * @since 1.0
 *
 */
function inline_do_sidebar_alt() {

	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Sidebar Alt' ) ) {
		echo '<div class="widget text-widget">';
			echo '<h3 class="widget-title">';
				_e( 'Alternate Sidebar Area', 'inline' );
			echo '</h3>';
			echo '<p>';
				printf( __( 'This is the alternate sidebar area. Go to your <a href="%s">Widgets Panel</a> and start dragging in widgets to make the sidebar active.', 'inline' ), admin_url( 'widgets.php' ) );
			echo '</p>';
		echo '</div><!--end .text-widget-->';
	}

}

add_action( 'inline_sidebar_alt', 'inline_sidebar_alt_structure_end', 20 );
/**
 *
 * This function outputs the ending structure of the inLine alternate sidebar.
 *
 * We add a high priority to this action to make sure that it fires after anything else in the inline_sidebar_alt hook.
 *
 * @since 1.0
 *
 */
function inline_sidebar_alt_structure_end() {

	do_action( 'inline_after_sidebar_alt_widgets' );
	echo '</div><!--end .sidebar-->';
	echo '</div><!--end #sidebar-->';
	do_action( 'inline_after_sidebar_alt' );

}