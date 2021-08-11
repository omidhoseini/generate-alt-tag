<?php
/**
 * Plugin Name:       Generate Alt Tag
 * Plugin URI:        https://brpcreative.com.au
 * Description:       This plugin generate "ALT TAG" image from image filename automatically.
 * Version:           1.1.1
 * Requires at least: 5.7
 * Requires PHP:      5.6
 * Author:            BRPCreative
 * Author URI:        https://brpcreative.com.au
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       generate-alt-tag
 * Domain Path:       /languages
 *
 * @package   generate-alt-tag
 * @category  plugin
 * @link      https://github.com/omidhoseini/create-alt-image
 * @author    BRPCreative
 * @license   GPL v2 or later
 * @copyright Copyright (c) 2021, BRPCreative.
 */

use GAT\Inc\Classes\GATRegister;

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

// Define plugin path.
\define( '_GAT_PLUGIN_PATH', \plugin_dir_path( __FILE__ ) );
\define( '_GAT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
\define( '_GAT_ASSETS_URL', plugins_url( '/inc/src/' . dirname( __FILE__ ) ) );

// Get all plugin data.
require_once ABSPATH . 'wp-admin/includes/plugin.php';
$plugin_data = \get_plugin_data( __FILE__ );

// Define plugin name and version.
\define( '_GAT_NAME', $plugin_data['Name'] );
\define( '_GAT_VERSION', $plugin_data['Version'] );

// Call the GATRegister class..
require_once _GAT_PLUGIN_PATH . 'inc/classes/class-gatregister.php';
( new GATRegister() );
