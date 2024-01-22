<?php
/**
 * Settings page
 *
 * @package Review-Easy
 */

declare( strict_types=1 );

namespace ReviewEasy\Settings\Page;

use function ReviewEasy\Settings\Fields\get_custom_review_easy_data;

add_action( 'admin_menu', __NAMESPACE__ . '\\add_settings_page', 9 );

/**
 * Add settings page scripts
 */
function settings_assets(): void {

	if ( file_exists( REVIEW_EASY_DIR_PATH . '/build/settings/settings.js' ) ) {
		$script_deps_path    = REVIEW_EASY_DIR_PATH . '/build/settings/settings.asset.php';
		$script_dependencies = file_exists( $script_deps_path ) ?
			include $script_deps_path :
			[
				'dependencies' => [],
				'version'      => REVIEW_EASY_VERSION,
			];

		wp_register_script(
			'review-easy-plugin-script',
			plugins_url( '../../build/settings/', __FILE__ ) . 'settings.js',
			$script_dependencies['dependencies'],
			$script_dependencies['version'],
			false
		);
		wp_enqueue_script( 'review-easy-plugin-script' );
	}

	if ( file_exists( REVIEW_EASY_DIR_PATH . '/build/settings/settings.css' ) ) {
		wp_register_style(
			'review-easy-settings-plugin-style',
			plugins_url( '../../build/settings/', __FILE__ ) . 'settings.css',
			[ 'wp-components' ],
			REVIEW_EASY_VERSION,
		);
		wp_enqueue_style( 'review-easy-settings-plugin-style' );
	}

	/**
	 * Make settings available to the settings page
	 */
	\wp_localize_script(
		'review-easy-plugin-script',
		'ReviewEasySettings',
		get_custom_review_easy_data()
	);
}

/**
 * Register settings page
 */
function add_settings_page(): void {
	$page_hook_suffix = add_submenu_page(
		'options-general.php',
		__( 'ReviewEasy Settings', 'review-easy' ),
		__( 'ReviewEasy Settings', 'review-easy' ),
		'manage_options',
		'review_easy_settings',
		__NAMESPACE__ . '\\settings_page'
	);
	add_action( "admin_print_scripts-{$page_hook_suffix}", __NAMESPACE__ . '\\settings_assets' );
}

/**
 * Add React placeholder to settings page
 */
function settings_page(): void {
	echo '<div id="review-easy-settings"></div>';
}
