<?php
/**
 *
 * This file houses our all of our comment mumbo jumbo! :)
 *
 * @package inLine
 *
 */

add_action( 'inline_comment_form', 'inline_do_comment_form' );
/**
 *
 * This function outputs the comment form structure for the inLine theme.
 *
 * The following filters are added to this function by default:
 *
 * inline_respond_comment_text, inline_comment_number_text, inline_comment_args, inline_pingback_args, inline_respond_form_text
 * inline_paginate_comments
 *
 * The following hooks are added to this function by default:
 *
 * inline_after_comment_respond
 *
 * @since 1.0
 *
 */
function inline_do_comment_form() {

	global $post, $wp_query, $comment;
	
	do_action( 'inline_before_comments' );

	echo '<div id="comments">';
	
		if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
			die ( 'Please do not load this page directly. Thanks!' );
		}
		if ( post_password_required() ) : {
			echo '<p class="nocomments">' . __( 'This post is password protected. Please enter the password to view comments.', 'inline' ) . '</p>';
			echo '</div><!--end #comments-->';
		}
		
		return; endif; // kill the current script, but allow for the rest of the template files to load

		if ( comments_open() || pings_open() ) : ?>
	
			<span class="leave-comment">
				<a href="<?php the_permalink(); ?>#respond-header"><?php echo apply_filters( 'inline_respond_comment_text', __( 'Add your comment &rarr;', 'inline' ) ); ?></a>
			</span>
			<h4 class="comment-number">
				<?php 
						$comment_number_text = comments_number( '0 Comments', '1 Comment', '% Comments' );
						apply_filters( 'inline_comment_number_text', __( $comment_number_text, 'inline' ) ); 	
				?>
			</h4>
			
		<?php endif;
		
		if ( have_comments() ) :
		
			if ( !empty( $wp_query->comments_by_type['comment'] ) ) : ?>
		
			<?php if ( get_comments_number() > get_option( 'comments_per_page' ) ) : ?>
			<div class="comment-navigation">
				<div class="comment-navigation-wrapper">
					<?php $paginate_comments = paginate_comments_links( array( 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); ?>
					<?php apply_filters( 'inline_paginate_comments', __( $paginate_comments, 'inline' ) ); ?>
				</div>
			</div>
			<?php endif; ?>
			
			<?php do_action( 'inline_before_comment_list' ); ?>
		
			<ol class="comment-list">
				<?php 
						$comment_args = 'type=comment&callback=inline_comments_callback';
						wp_list_comments( apply_filters( 'inline_comment_args', __( $comment_args, 'inline' ) ) );
				?>
			</ol>
			
			<?php do_action( 'inline_after_comment_list' ); ?>
			
			<?php endif; // end for $comment_by_type['comment']
			
		endif; // end for have_comments()
			
			if ( !empty( $wp_query->comments_by_type['pings'] ) && pings_open() ) : ?>
			
			<?php do_action( 'inline_before_pings_list' ); ?>
					
			<h3 class="pingback-title"><?php echo apply_filters( 'inline_pingback_title', __( 'Pingbacks', 'inline' ) ); ?></h3>
			<ol class="pingback-list">
				<?php 
						$pingback_args = 'type=pings&callback=inline_pingbacks_callback';
						wp_list_comments( apply_filters( 'inline_pingback_args', __( $pingback_args, 'inline' ) ) );
				?>		
			</ol>
			
			<?php do_action( 'inline_after_pings_list' ); ?>
			
			<?php endif; // end for $comment_by_type['pings']
		
		do_action( 'inline_comment_respond' ); ?>
	
	</div><!--end #comments-->
	
	<?php do_action( 'inline_after_comments' ); ?>

	<?php

}

/**
 *
 * This function outputs the comment callback function for the inLine comment form.
 *
 * The following filters are added to this function by default:
 *
 * inline_commenter_says, inline_get_avatar
 *
 * @since 1.0
 *
 */
function inline_comments_callback( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment; global $post; ?>
   
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<div class="outer-comment">
				<div class="inner-comment">
     				<div class="comment-text"><?php comment_text(); ?></div>
     			</div>
     		</div>
     		
     		<div class="comment-meta-wrapper">
     		
      			<span class="comment-author vcard">
        			<?php echo apply_filters( 'inline_get_avatar', __( get_avatar( $comment, $size='48' ), 'inline' ) ); ?>
        			<?php printf( __( '<span class="says">%1$s</span> <cite class="fn">%2$s</cite>' ), apply_filters( 'inline_commenter_says', __( 'By: ', 'inline' ) ), get_comment_author_link() ); ?>
      			</span>
      			<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &rarr;', 'inline' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span><!--end .reply-->
      	
      			<?php if ( $comment->comment_approved == '0' ) : ?>
         			<span class="wait"><?php _e( 'Your comment is awaiting moderation.', 'inline' ); ?></span>
         			<br />
         		<?php endif; ?>
      			
      			<?php if ( $comment->user_id == $post->post_author ) : ?>
      				<span class="author"><?php _e( 'Author', 'inline' ); ?></span>
      			<?php endif; ?>
      			
      			<?php do_action( 'inline_comment_special_meta' ); ?>

      			<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __( '%1$s at %2$s', 'inline' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'inline' ),'  ','' ); ?></div>
      			
      		</div><!--end .comment-meta-wrapper-->
      
		</div>
		
		<div class="clear"></div>
	<?php //leave off the closing </li> tag for comment threading
	
}

/**
 *
 * This function outputs the pingback callback function for the inLine comment form.
 *
 * @since 1.0
 *
 */
function inline_pingbacks_callback( $comment ) {

	$GLOBALS['comment'] = $comment; global $post; ?>
		
	<li <?php comment_class(); ?>>
		<?php comment_author_link(); ?>
	</li>
	<?php 

}

add_action( 'inline_comment_respond', 'inline_do_comment_respond' );
/**
 *
 * This function outputs the respond form for inLine comments.This area is now filterable and follows standards.
 *
 * @since 1.2.2
 *
 */
function inline_do_comment_respond() {

	global $comment, $id, $user_identity;
	
	if ( comments_open() ) :
		
		do_action( 'inline_before_comment_respond' );
		
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true"' : '' );
		$respond_args = array(
				'fields' => array(
					'author' => '<input class="name" id="author" name="author" type="text" tabindex="1" placeholder="' . esc_attr( __( 'Your Name (required)', 'inline' ) ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />',
					'email'  => '<input class="email" id="email" name="email" type="text" tabindex="2" placeholder="' . esc_attr( __( 'Your Email (required)', 'inline' ) ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />',
					'url'    => '<input class="url" id="url" name="url" type="text" tabindex="3" placeholder="' . esc_attr( __( 'Your Website (optional)', 'inline' ) ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />'
			),
				'comment_field' => '<textarea class="message" id="comment" name="comment" tabindex="4" cols="50" rows="10" ' . $aria_req . '></textarea>',
				'label_submit' => __( 'Submit Comment', 'inline' ),
				'cancel_reply_link' => __( 'Cancel Reply', 'inline' ),
				'title_reply' => __( 'Leave your comment below!', 'inline' ),
				'comment_notes_before' => '',
				'comment_notes_after' => ''
		); ?>
		
		<div id="respond-header">
			<?php comment_form( $respond_args ); ?>
		</div><!--end #respond-header-->
		
		<?php do_action( 'inline_after_comment_respond' ); ?>
		
	<?php endif;

}