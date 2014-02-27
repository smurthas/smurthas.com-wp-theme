<?php
/**
 *
 * Boots up all the information necessary to output the top-section part of the document.
 *
 * @package inLine
 *
 */

add_action( 'inline_top_section', 'inline_top_section_structure_start', 3 );
/**
 *
 * This function outputs the beginning structure of the inLine top section.
 *
 * We add a low priority to this action to make sure that it fires before anything else in the inline_top_section hook.
 *
 * @since 1.0
 *
 */
function inline_top_section_structure_start() {

	do_action( 'inline_before_top_section' );
	echo '<div id="top-section">';
	echo '<div class="wrap">';

}

//add_action( 'inline_page_titles', 'inline_do_page_titles' );
/**
 *
 * This function outputs the page title for each of the different page types in inLine. 
 *
 * The following filters are included in this action:
 *
 * inline_blog_title_label, inline_blog_title, inline_cpt_title, inline_page_title, inline_404_title_label, inline_search_results_text,
 * inline_search_no_results_text, inline_404_title, inline_archive_title_label, inline_category_title, inline_tag_title, inline_month_title, 
 * inline_day_title, inline_tax_title, inline_author_title
 *
 * @since 1.0
 *
 */
function inline_do_page_titles() {

	global $inline_options, $post;

	if ( is_home() && $inline_options['default_blog_title'] != '' || is_single() && 'post' == get_post_type() && $inline_options['default_blog_title'] != '' ) {
		$inline_title_tag = 'h2';
		$inline_title_output = sprintf( '<%s class="page-title">%s</%s>', $inline_title_tag, esc_attr( $inline_options['default_blog_title'] ), $inline_title_tag );
		echo $inline_title_output;
	}

	elseif ( is_home() || is_single() && 'post' == get_post_type() ) { // Outputs the title for single pages for normal posts
		$single_title = apply_filters( 'inline_blog_title_label', __( 'The Blog', 'inline' ) );
		$single_tag = 'h2';
		$single_output = sprintf( '<%s class="page-title">%s</%s>', $single_tag, $single_title, $single_tag );
		echo apply_filters( 'inline_blog_title', $single_output );
	}
	
	elseif ( is_single() || is_post_type_archive() ) { // Outputs the title for any other single post (for custom post types)
		$text = 'The ';	
		$alt_single_object = apply_filters( 'inline_cpt_title_label', __( $text . $post->post_type, 'inline' ) );
		$alt_single_title = $alt_single_object;
		$alt_single_tag = 'h2';
		$alt_single_output = sprintf( '<%s class="page-title">%s</%s>', $alt_single_tag, $alt_single_title, $alt_single_tag );
		echo apply_filters( 'inline_cpt_title', $alt_single_output ); 
	}

	elseif ( is_search() ) { // Outputs title for returned/not-returned search results
		if ( have_posts() ) {
			echo '<h1 class="page-title">';
				echo apply_filters( 'inline_search_results_text', __( 'You searched for: ', 'inline' ) ); the_search_query();
			echo '</h1>';
		}
	
		else {
			echo '<h1 class="page-title">';
				echo apply_filters( 'inline_search_no_results_text', __( 'No results found for: ', 'inline' ) ); the_search_query();
			echo '</h1>';
		}

	}

	if ( is_page() ) {
		$page_title = get_the_title();
		$page_tag = 'h1';
		$page_output = sprintf( '<%s class="page-title">%s</%s>', $page_tag, $page_title, $page_tag );
		echo apply_filters( 'inline_page_title', $page_output );
	}

	if ( is_404() ) {
		$four_title = apply_filters( 'inline_404_title_label', __( 'Error 404: Page Not Found', 'inline' ) );
		$four_tag = 'h1';
		$four_output = sprintf( '<%s class="page-title">%s</%s>', $four_tag, $four_title, $four_tag );
		echo apply_filters( 'inline_404_title', $four_output );	
	}

	if ( is_archive() ) {
		$archive_title = apply_filters( 'inline_archive_title_label', __( 'Viewing posts from: ', 'inline' ) );
		$archive_tag = 'h1';

		if ( is_category() ) {
			$category_title_object = single_cat_title( '', false );
			$category_title = $archive_title . $category_title_object;
			$category_output = sprintf( '<%s class="page-title">%s</%s>', $archive_tag, $category_title, $archive_tag );
			echo apply_filters( 'inline_category_title', $category_output );
		}
	
		if ( is_tag() ) {
			$tag_title_object = single_tag_title( '', false );
			$tag_title = $archive_title . $tag_title_object;
			$tag_output = sprintf( '<%s class="page-title">%s</%s>', $archive_tag, $tag_title, $archive_tag );
			echo apply_filters( 'inline_tag_title', $tag_output );
		}
	
		if ( is_month() ) {
			$month_title_object = get_the_time( 'F, Y' );
			$month_title = $archive_title . $month_title_object;
			$month_output = sprintf( '<%s class="page-title">%s</%s>', $archive_tag, $month_title, $archive_tag );
			echo apply_filters( 'inline_month_title', $month_output );
		}
	
		if ( is_day() ) {
			$day_title_object = get_the_time( 'F j, Y' );
			$day_title = $archive_title . $day_title_object;
			$day_output = sprintf( '<%s class="page-title">%s</%s>', $archive_tag, $day_title, $archive_tag );
			echo apply_filters( 'inline_day_title', $day_output );
		}
	
		if ( is_tax() ) {
			$tax_title_object = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$tax_title = $archive_title . $tax_title_object;
			$tax_output = sprintf( '<%s class="page-title">%s</%s>', $archive_tag, $tax_title, $archive_tag );
			echo apply_filters( 'inline_tax_title', $tax_output );
		}
	
		if ( is_author() ) {
			$author_title_object = get_query_var( 'author_name' ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
			$author_title = $archive_title . $author_title_object->display_name;
			$author_output = sprintf( '<%s class="page-title">%s</%s>', $archive_tag, $author_title, $archive_tag );
			echo apply_filters( 'inline_author_title', $author_output );
		}

	}

}

add_action( 'inline_top_section_widget', 'inline_do_top_section_widget' );
/**
 *
 * This function outputs a widgetized area to the right of the page titles. 
 *
 * @since 1.0
 *
 */
function inline_do_top_section_widget() {

	dynamic_sidebar( 'Top Section Widget' );

}

add_action( 'inline_top_section', 'inline_do_top_section' );
/**
 *
 * This function outputs all the content contained within the inLine top section. 
 *
 * The following hooks are included in this action:
 *
 * inline_page_titles
 *
 * @since 1.0
 *
 */
function inline_do_top_section() {

	do_action( 'inline_page_titles' );
	echo '<div class="top-widget">';
		do_action( 'inline_top_section_widget' );
	echo '</div><!--end .top-widget-->';
	echo '<div class="clear"></div>';

}

add_action( 'inline_top_section', 'inline_top_section_structure_end', 20 );
/**
 *
 * This function outputs the ending structure of the inLine top section.
 *
 * We add a high priority to this action to make sure that it fires after anything else in the inline_top_section hook.
 *
 * @since 1.0
 *
 */
function inline_top_section_structure_end() {

	echo '</div><!--end #top-section .wrap-->';
	echo '</div><!--end #top-section-->';
	do_action( 'inline_after_top_section' );

}
