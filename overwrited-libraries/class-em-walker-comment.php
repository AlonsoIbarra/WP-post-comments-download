<?php
/**
 * Comment API: Walker_Comment class
 *
 * @package overwrited-libraries
 * @since 1.0.0
 */

/**
 * Custom walker class used to overwrite Walker_Comment and fix an error on comments output.
 *
 * @since 1.0.0
 *
 * @see Walker
 */
class EM_Walker_Comment extends Walker_Comment {

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.7.0
	 * @since 5.9.0 Renamed `$comment` to `$data_object` to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::end_el()
	 * @see wp_list_comments()
	 *
	 * @param string     $output      Used to append additional content. Passed by reference.
	 * @param WP_Comment $data_object Comment data object.
	 * @param int        $depth       Optional. Depth of the current comment. Default 0.
	 * @param array      $args        Optional. An array of arguments. Default empty array.
	 */
	public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
		if ( ! empty( $args['end-callback'] ) ) {
			ob_start();
			call_user_func(
				$args['end-callback'],
				$data_object, // The current comment object.
				$args,
				$depth
			);
			$output .= ob_get_clean();
			return;
		}
		if ( 'div' === $args['style'] ) {
			// </div> remover in order to contain all comments output inside of main div.
			$output .= "<!-- #comment-## -->\n";
		} else {
			$output .= "<!-- #comment-## -->\n";
		}
	}

}
