<?php
/**
 *
 * This file contains all the stuff that goes on in the administration panel - everything from adding meta boxes, placing in content and 
 * editing/updating settings.
 *
 * The following setup follows the Settings API. The Settings API is the way to go because it is cleaner, more secure and better interacts 
 * with the WordPress core. 
 *
 * @package inLine
 *
 */

add_action( 'admin_init', 'inline_register_settings' );
/**
 *
 * Before we do anything, we need to register our settings, sections and fields for our options. We will go ahead and do that now.
 *
 * We register just one setting, but everything is stored in array which contains all of our data. This function will also register our
 * settings sections in each options page, as well as our settings fields for each options page.
 *
 * @since 1.0
 *
 */
function inline_register_settings() {

	// For reference: register_setting( $option_group, $option_name, $sanitize_callback );
	register_setting( 'inline_theme_options', 'inline_theme_options', 'inline_validate_options' );
	
	// For reference: add_settings_section( $id, $title, $callback, $page );
	add_settings_section( 'layout_section', __( 'Layout Options', 'inline' ), 'inline_layout_section', 'inline-options' );
	add_settings_section( 'content_section', __( 'Content Options', 'inline' ), 'inline_content_section', 'inline-options' );
	add_settings_section( 'scripts_section', __( 'Header and Footer Scripts', 'inline' ), 'inline_scripts_section', 'inline-options' );
	
	// For reference: add_settings_field( $id, $title, $callback, $page, $section, $args );
	
	// Layout section fields
	add_settings_field( 'default_page_layout', __( 'Default Page Layout:', 'inline' ), 'inline_default_page_layout_input', 'inline-options', 'layout_section' );
	add_settings_field( 'default_post_layout', __( 'Default Post Layout:', 'inline' ), 'inline_default_post_layout_input', 'inline-options', 'layout_section' );
	add_settings_field( 'default_index_layout', __( 'Default Index Page Layout:', 'inline' ), 'inline_default_index_layout_input', 'inline-options', 'layout_section' );
	add_settings_field( 'inline_no_post_comments', __( 'Disable Comments on Posts?', 'inline' ), 'inline_default_post_comments', 'inline-options', 'layout_section' );
	add_settings_field( 'inline_no_page_comments', __( 'Disable Comments on Pages?', 'inline' ), 'inline_default_page_comments', 'inline-options', 'layout_section' );
	
	// Content section fields
	add_settings_field( 'default_blog_title', __( 'Blog Title:', 'inline' ), 'inline_default_blog_title_input', 'inline-options', 'content_section' );
	add_settings_field( 'default_index_content', __( 'Default Index Content Layout:', 'inline' ), 'inline_default_index_content_layout', 'inline-options', 'content_section' );
	add_settings_field( 'default_archive_content', __( 'Default Archive Content Layout:', 'inline' ), 'inline_default_archive_content_layout', 'inline-options', 'content_section' );
	add_settings_field( 'default_search_content', __( 'Default Search Content Layout:', 'inline' ), 'inline_default_search_content_layout', 'inline-options', 'content_section' );
	
	// Scripts section fields
	add_settings_field( 'inline_header_scripts', __( 'Header Scripts:', 'inline' ), 'inline_header_scripts_input', 'inline-options', 'scripts_section' );
	add_settings_field( 'inline_footer_scripts', __( 'Footer Scripts:', 'inline' ), 'inline_footer_scripts_input', 'inline-options', 'scripts_section' );

}

/**
 *
 * Before we do anything else, we need to register our default settings for our fields.
 *
 * @since 1.0
 *
 */
function inline_default_theme_options() {

	$options = array(
		'default_page_layout' => 'Default (Content / Sidebar)',
		'default_post_layout' => 'Default (Content / Sidebar)',
		'default_index_layout' => 'Default (Content / Sidebar)',
		'default_blog_title' => '',
		'default_index_content' => 'Post Excerpt',
		'default_archive_content' => 'Post Excerpt',
		'default_search_content' => 'Post Excerpt',
		'inline_no_post_comments' => '',
		'inline_no_page_comments' => '',
		'inline_header_scripts' => '',
		'inline_footer_scripts' => ''
	);
	
	return $options;

}

add_action( 'after_setup_theme', 'inline_default_theme_options_setup', 9 );
/**
 *
 * Now that we have our default options above, let's register them when the theme is activated using the after_setup_theme hook.
 *
 * @since 1.0
 *
 */
function inline_default_theme_options_setup() {

	global $inline_options;
	$inline_options = get_option( 'inline_theme_options' );
	
	if ( false === $inline_options ) {
		$inline_options = inline_default_theme_options();
	}
	
	update_option( 'inline_theme_options', $inline_options );

}

add_action( 'admin_head', 'inline_admin_css' );
/**
 *
 * We are going to go ahead and register our CSS for our theme settings.
 *
 * @since 1.0
 *
 */
function inline_admin_css() {

	if ( 'appearance_page_inline-options' !== get_current_screen()->id )
		return;
	
	?>
	<link rel="stylesheet" href="<?php echo INLINE_ADMIN_URL . '/admin-css.css'; ?>" type="text/css" media="all" />
	<?php

}
	
add_action( 'admin_menu', 'inline_theme_options' );
/**
 *
 * The next step is to actually add in our theme page. This will be added to the Appearances tab.
 *
 * @since 1.0
 *
 */
function inline_theme_options() {

	// For reference: add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
	add_theme_page( __( 'inLine Settings', 'inline' ), __( 'inLine Settings', 'inline' ), 'edit_theme_options', 'inline-options', 'inline_theme_options_page' );

}

/**
 *
 * The next step is to populate our function that was just added, inline_theme_options_page
 * It's time to get busy with our stuff now!
 *
 * @since 1.0
 *
 */
function inline_theme_options_page() {

	global $wp_version;

	?>

	<div id="inline-options-wrapper">
		<div class="wrap">
		
			<div class="header">
			
				<div class="head-wrap">
					<div id="icon-themes" class="icon32"><br /></div>
					<h2><?php _e( 'inLine Theme Settings', 'inline' ); ?></h2>
					<span class="tag"><?php _e( "Minimal Design. Minimal Theme. inLine.", "inline" ); ?></span>
					<a class="support" href="http://inline.thomasgriffinmedia.com/" title="inLine Documentation and Support" target="_blank"><?php _e( 'inLine Documentation and Support', 'inline' ); ?></a>
				</div><!--end .head-wrap-->
					
			</div><!--end .header-->
			
			<div class="promote-soliloquy">
				<a class="logo-area" href="http://soliloquywp.com/?utm_source=inlinetheme&utm_medium=link&utm_campaign=inLine" title="<?php esc_attr_e( 'Soliloquy - The Best Response WordPress Slider Plugin. Period.', 'inline' ); ?>" target="_blank"><img src="<?php echo INLINE_ADMIN_URL . '/images/logo.png'; ?>" width="300px" height="62px" alt="<?php esc_attr_e( 'Soliloquy - The Best Response WordPress Slider Plugin. Period.', 'inline' ); ?>" /></a>
				<p><?php _e( '<strong><a href="http://soliloquywp.com/?utm_source=inlinetheme&utm_medium=link&utm_campaign=inLine" title="Soliloquy - The Best Response WordPress Slider Plugin. Period." target="_blank">Soliloquy</a> is by far the best responsive WordPress image slider plugin on the market.</strong> <a href="http://soliloquywp.com/?utm_source=inlinetheme&utm_medium=link&utm_campaign=inLine" title="Soliloquy - The Best Response WordPress Slider Plugin. Period." target="_blank">Soliloquy</a> is audited by Mark Jaquith, lead developer of WordPress, for security and features the easiest to use and most performance optimized code for an image slider plugin. Want to spice up inLine, attract more visitors and gain more leads? <a href="http://soliloquywp.com/?utm_source=inlinetheme&utm_medium=link&utm_campaign=inLine" title="Soliloquy - The Best Response WordPress Slider Plugin. Period." target="_blank">Purchase Soliloquy</a> and start using it in the inLine theme today!', 'inline' ); ?></p>
			</div>
			
			<?php
			
			// The following stuff below adds our success message if any option has been updated (including resetting options)
			if ( isset( $_GET['settings-updated'] ) && 'true' == esc_attr( $_GET['settings-updated'] ) ) {
				echo '<div class="settings-updated fade">';
					echo '<p>'; printf( __( 'Your theme settings have been saved! <a href="%s">Check out your site now!</a>', 'inline' ), trailingslashit( home_url() ) ); echo '</p>';
				echo '</div><!--end .settings-updated-->';
			}
			// The end of that, now on to our fields!
			
			// Check if the WP version is below 3.2. If so, display an error message and force user to upgrade before using the Settings area
			if ( $wp_version < 3.2 ) {
				echo '<div class="warning">';
					echo '<p>';
						printf( __( 'The inLine theme requires WordPress 3.2. <strong>Your current version of WordPress is %1$s</strong>, so you must upgrade before you can access the inLine theme settings area. <a href="%2$s" title="Upgrade WordPress Now!">Click here to upgrade WordPress to the latest version.</a>', 'inline' ), get_bloginfo( 'version' ), admin_url ( 'update-core.php' ) );
					echo '</p>';
				echo '</div><!--end .warning-->';
				
			return; } ?>
			
			<div class="main-content">
				
				<form action="options.php" method="post" enctype="multipart/form-data">
				
					<p class="submit top">
        				<input name="inline_theme_options[submit-inline-options]" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'inline' ); ?>" />
        				<input name="inline_theme_options[reset-inline-options]" type="submit" class="button-secondary" value="<?php esc_attr_e( 'Reset Options', 'inline' ); ?>" />
      				</p>
				
				<?php settings_fields( 'inline_theme_options' ); ?>
				<?php do_settings_sections( 'inline-options' ); ?>
				
					
      				<p class="submit">
        				<input name="inline_theme_options[submit-inline-options]" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'inline' ); ?>" />
        				<input name="inline_theme_options[reset-inline-options]" type="submit" class="button-secondary" value="<?php esc_attr_e( 'Reset Options', 'inline' ); ?>" />
      				</p>
      				
   				</form>
   				
			</div><!--end .main-content-->
			
			<?php do_action( 'inline_admin_credits' ); ?>
	
		</div><!--end .wrap-->
	</div><!--end #inline-options-wrapper-->

<?php }

add_action( 'inline_admin_credits', 'inline_do_admin_credits' );
/**
 *
 * This is the function that adds the donation section for the admin settings. The donation link can be removed in the functions.php file by using
 * the following line:
 *
 * remove_action( 'inline_admin_credits', 'inline_do_admin_credits' );
 *
 * @since 1.0
 *
 */
function inline_do_admin_credits() { 

	?>
	<div class="donate">
		<p class="credits"><?php _e( 'This theme was built by Thomas Griffin from <a href="http://thomasgriffinmedia.com/" title="Thomas Griffin Media" target="_blank">Thomas Griffin Media</a>', 'inline' ); ?></p>
		<div class="tgm-donate">
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JMZ2X8NK26X4N" title="Click now to donate to Thomas Griffin Media via PayPal!" target="_blank"></a>
		</div><!--end .tgm-donate-->
	</div><!--end .donate-->
	<?php

}

/**
 *
 * This is the function that adds our Default Layout section. It is the paragraph beside our tables of input.
 *
 * @since 1.0
 *
 */
function inline_layout_section() {

	echo "<p class='intro'>" . __( "Sometimes you just don't want the same layout on every page. Sometimes you want different layouts for both posts and pages. inLine makes it easy to set default layouts for both.<br /><br /> <span>You can further customize the layouts for each individual post, page or custom post type in each respective edit screen.</span>", "inline" ) . "</p>";

}

/**
 *
 * This is the function goes along with our Layout section. It adds a dropdown menu of layout options for pages.
 *
 * @since 1.0
 *
 */
function inline_default_page_layout_input() {
	
	$options = get_option( 'inline_theme_options' );
	$page_layouts = array( "Default (Content / Sidebar)", "Full Width", "Left Sidebar", "Content / Sidebar / Sidebar", "Sidebar / Content / Sidebar", "Sidebar / Sidebar / Content" );
	
	echo "<select id='dropdown' name='inline_theme_options[default_page_layout]'>";
	foreach( $page_layouts as $page_layout ) {
		$selected = ( $options['default_page_layout'] == $page_layout ) ? 'selected="selected"' : '';
		echo "<option value='$page_layout' $selected>" . esc_html( $page_layout ) . "</option>";
	}
	echo "</select>";

}

/**
 *
 * This is the function goes along with our Layout section. It adds a dropdown menu of layout options for posts.
 *
 * @since 1.0
 *
 */
function inline_default_post_layout_input() {

	$options = get_option( 'inline_theme_options' );
	$post_layouts = array( "Default (Content / Sidebar)", "Full Width", "Left Sidebar", "Content / Sidebar / Sidebar", "Sidebar / Content / Sidebar", "Sidebar / Sidebar / Content" );
	
	echo "<select id='dropdown' name='inline_theme_options[default_post_layout]'>";
	foreach( $post_layouts as $post_layout ) {
		$selected = ( $options['default_post_layout'] == $post_layout ) ? 'selected="selected"' : '';
		echo "<option value='$post_layout' $selected>" . esc_html( $post_layout ) . "</option>";
	}
	echo "</select>";
	
}

/**
 *
 * This is the function goes along with our Layout section. It adds a dropdown menu of layout options for our index page (where the posts reside).
 *
 * @since 1.0
 *
 */
function inline_default_index_layout_input() {

	$options = get_option( 'inline_theme_options' );
	$index_layouts = array( "Default (Content / Sidebar)", "Full Width", "Left Sidebar", "Content / Sidebar / Sidebar", "Sidebar / Content / Sidebar", "Sidebar / Sidebar / Content" );
	
	echo "<select id='dropdown' name='inline_theme_options[default_index_layout]'>";
	foreach( $index_layouts as $index_layout ) {
		$selected = ( $options['default_index_layout'] == $index_layout ) ? 'selected="selected"' : '';
		echo "<option value='$index_layout' $selected>" . esc_html( $index_layout ) . "</option>";
	}
	echo "</select>";
	
	echo "<span class='info'>" . __( "(applies to custom post type archive pages as well)", "inline" ) . "</span>";
	
}

/**
 *
 * This is the function goes along with our Layout section. It offers a checkbox to let users decide if they want comments on posts on or off
 * by default.
 *
 * @since 1.0
 *
 */
function inline_default_post_comments() {

	$options = get_option( 'inline_theme_options' );
	$checked = '';
	if ( $options['inline_no_post_comments'] ) { $checked = ' checked="checked" '; }
	
	echo "<input ".$checked." id='no-comments' name='inline_theme_options[inline_no_post_comments]' type='checkbox' />";

}

/**
 *
 * This is the function goes along with our Layout section. It offers a checkbox to let users decide if they want comments on pages on or off
 * by default.
 *
 * @since 1.0
 *
 */
function inline_default_page_comments() {

	$options = get_option( 'inline_theme_options' );
	$checked = '';
	if ( $options['inline_no_page_comments'] ) { $checked = ' checked="checked" '; }
	
	echo "<input ".$checked." id='no-comments' name='inline_theme_options[inline_no_page_comments]' type='checkbox' />";

}

/**
 *
 * This is the function that adds our Content section. It is the paragraph beside our tables of input.
 *
 * @since 1.0
 *
 */
function inline_content_section() {

	echo "<p class='intro'>" . __( "You can edit general content settings within this area. Specifically, you can edit the blog title and how the content is presented on archive pages.<br /><br /> <span>Tip: Custom Post Type (CPT) titles default to 'The {CPT}'. You can change this using the inline_cpt_title_label filter.</span>", "inline" ) . "</p>";

}

/**
 *
 * This is the function goes along with our Content section. It adds a text box for users to place in their default blog title.
 *
 * @since 1.0
 *
 */
function inline_default_blog_title_input() {
	
	$options = get_option( 'inline_theme_options' );
	echo "<input id='blog-title' name='inline_theme_options[default_blog_title]' size='40' type='text' value='{$options['default_blog_title']}' />";

}

/**
 *
 * This is the function goes along with our Content section. It adds a dropdown menu of layout options for our index page content.
 *
 * @since 1.0
 *
 */
function inline_default_index_content_layout() {

	$options = get_option( 'inline_theme_options' );
	$index_content_layouts = array( "Post Excerpt", "Post Content" );
	
	echo "<select id='dropdown' name='inline_theme_options[default_index_content]'>";
	foreach( $index_content_layouts as $index_content_layout ) {
		$selected = ( $options['default_index_content'] == $index_content_layout ) ? 'selected="selected"' : '';
		echo "<option value='$index_content_layout' $selected>" . esc_html( $index_content_layout ) . "</option>";
	}
	echo "</select>";
	
}

/**
 *
 * This is the function goes along with our Content section. It adds a dropdown menu of layout options for our archive page content.
 *
 * @since 1.0
 *
 */
function inline_default_archive_content_layout() {

	$options = get_option( 'inline_theme_options' );
	$archive_content_layouts = array( "Post Excerpt", "Post Content" );
	
	echo "<select id='dropdown' name='inline_theme_options[default_archive_content]'>";
	foreach( $archive_content_layouts as $archive_content_layout ) {
		$selected = ( $options['default_archive_content'] == $archive_content_layout ) ? 'selected="selected"' : '';
		echo "<option value='$archive_content_layout' $selected>" . esc_html( $archive_content_layout ) . "</option>";
	}
	echo "</select>";
	
}

/**
 *
 * This is the function goes along with our Content section. It adds a dropdown menu of layout options for our search page content.
 *
 * @since 1.0
 *
 */
function inline_default_search_content_layout() {

	$options = get_option( 'inline_theme_options' );
	$search_content_layouts = array( "Post Excerpt", "Post Content" );
	
	echo "<select id='dropdown' name='inline_theme_options[default_search_content]'>";
	foreach( $search_content_layouts as $search_content_layout ) {
		$selected = ( $options['default_search_content'] == $search_content_layout ) ? 'selected="selected"' : '';
		echo "<option value='$search_content_layout' $selected>" . esc_html( $search_content_layout ) . "</option>";
	}
	echo "</select>";
	
}

/**
 *
 * This is the function goes along with our Scripts section. It is the paragraph beside our tables of input.
 *
 * @since 1.0
 *
 */
function inline_scripts_section() {

	echo "<p class='intro'>" . __( "Do you need to output any extra scripts such as a tracking script or a slider script? You can place them in the boxes to the left.<br /><br /> <span>Tip: Try adding scripts to the footer first. This is the preferred position for any type of JavaScript.</span>" ) . "</p>";

}

/**
 *
 * This is the function goes along with our Scripts section. It adds a text box for users to place in their header scripts
 * (with HTML included).
 *
 * @since 1.0
 *
 */
function inline_header_scripts_input() {
	
	$options = get_option( 'inline_theme_options' );
	echo '<p class="script">Enter your header scripts into the box below with all the necessary HTML tags!</p>';
	echo "<textarea id='scripts' name='inline_theme_options[inline_header_scripts]' rows='7' cols='60' type='textarea'>{$options['inline_header_scripts']}</textarea>";

}

/**
 *
 * This is the function goes along with our Scripts section. It adds a text box for users to place in their footer scripts 
 * (with HTML included).
 *
 * @since 1.0
 *
 */
function inline_footer_scripts_input() {
	
	$options = get_option( 'inline_theme_options' );
	echo '<p class="script">Enter your footer scripts into the box below with all the necessary HTML tags!</p>';
	echo "<textarea id='scripts' name='inline_theme_options[inline_footer_scripts]' rows='7' cols='60' type='textarea'>{$options['inline_footer_scripts']}</textarea>";

}

/**
 *
 * This function sanitizes the input and returns the sanitized data. It allows us to either submit or reset our data.
 *
 * This function is defined in the register_setting action of the inline_register_settings function.
 *
 * @since 1.0
 *
 */
function inline_validate_options( $input ) {
	
	$inline_options = get_option( 'inline_theme_options' );
	$validated_input = $inline_options;
	
	$submit_options = ( !empty( $input['submit-inline-options'] ) ? true : false ); // This sets up our save option.
	$reset_options = ( !empty( $input['reset-inline-options'] ) ? true : false ); // This sets up our reset option.
	
	if ( $submit_options ) {
	
		// Layout section
		$validated_input['default_page_layout'] = ( ( 'Default (Content / Sidebar)' || 'Full Width' || 'Left Sidebar' || 'Content / Sidebar / Sidebar' || 'Sidebar / Content / Sidebar' || 'Sidebar / Sidebar / Content' ) == $input['default_page_layout'] ? $input['default_page_layout'] : $validated_input['default_page_layout'] );
		$validated_input['default_post_layout'] = ( ( 'Default (Content / Sidebar)' || 'Full Width' || 'Left Sidebar' || 'Content / Sidebar / Sidebar' || 'Sidebar / Content / Sidebar' || 'Sidebar / Sidebar / Content' ) == $input['default_post_layout'] ? $input['default_post_layout'] : $validated_input['default_post_layout'] );
		$validated_input['default_index_layout'] = ( ( 'Default (Content / Sidebar)' || 'Full Width' || 'Left Sidebar' || 'Content / Sidebar / Sidebar' || 'Sidebar / Content / Sidebar' || 'Sidebar / Sidebar / Content' ) == $input['default_index_layout'] ? $input['default_index_layout'] : $validated_input['default_index_layout'] );
		$validated_input['inline_no_post_comments'] = ( !empty( $input['inline_no_post_comments'] ) ? $input['inline_no_post_comments'] : '' );
		$validated_input['inline_no_page_comments'] = ( !empty( $input['inline_no_page_comments'] ) ? $input['inline_no_page_comments'] : '' );
		
		// Content section
		$validated_input['default_blog_title'] = esc_attr( trim( $input['default_blog_title'] ) );
		$validated_input['default_index_content'] = ( ('Post Excerpt' || 'Post Content' ) == $input['default_index_content'] ? $input['default_index_content'] : $validated_input['default_index_content'] );
		$validated_input['default_archive_content'] = ( ('Post Excerpt' || 'Post Content' ) == $input['default_archive_content'] ? $input['default_archive_content'] : $validated_input['default_archive_content'] );
		$validated_input['default_search_content'] = ( ('Post Excerpt' || 'Post Content' ) == $input['default_search_content'] ? $input['default_search_content'] : $validated_input['default_search_content'] );
		
		// Scripts section
		$validated_input['inline_header_scripts'] = esc_textarea( trim( $input['inline_header_scripts'] ) );
		$validated_input['inline_footer_scripts'] = esc_textarea( trim( $input['inline_footer_scripts'] ) );
	
	}
	
	elseif ( $reset_options ) {
	
		$inline_default_options = inline_default_theme_options();

		// Layout section
		$validated_input['default_page_layout'] = $inline_default_options['default_page_layout'];
		$validated_input['default_post_layout'] = $inline_default_options['default_post_layout'];
		$validated_input['default_index_layout'] = $inline_default_options['default_index_layout'];
		$validated_input['inline_no_post_comments'] = $inline_default_options['inline_no_post_comments'];
		$validated_input['inline_no_page_comments'] = $inline_default_options['inline_no_page_comments'];
		
		// Content section
		$validated_input['default_blog_title'] = $inline_default_options['default_blog_title'];
		$validated_input['default_index_content'] = $inline_default_options['default_index_content'];
		$validated_input['default_archive_content'] = $inline_default_options['default_archive_content'];
		$validated_input['default_search_content'] = $inline_default_options['default_search_content'];
		
		// Scripts section
		$validated_input['inline_header_scripts'] = $inline_default_options['inline_header_scripts'];
		$validated_input['inline_footer_scripts'] = $inline_default_options['inline_footer_scripts'];
		
	}
	
	return $validated_input;

}