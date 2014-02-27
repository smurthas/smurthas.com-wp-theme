<?php
/**
 *
 * This file references all of our action hooks.
 *
 * @package inLine
 *
 */
 
// Init hooks
function inline_init() { do_action( 'inline_init' ); }
function inline_pre_theme() { do_action( 'inline_pre_theme' ); }

// Before HTML begins (within <head></head> and just after the opening <body> tag
function inline_head_doctype() { do_action( 'inline_head_doctype' ); }
function inline_head_meta_output() { do_action( 'inline_head_meta_output' ); }
function inline_title() { do_action( 'inline_title' ); }
function inline_head_links() { do_action( 'inline_head_links' ); }
function inline_head_link_output() { do_action( 'inline_head_link_output' ); }
function inline_style() { do_action( 'inline_style' ); }
function inline_favicon() { do_action( 'inline_favicon' ); }
function inline_before_html() { do_action( 'inline_before_html' ); }

// Header action hooks
function inline_before_wireframe() { do_action( 'inline_before_wireframe' ); }
function inline_before_header() { do_action( 'inline_before_header' ); }
function inline_header() { do_action( 'inline_header') ; }
function inline_after_header() { do_action('inline_after_header'); }

// Hooks added directly to inline_header();
function inline_site_title() { do_action( 'inline_site_title' ); }
function inline_header_nav() { do_action( 'inline_header_nav' ); }

// After header hooks
function inline_secondary_nav() { do_action( 'inline_secondary_nav' ); }

// Top section action hooks
function inline_before_top_section() { do_action( 'inline_before_top_section' ); }
function inline_top_section() { do_action( 'inline_top_section' ); }
function inline_after_top_section() { do_action( 'inline_after_top_section' ); }

// Hooks added directly to inline_top_section();
function inline_page_titles() { do_action( 'inline_page_titles' ); }
function inline_top_section_widget() { do_action( 'inline_top_section_widget' ); }

// Hooks for the content section
function inline_before_main_content() { do_action( 'inline_before_main_content' ); }
function inline_before_content_sidebar_wrapper() { do_action( 'inline_before_content_sidebar_wrapper' ); }
function inline_before_content() { do_action( 'inline_before_content' ); }
function inline_content() { do_action( 'inline_content' ); }
function inline_after_content() { do_action( 'inline_after_content' ); }
function inline_after_content_sidebar_wrapper() { do_action( 'inline_after_content_sidebar_wrapper' ); }
function inline_after_main_content() { do_action( 'inline_after_main_content' ); }

// Hooks for the loop
function inline_before_post() { do_action( 'inline_before_post' ); }
function inline_before_post_title() { do_action( 'inline_before_post_title' ); }
function inline_post_title() { do_action( 'inline_post_title' ); }
function inline_after_post_title() { do_action( 'inline_after_post_title' ); }
function inline_before_post_content() { do_action( 'inline_before_post_content' ); }
function inline_post_content() { do_action( 'inline_post_content' ); }
function inline_after_post_content() { do_action( 'inline_after_post_content' ); }
function inline_after_post() { do_action( 'inline_after_post' ); }
function inline_pagination() { do_action( 'inline_pagination' ); }
function inline_alternate_loop() { do_action( 'inline_alternate_loop' ); }

// Sidebar action hooks
function inline_before_main_sidebar() { do_action( 'inline_before_main_sidebar' ); }
function inline_before_main_sidebar_widgets() { do_action( 'inline_before_main_sidebar_widgets' ); }
function inline_before_sidebar_alt() { do_action( 'inline_before_sidebar_alt' ); }
function inline_before_sidebar_alt_widgets() { do_action( 'inline_before_sidebar_alt_widgets' ); }
function inline_sidebar() { do_action( 'inline_sidebar' ); }
function inline_sidebar_alt() { do_action( 'inline_sidebar_alt' ); }
function inline_after_main_sidebar_widgets() { do_action( 'inline_after_main_sidebar_widgets' ); }
function inline_after_main_sidebar() { do_action( 'inline_after_main_sidebar' ); }
function inline_after_sidebar_alt_widgets() { do_action( 'inline_after_sidebar_alt_widgets' ); }
function inline_after_sidebar_alt() { do_action( 'inline_after_sidebar_alt' ); }

// Comment hooks
function inline_before_comments() { do_action( 'inline_before_comments' ); }
function inline_before_comment_list() { do_action( 'inline_before_comment_list' ); }
function inline_before_pings_list() { do_action( 'inline_before_pings_list' ); }
function inline_comment_special_meta() { do_action( 'inline_comment_special_meta' ); }
function inline_comment_form() { do_action( 'inline_comment_form' ); }
function inline_after_comment_list() { do_action( 'inline_after_comment_list' ); }
function inline_after_pings_list() { do_action( 'inline_after_pings_list' ); }
function inline_before_comment_respond() { do_action( 'inline_before_comment_respond' ); }
function inline_after_comment_respond() { do_action( 'inline_after_comment_respond' ); }
function inline_after_comments() { do_action( 'inline_after_comments' ); }

// Footer action hooks
function inline_before_footer() { do_action( 'inline_before_footer' ); }
function inline_footer() { do_action( 'inline_footer' ); }
function inline_after_footer() { do_action( 'inline_after_footer' ); }
function inline_after_wireframe() { do_action( 'inline_after_wireframe' ); }

// Hooks added directly to inline_footer();
function inline_credits() { do_action( 'inline_credits' ); }

// After HTML hooks
function inline_after_html() { do_action( 'inline_after_html' ); }

// Admin hooks
function inline_admin_credits() { do_action( 'inline_admin_credits' ); }