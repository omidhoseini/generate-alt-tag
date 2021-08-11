<?php
/**
 * The GAT without-alt-callback template.
 *
 * @package generate-alt-tag
 * @since 1.1.0
 */

use GAT\Inc\Classes\Controller\GetAttachments;

$attachments_ids = GetAttachments::gat__get_attachments_ids();

$images_without_alt_array = array();
foreach ( $attachments_ids as $attachment_id ) :

	if ( \wp_attachment_is_image( $attachment_id ) ) :

		if ( \strlen( \get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) === 0 ) :

			$images_without_alt_array[ $attachment_id ] = \basename( \get_post( $attachment_id )->guid );
		endif;

	endif;

endforeach;

$count_without_alt = \count( $images_without_alt_array );
echo '<div class="flex flex-row justify-start items-center">';
echo '<div class="flex flex-col">';
echo '<div class="flex">';
printf(
	'<data id="gat_without_alt" value="%d" class="%s text-base text-current font-bold px-3 py-2 rounded-md">%d</data>%s',
	\esc_attr( $count_without_alt ),
	( \esc_attr( $count_without_alt ) ) ? 'bg-yellow-100' : 'bg-green-100',
	\esc_attr( $count_without_alt ),
	( \esc_attr( $count_without_alt ) ) ? '<i class="far fa-times-circle m-2 text-2xl text-yellow-700"></i>' : '<i class="far fa-check-circle m-2 text-2xl text-green-600"></i>',
);
echo '</div>';
if ( \esc_attr( $count_without_alt ) ) :
	echo '<div class="flex flex-col">';
	echo '<h4 class="text-base font-bold my-3 py-3 border-b-2 border-red-300">List of images without alt tag: ';
	echo '<br/>';
	echo '<kbd class="text-xs">In the below you can click name of image for add alt-text to it.</kbd>';
	echo '</h4>';
	echo '<div class="overflow-auto ';
	echo $count_without_alt > 5 ? 'h-36' : 'h-auto';
	echo ' w-full min-w-min whitespace-nowrap">';
	$count = 1;
	foreach ( $images_without_alt_array as $image_id => $image_basename ) :
		printf(
			'<div class="flex flex-row justify-start items-center">
			<label for="gat_without_alt_%d">%d-</label>
			<a href="upload.php?item=%d&mode=grid" id="gat_without_alt_%d" target="_blank" class="text-sm text-muted m-1 rounded-md">%s</a>
			</div>',
			\esc_attr( $count ),
			\esc_attr( $count ),
			\esc_attr( $image_id ),
			\esc_attr( $count ),
			\esc_attr( $image_basename ),
		);
		$count++;
	endforeach;
	echo '</div>';
	echo '</div>';
endif;
echo '</div>';
if ( ! esc_attr( $count_without_alt ) ) :
	echo '<kbd class="text-xs text-current font-bold ml-3">Good Job! all images have alt tags.</kbd>';
endif;
echo '</div>';
