<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.me/
 *
 * @package togetherish
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function togetherish_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'	=> 'togetherish_infinite_scroll_render',
		'footer'	=> 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus
	add_theme_support( 'jetpack-social-menu' );

	add_theme_support( 'featured-content', array(
		'filter'	 => 'togetherish_get_featured_posts',
		'max_posts'  => 1,
		'post_types' => array( 'post', 'page' ),
	) );
}
add_action( 'after_setup_theme', 'togetherish_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function togetherish_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'components/post/content', 'search' );
		else :
			get_template_part( 'components/post/content', get_post_format() );
		endif;
	}
}

function togetherish_social_menu() {
	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	} else {
		jetpack_social_menu();
	}
}

/**
 * Featured Posts
 */
function togetherish_has_multiple_featured_posts() {
	$featured_posts = apply_filters( 'togetherish_get_featured_posts', array() );
	if ( is_array( $featured_posts ) && 1 < count( $featured_posts ) ) {
		return true;
	}
	return false;
}
function togetherish_get_featured_posts() {
	return apply_filters( 'togetherish_get_featured_posts', false );
}
