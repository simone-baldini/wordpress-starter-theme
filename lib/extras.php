<?php

namespace SimoneBaldini\WordPressStarterTheme\Extras;

/**
 * Disable the emoji's
 */
add_action(
	'init',
	function () {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter(
			'tiny_mce_plugins',
			function ( $plugins ) {
				if ( is_array( $plugins ) ) {
					return array_diff( $plugins, array( 'wpemoji' ) );
				} else {
					return array();
				}
			}
		);
		add_filter(
			'wp_resource_hints',
			function ( $urls, $relation_type ) {
				if ( 'dns-prefetch' === $relation_type ) {
					/** This filter is documented in wp-includes/formatting.php */
					$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
					$urls          = array_diff( $urls, array( $emoji_svg_url ) );
				}
				return $urls;
			},
			10,
			2
		);
	}
);

add_action(
	'wp_footer',
	function () {
		wp_deregister_script( 'wp-embed' );
	}
);

add_filter(
	'style_loader_tag',
	function ( $tag, $handle, $href, $media ) {
		return sprintf(
			'<link rel="preload" id="%s-css" href="%s" media="%s" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" />',
			$handle,
			$href,
			$media
		);
	},
	10,
	4
);

add_filter(
	'script_loader_tag',
	function ( $tag, $handle ) {
		if ( strpos( $handle, '@async' ) !== false ) {
			return str_replace( '<script ', '<script async ', $tag );
		} elseif ( strpos( $handle, '@defer' ) !== false ) {
			return str_replace( '<script ', '<script defer ', $tag );
		} else {
			return $tag;
		}
	},
	10,
	2
);

add_action(
	'init',
	function () {
		if ( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3.4.1', true );
			wp_enqueue_script( 'jquery' );
		}
	}
);
