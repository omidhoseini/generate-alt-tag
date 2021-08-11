<?php
/**
 * The GAT regenerate-all-alt-callback template.
 *
 * @package generate-alt-tag
 * @since 1.1.0
 */

echo '<div class="flex flex-row justify-start items-center">';
printf(
	'<input type="checkbox" id="gat_regenerate_all_alt" name="gat_options[gat_regenerate_all_alt]" value="1" %s />',
	checked( esc_attr( isset( $this->options['gat_regenerate_all_alt'] ) ), true, false )
);
echo '<kbd class="text-xs bg-yellow-100 text-red-600 ml-3 font-semibold">CAUTION: this will overwrite existing alt tags for all images!</kbd>';
echo '</div>';
