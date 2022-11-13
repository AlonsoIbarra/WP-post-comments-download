<?php
/**
 * No comments so far.
 *
 * @since      1.0.0
 * @package    shortcode-classes
 * @author     isaul37@hotmail.es
 */

if ( ! class_exists( 'CommentsDownload' ) ) {
	/**
	 * This class defines all code necessary to render button for comments downloading.
	 */
	class CommentsDownload {

		/**
		 * Generate html button.
		 *
		 * @since    1.0.0
		 * @access   public
		 * @return   String
		 */
		public function get_content() {

			if ( isset( $_GET['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['nonce'] ) ), 'coverage-nonce' ) ) {
				die( 'Access forbidden. Nonce does not match.' );
			}
			$template_path = dirname( __FILE__ ) . '/templates/comments-download-template.php';
			$em_download_url_form = ( 'on' === $_SERVER['HTTPS'] && isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]";
			$em_download_url_form = 'http://localhost/wp-admin/admin.php?page=em-comments-pdf-download';
			$options = get_option( 'em_plugin_settings_options' );

			set_query_var( 'em_download_url_form', $em_download_url_form );
			set_query_var( 'show_icon', esc_attr( $options['btn_show_icon'] ) );
			set_query_var( 'button_label', esc_attr( $options['btn_label'] ) );
			set_query_var( 'button_css_class', esc_attr( $options['btn_css_class'] ) );
			set_query_var( 'button_style', esc_attr( $options['btn_style'] ) );
			set_query_var( 'btn_position', esc_attr( $options['btn_position'] ) );

			ob_start();
			load_template( $template_path );
			$output = ob_get_clean();

			return $output;
		}

		/**
		 * Function to get the code.
		 *
		 * @since    1.0.0
		 * @access   public
		 * @return   String
		 */
		public function render_code() {
			$response = $this->get_content();
			return $response;
		}
	}
}

