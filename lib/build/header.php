<?php
/**
 *
 * Boots up all the information necessary to output the header part of the document.
 *
 * @package inLine
 *
 */

add_action( 'inline_head_doctype', 'inline_do_head_doctype' );
/**
 *
 * This takes care of the document type and all that jazz that goes in the header. This supports HTML5.
 *
 * The following filters/hooks are added to this function by default:
 *
 * inline_doctype, inline_head_meta_output
 *
 * @since 1.0
 *
 */
function inline_do_head_doctype() {

	?>
	<?php echo apply_filters( 'inline_doctype', '<!DOCTYPE html>' ); ?>
	<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php do_action( 'inline_head_meta_output' ); ?>
	<?php

}

add_action( 'inline_title', 'inline_do_title' );
/**
 *
 * This function adds the information used to generate all the information within the <title></title> tags. 
 * 
 * This is a modified version of the format used in the Twenty Ten theme.
 *
 * @since 1.0
 *
 */
function inline_do_title() {

	?>
	<title><?php
	
		global $page, $paged; // Print the <title> tag based on what is being used
		
		wp_title( '|', true, 'right' );
		
		bloginfo( 'name' ); // Add the blog name

		// Add the blog description for the home/front page
		$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

		// Add a page number if necessary
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'inline' ), max( $paged, $page ) );

	?></title>
	<?php 

}

add_action( 'inline_head_links', 'inline_do_head_links' );
/**
 *
 * This function outputs the rest of our <link> tags in the header.
 *
 * The following hooks are added to this function by default:
 *
 * inline_head_link_output
 *
 * @since 1.0
 *
 */
function inline_do_head_links() {

	?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php do_action( 'inline_head_link_output' ); ?>
	<?php

}

add_action( 'inline_style', 'inline_do_style' ); 
/**
 *
 * This function outputs the link to the inLine stylesheet. It's probably best that you don't mess with this function. :)
 *
 * @since 1.0
 *
 */
function inline_do_style() {

	?>
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="all" />
	<?php 

}

add_action( 'inline_favicon', 'inline_do_favicon' ); 
/**
 *
 * This function outputs the link to the inLine favicon. It's that pretty little icon that you see beside your URL address. :)
 *
 * @since 1.0
 *
 */
function inline_do_favicon() {

	?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
	<?php 

}

add_action( 'wp_head', 'inline_do_header_scripts' );
/**
 *
 * This function outputs the HTML in the Theme Options page for the Header Scripts area.
 *
 * @since 1.0
 *
 */
function inline_do_header_scripts() {

	global $inline_options;
	
	if ( $inline_options['inline_header_scripts'] != '' ) {
		echo html_entity_decode( $inline_options['inline_header_scripts'], ENT_QUOTES );
	} ?>
	
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<?php }

add_action( 'inline_before_wireframe', 'inline_structure_start' );
/**
 *
 * This function outputs the beginning structure of the inLine theme.
 *
 * The following hooks are included in this action:
 *
 * inline_before_html
 *
 * @since 1.0
 *
 */
function inline_structure_start() {

	do_action ( 'inline_before_html' ); // Allows for insertion of code before the theme structure is fired

	?>
	<body <?php body_class(); ?>>
	<?php

	echo '<section id="wrapper">';

}

add_action( 'inline_header', 'inline_header_structure_start', 3 );
/**
 *
 * This function outputs the beginning structure of the inLine header.
 *
 * We add a low priority to this action to make sure that it fires before anything else in the inline_header hook.
 *
 * @since 1.0
 *
 */
function inline_header_structure_start() {

	echo '<header id="header">';
	echo '<div class="wrap">';

}

add_action( 'inline_site_title', 'inline_do_site_title' );
/**
 *
 * This function outputs the site title. 
 *
 * The following filters are included in this action:
 *
 * inline_logo_title
 *
 * @since 1.0
 *
 */
function inline_do_site_title() {
	$names = explode(' ', get_bloginfo( 'name' ), 2);
	$link = sprintf( '<a href="%s" title="%s"><span class="first-title">%s</span>%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name', 'display' ) ), $names[0], $names[1] );
	$output = sprintf( '<h1 id="logo">%s</h1>', $link);
	echo apply_filters( 'inline_logo_title', $output ); // echo the output of the logo title

}

add_action( 'inline_header_nav', 'inline_do_header_nav' );
/**
 *
 * This function outputs the navigation menu in the header. 
 *
 * @since 1.0
 *
 */
function inline_do_header_nav() {

	// Create the primary nav menu
	$inline_primary_nav = wp_nav_menu( array( 'theme_location' => 'primary', 'sort_column' => 'menu_order', 'container_id' => 'primary', 'container_class' => 'menu-header', 'echo' => 'false', 'fallback_cb' => 'inline_fallback_primary_nav' ) );
						
	// Display the primary nav menu only if it is set
	if ( $inline_primary_nav ) {
		echo $inline_primary_nav;
	}
	
}

add_action( 'inline_header', 'inline_do_header' );
/**
 *
 * This function outputs all the content contained within the inLine header. 
 *
 * The following hooks are included in this action:
 *
 * inline_site_title, inline_header_nav
 *
 * @since 1.0
 *
 */
function inline_do_header() {

	echo '<div class="title">';
		do_action( 'inline_site_title' );
	echo '</div><!--end .title-->';

	echo '<nav id="navigation">';
		do_action( 'inline_header_nav' );
	echo '</nav><!--end #navigation-->';
	
	echo '<div class="clear"></div>';

}

add_action( 'inline_header', 'inline_header_structure_end', 20 );
/**
 *
 * This function outputs the ending structure of the inLine header.
 *
 * We add a high priority to this action to make sure that it fires after anything else in the inline_header hook.
 *
 * @since 1.0
 *
 */
function inline_header_structure_end() {

	echo '</div><!--end #header .wrap-->';
	echo '</header><!--end #header-->';

}

add_action( 'inline_secondary_nav', 'inline_do_secondary_nav' );
/**
 *
 * This function outputs the secondary navigation menu right after the header. 
 *
 * @since 1.0
 *
 */
function inline_do_secondary_nav() {

	// Create the secondary nav menu
	$inline_secondary_nav = wp_nav_menu( array( 'theme_location' => 'secondary', 'sort_column' => 'menu_order', 'container_id' => 'secondary', 'container_class' => 'menu-secondary', 'echo' => 'false', 'fallback_cb' => 'inline_fallback_secondary_nav' ) );
						
	// Display the secondary nav menu only if it is set
	if ( $inline_secondary_nav ) {
		echo $inline_secondary_nav;
	}
	
}

add_action( 'inline_after_header', 'inline_do_after_header' );
/**
 *
 * This function outputs all the secondary nav menu within the hook inline_after_header 
 *
 * The following hooks are included in this action:
 *
 * inline_secondary_nav
 *
 * @since 1.0
 *
 */
function inline_do_after_header() {

	echo '<nav id="secondary-nav">';
		echo '<div class="wrap">';
			do_action( 'inline_secondary_nav' );
		echo '</div><!--end #secondary-nav .wrap-->';
	echo '</nav><!--end #secondary-nav-->';
	
	echo '<div class="clear"></div>';

}
