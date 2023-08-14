<?php
/**
 * Noop functions for load-scripts.php and load-styles.php.
 *
 * @package WordPress
 * @subpackage Administration
 * @since 4.4.0
 */

/**
 * @ignore
 */
function __($text, $domain = 'default') {}

/**
 * @ignore
 */
function _x($text, $context, $domain = 'default') {}

/**
 * @ignore
 */
function add_filter() {}

/**
 * @ignore
 */
function esc_attr() {}

/**
 * @ignore
 */
function apply_filters($hook_name, $value, ...$args) {}

/**
 * @ignore
 */
function get_option($option, $default_value = false) {}

/**
 * @ignore
 */
function is_lighttpd_before_150() {}

/**
 * @ignore
 */
function add_action($hook_name, $callback, $priority = 10, $accepted_args = 1) {}

/**
 * @ignore
 */
function did_action($hook_name) {}

/**
 * @ignore
 */
function do_action_ref_array($hook_name, $args) {}

/**
 * @ignore
 */
function get_bloginfo($show = '', $filter = 'raw') {}

/**
 * @ignore
 */
function is_admin() {
	return true;
}

/**
 * @ignore
 */
function site_url() {}

/**
 * @ignore
 */
function admin_url() {}

/**
 * @ignore
 */
function home_url() {}

/**
 * @ignore
 */
function includes_url($path = '', $scheme = null) {}

/**
 * @ignore
 */
function wp_guess_url() {}

function get_file( $path ) {
    if (defined('__BPC__')) {
        if (!include_file_exists($path)) {
            return '';
        }
        return resource_get_contents($path);
    } else {
	$path = realpath( $path );

	if ( ! $path || ! @is_file( $path ) ) {
		return '';
	}

	return @file_get_contents( $path );
	}
}
