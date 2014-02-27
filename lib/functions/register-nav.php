<?php
/**
 *
 * This file initializes the default navigation menu(s) and adds a fallback to the main menu if no menu exists.
 *
 * @package inLine
 *
 */
 
if ( function_exists( 'register_nav_menu' )) { 
	register_nav_menu( 'primary', 'Primary Navigation Menu' );
	register_nav_menu( 'secondary', 'Secondary Navigation Menu' );
}

/**
 *
 * This function adds our primary fallback nav menu. It simply displays the home page link. To replace this, create a new WP 3.0 Nav Menu by going
 * to Appearance > Menus
 *
 * @since 1.0
 *
 */
function inline_fallback_primary_nav() {

	echo '<ul id="menu-primary-navigation" class="menu">';
		wp_list_pages( 'title_li=&sort_column=menu_order' );
	echo '</ul>';

}

/**
 *
 * This function adds our secondary fallback nav menu. By default, it displays nothing. To replace this, create a new WP 3.0 Nav Menu by going
 * to Appearance > Menus
 *
 * @since 1.0
 *
 */
function inline_fallback_secondary_nav() {

	// do nothing!

}