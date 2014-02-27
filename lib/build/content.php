<?php
/**
 *
 * Boots up all the information necessary to output the content part of the document.
 *
 * This is where the bulk of the action happens for our theme. Let's get started, shall we?
 *
 * @package inLine
 *
 */
 
add_action( 'inline_content', 'inline_content_structure_start', 3 );
/**
 *
 * This function outputs the beginning structure of the inLine content structure.
 *
 * We add a low priority to this action to make sure that it fires before anything else in the inline_content hook.
 *
 * The following hooks are added to this function by default:
 *
 * inline_before_content
 *
 * @since 1.0
 *
 */
function inline_content_structure_start() {

echo '<div id="main-content">';
	echo '<div class="wrap">';
	
		do_action( 'inline_before_content_sidebar_wrapper' );
	
		echo '<div class="content-sidebar-wrapper">';
		
		do_action( 'inline_before_content' ); // This hook fires right before the content div
		
		echo '<div id="content">';

}

add_action( 'inline_content', 'inline_do_content' );
/**
 *
 * This function outputs the loop for any of inLine's pages or posts. This is the meat of the theme and where a lot of the action happens.
 *
 * The following hooks are added to this function by default:
 *
 * inline_before_post, inline_before_post_title, inline_post_title, inline_after_post_title, inline_before_post_content, inline_post_content,
 * inline_after_post_content, inline_after_post, inline_pagination, inline_alternate_loop
 *
 * @since 1.0
 *
 */
function inline_do_content() {

if ( have_posts() ) : while ( have_posts() ) : the_post(); // Begin our content loop

	do_action( 'inline_before_post' ); ?>
	
	<article <?php post_class(); ?>>
	
		<?php do_action( 'inline_before_post_title' ); ?>
		<?php do_action( 'inline_post_title' ); ?>
		<?php do_action( 'inline_after_post_title' ); ?>
		
		<?php do_action( 'inline_before_post_content' ); ?>
		<?php do_action( 'inline_post_content' ); ?>
		<?php do_action( 'inline_after_post_content' ); ?>
		
	</article><!--end .post_class-->
	
	<?php
	
	do_action( 'inline_after_post' );
	
	endwhile; // Partially end our loop. We'll add in another loop if we have no posts
	
	do_action( 'inline_pagination' ); // Add pagination on posts if necessary
	
	else: do_action( 'inline_alternate_loop' );
	
	endif;
	
}

add_action( 'inline_content', 'inline_content_structure_end', 20 );
/**
 *
 * This function outputs the ending structure of the inLine content.
 *
 * We add a high priority to this action to make sure that it fires after anything else in the inline_content hook.
 *
 * The following hooks are added to this function by default:
 *
 * inline_after_content
 *
 * @since 1.0
 *
 */
function inline_content_structure_end() {

		echo '</div><!--end #content-->';
			
		do_action( 'inline_after_content' );
			
		echo '</div><!--end .content-sidebar-wrapper-->';
		
		do_action( 'inline_after_content_sidebar_wrapper' );
		
	echo '</div><!--end #main-content .wrap-->';
echo '</div><!--end #main-content-->';

}