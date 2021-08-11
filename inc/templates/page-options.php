<?php
/**
 * The GAT page-options template.
 *
 * @package generate-alt-tag
 * @since 1.1.0
 */

use GAT\Inc\Classes\Controller\AltText;
?>

<div class="wrap">
	<h1><?php echo \esc_html( \_GAT_NAME ); ?> (GAT) Settings
		<kbd class="text-xs">
			Version <?php echo \esc_html( \_GAT_VERSION ); ?>
		</kbd>
	</h1>
	<P class="text-base text-current mt-3 wrap-words">This plugin will auto populate the image alt tag for all of your image files, based on the following settings.</P>
	<form method="post" action="options.php" class="flex flex-row justify-between items-between bg-gray-200 p-8 mt-8 rounded ring-8 ring-gray-300">
		<div class="flex flex-col justify-start items-start w-2/4">
		<?php
			// This prints out all hidden setting fields.
			\settings_fields( 'gat_options_group' );
			\do_settings_sections( 'gat-setting-admin' );
			\submit_button();
		?>
		</div>
		<div class="w-1/4">
			<div class="flex flex-col text-center px-8">
				<h4 class="text-base font-semibold text-gray-600 border-b-2 border-gray-500 pb-3 mb-3">All alternative-texts of images:</h4>
				<div class="flex flex-col overflow-auto h-80 whitespace-nowrap">
				<?php

				$alt_text_array = AltText::gat__get_alt_text();

				foreach ( $alt_text_array as $image_id => $alt_text ) :
					if ( $alt_text ) :
						printf(
							'<a href="upload.php?item=%d&mode=grid" class="text-blue-600 underline py-1" target="_blank">%s</a>',
							esc_attr( $image_id ),
							esc_attr( $alt_text )
						);
					endif;
				endforeach;

				?>
				</div>
			</div>
		</div>
		<div class="w-1/4">
			<div class="flex flex-col justify-between bg-gray-300 ring-2 ring-gray-700 p-4 rounded-lg space-y-4 h-full">
				<div class="flex flex-col space-y-4">
					<a href="https://brpcreative.com.au" class="text-sm text-blue-500" target="_blank">
						<h3 class="text-2xl font-bold text-blue-700">BRPCreative</h3>
					</a>
					<h4 class="text-sm font-semibold text-gray-600">Virtual Web Development Agency</h4>
					<p class="text-sm text-gray-600">Get your web application done the right way!</p>
				</div>
				<div class="flex flex-col space-y-8">
					<div class="flex flex-row">
						<div class="mr-8 w-1/5">
							<img src="<?php echo \esc_attr( plugins_url( 'dist/images/we-think-then-we-code.png', dirname( __FILE__ ) ) ); ?>" alt="we-think-then-we-code" width="100%" class="border-0"/>
						</div>
						<div class="w-4/5">
							<p>We Think, Then We Code.</p>
							<p class="my-1">— Planing and structure is all that matters.</p>
							<p>We don't spend much time ' cleaning ' our code,
							because all of our developers write clean code by default.
							</p>
						</div>
					</div>
					<div class="flex flex-row">
						<div class="mr-8 w-1/5">
							<img src="<?php echo \esc_attr( plugins_url( 'dist/images/do-not-re-invent-the-wheel.png', dirname( __FILE__ ) ) ); ?>" alt="we-think-then-we-code" width="100%" class="border-0"/>
						</div>
						<div class="w-4/5">
							<p>Do not re-invent the wheel!</p>
							<p>— Community of developers have never been stronger.</p>
							<p>90% of the code your application requires, is already developed.
							We just help you glue the pieces together in an efficient way.</p>
						</div>
					</div>
					<div class="flex flex-row">
						<div class="mr-8 w-1/5">
							<img src="<?php echo \esc_attr( plugins_url( 'dist/images/a-variety-of-technology-stacks.png', dirname( __FILE__ ) ) ); ?>" alt="we-think-then-we-code" width="100%" class="border-0"/>
						</div>
						<div class="w-4/5">
							<p class="break-all ">A Variety of Technology Stacks</p>
							<p class="break-all ">— We offer years of experience combined with a wealth of knowledge in a broad range of web technologies.</p>
							<p class="break-words">The key to the success of your project is choosing the right platforms and systems.
							Let us worry about the background processes and system integrations while you focus on what you do best!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
