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

$template_path = dirname( __FILE__ ) . '/../templates/settings-template.php';
load_template( $template_path );
