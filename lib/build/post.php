<?php
/**
 *
 * Boots up all the information necessary to output the post content part of the document.
 *
 * This is where the bulk (and I mean the real meaty bulk) of the action happens for our theme. Let's get started, shall we?
 *
 * @package inLine
 *
 */

add_action( 'inline_before_post_title', 'inline_post_date' );
/**
 *
 * This function outputs the date structure the floats beside posts.
 *
 * @since 1.0
 *
 */
function inline_post_date() {

	global $post;

	if ( ! is_page( $post->ID ) ) {
		echo '<div class="post-date">';
			echo '<div class="num">';
				echo get_the_time( 'd' );
			echo '</div><!--end .num-->';
			echo '<div class="month">';
				echo get_the_time( 'M' );
			echo '</div><!--end .month-->';
			echo '<div class="year">';
				echo get_the_time( 'Y' );
			echo '</div><!--end .year-->';
		echo '</div><!--end .post-date-->';
	}

}

add_action( 'inline_before_post_title', 'inline_sticky_post' );
/**
 *
 * This function outputs the sticky post icon for any post checked as 'sticky'.
 *
 * @since 1.0
 *
 */
function inline_sticky_post() {

	global $post;

	if ( ! is_page( $post->ID ) && is_sticky() ) {
		echo '<div class="post-sticky"></div><!--end .post-sticky-->';
	}

}


add_action( 'inline_post_title', 'inline_do_post_title' );
/**
 *
 * This function outputs the post title for all posts.
 *
 * @since 1.0
 *
 */
function inline_do_post_title() {

	global $post;

	if ( ! is_page( $post->ID ) && ! is_single() ) {
		echo '<h2 class="entry-title">'; ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		<?php echo '</h2>'; ?>
	<?php }
	
	elseif ( !is_page( $post->ID ) && !has_post_format( 'aside' ) ) { 
		echo '<h2 class="entry-title">';
			echo the_title();
		echo '</h2>';
	}

}

add_action( 'inline_after_post_title', 'inline_post_meta' );
/**
 *
 * This function outputs the post meta author info for all posts.
 *
 * The following filters are added to this function by default:
 *
 * inline_meta_author_text, inline_post_meta_separator, inline_meta_author_link, inline_post_meta_comments_zero, inline_post_meta_comments
 * inline_post_meta_comments_one, inline_post_meta
 *
 * @since 1.0
 * @updated 6-30-11 - wrapped all functions into one function hooked into inline_after_post_title, all content can be filtered
 *
 */
function inline_post_meta( $query ) {

	global $post, $authordata;
     
        // Make sure we're not on a page or using the post format 'aside'
    	if ( ! is_page( $post->ID ) ) {
     
            // Build the Author Link. Copy of the_author_posts_link() except not echoing
        	$author_link = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url( $authordata->ID, $authordata->user_nicename ), esc_attr( sprintf( __( 'Posts by %s', 'inline' ), get_the_author() ) ), get_the_author() );
                   
          	// Build the Author line with filters
            $author = '<span class="post-author">' . apply_filters( 'inline_meta_author_text', __( 'By ', 'inline' ) ) . apply_filters( 'inline_meta_author_link', $author_link ) . '</span>';
                   
           		// Create Separator
            	$separator = '<span class="sep">' . apply_filters( 'inline_post_meta_separator', __( '|', 'inline' ) ) . '</span>';
                   
            	// Build Categories
            	$categories = '<span class="post-categories">' . get_the_category_list(', ') . '</span>';
   
            	// Build Comments
            	global $inline_options;
            	$comments = '';
            	$num_comments = '';
            
            	if ( comments_open() && $inline_options['inline_no_post_comments'] == '' ) {
                   
            		$comments .= $separator . '<span class="post-comments"><a href="' . get_permalink() . '#comments">';
            	
                	$num_comments = get_comments_number();
                
                	if ( $num_comments == 0 ) {
                		$comments .= apply_filters( 'inline_post_meta_comments_zero', __( 'Be the first to comment!', 'inline' ) );
                	} elseif ( $num_comments > 1 ) {
                		$comments .= $num_comments . apply_filters( 'inline_post_meta_comments', __( ' Comments', 'inline' ) );
                	} else {
                		$comments .= apply_filters( 'inline_post_meta_comments_one', __( '1 Comment', 'inline' ) );
                	}
                           
                	$comments .= '</a></span>';
                
            	}
                   
            // Build Meta
            $meta = $author . $separator . $categories . $comments;
            echo '<p class="post-meta"> ' . apply_filters( 'inline_post_meta', $meta ) . '</p>';                           
            
		}

}

add_action( 'inline_before_post_content', 'inline_post_thumbnail' );
/**
 *
 * This function outputs the post thumbnail for the post (not the single post, only index and archive pages).
 *
 * The following filters are added to this function by default:
 *
 * inline_index_post_thumbnail
 *
 * @since 1.0
 *
 */
function inline_post_thumbnail() {

	if ( has_post_thumbnail() ) {
	
		if ( ! is_single() || ! is_singular() ) {
			echo '<div class="post-thumb">'; ?>
				<a class="thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( apply_filters( 'inline_index_post_thumbnail', __( 'post-thumb', 'inline' ) ) ); ?></a>
			<?php echo '</div><!--end .post-thumb-->'; ?>
		<?php }
		
	}	

}

add_action( 'inline_before_post_content', 'inline_post_thumbnail_full', 9 );
/**
 *
 * This function outputs the post thumbnail for the single and singular post pages.
 *
 * The following filters are added to this function by default:
 *
 * inline_full_middle_thumbnail, inline_full_side_thumbnail, inline_full_post_thumbnail, inline_full_width_thumbnail
 *
 * @since 1.0
 *
 */
function inline_post_thumbnail_full() {

	global $inline_options, $post;

	if ( has_post_thumbnail() ) {
	
		if ( is_single() && $inline_options['default_post_layout'] == 'Sidebar / Content / Sidebar' && get_post_meta( $post->ID, '_wp_post_template', true ) == '' || is_single() && get_post_meta( $post->ID, '_wp_post_template', true ) == 'sidebar-content-sidebar-template-post.php' ) {
			echo '<div class="post-full">';
				the_post_thumbnail( apply_filters( 'inline_full_middle_thumbnail', __( 'post-full-template-mid', 'inline' ) ) );
			echo '</div><!--end .post-full-->';
		}
		
		elseif ( is_single() && $inline_options['default_post_layout'] == 'Content / Sidebar / Sidebar' && get_post_meta( $post->ID, '_wp_post_template', true ) == '' || is_single() && $inline_options['default_post_layout'] == 'Sidebar / Sidebar / Content' && get_post_meta( $post->ID, '_wp_post_template', true ) == '' || is_single() && get_post_meta( $post->ID, '_wp_post_template', true ) == 'content-sidebar-sidebar-template-post.php' || is_single() && get_post_meta( $post->ID, '_wp_post_template', true ) == 'sidebar-sidebar-content-template-post.php' ) {
			echo '<div class="post-full">';
				the_post_thumbnail( apply_filters( 'inline_full_side_thumbnail', __( 'post-full-template-side', 'inline' ) ) );
			echo '</div><!--end .post-full-->';
		}
		
		elseif ( is_single() && $inline_options['default_post_layout'] == 'Full Width' && get_post_meta( $post->ID, '_wp_post_template', true ) == '' || is_single() && $inline_options['default_post_layout'] == 'Full Width' && get_post_meta( $post->ID, '_wp_post_template', true ) == 'full-width-template-post.php' ) {
			echo '<div class="post-full">';
				the_post_thumbnail( apply_filters( 'inline_full_width_thumbnail', __( 'post-full-width', 'inline' ) ) );
			echo '</div><!--end .post-full-->';
		}
	
		elseif ( is_single() || is_singular() ) {
			echo '<div class="post-full">';
				the_post_thumbnail( apply_filters( 'inline_full_post_thumbnail', __( 'post-full', 'inline' ) ) );
			echo '</div><!--end .post-full-->';
		}
		
	}	

}

add_action( 'inline_post_content', 'inline_do_post_content' );
/**
 *
 * This function outputs the content for single and page posts.
 *
 * @since 1.0
 *
 */
function inline_do_post_content() {
	
	the_content();

}

/**
 *
 * This function outputs the content for index and archive pages.
 *
 * The following filters are added to this function by default:
 *
 * inline_read_more_text
 *
 * @since 1.0
 *
 */

function inline_do_post_content_excerpt() {
	
	global $inline_options;
	
		if ( is_home() && $inline_options['default_index_content'] == 'Post Excerpt' || is_archive() && $inline_options['default_archive_content'] == 'Post Excerpt' || is_search() && $inline_options['default_search_content'] == 'Post Excerpt' ) {
	
			the_excerpt(); ?>
			<a class="post-more" href="<?php the_permalink(); ?>"><?php echo apply_filters( 'inline_read_more_text', __( 'Continue Reading &rarr;', 'inline' ) ); ?></a>

		<?php }
	
		elseif ( is_home() && $inline_options['default_index_content'] == 'Post Content' || is_archive() && $inline_options['default_archive_content'] == 'Post Content' || is_search() && $inline_options['default_search_content'] == 'Post Content' || has_post_format( 'aside' ) ) {
		
			the_content();
		}
	
}

/**
 *
 * This function outputs the content for the 404 page.
 *
 * @since 1.0
 *
 */

function inline_do_post_content_404() { 

		echo '<div class="sorry">';
			echo '<p>';
				printf( __( 'We are sorry, but it seems that you have reached this page in error. You can <a href="%s">return to the homepage</a> or make a search below to find the correct page.', 'inline' ), trailingslashit( home_url() ) );
			echo '</p>';
			get_search_form();
		echo '</div><!--end .sorry-->';

}

add_action( 'inline_after_post_content', 'inline_link_pages' );
/**
 *
 * This function outputs the page links if someone is making a post with multiple pages.
 *
 * The following filters are added to this function by default:
 *
 * inline_custom_link_pages
 *
 * @since 1.0
 *
 */
function inline_link_pages() {

	if ( is_singular() ) {
		$args = array(
			'before' => '<div class="page-links">' . __( '<span>View More Pages: </span>', 'inline' ),
			'after' => '</div>',
			'next_or_number' => 'next',
			'nextpagelink' => __( '&rarr;', 'inline' ),
			'previouspagelink' => __( '&larr;', 'inline' )	
		);
		wp_link_pages( apply_filters( 'inline_custom_link_pages', $args ) );
	}

}

add_action( 'inline_after_post_content', 'inline_post_tags' );
/**
 *
 * This function outputs the post tags for single posts.
 *
 * The following filters are added to this function by default:
 *
 * inline_post_tags_text
 *
 * @since 1.0
 *
 */
function inline_post_tags() {

	if ( is_single() ) {
	
		if ( has_tag() ) {
			echo '<div class="post-tags">';
				echo the_tags( apply_filters( 'inline_post_tags_text', __( 'Tagged as: ', 'inline' ) ), ', ', '<br />' );
			echo '</div><!--end .post-tags-->';
		}
	
	}

}

add_action( 'inline_after_post', 'inline_trackback_rdf' );
/**
 *
 * This function outputs the trackback stuff for pingbacks.
 *
 * @since 1.0
 *
 */
function inline_trackback_rdf() {

	if ( is_single() ) { ?>
		<!--
		<?php trackback_rdf(); ?>
		-->
	<?php }

}

add_action( 'inline_after_post', 'inline_comments' );
/**
 *
 * This function outputs the comments template for single and page posts.
 *
 * @since 1.0
 *
 */
function inline_comments() {

	global $inline_options;
	
	if ( $inline_options['inline_no_post_comments'] != '' && is_single() ) {
		return;
	}
	if ( $inline_options['inline_no_page_comments'] != '' && is_page() ) {
		return;
	}

	if ( ! is_home() || ! is_archive() ) {
		if ( comments_open() ) {
			comments_template( '/comments.php', true );
		}
	}

}

add_action( 'inline_pagination', 'inline_do_page_pagination', 11 );
/**
 *
 * This function outputs page pagination for index and archive pages.
 *
 * @since 1.0
 *
 */
function inline_do_page_pagination() {
	
		if ( is_home() || is_archive() || is_search() || is_post_type_archive() ) {
			echo '<div class="paginate">';
				if ( function_exists( 'inline_page_nav' ) ) { 
					inline_page_nav();
				}	
			echo '</div><!--end .paginate-->';
		}

}

add_action( 'inline_pagination', 'inline_do_post_pagination', 11 );
/**
 *
 * This function outputs post pagination for single posts.
 *
 * The following filters are added to this function by default:
 *
 * inline_post_pagination_text
 *
 * @since 1.0
 *
 */
function inline_do_post_pagination() {

	global $wp_query;
	
	$count = wp_count_posts();
	$publish = $count->publish;
	
		if ( is_single() && $publish > 1 ) {
			echo '<div class="pagination">'; ?>
			<span class="pagination-text"><?php echo apply_filters( 'inline_post_pagination_text', __( 'View More Posts:', 'inline' ) ); ?></span>
				<?php echo '<ul>'; ?>
					<li class="next"><?php previous_post_link( '%link', '&larr;' ); ?></li>
					<li class="prev"><?php next_post_link( '%link', '&rarr;' ); ?></li>
				<?php echo '</ul>';
			echo '</div><!--end .pagination-->';
		}

}

add_action( 'inline_after_content', 'inline_main_sidebar' );
/**
 *
 * This function outputs the main sidebar for the inLine theme.
 *
 * @since 1.0
 *
 */
function inline_main_sidebar() {

	get_sidebar();

}

/**
 *
 * This function outputs the alternate sidebar for the inLine theme. It also adds a clearfix to make sure our floats clear correctly.
 *
 * THIS FUNCTION MUST BE USED IN A TEMPLATE FILE IN ORDER TO BE ACTIVATED! :)
 *
 * @since 1.0
 *
 */
function inline_alternate_sidebar() {

	get_sidebar( 'alt' );

}

add_action( 'inline_after_content', 'inline_content_clearfix', 99 );
/**
 *
 * This function adds a clearfix for the sidebar/content floats. Don't try using the overflow: hidden; trick or your date and sticky icons will
 * magically disappear. ;)
 *
 * @since 1.0
 *
 */
function inline_content_clearfix() {

	?>
	<div class="clear"></div>
	<?php

}

add_action( 'the_post', 'inline_post_content_helper' );
/**
 *
 * This function acts as a helper for our other functions so that we can easily add/modify/remove content outputted for excerpts,
 * archive pages, search pages, etc.
 *
 * @since 1.0
 *
 */
function inline_post_content_helper() {

	if ( is_home() || is_archive() || is_search() ) {
		remove_action( 'inline_post_content', 'inline_do_post_content' );
		add_action( 'inline_post_content', 'inline_do_post_content_excerpt' );
	}

}

add_action( 'template_redirect', 'inline_four_content_helper' );
/**
 *
 * This function acts as a helper for our 404 page. Since the action hook 'the_post' fires too late for 404 pages, we add this into the action
 * hook 'template_redirect', which fires before any post content is loaded.
 *
 * @since 1.0
 *
 */
function inline_four_content_helper() {

	if ( is_404() ) {
		remove_action( 'inline_content', 'inline_do_content' );
		add_action( 'inline_content', 'inline_do_post_content_404' );
		wp_reset_query();
	}

}
