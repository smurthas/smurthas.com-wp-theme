<?php
/**
 *
 * Outputs the main body classes for the inLine theme.
 *
 * @package inLine
 *
 */

add_filter( 'body_class', 'inline_body_classes' );
/**
 *
 * This function adds our main body classes.
 *
 * @since 1.0
 *
 */
function inline_body_classes( $classes ) {

	global $wp_query, $post, $inline_options, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if ( is_single() ) {
			$post_template_nicename = sanitize_html_class( str_replace( '.', '-', get_post_meta( $post->ID, '_wp_post_template', true ) ), '' );
			$post_template_nicename = sanitize_html_class( preg_replace( '/-php/', '', $post_template_nicename ), '' );
			$classes[] = $post_template_nicename;
	}
	
	if ( is_home() ) {
			$classes[] = 'home';
	}
	
	if ( is_404() ) {
			$classes[] = 'fourohfour';
	}
	
	if ( is_page_template() ) {
			$page_id = $wp_query->get_queried_object_id();
			$template_nicename = sanitize_html_class( str_replace( '.', '-', get_post_meta( $page_id, '_wp_page_template', true ) ), '' );
			$template_nicename = sanitize_html_class( preg_replace( '/-php/', '', $template_nicename ), '' );
			$classes[] = $template_nicename;
	}

	if ( $is_lynx ) {
			$classes[] = 'lynx';
	}
	
	if ( $is_gecko ) {
			$classes[] = 'gecko';
	}
	
	if ( $is_opera ) {
			$classes[] = 'opera';
	}
	
	if ( $is_NS4 ) {
			$classes[] = 'ns4';
	}
	
	if ( $is_safari ) {
			$classes[] = 'safari';
	}
	
	if ( $is_chrome ) { 
			$classes[] = 'chrome';
	}
	
	if ( $is_IE ) {
			$classes[] = 'ie';
	}

	if ( $is_iphone ) {
			$classes[] = 'iphone';
	}
	
	$browser = $_SERVER[ 'HTTP_USER_AGENT' ];
  
    if ( preg_match( "/Mac/", $browser ) ){
        	$classes[] = 'mac';
    }
    
    if ( preg_match( "/Windows/", $browser ) ){
        	$classes[] = 'windows';
    }
    
    if ( preg_match( "/Linux/", $browser ) ) {
        	$classes[] = 'linux';
    }
    
    return array_unique( $classes );
    
};