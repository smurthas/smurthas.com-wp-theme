<?php
/**
 *
 * This file holds that function that will output all of our body classes when a new default post or page layout is chosen.
 *
 * @package inLine
 *
 */

/**
 *
 * This function outputs our body classes when a page layout option is selected in the Theme Options panel.
 *
 * @since 1.0
 *
 */
function inline_page_body_class( $classes ) {

	global $inline_options, $post;
	
	if ( $inline_options['default_page_layout'] == 'Full Width' && is_page() ) {
		$classes[] = 'full-width-template';
	}
	if ( $inline_options['default_page_layout'] == 'Left Sidebar' && is_page() ) {
		$classes[] = 'left-sidebar-template';
	}
	if ( $inline_options['default_page_layout'] == 'Content / Sidebar / Sidebar' && is_page() ) {
		$classes[] = 'content-sidebar-sidebar-template';
	}
	if ( $inline_options['default_page_layout'] == 'Sidebar / Content / Sidebar' && is_page() ) {
		$classes[] = 'sidebar-content-sidebar-template';
	}
	if ( $inline_options['default_page_layout'] == 'Sidebar / Sidebar / Content' && is_page() ) {
		$classes[] = 'sidebar-sidebar-content-template';
	}
	
	return array_unique( $classes );

}

/**
 *
 * This function outputs our body classes when a post layout option is selected in the Theme Options panel.
 *
 * @since 1.0
 *
 */
function inline_post_body_class( $classes ) {

	global $inline_options, $post;
	
	if ( $inline_options['default_post_layout'] == 'Full Width' && ! is_page() && ! is_home() ) {
		$classes[] = 'full-width-template';
	}
	if ( $inline_options['default_post_layout'] == 'Left Sidebar' && ! is_page() && ! is_home() ) {
		$classes[] = 'left-sidebar-template';
	}
	if ( $inline_options['default_post_layout'] == 'Content / Sidebar / Sidebar' && ! is_page() && ! is_home() ) {
		$classes[] = 'content-sidebar-sidebar-template';
	}
	if ( $inline_options['default_post_layout'] == 'Sidebar / Content / Sidebar' && ! is_page() && ! is_home() ) {
		$classes[] = 'sidebar-content-sidebar-template';
	}
	if ( $inline_options['default_post_layout'] == 'Sidebar / Sidebar / Content' && ! is_page() && ! is_home() ) {
		$classes[] = 'sidebar-sidebar-content-template';
	}
	
	return array_unique( $classes );

}

/**
 *
 * This function outputs our body classes when an index layout option is selected in the Theme Options panel.
 *
 * @since 1.0
 *
 */
function inline_index_body_class( $classes ) {

	global $inline_options, $post;
	
	if ( $inline_options['default_index_layout'] == 'Full Width' && is_home() || $inline_options['default_index_layout'] == 'Full Width' && is_post_type_archive() ) {
		$classes[] = 'full-width-template';
	}
	if ( $inline_options['default_index_layout'] == 'Left Sidebar' && is_home() || $inline_options['default_index_layout'] == 'Left Sidebar' && is_post_type_archive() ) {
		$classes[] = 'left-sidebar-template';
	}
	if ( $inline_options['default_index_layout'] == 'Content / Sidebar / Sidebar' && is_home() || $inline_options['default_index_layout'] == 'Left Sidebar' && is_post_type_archive() ) {
		$classes[] = 'content-sidebar-sidebar-template';
	}
	if ( $inline_options['default_index_layout'] == 'Sidebar / Content / Sidebar' && is_home() || $inline_options['default_index_layout'] == 'Sidebar / Content / Sidebar' && is_post_type_archive() ) {
		$classes[] = 'sidebar-content-sidebar-template';
	}
	if ( $inline_options['default_index_layout'] == 'Sidebar / Sidebar / Content' && is_home() || $inline_options['default_index_layout'] == 'Sidebar / Sidebar / Content' && is_post_type_archive() ) {
		$classes[] = 'sidebar-sidebar-content-template';
	}
	
	return array_unique( $classes );

}

/**
 *
 * This function outputs our body classes when no search results are found.
 *
 * @since 1.0
 *
 */
function inline_search_body_class( $classes ) {

	global $inline_options, $post;
	
	if ( $inline_options['default_post_layout'] == 'Full Width' && ( ! isset( $post ) && is_search() ) ) {
		$classes[] = 'full-width-template';
	}
	if ( $inline_options['default_post_layout'] == 'Left Sidebar' && ( ! isset( $post ) && is_search() ) ) {
		$classes[] = 'left-sidebar-template';	
	}
	if ( $inline_options['default_post_layout'] == 'Content / Sidebar / Sidebar' && ( ! isset( $post ) && is_search() ) ) {
		$classes[] = 'content-sidebar-sidebar-template';	
	}
	if ( $inline_options['default_post_layout'] == 'Sidebar / Content / Sidebar' && ( ! isset( $post ) && is_search() ) ) {
		$classes[] = 'sidebar-content-sidebar-template';
	}
	if ( $inline_options['default_post_layout'] == 'Sidebar / Sidebar / Content' && ( ! isset( $post ) && is_search() ) ) {
		$classes[] = 'sidebar-sidebar-content-template';
	}
	
	return array_unique( $classes );

}