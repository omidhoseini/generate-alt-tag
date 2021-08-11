<?php
/**
 * AltText File
 *
 * @package    generate-alt-tag
 * @category   class
 * @author     BRPCreative
 * @since      1.1.0
 * @copyright  Copyright (c) 2021, BRPCreative.
 */

namespace GAT\Inc\Classes\Controller;

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

require_once \_GAT_PLUGIN_PATH . 'inc/classes/controller/class-getattachments.php';

/**
 * AltText class
 */
class AltText {

	/**
	 * The options variable
	 *
	 * @var array Is array of custom fields from page options of this plugin.
	 */
	public $options;

	/**
	 * The __construct function
	 */
	public function __construct() {

		$this->options = \count( \get_option( 'gat_options' ) ) ? \get_option( 'gat_options' ) : array();
		\add_action( 'add_attachment', array( $this, 'gat__generate_alt_text' ) );
		\add_action( 'init', array( $this, 'gat__update_alt_text' ) );
	}

	/**
	 * The gat__generate_alt_text function.
	 * This function generates alt-text for any uploaded image.
	 *
	 * @param string $media_id The media identifier is assigned during upload file.
	 * @return void
	 */
	public function gat__generate_alt_text( $media_id ) {

		if ( ! ( \array_key_exists( 'gat_disable_plugin', $this->options ) ? $this->options['gat_disable_plugin'] : null ) ) :

			if ( \wp_attachment_is_image( $media_id ) ) :

				$image_url = \wp_get_attachment_image_url( $media_id );

				if ( $image_url ) :

					// Generate alt-text from image url.
					$basename = \preg_replace( '/\d+/', '', \basename( $image_url ) );
					$basename = \preg_replace( '/((-|_)*x.*)|((-|_)*\.\w+)/', '', $basename );
					$alt_text = \esc_attr( \ucwords( \preg_replace( '/-|_/', ' ', $basename ) ) );

				endif;

				if ( \array_key_exists( 'gat_regenerate_all_alt', $this->options ) ? $this->options['gat_regenerate_all_alt'] : null ) :

					// Generate All images alt-text.
					\update_post_meta( $media_id, '_wp_attachment_image_alt', $alt_text ? $alt_text : 'alt-text' );

				else :

					// If don't exist the image alt-text, it sets here.
					if ( \strlen( \get_post_meta( $media_id, '_wp_attachment_image_alt', true ) ) === 0 ) :

						\update_post_meta( $media_id, '_wp_attachment_image_alt', $alt_text ? $alt_text : 'alt-text' );
					endif;

				endif;

				\wp_update_post(
					array(
						'ID' => $media_id,
					)
				);

			endif;
		endif;
	}

	/**
	 * The gat__update_alt_text function.
	 * This functions updates all images alt-text.
	 *
	 * @return void
	 */
	public function gat__update_alt_text() {

		$attachments_ids = GetAttachments::gat__get_attachments_ids();

		foreach ( $attachments_ids as $attachment_id ) :

				$this->gat__generate_alt_text( $attachment_id );

		endforeach;

	}

	/**
	 * The gat__get_alt_text function.
	 * This function creates a list of all alt-text.
	 *
	 * @return array
	 */
	public static function gat__get_alt_text() {

		$attachments_ids = GetAttachments::gat__get_attachments_ids();

		$alt_text_array = array();

		foreach ( $attachments_ids as $attachment_id ) :

			$alt_text_array[ $attachment_id ] = \get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

		endforeach;

		return $alt_text_array;
	}

}
