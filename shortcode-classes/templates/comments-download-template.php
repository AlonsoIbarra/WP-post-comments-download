<?php
/**
 * Template for rendering button dor download.
 *
 * @link       https://https://fiesta.lezlynorman.com
 * @since      1.0.0
 *
 * @package    includes
 */

?>
<div style="text-align: <?php echo esc_attr( $btn_position ); ?>">
	<form method="post" id="em_download_to_pdf_form">
		<input type="hidden" id="em_download_url_form" name="em_download_url_form" value="<?php echo esc_attr( $em_download_url_form ); ?>">
		<button class="<?php echo esc_attr( $button_css_class ); ?> " style="<?php echo esc_attr( $button_style ); ?> " >
			<?php echo esc_html( $button_label ); ?>
			<?php if ( $show_icon ) : ?>
				<span class="dashicons dashicons-pdf"></span>
			<?php endif; ?>
		</button>
	</form>
</div>
