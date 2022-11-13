<?php
/**
 * File that contents all plugin shortcodes.
 *
 * @package           Event_Memories
 */

/***
 *  Include shortcode for comments button downloading.
 */
$comments_class_path = plugin_dir_path( __FILE__ ) . 'shortcode-classes/class-commentsdownload.php';
if ( file_exists( $comments_class_path ) ) {
	require_once $comments_class_path;
}


if ( ! function_exists( 'comments_button_shortcode' ) ) {
	/**
	 * Function to render shortcode comments button for downloading.
	 */
	function comments_button_shortcode() {
		$button = new CommentsDownload();
		echo $button->render_code();
	}
}
add_shortcode( 'Event-Memories-Button', 'comments_button_shortcode' );
