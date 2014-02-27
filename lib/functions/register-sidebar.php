<?php
/**
 *
 * This file initializes the default sidebars for the inLine theme. It also registers our widgetized area in the top section.
 *
 * @package inLine
 *
 */

if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
			'name' => 'Sidebar One',
			'id' => 'sidebar-one',
			'before_widget' => '<div id="%1$s" class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
	) );
		
if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
			'name' => 'Sidebar Alt',
			'id' => 'sidebar-alt',
			'before_widget' => '<div id="%1$s" class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
	) );

if ( function_exists( 'register_sidebar' ) )
	register_sidebar( array(
			'name' => 'Top Section Widget',
			'id' => 'top-section',
			'before_widget' => '<div id="%1$s" class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
	) );