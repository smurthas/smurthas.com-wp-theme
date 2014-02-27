<?php
/**
 *
 * Outputs the default script package functions for the inLine theme.
 *
 * @package inLine
 *
 */

add_action( 'init', 'inline_mobilize_jquery', 9 ); // Add a higher priority for this function to make sure it gets fired first
/**
 *
 * This function adds the standard jQuery library included with WordPress (v. 1.6.1). You can remove this to add Google's library if you want.
 *
 * @since 1.0
 *
 */
function inline_mobilize_jquery() {

	if ( ! is_admin() )
		wp_enqueue_script( 'jquery' );

}

add_action( 'init', 'inline_mobilize_standard_script' );
/**
 *
 * This function adds the standard JavaScript for the inLine theme. It is recommended that you do not remove this file!
 *
 * @since 1.0
 *
 */
function inline_mobilize_standard_script() {

	if ( ! is_admin() )
		wp_enqueue_script( 'inline_standard' , INLINE_JS_URL . '/standard.js', 'jquery', '1.0', true );

}

add_action( 'get_header', 'inline_comment_reply_script' );
/**
 *
 * This function adds the comment reply script for threaded comments.
 *
 * @since 1.0
 *
 */
function inline_comment_reply_script() {

	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() )
		wp_enqueue_script( 'comment-reply' );

}