<?php
/**
 *
 * This file contains all the functions that output the Page Archives template.
 *
 * @package inLine
 *
 */
 
/**
 *
 * This function outputs different page layouts as selected in the Theme Options menu.
 *
 * @since 1.0
 *
 */
function inline_page_archives_layout() {

	global $inline_options, $post;
	
	if ( $inline_options['default_page_layout'] == 'Default (Content / Sidebar)' && is_page() ) {
	}
	if ( $inline_options['default_page_layout'] == 'Full Width' && is_page() ) {
		add_filter( 'body_class', 'inline_page_body_class' );
		remove_action( 'inline_after_content', 'inline_main_sidebar' );
	}
	if ( $inline_options['default_page_layout'] == 'Left Sidebar' && is_page() ) {
		add_filter( 'body_class', 'inline_page_body_class' );
	}
	if ( $inline_options['default_page_layout'] == 'Content / Sidebar / Sidebar' && is_page() ) {
		add_filter( 'body_class', 'inline_page_body_class' );
		add_action( 'inline_after_content', 'inline_alternate_sidebar' );
	}
	if ( $inline_options['default_page_layout'] == 'Sidebar / Content / Sidebar' && is_page() ) {
		remove_action( 'inline_after_content', 'inline_main_sidebar' );
		add_filter( 'body_class', 'inline_page_body_class' );
		add_action( 'inline_before_content', 'inline_main_sidebar' );
		add_action( 'inline_after_content', 'inline_alternate_sidebar' );
	}
	if ( $inline_options['default_page_layout'] == 'Sidebar / Sidebar / Content' && is_page() ) {
		add_filter( 'body_class', 'inline_page_body_class' );
		add_action( 'inline_after_content', 'inline_alternate_sidebar' );
	}

}

/**
 *
 * This function outputs the starting structure for the Page Archives template.
 *
 * @since 1.0
 *
 */
function inline_archive_structure_start() {

	echo '<div id="archive">';
	
}

/**
 *
 * This function outputs the starting structure of the left column for the Page Archives template.
 *
 * @since 1.0
 *
 */
function inline_archive_left_column_start() {

	echo '<div class="left">';
	
}

/**
 *
 * This function outputs all of the left column info for the Page Archives template.
 *
 * The following filters are added to this function by default:
 * 
 * inline_month_archives_text, inline_recent_archives_text
 *
 * @since 1.0
 *
 */
function inline_archive_left_column() {

	echo '<h2>';
		echo apply_filters( 'inline_month_archives_text', __( 'Archives by Month:', 'inline' ) );
	echo '</h2>';
	
	echo '<ul class="monthly-archives">';
		wp_get_archives( 'type=monthly&show_post_count=1' );
	echo '</ul>';
	
	echo '<h2>';
		echo apply_filters( 'inline_recent_archives_text', __( '25 Most Recent Posts', 'inline' ) );
	echo '</h2>';
	
	echo '<ul class="recent-archives">';
	
		query_posts( 'showposts=25' );
		if ( have_posts() ) : while ( have_posts() ) : the_post(); // Start the loop for our posts
		?>
			<li><?php the_time( 'M j, Y' ); ?> - <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; endif; wp_reset_query();
		
	echo '</ul>';
		
}

/**
 *
 * This function outputs the ending structure of the left column for the Page Archives template.
 *
 * @since 1.0
 *
 */
function inline_archive_left_column_end() {

	echo '</div><!--end .left-->';
	
}

/**
 *
 * This function outputs the starting structure of the right column for the Page Archives template.
 *
 * @since 1.0
 *
 */
function inline_archive_right_column_start() {

	echo '<div class="right">';
	
}

/**
 *
 * This function outputs all of the right column info for the Page Archives template.
 *
 * The following filters are added to this function by default:
 *
 * inline_category_archives_text, inline_author_archives_text
 *
 * @since 1.0
 *
 */
function inline_archive_right_column() {

	echo '<h2>';
		echo apply_filters( 'inline_category_archives_text', __( 'Archives by Category:', 'inline' ) );
	echo '</h2>';
	
	echo '<ul class="category-archives">';
		wp_list_categories( 'title_li=&hierarchical=0&show_count=1' );
	echo '</ul>';
	
	echo '<h2>';
		echo apply_filters( 'inline_author_archives_text', __( 'Archives by Author:', 'inline' ) );
	echo '</h2>';
	
	echo '<ul class="author-archives">';
		wp_list_authors( 'optioncount=1' );
	echo '</ul>';
		
}

/**
 *
 * This function outputs the ending structure of the right column for the Page Archives template.
 *
 * @since 1.0
 *
 */
function inline_archive_right_column_end() {

	echo '</div><!--end .right-->';
	
}

/**
 *
 * This function outputs the bottom search form for the Page Archives template.
 *
 * The following filters are added to this function by default:
 *
 * inline_search_archives_text
 *
 * @since 1.0
 *
 */
function inline_archive_search_form() {

	echo '<div class="archive-search clear">';
		echo '<h2 class="search">';
			echo apply_filters( 'inline_search_archives_text', __( 'You can also search the site using the form below:', 'inline' ) );
		echo '</h2>';
		
			get_search_form();
			
	echo '</div><!--end .archive-search-->';

}

/**
 *
 * This function outputs the ending structure for the Page Archives template.
 *
 * @since 1.0
 *
 */
function inline_archive_structure_end() {

	echo '</div><!--end #archive-->';
	
}