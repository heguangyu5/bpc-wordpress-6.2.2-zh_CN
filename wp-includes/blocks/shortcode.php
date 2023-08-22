<?php
/**
 * Server-side rendering of the `core/shortcode` block.
 *
 * @package WordPress
 */

/**
 * Performs wpautop() on the shortcode block content.
 *
 * @param array  $attributes The block attributes.
 * @param string $content    The block content.
 *
 * @return string Returns the block content.
 */
function render_block_core_shortcode( $attributes, $content, $arg3 = null ) {
	return wpautop( $content );
}

/**
 * Registers the `core/shortcode` block on server.
 */
function register_block_core_shortcode() {
	register_block_type_from_metadata(
		ABSPATH . WPINC . '/blocks/shortcode',
		array(
			'render_callback' => 'render_block_core_shortcode',
		)
	);
}
add_action( 'init', 'register_block_core_shortcode', 10, 0 );
