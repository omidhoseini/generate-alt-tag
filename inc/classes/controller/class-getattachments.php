<?php
/**
 * GetAttachments File
 *
 * @package    generate-alt-tag
 * @category   class
 * @author     BRPCreative
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, BRPCreative.
 */

namespace GAT\Inc\Classes\Controller;

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

/**
 * GetAttachments class
 */
class GetAttachments {

	/**
	 * The gat__get_attachments_ids function
	 *
	 * @return array
	 */
	public static function gat__get_attachments_ids() {

		$images_ids = array();

		$args = array(
			'post_type'   => 'attachment',
			'numberposts' => -1,
		);

		// Get all attachments.
		$attachments = \get_posts( $args );

		// Create an array of attachments ids.
		foreach ( $attachments as $attachment ) :
			$images_ids [] = $attachment->ID;
		endforeach;

		return $images_ids;

	}

}
