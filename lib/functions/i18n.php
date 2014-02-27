<?php
/**
 *
 * i18n for the inLine theme.
 *
 * @package inLine
 *
 */

load_theme_textdomain( 'inline', INLINE_LANGUAGES_DIR );
$i18n = get_locale();
$i18n_file = INLINE_LANGUAGES_DIR . "/$i18n.php";
if ( is_readable( $i18n_file ) )
	load_template( $i18n_file );