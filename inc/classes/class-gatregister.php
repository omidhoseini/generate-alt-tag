<?php
/**
 * GATRegister File
 *
 * @package    generate-alt-tag
 * @category   class
 * @author     BRPCreative
 * @since      1.1.0
 * @copyright  Copyright (c) 2021, BRPCreative.
 */

namespace GAT\Inc\Classes;

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

use GAT\Inc\Classes\Controller\AltText;
use GAT\Inc\Classes\Admin\PageOptions;
use GAT\Inc\Classes\Utilities\EnqueueAssets;

/**
 * GATRegister class
 */
class GATRegister {

	/**
	 * Plugin variable
	 *
	 * @var string
	 */
	public $plugin;

	/**
	 * The __construct function
	 *
	 * @return void
	 */
	public function __construct() {
		$this->plugin = \plugin_basename( \_GAT_PLUGIN_PATH . 'generate-alt-tag.php' );
		$this->gat__generate_alt_tag_init();
		\add_filter( "plugin_action_links_$this->plugin", array( $this, 'gat__settings_link' ) );
	}

	/**
	 * The gat__settings_link function
	 *
	 * @param array $links The array of plugin links.
	 * @return array
	 */
	public function gat__settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=gat-setting-admin">Settings</a>';
		\array_push( $links, $settings_link );
		return $links;
	}

	/**
	 * The gat__generate_alt_tag_init function.
	 *
	 * @return void
	 */
	public function gat__generate_alt_tag_init() {

		require_once _GAT_PLUGIN_PATH . 'inc/classes/utilities/class-enqueueassets.php';
		require_once _GAT_PLUGIN_PATH . 'inc/classes/admin/class-pageoptions.php';
		require_once _GAT_PLUGIN_PATH . 'inc/classes/controller/class-alttext.php';

		if ( is_admin() ) :

			// Add styles and scripts.
			new EnqueueAssets();

			// Create page options for plugin.
			new PageOptions();

			// Ability to generate text automatically.
			new AltText();

		endif;
	}
}
