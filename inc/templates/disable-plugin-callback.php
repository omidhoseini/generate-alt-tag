<?php
/**
 * The GAT disable-plugin-callback template.
 *
 * @package generate-alt-tag
 * @since 1.1.0
 */

echo '<div class="flex flex-row justify-start items-center">';
printf(
	'<input type="checkbox" id="gat_disable_plugin" name="gat_options[gat_disable_plugin]" value="1" %s />',
	checked( esc_attr( isset( $this->options['gat_disable_plugin'] ) ), true, false )
);
echo '<kbd class="text-xs text-current ml-3 font-semibold">This will disable plugin temporarily.</kbd>';
echo '</div>';
