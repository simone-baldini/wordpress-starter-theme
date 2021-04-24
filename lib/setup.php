<?php

namespace SimoneBaldini\WordPressStarterTheme\Setup;

use SimoneBaldini\WordPressStarterTheme\Assets;

/**
 * Theme setup
 */
function setup() {
	// Enable features from Soil when plugin is activated
	// https://roots.io/plugins/soil/
	add_theme_support( 'soil-clean-up' );
	add_theme_support( 'soil-nav-walker' );
	add_theme_support( 'soil-nice-search' );
	add_theme_support( 'soil-jquery-cdn' );
	add_theme_support( 'soil-relative-urls' );

	// Make theme available for translation
	// Community translations can be found at https://github.com/roots/sage-translations
	load_theme_textdomain( 'sage', get_template_directory() . '/lang' );

	// Enable plugins to manage the document title
	// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
	add_theme_support( 'title-tag' );

	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus(
		array(
			'primary_navigation' => __( 'Primary Navigation', 'sage' ),
		)
	);

	// Enable post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support( 'post-thumbnails' );

	// Enable post formats
	// http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

	// Enable HTML5 markup support
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

	// Use main stylesheet for visual editor
	// To add custom styles edit /assets/styles/layouts/_tinymce.scss
	add_editor_style( Assets\asset_path( 'styles/main.css' ) );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

/**
 * Theme assets
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'theme/js@defer', Assets\asset_path( 'scripts/main.js' ), array(), '1.0', true );
		wp_enqueue_style( 'theme/css', Assets\asset_path( 'styles/main.css' ), false, '1.0' );
	},
	100
);
