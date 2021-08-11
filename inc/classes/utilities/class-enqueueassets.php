<?php
/**
 * EnqueueAssets File
 *
 * @package    generate-alt-tag
 * @category   class
 * @author     BRPCreative
 * @since      1.1.0
 * @copyright  Copyright (c) 2021, BRPCreative.
 */

namespace GAT\Inc\Classes\Utilities;

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

/**
 * EnqueueAssets class
 */
class EnqueueAssets {


	/**
	 * The $hook variable
	 *
	 * @var string
	 */
	public $hook;

	/**
	 * The __constructor function.
	 *
	 * @since 1.1.0
	 * @return void
	 */
	public function __construct() {

		// Add styles in BACKEND via enqueue in admin_enqueue_scripts hook.
		\add_action( 'admin_enqueue_scripts', array( $this, 'gat__admin_styles' ) );
	}

	/**
	 * The gat__admin_styles function.
	 *
	 * Page options styles.
	 *
	 * @param array $hook of page.
	 * @since 1.1.0
	 * @return void
	 */
	public function gat__admin_styles( $hook ) {

		// Check if isn't be GAT options-page.
		global $page_hook_suffix;
		if ( $hook !== $page_hook_suffix ) {
			return;
		}

		// Enqueue all scripts, styles, settings, and templates necessary to use all media JS APIs.
		wp_enqueue_media();

		// Include gat-tailwind file.
		wp_register_style(
			'gat-admin-tailwind-local', // handle.
			\_GAT_PLUGIN_URL . 'inc/dist/css/tailwind.css', // src.
			array(), // deps.
			'2.2.7', // version.
			'all' // media.
		);
		wp_enqueue_style( 'gat-admin-tailwind-local' );

		// Include fontawesome.
		wp_register_style(
			'gat-fontawesome-cdn', // handle.
			'https://use.fontawesome.com/releases/v5.15.4/css/all.css', // src.
			array(), // deps.
			'5.15.4', // version.
			'all' // media.
		);
		wp_enqueue_style( 'gat-fontawesome-cdn' );
	}
}
