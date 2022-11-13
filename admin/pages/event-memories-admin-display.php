<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://www.linkedin.com/in/saulalonsoibarra-software-engineer/
 * @since      1.0.0
 *
 * @package    Event_Memories
 * @subpackage Event_Memories/admin/partials
 */

?>

<?php
/**
 * Provide a public-facing view for the plugin.
 *
 * @link       https://https://fiesta.lezlynorman.com
 * @since      1.0.0
 *
 * @package    includes
 */

// check permission.
if ( ! is_admin() ) {
	die( 'Request not allowed.' );
}

$args = array(
	'post_type'      => 'post',
	'orderby'        => 'ID',
	'post_status'    => 'publish',
	'order'          => 'DESC',
	'posts_per_page' => -1,
);

$result             = new WP_Query( $args );
$template_path      = dirname( __FILE__ ) . '/../templates/list-template.php';
set_query_var( 'result', $result );
load_template( $template_path );
