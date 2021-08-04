<?php
/**
 * GenerateAltText File
 *
 * @package    generate-alt-text
 * @category   class
 * @author     BRPCreative
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, BRPCreative.
 */

namespace CAI\Classes;

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

require_once \CAI_PATH . 'classes/class-getattachments.php';

/**
 * GenerateAltText class
 */
class GenerateAltText {

	/**
	 * The __construct function
	 */
	public function __construct() {
		\add_action( 'add_attachment', array( $this, 'om_generate_alt_text' ) );
		\add_action( 'init', array( $this, 'om_update_alt_text' ) );
	}

	/**
	 * The om_generate_alt_text function.
	 *
	 * @param string $media_id The media identifier is assigned during upload file.
	 * @return void
	 */
	public function om_generate_alt_text( $media_id ) {

		if ( \wp_attachment_is_image( $media_id ) ) :

			$image_url = \wp_get_attachment_image_url( $media_id );

			if ( $image_url ) :

				// Generate alt-text from image url.
				$basename = \preg_replace( '/\d+/', '', \basename( $image_url ) );
				$alt_text = \preg_replace( '/(\-*x.*)|(\.\w+)/', '', $basename );

			endif;

			// If don't exist the image alt-text, it sets here.
			if ( \strlen( \get_post_meta( $media_id, '_wp_attachment_image_alt', true ) ) === 0 ) :
				\update_post_meta( $media_id, '_wp_attachment_image_alt', $alt_text ? $alt_text : 'alt-text' );
			endif;

			\wp_update_post(
				array(
					'ID' => $media_id,
				)
			);

		endif;

	}

	/**
	 * The om_update_alt_text function.
	 *
	 * @return void
	 */
	public function om_update_alt_text() {

		$attachments_ids = GetAttachments::om_get_attachments_ids();

		foreach ( $attachments_ids as $attachment_id ) :

			$this->om_generate_alt_text( $attachment_id );

		endforeach;

	}

}
