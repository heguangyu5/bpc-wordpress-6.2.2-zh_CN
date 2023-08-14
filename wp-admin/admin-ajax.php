<?php
/**
 * WordPress Ajax Process Execution
 *
 * @package WordPress
 * @subpackage Administration
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 */

/**
 * Executing Ajax process.
 *
 * @since 2.1.0
 */
define( 'DOING_AJAX', true );
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}

/** Load WordPress Bootstrap */
require_once dirname( __DIR__ ) . '/wp-load.php';

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
header( 'X-Robots-Tag: noindex' );

// Require a valid action parameter.
if ( empty( $_REQUEST['action'] ) || ! is_scalar( $_REQUEST['action'] ) ) {
	wp_die( '0', 400 );
}

/** Load WordPress Administration APIs */
require_once ABSPATH . 'wp-admin/includes/admin.php';

/** Load Ajax Handlers for WordPress Core */
require_once ABSPATH . 'wp-admin/includes/ajax-actions.php';

send_nosniff_header();
nocache_headers();

/** This action is documented in wp-admin/admin.php */
do_action( 'admin_init' );

$core_actions_get = array(
	'fetch-list'          => 0,
	'ajax-tag-search'     => 0,
	'wp-compression-test' => 0,
	'imgedit-preview'     => 0,
	'oembed-cache'        => 0,
	'autocomplete-user'   => 0,
	'dashboard-widgets'   => 0,
	'logged-in'           => 0,
	'rest-nonce'          => 0,
);

$core_actions_post = array(
	'oembed-cache'                      => 0,
	'image-editor'                      => 0,
	'delete-comment'                    => 0,
	'delete-tag'                        => 0,
	'delete-link'                       => 0,
	'delete-meta'                       => 0,
	'delete-post'                       => 1,
	'trash-post'                        => 1,
	'untrash-post'                      => 1,
	'delete-page'                       => 1,
	'dim-comment'                       => 0,
	'add-link-category'                 => 1,
	'add-tag'                           => 0,
	'get-tagcloud'                      => 0,
	'get-comments'                      => 1,
	'replyto-comment'                   => 1,
	'edit-comment'                      => 0,
	'add-menu-item'                     => 0,
	'add-meta'                          => 0,
	'add-user'                          => 1,
	'closed-postboxes'                  => 0,
	'hidden-columns'                    => 0,
	'update-welcome-panel'              => 0,
	'menu-get-metabox'                  => 0,
	'wp-link-ajax'                      => 0,
	'menu-locations-save'               => 0,
	'menu-quick-search'                 => 0,
	'meta-box-order'                    => 0,
	'get-permalink'                     => 0,
	'sample-permalink'                  => 0,
	'inline-save'                       => 0,
	'inline-save-tax'                   => 0,
	'find_posts'                        => 0,
	'widgets-order'                     => 0,
	'save-widget'                       => 0,
	'delete-inactive-widgets'           => 0,
	'set-post-thumbnail'                => 0,
	'date_format'                       => 0,
	'time_format'                       => 0,
	'wp-remove-post-lock'               => 0,
	'dismiss-wp-pointer'                => 0,
	'upload-attachment'                 => 0,
	'get-attachment'                    => 0,
	'query-attachments'                 => 0,
	'save-attachment'                   => 0,
	'save-attachment-compat'            => 0,
	'send-link-to-editor'               => 0,
	'send-attachment-to-editor'         => 0,
	'save-attachment-order'             => 0,
	'media-create-image-subsizes'       => 0,
	'heartbeat'                         => 0,
	'get-revision-diffs'                => 0,
	'save-user-color-scheme'            => 0,
	'update-widget'                     => 0,
	'query-themes'                      => 0,
	'parse-embed'                       => 0,
	'set-attachment-thumbnail'          => 0,
	'parse-media-shortcode'             => 0,
	'destroy-sessions'                  => 0,
	'install-plugin'                    => 0,
	'update-plugin'                     => 0,
	'crop-image'                        => 0,
	'generate-password'                 => 0,
	'save-wporg-username'               => 0,
	'delete-plugin'                     => 0,
	'search-plugins'                    => 0,
	'search-install-plugins'            => 0,
	'activate-plugin'                   => 0,
	'update-theme'                      => 0,
	'delete-theme'                      => 0,
	'install-theme'                     => 0,
	'get-post-thumbnail-html'           => 0,
	'get-community-events'              => 0,
	'edit-theme-plugin-file'            => 0,
	'wp-privacy-export-personal-data'   => 0,
	'wp-privacy-erase-personal-data'    => 0,
	'health-check-site-status-result'   => 0,
	'health-check-dotorg-communication' => 0,
	'health-check-is-in-debug-mode'     => 0,
	'health-check-background-updates'   => 0,
	'health-check-loopback-requests'    => 0,
	'health-check-get-sizes'            => 0,
	'toggle-auto-updates'               => 0,
	'send-password-reset'               => 0,
);

// Deprecated.
$core_actions_post_deprecated = array(
	'wp-fullscreen-save-post'           => 0,
	'press-this-save-post'              => 0,
	'press-this-add-category'           => 0,
	'health-check-dotorg-communication' => 0,
	'health-check-is-in-debug-mode'     => 0,
	'health-check-background-updates'   => 0,
	'health-check-loopback-requests'    => 0,
);

$core_actions_post = $core_actions_post + $core_actions_post_deprecated;

// Register core Ajax calls.
if ( ! empty( $_GET['action'] ) && isset($core_actions_get[$_GET['action']]) ) {
	add_action( 'wp_ajax_' . $_GET['action'], 'wp_ajax_' . str_replace( '-', '_', $_GET['action'] ), 1, $core_actions_get[$_GET['action']] );
}

if ( ! empty( $_POST['action'] ) && isset($core_actions_post[$_POST['action']]) ) {
	add_action( 'wp_ajax_' . $_POST['action'], 'wp_ajax_' . str_replace( '-', '_', $_POST['action'] ), 1, $core_actions_post[$_POST['action']] );
}

add_action( 'wp_ajax_nopriv_generate-password', 'wp_ajax_nopriv_generate_password' );

add_action( 'wp_ajax_nopriv_heartbeat', 'wp_ajax_nopriv_heartbeat', 1 );

$action = $_REQUEST['action'];

if ( is_user_logged_in() ) {
	// If no action is registered, return a Bad Request response.
	if ( ! has_action( "wp_ajax_{$action}" ) ) {
		wp_die( '0', 400 );
	}

	/**
	 * Fires authenticated Ajax actions for logged-in users.
	 *
	 * The dynamic portion of the hook name, `$action`, refers
	 * to the name of the Ajax action callback being fired.
	 *
	 * @since 2.1.0
	 */
	do_action( "wp_ajax_{$action}" );
} else {
	// If no action is registered, return a Bad Request response.
	if ( ! has_action( "wp_ajax_nopriv_{$action}" ) ) {
		wp_die( '0', 400 );
	}

	/**
	 * Fires non-authenticated Ajax actions for logged-out users.
	 *
	 * The dynamic portion of the hook name, `$action`, refers
	 * to the name of the Ajax action callback being fired.
	 *
	 * @since 2.8.0
	 */
	do_action( "wp_ajax_nopriv_{$action}" );
}

// Default status.
wp_die( '0' );
