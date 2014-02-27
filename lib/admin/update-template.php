<?php
/**
 *
 * This file is key for updating our default post and page layout. It look to see if a new layout is set, and if so, it updates it with the 
 * relevant admin meta box as well. This can be overwritten on a per post/page basis.
 *
 * @package inLine
 *
 */

add_action( 'template_redirect', 'inline_default_page_template_setup', 9 );
/**
 *
 * This function outputs our default page layouts as chosen in the Theme Options panel.
 *
 * We add a low priority to this action to make sure that it fires before the default template is loaded.
 *
 * @since 1.0
 *
 */
function inline_default_page_template_setup() {

	global $inline_options, $post, $classes;
	
	if ( $inline_options['default_page_layout'] == 'Default (Content / Sidebar)' && is_page() ) {
	}
	
	if ( $inline_options['default_page_layout'] == 'Full Width' && is_page() ) {
		if ( get_post_meta( $post->ID, '_wp_page_template', true ) == 'default' ) {
			add_filter( 'body_class', 'inline_page_body_class' );
			locate_template( array( 'full-width-template.php' ), true );
			exit();
		}
	}
	
	if ( $inline_options['default_page_layout'] == 'Left Sidebar' && is_page() ) {
		if ( get_post_meta( $post->ID, '_wp_page_template', true ) == 'default' ) {
			add_filter( 'body_class', 'inline_page_body_class' );
			locate_template( array( 'left-sidebar-template.php' ), true );
			exit();
		}
	}
	
	if ( $inline_options['default_page_layout'] == 'Content / Sidebar / Sidebar' && is_page() ) {
		if ( get_post_meta( $post->ID, '_wp_page_template', true ) == 'default' ) {
			add_filter( 'body_class', 'inline_page_body_class' );
			locate_template( array( 'content-sidebar-sidebar-template.php' ), true );
			exit();
		}
	}
	
	if ( $inline_options['default_page_layout'] == 'Sidebar / Content / Sidebar' && is_page() ) {
		if ( get_post_meta( $post->ID, '_wp_page_template', true ) == 'default' ) {
			add_filter( 'body_class', 'inline_page_body_class' );
			locate_template( array( 'sidebar-content-sidebar-template.php' ), true );
			exit( $default_template );
		}
	}
	
	if ( $inline_options['default_page_layout'] == 'Sidebar / Sidebar / Content' && is_page() ) {
		if ( get_post_meta( $post->ID, '_wp_page_template', true ) == 'default' ) {
			add_filter( 'body_class', 'inline_page_body_class' );
			locate_template( array( 'sidebar-sidebar-content-template.php' ), true );
			exit();
		}
	}

}

add_action( 'template_redirect', 'inline_default_post_template_setup', 9 );
/**
 *
 * This function outputs our default post layouts as chosen in the Theme Options panel.
 *
 * We add a low priority to this action to make sure that it fires before the default template is loaded.
 *
 * @since 1.0
 *
 */
function inline_default_post_template_setup() {

	global $inline_options, $post, $classes;
	
	if ( $inline_options['default_post_layout'] == 'Default (Content / Sidebar)' && ! is_page() ) {
	}
	
	if ( $inline_options['default_post_layout'] == 'Full Width' && ! is_page() && ! is_home() && ! ( ! isset( $post ) && is_search() ) ) {
		if ( get_post_meta( $post->ID, '_wp_post_template', true ) == '' ) {
			add_filter( 'body_class', 'inline_post_body_class' );
			locate_template( array( 'full-width-template.php' ), true );
			exit();
		}
	}
	
	if ( $inline_options['default_post_layout'] == 'Left Sidebar' && ! is_page() && ! is_home() && ! ( ! isset( $post ) && is_search() ) ) {
		if ( get_post_meta( $post->ID, '_wp_post_template', true ) == '' ) {
			add_filter( 'body_class', 'inline_post_body_class' );
			locate_template( array( 'left-sidebar-template.php' ), true );
			exit();
		}
	}
	
	if ( $inline_options['default_post_layout'] == 'Content / Sidebar / Sidebar' && ! is_page() && ! is_home() && ! ( ! isset( $post ) && is_search() ) ) {
		if ( get_post_meta( $post->ID, '_wp_post_template', true ) == '' ) {
			add_filter( 'body_class', 'inline_post_body_class' );
			locate_template( array( 'content-sidebar-sidebar-template.php' ), true );
			exit();
		}
	}
	
	if ( $inline_options['default_post_layout'] == 'Sidebar / Content / Sidebar' && ! is_page() && ! is_home() && ! ( ! isset( $post ) && is_search() ) ) {
		if ( get_post_meta( $post->ID, '_wp_post_template', true ) == '' ) {
			add_filter( 'body_class', 'inline_post_body_class' );
			locate_template( array( 'sidebar-content-sidebar-template.php' ), true );
			exit();
		}
	}
	
	if ( $inline_options['default_post_layout'] == 'Sidebar / Sidebar / Content' && ! is_page() && ! is_home() && ! ( ! isset( $post ) && is_search() ) ) {
		if ( get_post_meta( $post->ID, '_wp_post_template', true ) == '' ) {
			add_filter( 'body_class', 'inline_post_body_class' );
			locate_template( array( 'sidebar-sidebar-content-template.php' ), true );
			exit();
		}
	}

}

add_action( 'template_redirect', 'inline_default_index_template_setup', 9 );
/**
 *
 * This function outputs our default index layouts as chosen in the Theme Options panel.
 *
 * We add a low priority to this action to make sure that it fires before the default template is loaded.
 *
 * @since 1.0
 *
 */
function inline_default_index_template_setup() {

	global $inline_options, $post, $classes;

	if ( $inline_options['default_index_layout'] == 'Default (Content / Sidebar)' && is_home() || $inline_options['default_index_layout'] == 'Default (Content / Sidebar)' && is_post_type_archive() ) {
	}
	
	if ( $inline_options['default_index_layout'] == 'Full Width' && is_home() || $inline_options['default_index_layout'] == 'Full Width' && is_post_type_archive() ) {	
			add_filter( 'body_class', 'inline_index_body_class' );
			locate_template( array( 'full-width-template.php' ), true );
			exit();
	}
	
	if ( $inline_options['default_index_layout'] == 'Left Sidebar' && is_home() || $inline_options['default_index_layout'] == 'Left Sidebar' && is_post_type_archive() ) {	
			add_filter( 'body_class', 'inline_index_body_class' );
			locate_template( array( 'left-sidebar-template.php' ), true );
			exit();
	}
	
	if ( $inline_options['default_index_layout'] == 'Content / Sidebar / Sidebar' && is_home() || $inline_options['default_index_layout'] == 'Content / Sidebar / Sidebar' && is_post_type_archive() ) {	
			add_filter( 'body_class', 'inline_index_body_class' );
			locate_template( array( 'content-sidebar-sidebar-template.php' ), true );
			exit();
	}
	
	if ( $inline_options['default_index_layout'] == 'Sidebar / Content / Sidebar' && is_home() || $inline_options['default_index_layout'] == 'Sidebar / Content / Sidebar' && is_post_type_archive() ) {	
			add_filter( 'body_class', 'inline_index_body_class' );
			locate_template( array( 'sidebar-content-sidebar-template.php' ), true );
			exit();
	}
	
	if ( $inline_options['default_index_layout'] == 'Sidebar / Sidebar / Content' && is_home() || $inline_options['default_index_layout'] == 'Sidebar / Sidebar / Content' && is_post_type_archive() ) {	
			add_filter( 'body_class', 'inline_index_body_class' );
			locate_template( array( 'sidebar-sidebar-content-template.php' ), true );
			exit();
	}

}

add_action( 'template_redirect', 'inline_default_search_template_setup', 9 );
/**
 *
 * This function outputs our default post layouts for search pages with no results.
 *
 * We add a low priority to this action to make sure that it fires before the default template is loaded.
 *
 * This function contains an important filter: inline_search_no_result_custom_template
 * This filter will allow someone to set a specific function into the inline_alternate_loop hook for output so they can customize search
 * pages with no results for templates other than the default template.
 *
 * @since 1.0
 *
 */
function inline_default_search_template_setup() {

	global $inline_options, $post, $classes;
	
	if ( $inline_options['default_post_layout'] == 'Default (Content / Sidebar)' && ( ! isset( $post ) && is_search() ) ) {
	}
	
	if ( $inline_options['default_post_layout'] == 'Full Width' && ( ! isset( $post ) && is_search() ) ) {
		apply_filters( 'inline_search_no_result_custom_template', __( add_action( 'inline_alternate_loop', 'inline_search_no_results' ), 'inline' ) );
		add_filter( 'body_class', 'inline_search_body_class' );
		add_action( 'template_redirect', 'inline_search_no_results_template', 11 );
	}
	
	if ( $inline_options['default_post_layout'] == 'Left Sidebar' && ( ! isset( $post ) && is_search() ) ) {
		apply_filters( 'inline_search_no_result_custom_template', __( add_action( 'inline_alternate_loop', 'inline_search_no_results' ), 'inline' ) );
		add_filter( 'body_class', 'inline_search_body_class' );
		add_action( 'template_redirect', 'inline_search_no_results_template', 11 );
	}
	
	if ( $inline_options['default_post_layout'] == 'Content / Sidebar / Sidebar' && ( ! isset( $post ) && is_search() ) ) {
		apply_filters( 'inline_search_no_result_custom_template', __( add_action( 'inline_alternate_loop', 'inline_search_no_results' ), 'inline' ) );
		add_filter( 'body_class', 'inline_search_body_class' );
		add_action( 'template_redirect', 'inline_search_no_results_template', 11 );
	}

	if ( $inline_options['default_post_layout'] == 'Sidebar / Content / Sidebar' && ( ! isset( $post ) && is_search() ) ) {
		apply_filters( 'inline_search_no_result_custom_template', __( add_action( 'inline_alternate_loop', 'inline_search_no_results' ), 'inline' ) );
		add_filter( 'body_class', 'inline_search_body_class' );
		add_action( 'template_redirect', 'inline_search_no_results_template', 11 );
	}
	
	if ( $inline_options['default_post_layout'] == 'Sidebar / Sidebar / Content' && ( ! isset( $post ) && is_search() ) ) {
		apply_filters( 'inline_search_no_result_custom_template', __( add_action( 'inline_alternate_loop', 'inline_search_no_results' ), 'inline' ) );
		add_filter( 'body_class', 'inline_search_body_class' );
		add_action( 'template_redirect', 'inline_search_no_results_template', 11 );
	}

}

/**
 *
 * This function loads up our templates for redirection whenever we hit a custom template search page with no results.
 *
 * @since 1.0
 *
 */
function inline_search_no_results_template() {

	global $inline_options;
	
	if ( $inline_options['default_post_layout'] == 'Full Width' ) {
		locate_template( array( 'full-width-template.php' ), true );
		exit();
	}
	
	if ( $inline_options['default_post_layout'] == 'Left Sidebar' ) {
		locate_template( array( 'left-sidebar-template.php' ), true );
		exit();
	}
	
	if ( $inline_options['default_post_layout'] == 'Content / Sidebar / Sidebar' ) {
		locate_template( array( 'content-sidebar-sidebar-template.php' ), true );
		exit();
	}
	
	if ( $inline_options['default_post_layout'] == 'Sidebar / Content / Sidebar' ) {
		locate_template( array( 'sidebar-content-sidebar-template.php' ), true );
		exit();
	}
	
	if ( $inline_options['default_post_layout'] == 'Sidebar / Sidebar / Content' ) {
		locate_template( array( 'sidebar-sidebar-content-template.php' ), true );
		exit();
	}
	
}