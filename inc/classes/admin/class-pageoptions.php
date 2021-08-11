<?php
/**
 * PageOptions File
 *
 * @package    generate-alt-tag
 * @category   class
 * @author     BRPCreative
 * @since      1.1.0
 * @copyright  Copyright (c) 2021, BRPCreative.
 */

namespace GAT\Inc\Classes\Admin;

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

/**
 * PageOptions class
 */
class PageOptions {

	/**
	 * Holds the values to be used in the fields callbacks
	 *
	 * @var mixed
	 */
	public $options;

	/**
	 * The __construct function
	 * Start up
	 *
	 * @return void
	 */
	public function __construct() {

		\add_action( 'admin_menu', array( $this, 'gat__add_plugin_page' ) );
		\add_action( 'admin_init', array( $this, 'gat__page_init' ) );
	}

	/**
	 * The gat__add_plugin_page function
	 * Add options page
	 *
	 * @return void
	 */
	public function gat__add_plugin_page() {

		global $page_hook_suffix;

		// This page will be under "Media".
		$page_hook_suffix = \add_options_page(
			'Settings Admin', // Page title.
			'GAT Settings', // Menu title.
			'manage_options', // Capability.
			'gat-setting-admin', // Menu slug.
			array( $this, 'gat__create_page_options' ), // Callback.
			10 // Position.
		);
	}

	/**
	 * The gat__create_page_options function
	 * Options page callback
	 *
	 * @return void
	 */
	public function gat__create_page_options() {

		// Set class property.
		$this->options = \get_option( 'gat_options' );
		require_once \_GAT_PLUGIN_PATH . 'inc/templates/page-options.php';
	}

	/**
	 * The gat__page_init function
	 * Register and add settings
	 *
	 * @return void
	 */
	public function gat__page_init() {

		\register_setting(
			'gat_options_group', // Option group.
			'gat_options', // Option name.
			array( $this, 'gat__sanitize' ) // Sanitize.
		);

		\add_settings_section(
			'gat_info_section_id', // ID.
			'<h3 class="text-lg py-3 border-t-2 border-gray-500">GAT Information</h3>', // Title.
			array( $this, 'gat__print_section_info' ), // Callback.
			'gat-setting-admin' // Page.
		);

		\add_settings_section(
			'gat_setting_section_id', // ID.
			'<h3 class="text-lg mt-8 py-3 border-t-2 border-gray-500">GAT Custom Settings</h3>', // Title.
			array(), // Callback.
			'gat-setting-admin' // Page.
		);

		\add_settings_field(
			'gat_without_alt', // ID.
			'Without alt tag(s)', // Title.
			array( $this, 'gat__without_alt_callback' ), // Callback.
			'gat-setting-admin', // Page.
			'gat_info_section_id' // Section.
		);

		\add_settings_field(
			'gat_regenerate_all_alt', // ID.
			'Regenerate all alt tags', // Title.
			array( $this, 'gat__regenerate_all_alt_callback' ), // Callback.
			'gat-setting-admin', // Page.
			'gat_setting_section_id' // Section.
		);

		\add_settings_field(
			'gat_disable', // ID.
			'Disable Plugin', // Title.
			array( $this, 'gat__disable_plugin_callback' ), // Callback.
			'gat-setting-admin', // Page.
			'gat_setting_section_id' // Section.
		);
	}

	/**
	 * The gat__sanitize function
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys.
	 * @return mixed
	 */
	public function gat__sanitize( $input ) {

		$sanitize_input = array();

		if ( isset( $input['gat_regenerate_all_alt'] ) ) :
			$sanitize_input['gat_regenerate_all_alt'] = \absint( $input['gat_regenerate_all_alt'] );
		endif;

		if ( isset( $input['gat_disable_plugin'] ) ) :
			$sanitize_input['gat_disable_plugin'] = \absint( $input['gat_disable_plugin'] );
		endif;

		return $sanitize_input;
	}

	/**
	 * The gat__print_section_info function.
	 * Print the Section text
	 *
	 * @return void
	 */
	public function gat__print_section_info() {

		print '<p class="text-sm text-gray-500">Number of images without alt tag, you should generate them.</p>';
	}

	/**
	 * The gat__print_section_setting function.
	 * Print the Section text
	 *
	 * @return void
	 */
	public function gat__print_section_setting() {

		print '<p class="text-sm text-gray-500">This will overwrite existing alt tags for all images.</p>';
	}

	/**
	 * Get without-alt-callback template file.
	 *
	 * @return void
	 */
	public function gat__without_alt_callback() {

		require_once \_GAT_PLUGIN_PATH . 'inc/templates/without-alt-callback.php';
	}

	/**
	 * Get regenerate-all-alt-callback template file.
	 *
	 * @return void
	 */
	public function gat__regenerate_all_alt_callback() {

		require_once \_GAT_PLUGIN_PATH . 'inc/templates/regenerate-all-alt-callback.php';
	}

	/**
	 * Get regenerate-all-alt-callback template file.
	 *
	 * @return void
	 */
	public function gat__disable_plugin_callback() {

		require_once \_GAT_PLUGIN_PATH . 'inc/templates/disable-plugin-callback.php';
	}

}
