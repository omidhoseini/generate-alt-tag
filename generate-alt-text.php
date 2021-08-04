<?php
/**
 * Generate "alt-text" image automatically.
 *
 * @package   generate-alt-text
 * @category  plugin
 * @link      https://github.com/omidhoseini/create-alt-image
 * @author    BRPCreative
 * @copyright Copyright (c) 2021, BRPCreative.
 * @license   GPL v2 or later
 *
 * Plugin Name: Generate Alt Text
 * Description: This plugin creates automatic "alt-text" image from product image filename.
 * Version: 1.0.0
 * Author: BRPCreative
 * Author URI: https://brpcreative.com.au
 * Text Domain: generate-alt-text
 * Requires PHP: 5.6
 */

// Security Note: Blocks direct access to the PHP files.
defined( 'ABSPATH' ) || die;

// Define plugin path.
define( 'CAI_PATH', plugin_dir_path( __FILE__ ) );

use CAI\Classes\GenerateAltText;

/**
 * The om_create_alt_image_init function.
 *
 * @return void
 */
function om_generate_alt_text_init() {
	require_once CAI_PATH . 'classes/class-generatealttext.php';
	new GenerateAltText();
}

// Call the om_generate_alt_text_init function.
om_generate_alt_text_init();
