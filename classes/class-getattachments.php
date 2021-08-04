<?php
/**
 * GetAttachments File
 *
 * @package    generate-alt-text
 * @category   class
 * @author     BRPCreative
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, BRPCreative.
 */

namespace CAI\Classes;

// Security Note: Blocks direct access to the PHP files.
defined( 'ABSPATH' ) || die;

/**
 * GetAttachments class
 */
class GetAttachments {

	/**
	 * The om_get_images_ids function
	 *
	 * @return array
	 */
	public static function om_get_attachments_ids() {

		$images_ids = array();

		$args = array(
			'post_type'   => 'attachment',
			'numberposts' => -1,
		);

		// Get all attachments.
		$attachments = get_posts( $args );

		// Create an array of products id.
		foreach ( $attachments as $attachment ) :
			$images_ids [] = $attachment->ID;
		endforeach;

		return $images_ids;

	}

}
