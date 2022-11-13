<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://www.linkedin.com/in/saulalonsoibarra-software-engineer/
 * @since             1.0.0
 * @package           Event_Memories
 *
 * @wordpress-plugin
 * Plugin Name:       event-memories
 * Plugin URI:        https://https://fiesta.lezlynorman.com
 * Description:       Custom plugin to generate a signature book for weddings event.
 * Version:           1.0.0
 * Author:            Saul Ibarra
 * Author URI:        https://https://www.linkedin.com/in/saulalonsoibarra-software-engineer/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       event-memories
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EVENT_MEMORIES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-event-memories-activator.php
 */
function activate_event_memories() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-event-memories-activator.php';
	Event_Memories_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-event-memories-deactivator.php
 */
function deactivate_event_memories() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-event-memories-deactivator.php';
	Event_Memories_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_event_memories' );
register_deactivation_hook( __FILE__, 'deactivate_event_memories' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-event-memories.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_event_memories() {

	$plugin = new Event_Memories();
	$plugin->run();

}
run_event_memories();

/**
 *  Action to render Plugin settings setup page.
 */
add_action( 'admin_init', 'em_setings_setup_page' );

if ( ! function_exists( 'em_setings_setup_page' ) ) {
	/**
	 * Function for plugin settings.
	 */
	function em_setings_setup_page() {

		register_setting(
			'em_plugin_settings_options',
			'em_plugin_settings_options'
		);

		add_settings_section(
			'em_settings',
			__( 'Settings', 'event-memories' ),
			'em_plugin_settings_instructions',
			'em_plugin_settings'
		);

		add_settings_field(
			'em_plugin_setting_button_label',
			__( 'Button label', 'event-memories' ),
			'em_plugin_setting_btn_label',
			'em_plugin_settings',
			'em_settings'
		);
		add_settings_field(
			'em_plugin_setting_btn_css_class',
			__( 'Button CSS class', 'event-memories' ),
			'em_plugin_setting_btn_css_class',
			'em_plugin_settings',
			'em_settings'
		);
		add_settings_field(
			'em_plugin_setting_btn_style',
			__( 'Button style', 'event-memories' ),
			'em_plugin_setting_btn_style',
			'em_plugin_settings',
			'em_settings'
		);
		add_settings_field(
			'em_plugin_setting_btn_align',
			__( 'Button position', 'event-memories' ),
			'em_plugin_setting_btn_position',
			'em_plugin_settings',
			'em_settings'
		);
		add_settings_field(
			'em_plugin_setting_btn_show_icon',
			__( 'Show PDF icon', 'event-memories' ),
			'em_plugin_setting_btn_show_icon',
			'em_plugin_settings',
			'em_settings'
		);
	}
}

if ( ! function_exists( 'em_plugin_settings_instructions' ) ) {
	/**
	 * Function for plugin settings.
	 */
	function em_plugin_settings_instructions() {
		echo sprintf( '<p>%s</p>',  __( 'Here you can customize download button settings... Because i love you! <3', 'event-memories' ) );
		echo '<p>Button shortcode: [Event-Memories-Button]</p>';
	}
}

if ( ! function_exists( 'em_plugin_setting_btn_label' ) ) {
	/**
	 * Function for render button label input field.
	 */
	function em_plugin_setting_btn_label() {
		$options = get_option( 'em_plugin_settings_options' );
		echo "<input id='em_plugin_setting_btn_label' name='em_plugin_settings_options[btn_label]' type='text' value='" . esc_attr( $options['btn_label'] ) . "' />";
	}
}

if ( ! function_exists( 'em_plugin_setting_btn_position' ) ) {
	/**
	 * Function for render button position field.
	 */
	function em_plugin_setting_btn_position() {
		$options = get_option( 'em_plugin_settings_options' );

		$items = array(
			'left'   => __( 'Left', 'event-memories' ),
			'center' => __( 'Center', 'event-memories' ),
			'right'  => __( 'Right', 'event-memories' ),
		);
		?>
		<select name='em_plugin_settings_options[btn_position]'>
			<?php foreach ( $items as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php echo selected( $options['btn_position'], $value ); ?>>
					<?php echo esc_attr( $label ); ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php
	}
}

if ( ! function_exists( 'em_plugin_setting_btn_css_class' ) ) {
	/**
	 * Function for render css input field.
	 */
	function em_plugin_setting_btn_css_class() {
		$options = get_option( 'em_plugin_settings_options' );
		echo "<input id='em_plugin_setting_btn_css_class' name='em_plugin_settings_options[btn_css_class]' type='text' value='" . esc_attr( $options['btn_css_class'] ) . "' />";
	}
}

if ( ! function_exists( 'em_plugin_setting_btn_style' ) ) {
	/**
	 * Function for render style input field.
	 */
	function em_plugin_setting_btn_style() {
		$options = get_option( 'em_plugin_settings_options' );
		echo "<input id='em_plugin_setting_btn_style' name='em_plugin_settings_options[btn_style]' type='text' value='" . esc_attr( $options['btn_style'] ) . "' />";
	}
}

if ( ! function_exists( 'em_plugin_setting_btn_show_icon' ) ) {
	/**
	 * Function for render checkbox for PDF icon.
	 */
	function em_plugin_setting_btn_show_icon() {
		$options = get_option( 'em_plugin_settings_options' );
		?>
		<input id='em_plugin_setting_btn_icon' name='em_plugin_settings_options[btn_show_icon]' type='checkbox' value='1' <?php echo checked( $options['btn_show_icon'], 1 ); ?> />
		<?php
	}
}

if ( ! function_exists( 'em_render_plugin_settings_form' ) ) {
	/**
	 * Function for render style input field.
	 */
	function em_render_plugin_settings_form() {
		if ( is_admin() ) {
			?>
			<h2><?php echo __( 'Event memories plugin', 'event-memories' ); ?></h2>
			<form action="options.php" method="post">
				<?php settings_fields( 'em_plugin_settings_options' ); ?>
				<?php do_settings_sections( 'em_plugin_settings' ); ?>
				<?php submit_button(); ?>
			</form>
			<?php
		}
	}
}

/**
 *  Action to render dashboard menu.
 */
add_action( 'admin_menu', 'create_book_option_menu' );

if ( ! function_exists( 'create_book_option_menu' ) ) {
	/**
	 * Function to render dashboard menu options.
	 */
	function create_book_option_menu() {

		add_menu_page(
			__( 'Entry list', 'event-memories' ),
			__( 'Event Memories', 'event-memories' ),
			'manage_options',
			'event-memories-entries',
			'events_memories_dashboard_page',
			'dashicons-book'
		);

		add_submenu_page(
			'event-memories-entries',
			__( 'Book Events Settings Page', 'event-memories' ),
			__( 'Settings', 'event-memories' ),
			'manage_options',
			'em_plugin_settings',
			'em_render_plugin_settings_form'
		);

		add_submenu_page(
			null,
			'file PDF',
			'file PDF',
			'manage_options',
			'em-comments-pdf-download',
			'em_pdf_template_loading'
		);
	}
}

if ( ! function_exists( 'em_pdf_template_loading' ) ) {
	/**
	 * The PDF template loading.
	 *
	 * @since    1.0.0
	 *  */
	function em_pdf_template_loading() {
		$plugin_path     = plugin_dir_path( __FILE__ );
		$admin_page_path = $plugin_path . 'public/partials/event-memories-pdf-render.php';
		if ( file_exists( $admin_page_path ) ) {
			require_once $admin_page_path;
		}
	}
}

if ( ! function_exists( 'events_memories_dashboard_page' ) ) {
	/**
	 * Function to render dashboard main page.
	 */
	function events_memories_dashboard_page() {
		if ( is_admin() ) {
			$plugin_path     = plugin_dir_path( __FILE__ );
			$admin_page_path = $plugin_path . 'admin/pages/event-memories-admin-display.php';
			if ( file_exists( $admin_page_path ) ) {
				require_once $admin_page_path;
			}
		}
	}
}

if ( ! function_exists( 'events_memories_settings_page' ) ) {
	/**
	 * Function to render dashboard settings page.
	 */
	function events_memories_settings_page() {
		if ( is_admin() ) {
			$plugin_path        = plugin_dir_path( __FILE__ );
			$settings_page_path = $plugin_path . 'admin/pages/event-memories-settings-display.php';
			if ( file_exists( $settings_page_path ) ) {
				require_once $settings_page_path;
			}
		}
	}
}

/**
 * Include shortcodes file.
 */
$shortcodes_file_path = plugin_dir_path( __FILE__ ) . 'shortcodes.php';
if ( file_exists( $shortcodes_file_path ) ) {
	require_once $shortcodes_file_path;
}

if ( ! function_exists( 'em_validate_token_pdf_input' ) ) {
	/**
	 * Function to validate token to pdf.
	 *
	 * @since    1.0.0
	 */
	function em_validate_token_pdf_input() {

		if ( ! isset( $_POST['key'] ) || '' === $_POST['key'] ) {
			return 'Access forbidden. Key does not exists.';
		}

		$key = sanitize_text_field( wp_unslash( $_POST['key'] ) );
		if ( ! wp_verify_nonce( $key, 'key' ) ) {
			wp_send_json_error(
				__( 'Invalid request, reload and try again.', 'event-memories' )
			);
		}

		if ( ! isset( $_POST['token'] ) ) {
			wp_send_json_error(
				__( 'Invalid request, token param is missing.', 'event-memories' )
			);
		}

		if ( wp_doing_ajax() ) {
			$token           = sanitize_text_field( wp_unslash( $_POST['token'] ) );
			$post_id         = base64_decode( $token );
			$post_exists     = get_permalink( $post_id );
			$post_categories = wp_get_post_categories( $post_id );

			if ( ! $post_exists || count( $post_categories ) === 0 ) {
				wp_send_json_error(
					__( 'Contraseña invalida.', 'event-memories' )
				);
			}
			$response = em_create_pdf_comments_file( $post_id );
			if ( $response ) :
				if ( filter_var( $response, FILTER_VALIDATE_URL ) ) :
					wp_send_json_success( $response );
				endif;
				wp_send_json_error(
					$response
				);
			endif;
			wp_send_json_error(
				__( 'Your file can not be created, send message to admin.', 'event-memories' )
			);
		}
	}
}
add_action( 'wp_ajax_em_validate_token_pdf_input', 'em_validate_token_pdf_input' );
add_action( 'wp_ajax_nopriv_em_validate_token_pdf_input', 'em_validate_token_pdf_input' );

if ( ! function_exists( 'em_create_pdf_comments_file' ) ) {
	/**
	 * Function to retrieve post comments and put into a new pdf file.
	 *
	 * @since  1.0.0
	 * @access private
	 * @param  int    $post_id   The ID of a existance post.
	 * @param  string $file_name The name of the output file, by default will be the post name.
	 * @return string The pdf file url if success or error message.
	 */
	function em_create_pdf_comments_file( $post_id, $file_name = '' ) {
		$args = array(
			'post_type' => 'post',
			'p'         => $post_id,
		);
		$query = new WP_Query( $args );

		ob_start();
		if ( ! $query->have_posts() ) :
			return esc_attr( __( 'Ups, recurso no encontrado.', 'event-memories' ) );
		endif;

		while ( $query->have_posts() ) :
			$query->the_post();
			if ( empty( $file_name ) ) :
				$file_name = esc_attr(
					str_replace( ' ', '_', get_the_title() )
				);
				$file_name = str_replace(
					array( '#', '&', ';', '"', '"', '/', '(', ')', '-', '*', '<', '>', ':', '?' ),
					'',
					$file_name
				);
			endif;

			if ( ! comments_open() ) :
				return __( 'Ups, los comentarios no están habilitados.', 'event-memories' );
			endif;

			if ( ! get_comments_number() ) :
				return __( 'No hay comentarios aún.', 'event-memories' );
			endif;

			?>
			<style>
				.em-comments-first-page{
					width: 100%;
					height: 900px;
					background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJlNTk3ZDM4ZC1jY2JmLTQxMzAtODM1NS1iOTZkNzVhNmU5ZTgiIGRhdGEtbmFtZT0iT0JKRUNUUyIgdmlld0JveD0iMCAwIDE4OS44IDM1LjgiPjx0aXRsZT5pY29ub3NfZmllc3RhPC90aXRsZT48cGF0aCBkPSJNOTAuMywyM2E1Ni40LDU2LjQsMCwwLDAtMzguNi01LjdsLTgsMmgtLjJjLTMuMy0uOC04LjItMi44LTYuNy03LjIuMS0uMy0uNS0uNi0uNi0uMmgtLjFhNS44LDUuOCwwLDAsMCw0LjEsOC4zQTU1LDU1LDAsMCwxLDI5LjcsMjJhMjMuNSwyMy41LDAsMCwxLTExLjQtMS45QTEzLjUsMTMuNSwwLDAsMSwxNC4yLDE3YTcuOCw3LjgsMCwwLDEtMS44LTMuMiw0LjEsNC4xLDAsMCwxLS4zLTEuNmMwLTIuMy44LTEuOSwyLjYsMS4zLS4zLjMuMi44LjUuNSwyLjktMy0yLjEtNi41LTMuNC0zLjZzLjMsNC45LDEuNSw2LjVBMTQuMiwxNC4yLDAsMCwwLDIwLDIxLjVjNS4yLDEuOCwxMC44LDEuNCwxNi4yLjNoLjJBNDgsNDgsMCwwLDAsNTYsMjMuNmE0NC44LDQ0LjgsMCwwLDAsOC44LTJjMy42LTEuMSw3LTMsMTAuOS0zLjFhLjEuMSwwLDAsMCwuMS0uMSwzLjcsMy43LDAsMCwxLDMuNSwzLjMsMy44LDMuOCwwLDAsMSwuMSwxLjhjLTEuMywxLjEtMi40LjgtMy44LjJhMi41LDIuNSwwLDAsMC0xLjUtLjMsMS4zLDEuMywwLDAsMC0xLjMsMS4yYy0uMiwyLjcsMy41LDEuNyw0LjksMS40QTMuMSwzLjEsMCwwLDAsODAsMjMuOWMwLS4xLjEtLjIsMC0uM2E1LjMsNS4zLDAsMCwwLS4xLTIuNSw0LjgsNC44LDAsMCwwLTEuMy0yLjIsNTIuOSw1Mi45LDAsMCwxLDExLjMsNC43QzkwLjMsMjMuOCw5MC42LDIzLjIsOTAuMywyM1pNNzYuNSwyNS42YTQuNCw0LjQsMCwwLDEtMS41LjNsLjMtMS42LjQuMmE3LjQsNy40LDAsMCwwLDEuNC40LDMuMywzLjMsMCwwLDAsMS40LS4xQTQuNCw0LjQsMCwwLDEsNzYuNSwyNS42Wk02NC4xLDE2LjdhNjEuNCw2MS40LDAsMCwxLDEwLjUsMS4ybC0xLjMuMmMtNS40LDAtMTAuNiwxLTE2LDJhODEsODEsMCwwLDEtOS45LDEuMWMtMy4yLjEtNi40LS4xLTkuNi4zbDMuMi0uOEM0OC43LDE4LjgsNTYuMSwxNi42LDY0LjEsMTYuN1pNMzYuMiwxNS4yYy4xLjIuMS4zLjIuNGgtLjFBLjkuOSwwLDAsMSwzNi4yLDE1LjJabTMsMy4zYTIuNiwyLjYsMCwwLDEtLjktLjksMTIuMywxMi4zLDAsMCwwLDMuMiwxLjdBMTAuNSwxMC41LDAsMCwxLDM5LjIsMTguNVptLTEuNSwzYS4xLjEsMCwwLDAtLjEuMWguMVptMjAsMS4yYTQ5LjgsNDkuOCwwLDAsMS0xOS42LTFjNS45LS42LDExLjctLjEsMTcuNS0xLjFzMTAuOS0yLDE2LjQtMi4ybC00LjgsMS43QTQ2LjIsNDYuMiwwLDAsMSw1Ny43LDIyLjdaIj48L3BhdGg+PHBhdGggZD0iTTE3Ny45LDE0Yy4zLjMuNy0uMi40LS41LDEuOC0zLjIsMi42LTMuNiwyLjYtMS4zLS4xLjQtLjEuOC0uMiwxLjNhNy4xLDcuMSwwLDAsMS0xLjUsM0ExMS45LDExLjksMCwwLDEsMTc1LDIwYy0zLjUsMS44LTcuNywyLjItMTEuNywyYTU1LDU1LDAsMCwxLTEwLjUtMS44LDUuOCw1LjgsMCwwLDAsNC4xLTguM2gtLjFjLS4xLS40LS43LS4xLS42LjIsMS41LDQuNC0zLjQsNi40LTYuNyw3LjJoLS4ybC04LTJBNTYsNTYsMCwwLDAsMTAyLjgsMjNhLjMuMywwLDAsMCwuMy42LDUxLjcsNTEuNywwLDAsMSwxMS40LTQuNyw0LjEsNC4xLDAsMCwwLTEuMywyLjIsNC40LDQuNCwwLDAsMC0uMiwyLjUuNC40LDAsMCwwLC4xLjMsMy4xLDMuMSwwLDAsMCwyLjMsMi4xYzEuMy4zLDUsMS4zLDQuOC0xLjRhMS4zLDEuMywwLDAsMC0xLjMtMS4yLDIuNSwyLjUsMCwwLDAtMS4yLjJjLTEuNS42LTIuNywxLjEtNC4xLS4xYTYuNiw2LjYsMCwwLDEsMC0xLjQsNCw0LDAsMCwxLDMuNi0zLjcuMS4xLDAsMCwwLC4xLjFjMy44LDAsNywxLjksMTAuNSwzYTQ5LDQ5LDAsMCwwLDkuMiwyLjEsNDgsNDgsMCwwLDAsMTkuNi0xLjdoLjJhMzUuNSwzNS41LDAsMCwwLDEzLjQuNWM0LjgtMSwxMS4zLTQuMywxMS4zLTEwLjFTMTc0LjUsMTAuNSwxNzcuOSwxNFpNMTE1LjcsMjVsMS4zLS40Yy44LS4zLjctLjYuOS41cy4yLDEtLjQuN2wtLjktLjItMS43LS40YTIuOCwyLjgsMCwwLDEtLjgtLjZBNC4yLDQuMiwwLDAsMCwxMTUuNywyNVptNDEuMS05LjNoLS4yYS41LjUsMCwwLDAsLjItLjRabS0zLDIuOGExMC41LDEwLjUsMCwwLDEtMi4zLjgsMTQuOCwxNC44LDAsMCwwLDMuMy0xLjdBNC4xLDQuMSwwLDAsMSwxNTMuOCwxOC41Wk0xNDksMTkuOWMyLC41LDQuMSwxLjEsNi4yLDEuNS0zLjEtLjMtNi4xLS4xLTkuMS0uMmE2MC4yLDYwLjIsMCwwLDEtMTAuNC0xLjEsODYuNSw4Ni41LDAsMCwwLTE2LTJsLTEuMy0uMmE2My4yLDYzLjIsMCwwLDEsNy42LTEuMUMxMzMuOSwxNi4zLDE0MS40LDE3LjksMTQ5LDE5LjlabS0xMy43LDIuOGE0Ni4yLDQ2LjIsMCwwLDEtOS41LTIuNkwxMjEsMTguNGM1LjUuMiwxMC45LDEuNCwxNi40LDIuMnMxMS42LjUsMTcuNSwxLjFBNDkuNyw0OS43LDAsMCwxLDEzNS4zLDIyLjdabTIwLjEtMS4xYzAtLjEsMC0uMS0uMS0uMWguMVoiPjwvcGF0aD48L3N2Zz4=");
				}
			</style>
			<div class="em-comments-first-page">
				<div class="em-comments-main-image" style="text-align: center;">
					<img style="width: 10%;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJiMWE3Y2JiOS02YWNjLTQyNGEtYWYzZS04YjIxOTZkMWI5MmMiIGRhdGEtbmFtZT0iT0JKRUNUUyIgdmlld0JveD0iMCAwIDExNi42IDEwNS4zIj48dGl0bGU+aWNvbm9zX2ZpZXN0YTwvdGl0bGU+PHBhdGggZD0iTTYwLjcsOTUuOWE0MS41LDQxLjUsMCwxLDEsNDEuNS00MS40QTQxLjUsNDEuNSwwLDAsMSw2MC43LDk1LjlabTAtODIuMmE0MC44LDQwLjgsMCwxLDAsNDAuOCw0MC44QTQwLjgsNDAuOCwwLDAsMCw2MC43LDEzLjdaIj48L3BhdGg+PHBhdGggZD0iTTc0LjgsMTUuNmMtLjIuNy0xLjMsMS0yLjUuNnMtMi0xLjItMS44LTEuOSwxLjMtLjksMi41LS42Uzc1LDE0LjksNzQuOCwxNS42WiI+PC9wYXRoPjxwYXRoIGQ9Ik03My4zLDE2LjZINzIuMmEzLjgsMy44LDAsMCwxLTEuNS0uOSwxLjUsMS41LDAsMCwxLS41LTEuMywxLjUsMS41LDAsMCwxLDEuMS0uOSwzLjcsMy43LDAsMCwxLDEuOC4xLDMuMiwzLjIsMCwwLDEsMS41LjksMS41LDEuNSwwLDAsMSwuNSwxLjNoMGExLjcsMS43LDAsMCwxLTEuMS45Wk03MiwxMy44aC0uNmEuOS45LDAsMCwwLS43LjVjLS4xLjMuMi43LjMuOGEzLjIsMy4yLDAsMCwwLDEuNC44LDIuNiwyLjYsMCwwLDAsMS41LjFjLjItLjEuNi0uMi43LS42aDBjLjEtLjMtLjItLjYtLjMtLjhBMi43LDIuNywwLDAsMCw3MywxNFoiPjwvcGF0aD48cGF0aCBkPSJNMzMuMiwyNGMyLjMtMi4zLDMuOC00LjcsMy04LjNhLjQuNCwwLDAsMC0uNi0uMSwxMy4zLDEzLjMsMCwwLDAtNC41LDkuN2MwLC41LjYuNS42LDB2LS4yaC4yYS4zLjMsMCwwLDAsLjIuNSwyNy42LDI3LjYsMCwwLDAsMTEuMS0uOWMuMi0uMS4zLS41LjEtLjZDNDAuNCwyMi43LDM2LjQsMjMuMiwzMy4yLDI0Wm0yLjQtNy41Yy42LDMuNC0xLjMsNS42LTMuNyw3LjloLS4xQTEyLjYsMTIuNiwwLDAsMSwzNS42LDE2LjVaTTMyLjMsMjVoMGMyLjgtLjksNi44LTEuNiw5LjgtLjZBMzIuMiwzMi4yLDAsMCwxLDMyLjMsMjVaIj48L3BhdGg+PHBhdGggZD0iTTUwLjYsMTguN2MtMi0xLjUtNS4yLTEuNi03LjktMS4yLDIuMS0xLjQsNC4xLTMuNSwzLjUtNS44YS4zLjMsMCwwLDAtLjUtLjIsMjIuNSwyMi41LDAsMCwwLTYuMiw3LjJjLS4yLjQuMy43LjUuNHMuMS0uMi4yLS4yaDBjMCwuMS4xLjIuMi4zYTE2LjIsMTYuMiwwLDAsMCwxMC4yLjNjLjItLjEuMi0uMy4yLS41UzUwLjgsMTguOCw1MC42LDE4LjdabS01LTYuM2MuMSwyLjMtMi43LDQuNS00LjgsNS41QTIyLjksMjIuOSwwLDAsMSw0NS42LDEyLjRabS00LjcsNi4yYzIuNy0uNyw2LjUtMSw5LC40QTE0LjYsMTQuNiwwLDAsMSw0MC45LDE4LjZaIj48L3BhdGg+PHBhdGggZD0iTTYxLjksMTYuM2MtMS0yLjctNS4zLTIuNy04LjEtMi41bDEuNi0xLjNDNTYuNSwxMS40LDU4LDkuOSw1OCw4LjNzLS4yLS40LS40LS40QTExLjMsMTEuMywwLDAsMCw1MCwxNC40Yy0uMi4zLjQuNy42LjNoMGMwLC4xLjEuMi4zLjJoLjhhMTcuMSwxNy4xLDAsMCwwLDkuOSwyLjFDNjEuOCwxNi43LDYyLDE2LjYsNjEuOSwxNi4zWk01MC44LDE0LjJhMTEsMTEsMCwwLDEsNi41LTUuNUE3LjksNy45LDAsMCwxLDU1LDEyYTYuMyw2LjMsMCwwLDEtNC4xLDIuMVptMiwuM2MyLjEtLjIsNy0uNSw4LjMsMS42QTE1LjksMTUuOSwwLDAsMSw1Mi44LDE0LjVaIj48L3BhdGg+PHBhdGggZD0iTTM2LDMwYy0zLjEtLjQtNi4yLS42LTguOS45LjItMS44LDEuMi0zLjYsMS41LTUuNXMuNS0zLjEtLjQtMy45LS40LS4yLS41LDBjLTIuOSwzLjEtMi4zLDYuNC0xLjUsMTAuMywwLC4zLjQuMy42LjFzMCwuNC4zLjRhMzIuMSwzMi4xLDAsMCwwLDUuNC4yLDkuMyw5LjMsMCwwLDAsMy43LTEuOUMzNi40LDMwLjQsMzYuMywzMC4xLDM2LDMwWm0tOS45LTMuMmE2LjcsNi43LDAsMCwxLC43LTMuMWMuMy0uNi43LTIsMS4yLS44cy0uMiwzLjYtLjYsNC45LS42LDEuNy0uOCwyLjVBMTQuOCwxNC44LDAsMCwxLDI2LjEsMjYuOFptLjcsNVptNC4zLjEtNC0uMkgyN2MyLjUtMS41LDUuMy0xLjUsOC4xLTEuMUE2LjgsNi44LDAsMCwxLDMxLjEsMzEuOVoiPjwvcGF0aD48cGF0aCBkPSJNOTkuMyw2OS4yYy0uNi0uMi0uOS0xLjQtLjUtMi42czEuMi0xLjksMS45LTEuNy45LDEuMy42LDIuNVMxMDAsNjkuNCw5OS4zLDY5LjJaIj48L3BhdGg+PHBhdGggZD0iTTk5LjYsNjkuNWgtLjNjLS45LS4yLTEuMi0xLjUtLjgtMi44czEuNC0yLjIsMi4zLTIsMS4xLDEuNS43LDIuOVMxMDAuMyw2OS41LDk5LjYsNjkuNVptLS4yLS41Yy42LjEsMS4zLS42LDEuNi0xLjdzLjItMi0uNC0yLjItMS4zLjYtMS42LDEuNi0uMSwyLjEuNCwyLjNaIj48L3BhdGg+PHBhdGggZD0iTTk5LjksMzAuNWMuMiwwLC4yLS4zLjEtLjVhMTMuNSwxMy41LDAsMCwwLTkuNy00LjcuMy4zLDAsMCwwLDAsLjZoLjJjLS4xLS4xLS41LS4xLS41LjItLjMsMy44LS40LDcuNS44LDExLjEsMCwuMy40LjQuNi4xLDEuNC0yLjgsMS02LjguMi0xMEM5My45LDI5LjgsOTYuMywzMS4zLDk5LjksMzAuNVptLS44LS41Yy0zLjQuNS01LjYtMS40LTcuOS0zLjhWMjZoMEExMy4xLDEzLjEsMCwwLDEsOTkuMSwzMFptLTgsNi4zYTMyLjIsMzIuMiwwLDAsMS0uNS05LjhoLjFDOTEuNSwyOS40LDkyLjIsMzMuMyw5MS4xLDM2LjNaIj48L3BhdGg+PHBhdGggZD0iTTEwMy44LDQwLjZjLjEsMCwuMy0uMy4yLS40YTI0LjQsMjQuNCwwLDAsMC03LjItNi40Yy0uNC0uMi0uNy4zLS40LjVzLjIuMS4yLjJoLjFjLS4yLDAtLjMuMS0uMy4yYTE0LjksMTQuOSwwLDAsMC0uNSwxMC4yYy4xLjIuMy4zLjQuMmguNGMxLjUtMi4xLDEuNy01LjIsMS4yLTcuOUM5OS4zLDM5LjIsMTAxLjQsNDEuMiwxMDMuOCw0MC42Wm0tLjctLjVjLTIuNC4xLTQuNS0yLjktNS41LTVBMjMuNywyMy43LDAsMCwxLDEwMy4xLDQwLjFabS02LjcsNC4xYTE0LjYsMTQuNiwwLDAsMSwuNS05Qzk3LjYsMzcuOSw5Ny44LDQxLjgsOTYuNCw0NC4yWiI+PC9wYXRoPjxwYXRoIGQ9Ik0xMDcuMyw1Mi4xYTExLjQsMTEuNCwwLDAsMC02LjMtNy43Yy0uNC0uMi0uNy40LS4zLjVzMCwuMS4xLjEtLjIuMS0uMi4zYTIuMiwyLjIsMCwwLDAsLjEuOEExNi40LDE2LjQsMCwwLDAsOTguNCw1NmMwLC4yLjIuNC40LjMsMi43LTEsMi45LTUuMywyLjctOC4xYTEwLjEsMTAuMSwwLDAsMCwxLjMsMS42YzEuMSwxLjIsMi41LDIuNyw0LjIsMi43UzEwNy4zLDUyLjMsMTA3LjMsNTIuMVpNOTksNTUuNWExNy4xLDE3LjEsMCwwLDEsMS44LTguM0MxMDAuOSw0OS4zLDEwMS4yLDU0LjIsOTksNTUuNVptNC4yLTYuMWE2LjcsNi43LDAsMCwxLTItNC4xaDBhMTAuOSwxMC45LDAsMCwxLDUuMyw2LjZDMTA1LjMsNTEuNSwxMDQuMSw1MC4yLDEwMy4yLDQ5LjRaIj48L3BhdGg+PHBhdGggZD0iTTkwLjMsMjIuOGMxLjEuMSwzLjEuNiwzLjktLjNzLjItLjQsMC0uNWMtMy0yLjktNi40LTIuNC0xMC4zLTEuNy0uMy4xLS4zLjQtLjEuNnMtLjQsMC0uNC4zYTI0LjQsMjQuNCwwLDAsMC0uMiw1LjQsOC40LDguNCwwLDAsMCwxLjcsMy43Yy4yLjIuNi4yLjYtLjEuNS0zLjEuOC02LjItLjYtOUM4Ni42LDIxLjQsODguNSwyMi41LDkwLjMsMjIuOFpNODksMjAuM2E2LjMsNi4zLDAsMCwxLDMsLjdsLjkuN2MuNi4zLjYuNS0uMS41cy0zLjctLjItNC45LS42YTI1LDI1LDAsMCwwLTIuNS0uOUEyMiwyMiwwLDAsMSw4OSwyMC4zWm0tNSwuNlptMSw4LjNhNy41LDcuNSwwLDAsMS0xLjItMy45LDI3LjMsMjcuMywwLDAsMSwuMy00LjFoMEM4NS41LDIzLjYsODUuNCwyNi40LDg1LDI5LjJaIj48L3BhdGg+PHBhdGggZD0iTTQ3LjUsOTMuNmMuMi0uNywxLjMtMSwyLjUtLjZzMiwxLjEsMS45LDEuOC0xLjQsMS0yLjYuN1M0Ny4zLDk0LjMsNDcuNSw5My42WiI+PC9wYXRoPjxwYXRoIGQ9Ik01MC4zLDk1LjlsLTEtLjJjLTEuNC0uMy0yLjMtMS4zLTIuMS0yLjFhMS4zLDEuMywwLDAsMSwxLjEtLjksMi44LDIuOCwwLDAsMSwxLjgsMGMxLjMuNCwyLjIsMS4zLDIsMi4ycy0uNS43LTEuMS45Wm0tMS4yLTIuOGgtLjdhLjkuOSwwLDAsMC0uNy41Yy0uMS42LjYsMS4zLDEuNywxLjVhMi42LDIuNiwwLDAsMCwxLjUuMWMuMi0uMS42LS4yLjctLjZzLS42LTEuMi0xLjctMS41WiI+PC9wYXRoPjxwYXRoIGQ9Ik05MC40LDgyLjlhLjQuNCwwLDAsMS0uMS4zaC0uMWMuMS0uMi4xLS41LS4yLS41YTI5LjYsMjkuNiwwLDAsMC0xMS4xLDEuMWMtLjIuMS0uMy41LS4xLjYsMi45LDEuNCw2LjkuOCwxMC4xLS4xLTIuMiwyLjQtMy42LDQuOC0yLjgsOC40YS40LjQsMCwwLDAsLjYuMUExMy43LDEzLjcsMCwwLDAsOTEsODIuOS4zLjMsMCwwLDAsOTAuNCw4Mi45Wk04MCw4NC4yYTI5LjQsMjkuNCwwLDAsMSw5LjgtLjloMEM4Nyw4NC4zLDgzLDg1LjEsODAsODQuMlptMTAuMi0uM2EuMS4xLDAsMCwwLC4xLS4xaDBhMTIuNSwxMi41LDAsMCwxLTMuNyw4LjFDODYsODguNSw4Ny44LDg2LjIsOTAuMiw4My45WiI+PC9wYXRoPjxwYXRoIGQ9Ik04Mi4yLDg5LjR2LjJIODJjMC0uMSwwLS4yLS4yLS4zYTE1LjUsMTUuNSwwLDAsMC0xMC4yLS4xYy0uMi4xLS4yLjMtLjIuNWwuMi4zYzIuMSwxLjUsNS4yLDEuNSw3LjksMS0yLjEsMS40LTMuOSwzLjYtMy4zLDUuOS4xLjMuMy4zLjUuMmEyNC4yLDI0LjIsMCwwLDAsNi4xLTcuNEEuMy4zLDAsMCwwLDgyLjIsODkuNFptLTkuOC4zYTE0LjIsMTQuMiwwLDAsMSw4LjkuMkM3OC43LDkwLjcsNzQuOCw5MS4xLDcyLjQsODkuN1ptNC4zLDYuNWMtLjEtMi4zLDIuNy00LjUsNC44LTUuNkEyMy40LDIzLjQsMCwwLDEsNzYuNyw5Ni4yWiI+PC9wYXRoPjxwYXRoIGQ9Ik03MS43LDk0LjFoMGMwLS4xLS4xLS4yLS4zLS4ybC0uOC4yYTE2LjQsMTYuNCwwLDAsMC05LjktMS45LjQuNCwwLDAsMC0uNC40YzEuMSwyLjcsNS40LDIuNiw4LjIsMi40QTYuNCw2LjQsMCwwLDAsNjcsOTYuM2MtMS4xLDEuMi0yLjYsMi43LTIuNiw0LjNzLjIuNC40LjNhMTEuNCwxMS40LDAsMCwwLDcuNi02LjZDNzIuNSw5My45LDcxLjksOTMuNyw3MS43LDk0LjFaTTYxLjIsOTIuOGExNS43LDE1LjcsMCwwLDEsOC4zLDEuNEM2Ny40LDk0LjUsNjIuNSw5NC45LDYxLjIsOTIuOFptMy45LDcuM2E5LjQsOS40LDAsMCwxLDIuMy0zLjMsNiw2LDAsMCwxLDQtMi4yaC4xQTEwLjksMTAuOSwwLDAsMSw2NS4xLDEwMC4xWiI+PC9wYXRoPjxwYXRoIGQ9Ik05NS43LDc2LjNjMC0uMy0uNC0uMi0uNSwwcy0uMS0uNC0uMy0uNGEyNi44LDI2LjgsMCwwLDAtNC45LS4xLDcuNSw3LjUsMCwwLDAtNC4yLDJjLS4yLjItLjIuNS4yLjYsMywuMyw2LjIuNSw4LjktMS4xLS4yLDEuOC0xLjIsMy42LTEuNCw1LjVzLS40LDMuMS41LDMuOS4zLjIuNCwwQzk3LjMsODMuNiw5Ni42LDgwLjIsOTUuNyw3Ni4zWm0tLjYuMVptLTguMiwxLjRhNi40LDYuNCwwLDAsMSwzLjktMS40YzEuMy0uMSwyLjcuMSw0LjEuMWgwQzkyLjUsNzguMSw4OS43LDc4LjEsODYuOSw3Ny44Wm03LjIsNy4xYTEyLjksMTIuOSwwLDAsMSwuNi00LjhjLjItLjguNS0xLjUuNy0yLjNhMTQuOCwxNC44LDAsMCwxLC41LDMuNSw4LjYsOC42LDAsMCwxLS41LDMuMkM5NC45LDg1LjQsOTQuNCw4Ni41LDk0LjEsODQuOVoiPjwvcGF0aD48cGF0aCBkPSJNMzkuMSw4OS4xYy0yLTIuOC0xLjctNi0xLjQtOS4ybC0uNi4yQTcuNSw3LjUsMCwwLDEsMzksODVhMjQuMSwyNC4xLDAsMCwxLS4xLDMuOGMwLC40LjcuNC43LDBhNDUuMSw0NS4xLDAsMCwwLDAtNS4yLDguMSw4LjEsMCwwLDAtMi0zLjljLS4yLS4zLS42LDAtLjYuMi0uMywzLjMtLjUsNi43LDEuNSw5LjUuMy40LjgsMCwuNi0uM1oiPjwvcGF0aD48cGF0aCBkPSJNMjEuNSw0MS41Yy43LjIsMSwxLjMuNywyLjVzLTEuMiwyLjEtMS45LDEuOS0xLTEuMy0uNy0yLjVTMjAuOCw0MS4zLDIxLjUsNDEuNVoiPjwvcGF0aD48cGF0aCBkPSJNMjAuNSw0Ni4yaC0uMmMtLjktLjMtMS4zLTEuNS0uOS0yLjlhMi40LDIuNCwwLDAsMSwuOC0xLjUsMS4yLDEuMiwwLDAsMSwxLjMtLjUsMS4yLDEuMiwwLDAsMSwuOSwxLDIuOCwyLjgsMCwwLDEsMCwxLjhDMjIuMSw0NS4zLDIxLjMsNDYuMiwyMC41LDQ2LjJabS44LTQuNWExLjIsMS4yLDAsMCwwLS43LjQsMi42LDIuNiwwLDAsMC0uNywxLjRjLS4zLDEtLjEsMiwuNSwyLjJzMS4yLS43LDEuNS0xLjdhMS45LDEuOSwwLDAsMCwwLTEuNWMwLS4zLS4yLS43LS41LS43WiI+PC9wYXRoPjxwYXRoIGQ9Ik0zMi41LDg0LjNoLS4zYS40LjQsMCwwLDAsLjYtLjMsMjkuNCwyOS40LDAsMCwwLTEuMy0xMWMtLjEtLjMtLjUtLjQtLjYtLjEtMS4zLDIuOS0uOCw2LjkuMiwxMC0yLjQtMi4xLTQuOS0zLjUtOC40LTIuNi0uMiwwLS4zLjMtLjEuNUExMy4zLDEzLjMsMCwwLDAsMzIuNSw4NUMzMi45LDg1LDMyLjksODQuMywzMi41LDg0LjNaTTMxLjIsNzRhMzIuMywzMi4zLDAsMCwxLC45LDkuOGgwQzMxLjEsODAuOSwzMC4yLDc3LDMxLjIsNzRabS4zLDEwLjFjMCwuMS4xLjEuMS4yaDBhMTIuOSwxMi45LDAsMCwxLTguMS0zLjZDMjYuOSw4MC4xLDI5LjIsODEuOCwzMS41LDg0LjFaIj48L3BhdGg+PHBhdGggZD0iTTI2LDc2LjJoLS4zYy4xLDAsLjMsMCwuMy0uMmExNC42LDE0LjYsMCwwLDAsMC0xMC4xLjIuMiwwLDAsMC0uNC0uMmMtLjEtLjEtLjMsMC0uNC4xLTEuNCwyLjEtMS40LDUuMi0uOSw4LTEuNC0yLjEtMy42LTQtNS45LTMuMy0uMywwLS4zLjMtLjIuNWEyNS4xLDI1LjEsMCwwLDAsNy40LDZDMjYsNzcsMjYuMyw3Ni40LDI2LDc2LjJabS0uNC05LjhhMTQuNiwxNC42LDAsMCwxLS4xLDlDMjQuNiw3Mi43LDI0LjIsNjguOSwyNS42LDY2LjRabS02LjUsNC40YzIuMy0uMiw0LjUsMi42LDUuNyw0LjdBMjEuNywyMS43LDAsMCwxLDE5LjEsNzAuOFoiPjwvcGF0aD48cGF0aCBkPSJNMjEuMiw2NS44aC0uMWMuMi0uMS4zLS4yLjItLjNhMS45LDEuOSwwLDAsMC0uMS0uOCwxNy40LDE3LjQsMCwwLDAsMS44LTEwYzAtLjItLjItLjQtLjQtLjMtMi43LDEuMS0yLjYsNS40LTIuMyw4LjJBMTAuNywxMC43LDAsMCwwLDE4LjksNjFjLTEuMS0xLTIuNi0yLjUtNC4zLTIuNS0uMiwwLS40LjItLjMuNEExMS4yLDExLjIsMCwwLDAsMjEsNjYuNEMyMS40LDY2LjYsMjEuNiw2NS45LDIxLjIsNjUuOFptMS4yLTEwLjZBMTUuNywxNS43LDAsMCwxLDIxLDYzLjVDMjAuOCw2MS40LDIwLjMsNTYuNiwyMi40LDU1LjJabS03LjMsNGE4LjksOC45LDAsMCwxLDMuNCwyLjMsNi42LDYuNiwwLDAsMSwyLjIsNGgwQTEwLjcsMTAuNywwLDAsMSwxNS4xLDU5LjJaIj48L3BhdGg+PHBhdGggZD0iTTM5LjYsODMuNmE4LjEsOC4xLDAsMCwwLTItMy45Yy0uMi0uMy0uNiwwLS42LjItLjMsMy4xLS40LDYuMiwxLjEsOC45LTEuOC0uMi0zLjYtMS4yLTUuNC0xLjNzLTMuMi0uNS00LC41YS4zLjMsMCwwLDAsMCwuNGMzLjIsMi44LDYuNSwyLjEsMTAuNCwxLjNhLjMuMywwLDAsMCwuMS0uNmMuMiwwLC40LS4xLjQtLjNBNDUuMSw0NS4xLDAsMCwwLDM5LjYsODMuNlptLTItMi44QTYuOCw2LjgsMCwwLDEsMzksODVhMjQuMSwyNC4xLDAsMCwxLS4xLDMuOGgwQz
					M3LjMsODYuNCwzNy40LDgzLjYsMzcuNiw4MC44Wm0tMy41LDkuMWE2LjksNi45LDAsMCwxLTMuMS0uNmMtLjktLjQtMi0uOS0uNS0xLjJhMTMuNCwxMy40LDAsMCwxLDQuOS41LDExLjEsMTEuMSwwLDAsMCwyLjIuN0ExOS43LDE5LjcsMCwwLDEsMzQuMSw4OS45Wk0zOSw4OVoiPjwvcGF0aD48L3N2Zz4=" />
				</div><!-- main image -->
				<div class="em-comments-title" style="text-align: center;">
					<P>
						<?php echo esc_attr__( 'NUESTRA BODA', 'event-memories' ); ?>
					</P>
					<P>
						<?php echo esc_attr__( get_the_title(), 'event-memories' ); ?>
					</P>
				</div><!-- title -->
				<div class="em-comments-due-date" style="text-align: center;">
					<?php
					$post_meta = get_post_meta( get_the_ID(), '_elementor_data' );
					$settings  = json_decode( esc_attr( $post_meta[0] ) );
					$due_date  = isset( $settings[0]->elements[1]->elements[3]->settings->due_date ) ?
						$settings[0]->elements[1]->elements[3]->settings->due_date :
						null;

					$date = date_create( $due_date );
					echo esc_html( date_format( $date, 'd | m | y' ) );
					?>
				</div><!--  Due date -->
				<div class="em-comments-effects" style="text-align:center;">
					<img style="width: 20%;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJlNTk3ZDM4ZC1jY2JmLTQxMzAtODM1NS1iOTZkNzVhNmU5ZTgiIGRhdGEtbmFtZT0iT0JKRUNUUyIgdmlld0JveD0iMCAwIDE4OS44IDM1LjgiPjx0aXRsZT5pY29ub3NfZmllc3RhPC90aXRsZT48cGF0aCBkPSJNOTAuMywyM2E1Ni40LDU2LjQsMCwwLDAtMzguNi01LjdsLTgsMmgtLjJjLTMuMy0uOC04LjItMi44LTYuNy03LjIuMS0uMy0uNS0uNi0uNi0uMmgtLjFhNS44LDUuOCwwLDAsMCw0LjEsOC4zQTU1LDU1LDAsMCwxLDI5LjcsMjJhMjMuNSwyMy41LDAsMCwxLTExLjQtMS45QTEzLjUsMTMuNSwwLDAsMSwxNC4yLDE3YTcuOCw3LjgsMCwwLDEtMS44LTMuMiw0LjEsNC4xLDAsMCwxLS4zLTEuNmMwLTIuMy44LTEuOSwyLjYsMS4zLS4zLjMuMi44LjUuNSwyLjktMy0yLjEtNi41LTMuNC0zLjZzLjMsNC45LDEuNSw2LjVBMTQuMiwxNC4yLDAsMCwwLDIwLDIxLjVjNS4yLDEuOCwxMC44LDEuNCwxNi4yLjNoLjJBNDgsNDgsMCwwLDAsNTYsMjMuNmE0NC44LDQ0LjgsMCwwLDAsOC44LTJjMy42LTEuMSw3LTMsMTAuOS0zLjFhLjEuMSwwLDAsMCwuMS0uMSwzLjcsMy43LDAsMCwxLDMuNSwzLjMsMy44LDMuOCwwLDAsMSwuMSwxLjhjLTEuMywxLjEtMi40LjgtMy44LjJhMi41LDIuNSwwLDAsMC0xLjUtLjMsMS4zLDEuMywwLDAsMC0xLjMsMS4yYy0uMiwyLjcsMy41LDEuNyw0LjksMS40QTMuMSwzLjEsMCwwLDAsODAsMjMuOWMwLS4xLjEtLjIsMC0uM2E1LjMsNS4zLDAsMCwwLS4xLTIuNSw0LjgsNC44LDAsMCwwLTEuMy0yLjIsNTIuOSw1Mi45LDAsMCwxLDExLjMsNC43QzkwLjMsMjMuOCw5MC42LDIzLjIsOTAuMywyM1pNNzYuNSwyNS42YTQuNCw0LjQsMCwwLDEtMS41LjNsLjMtMS42LjQuMmE3LjQsNy40LDAsMCwwLDEuNC40LDMuMywzLjMsMCwwLDAsMS40LS4xQTQuNCw0LjQsMCwwLDEsNzYuNSwyNS42Wk02NC4xLDE2LjdhNjEuNCw2MS40LDAsMCwxLDEwLjUsMS4ybC0xLjMuMmMtNS40LDAtMTAuNiwxLTE2LDJhODEsODEsMCwwLDEtOS45LDEuMWMtMy4yLjEtNi40LS4xLTkuNi4zbDMuMi0uOEM0OC43LDE4LjgsNTYuMSwxNi42LDY0LjEsMTYuN1pNMzYuMiwxNS4yYy4xLjIuMS4zLjIuNGgtLjFBLjkuOSwwLDAsMSwzNi4yLDE1LjJabTMsMy4zYTIuNiwyLjYsMCwwLDEtLjktLjksMTIuMywxMi4zLDAsMCwwLDMuMiwxLjdBMTAuNSwxMC41LDAsMCwxLDM5LjIsMTguNVptLTEuNSwzYS4xLjEsMCwwLDAtLjEuMWguMVptMjAsMS4yYTQ5LjgsNDkuOCwwLDAsMS0xOS42LTFjNS45LS42LDExLjctLjEsMTcuNS0xLjFzMTAuOS0yLDE2LjQtMi4ybC00LjgsMS43QTQ2LjIsNDYuMiwwLDAsMSw1Ny43LDIyLjdaIj48L3BhdGg+PHBhdGggZD0iTTE3Ny45LDE0Yy4zLjMuNy0uMi40LS41LDEuOC0zLjIsMi42LTMuNiwyLjYtMS4zLS4xLjQtLjEuOC0uMiwxLjNhNy4xLDcuMSwwLDAsMS0xLjUsM0ExMS45LDExLjksMCwwLDEsMTc1LDIwYy0zLjUsMS44LTcuNywyLjItMTEuNywyYTU1LDU1LDAsMCwxLTEwLjUtMS44LDUuOCw1LjgsMCwwLDAsNC4xLTguM2gtLjFjLS4xLS40LS43LS4xLS42LjIsMS41LDQuNC0zLjQsNi40LTYuNyw3LjJoLS4ybC04LTJBNTYsNTYsMCwwLDAsMTAyLjgsMjNhLjMuMywwLDAsMCwuMy42LDUxLjcsNTEuNywwLDAsMSwxMS40LTQuNyw0LjEsNC4xLDAsMCwwLTEuMywyLjIsNC40LDQuNCwwLDAsMC0uMiwyLjUuNC40LDAsMCwwLC4xLjMsMy4xLDMuMSwwLDAsMCwyLjMsMi4xYzEuMy4zLDUsMS4zLDQuOC0xLjRhMS4zLDEuMywwLDAsMC0xLjMtMS4yLDIuNSwyLjUsMCwwLDAtMS4yLjJjLTEuNS42LTIuNywxLjEtNC4xLS4xYTYuNiw2LjYsMCwwLDEsMC0xLjQsNCw0LDAsMCwxLDMuNi0zLjcuMS4xLDAsMCwwLC4xLjFjMy44LDAsNywxLjksMTAuNSwzYTQ5LDQ5LDAsMCwwLDkuMiwyLjEsNDgsNDgsMCwwLDAsMTkuNi0xLjdoLjJhMzUuNSwzNS41LDAsMCwwLDEzLjQuNWM0LjgtMSwxMS4zLTQuMywxMS4zLTEwLjFTMTc0LjUsMTAuNSwxNzcuOSwxNFpNMTE1LjcsMjVsMS4zLS40Yy44LS4zLjctLjYuOS41cy4yLDEtLjQuN2wtLjktLjItMS43LS40YTIuOCwyLjgsMCwwLDEtLjgtLjZBNC4yLDQuMiwwLDAsMCwxMTUuNywyNVptNDEuMS05LjNoLS4yYS41LjUsMCwwLDAsLjItLjRabS0zLDIuOGExMC41LDEwLjUsMCwwLDEtMi4zLjgsMTQuOCwxNC44LDAsMCwwLDMuMy0xLjdBNC4xLDQuMSwwLDAsMSwxNTMuOCwxOC41Wk0xNDksMTkuOWMyLC41LDQuMSwxLjEsNi4yLDEuNS0zLjEtLjMtNi4xLS4xLTkuMS0uMmE2MC4yLDYwLjIsMCwwLDEtMTAuNC0xLjEsODYuNSw4Ni41LDAsMCwwLTE2LTJsLTEuMy0uMmE2My4yLDYzLjIsMCwwLDEsNy42LTEuMUMxMzMuOSwxNi4zLDE0MS40LDE3LjksMTQ5LDE5LjlabS0xMy43LDIuOGE0Ni4yLDQ2LjIsMCwwLDEtOS41LTIuNkwxMjEsMTguNGM1LjUuMiwxMC45LDEuNCwxNi40LDIuMnMxMS42LjUsMTcuNSwxLjFBNDkuNyw0OS43LDAsMCwxLDEzNS4zLDIyLjdabTIwLjEtMS4xYzAtLjEsMC0uMS0uMS0uMWguMVoiPjwvcGF0aD48L3N2Zz4=" />
				</div><!-- .effects -->
				<div class="em-comments-subtitle" style="text-align: center;">
					<P>
						<?php echo esc_attr__( 'BUZÓN DE COMENTARIOS', 'event-memories' ); ?>
					</P>
				</div><!-- subtitle -->
			</div><!-- .first page -->
			<div class="em-comments-content" style="text-align: center; margin:1%; width:100%; border:solid 2px;">
				<ol class="comment-list" style="list-style: none;">
					<?php
					$args = array(
						'walker'            => null,
						'max_depth'         => '',
						'style'             => 'li',
						'callback'          => 'em_post_comments_callback',
						'end-callback'      => null,
						'type'              => 'all',
						'replay_text'       => __( 'Replay', 'event-memories' ),
						'page'              => '',
						'per_page'          => '',
						'avatar_size'       => 32,
						'reverse_top_level' => true,
						'reverse_childen'   => false,
						'format'            => current_theme_supports( 'html5', 'comment-list' ) ? 'html5' : 'xhtml',
						'short_ping'        => false,
						'echo'              => true,
					);
					$args = apply_filters( 'wp_list_comments_args', $args );
					wp_list_comments(
						$args,
						get_comments( array( 'post_id' => $post_id ) )
					);
					?>
				</ol>
			</div><!-- Comments-content -->
			<?php
		endwhile;
		$output = ob_get_clean();

		$root_path          = plugin_dir_path( __FILE__ );
		$autoload_file_path = $root_path . 'lib/vendor/autoload.php';
		$pdf_path           = $root_path . 'public/pdfs/';

		if ( file_exists( $autoload_file_path ) ) :
			include_once $autoload_file_path;
			$dompdf = new Dompdf\Dompdf();
			$dompdf->loadHtml( $output );
			$dompdf->setPaper( 'letter', 'portrait' );
			$dompdf->render();
			$pdf_output = $dompdf->output();

			$full_file_path = $pdf_path . $file_name . '.pdf';

			if ( ! is_dir( $pdf_path ) ) :
				mkdir( $pdf_path, 0777, true );
			endif;

			if ( file_exists( $full_file_path ) ) :
				unlink( $full_file_path );
			endif;

			if ( file_put_contents(
				$full_file_path,
				$pdf_output
			) ) :
				return plugin_dir_url( __FILE__ ) . 'public/pdfs/' . $file_name . '.pdf';
			endif;
		endif;
		return false;
	}
}

if ( ! function_exists( 'em_post_comments_callback' ) ) {
	/**
	 * Function to render single post comment in custom view.
	 *
	 * @since  1.0.0
	 * @access private
	 * @param  WP_Comment $comment The comment instance.
	 * @param  string     $args Im not sure what it contains.
	 * @param  int        $depth The comment post depth.
	 * @return void
	 */
	function em_post_comments_callback( $comment, $args, $depth ) {
		?>
		<div class="em-comments-single-comment-main-div" style="width:45%; float:left; margin:1%; padding:1%; border:solid 1px; position:relative;">
			<div class="em-comments-comment-author" style="text-align:center;">
				<b class="fn">
					<?php echo esc_attr( $comment->comment_author ); ?>
				</b>
			</div><!-- .comment-author -->
			<div class="em-comments-comment-content" style="text-align:center;">
				<p>
					<?php echo esc_attr( $comment->comment_content ); ?>
				</p>
			</div><!-- .comment-content -->
			<div class="em-comments-comment-metadata" style="text-align:center;">
				<small>
					<?php
					printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
					?>
				</small>
			</div><!-- .comment-metadata -->
			<div class="em-comments-comment-footer" style="text-align:center;">
				<img style="width: 50%;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJlNTk3ZDM4ZC1jY2JmLTQxMzAtODM1NS1iOTZkNzVhNmU5ZTgiIGRhdGEtbmFtZT0iT0JKRUNUUyIgdmlld0JveD0iMCAwIDE4OS44IDM1LjgiPjx0aXRsZT5pY29ub3NfZmllc3RhPC90aXRsZT48cGF0aCBkPSJNOTAuMywyM2E1Ni40LDU2LjQsMCwwLDAtMzguNi01LjdsLTgsMmgtLjJjLTMuMy0uOC04LjItMi44LTYuNy03LjIuMS0uMy0uNS0uNi0uNi0uMmgtLjFhNS44LDUuOCwwLDAsMCw0LjEsOC4zQTU1LDU1LDAsMCwxLDI5LjcsMjJhMjMuNSwyMy41LDAsMCwxLTExLjQtMS45QTEzLjUsMTMuNSwwLDAsMSwxNC4yLDE3YTcuOCw3LjgsMCwwLDEtMS44LTMuMiw0LjEsNC4xLDAsMCwxLS4zLTEuNmMwLTIuMy44LTEuOSwyLjYsMS4zLS4zLjMuMi44LjUuNSwyLjktMy0yLjEtNi41LTMuNC0zLjZzLjMsNC45LDEuNSw2LjVBMTQuMiwxNC4yLDAsMCwwLDIwLDIxLjVjNS4yLDEuOCwxMC44LDEuNCwxNi4yLjNoLjJBNDgsNDgsMCwwLDAsNTYsMjMuNmE0NC44LDQ0LjgsMCwwLDAsOC44LTJjMy42LTEuMSw3LTMsMTAuOS0zLjFhLjEuMSwwLDAsMCwuMS0uMSwzLjcsMy43LDAsMCwxLDMuNSwzLjMsMy44LDMuOCwwLDAsMSwuMSwxLjhjLTEuMywxLjEtMi40LjgtMy44LjJhMi41LDIuNSwwLDAsMC0xLjUtLjMsMS4zLDEuMywwLDAsMC0xLjMsMS4yYy0uMiwyLjcsMy41LDEuNyw0LjksMS40QTMuMSwzLjEsMCwwLDAsODAsMjMuOWMwLS4xLjEtLjIsMC0uM2E1LjMsNS4zLDAsMCwwLS4xLTIuNSw0LjgsNC44LDAsMCwwLTEuMy0yLjIsNTIuOSw1Mi45LDAsMCwxLDExLjMsNC43QzkwLjMsMjMuOCw5MC42LDIzLjIsOTAuMywyM1pNNzYuNSwyNS42YTQuNCw0LjQsMCwwLDEtMS41LjNsLjMtMS42LjQuMmE3LjQsNy40LDAsMCwwLDEuNC40LDMuMywzLjMsMCwwLDAsMS40LS4xQTQuNCw0LjQsMCwwLDEsNzYuNSwyNS42Wk02NC4xLDE2LjdhNjEuNCw2MS40LDAsMCwxLDEwLjUsMS4ybC0xLjMuMmMtNS40LDAtMTAuNiwxLTE2LDJhODEsODEsMCwwLDEtOS45LDEuMWMtMy4yLjEtNi40LS4xLTkuNi4zbDMuMi0uOEM0OC43LDE4LjgsNTYuMSwxNi42LDY0LjEsMTYuN1pNMzYuMiwxNS4yYy4xLjIuMS4zLjIuNGgtLjFBLjkuOSwwLDAsMSwzNi4yLDE1LjJabTMsMy4zYTIuNiwyLjYsMCwwLDEtLjktLjksMTIuMywxMi4zLDAsMCwwLDMuMiwxLjdBMTAuNSwxMC41LDAsMCwxLDM5LjIsMTguNVptLTEuNSwzYS4xLjEsMCwwLDAtLjEuMWguMVptMjAsMS4yYTQ5LjgsNDkuOCwwLDAsMS0xOS42LTFjNS45LS42LDExLjctLjEsMTcuNS0xLjFzMTAuOS0yLDE2LjQtMi4ybC00LjgsMS43QTQ2LjIsNDYuMiwwLDAsMSw1Ny43LDIyLjdaIj48L3BhdGg+PHBhdGggZD0iTTE3Ny45LDE0Yy4zLjMuNy0uMi40LS41LDEuOC0zLjIsMi42LTMuNiwyLjYtMS4zLS4xLjQtLjEuOC0uMiwxLjNhNy4xLDcuMSwwLDAsMS0xLjUsM0ExMS45LDExLjksMCwwLDEsMTc1LDIwYy0zLjUsMS44LTcuNywyLjItMTEuNywyYTU1LDU1LDAsMCwxLTEwLjUtMS44LDUuOCw1LjgsMCwwLDAsNC4xLTguM2gtLjFjLS4xLS40LS43LS4xLS42LjIsMS41LDQuNC0zLjQsNi40LTYuNyw3LjJoLS4ybC04LTJBNTYsNTYsMCwwLDAsMTAyLjgsMjNhLjMuMywwLDAsMCwuMy42LDUxLjcsNTEuNywwLDAsMSwxMS40LTQuNyw0LjEsNC4xLDAsMCwwLTEuMywyLjIsNC40LDQuNCwwLDAsMC0uMiwyLjUuNC40LDAsMCwwLC4xLjMsMy4xLDMuMSwwLDAsMCwyLjMsMi4xYzEuMy4zLDUsMS4zLDQuOC0xLjRhMS4zLDEuMywwLDAsMC0xLjMtMS4yLDIuNSwyLjUsMCwwLDAtMS4yLjJjLTEuNS42LTIuNywxLjEtNC4xLS4xYTYuNiw2LjYsMCwwLDEsMC0xLjQsNCw0LDAsMCwxLDMuNi0zLjcuMS4xLDAsMCwwLC4xLjFjMy44LDAsNywxLjksMTAuNSwzYTQ5LDQ5LDAsMCwwLDkuMiwyLjEsNDgsNDgsMCwwLDAsMTkuNi0xLjdoLjJhMzUuNSwzNS41LDAsMCwwLDEzLjQuNWM0LjgtMSwxMS4zLTQuMywxMS4zLTEwLjFTMTc0LjUsMTAuNSwxNzcuOSwxNFpNMTE1LjcsMjVsMS4zLS40Yy44LS4zLjctLjYuOS41cy4yLDEtLjQuN2wtLjktLjItMS43LS40YTIuOCwyLjgsMCwwLDEtLjgtLjZBNC4yLDQuMiwwLDAsMCwxMTUuNywyNVptNDEuMS05LjNoLS4yYS41LjUsMCwwLDAsLjItLjRabS0zLDIuOGExMC41LDEwLjUsMCwwLDEtMi4zLjgsMTQuOCwxNC44LDAsMCwwLDMuMy0xLjdBNC4xLDQuMSwwLDAsMSwxNTMuOCwxOC41Wk0xNDksMTkuOWMyLC41LDQuMSwxLjEsNi4yLDEuNS0zLjEtLjMtNi4xLS4xLTkuMS0uMmE2MC4yLDYwLjIsMCwwLDEtMTAuNC0xLjEsODYuNSw4Ni41LDAsMCwwLTE2LTJsLTEuMy0uMmE2My4yLDYzLjIsMCwwLDEsNy42LTEuMUMxMzMuOSwxNi4zLDE0MS40LDE3LjksMTQ5LDE5LjlabS0xMy43LDIuOGE0Ni4yLDQ2LjIsMCwwLDEtOS41LTIuNkwxMjEsMTguNGM1LjUuMiwxMC45LDEuNCwxNi40LDIuMnMxMS42LjUsMTcuNSwxLjFBNDkuNyw0OS43LDAsMCwxLDEzNS4zLDIyLjdabTIwLjEtMS4xYzAtLjEsMC0uMS0uMS0uMWguMVoiPjwvcGF0aD48L3N2Zz4=" />
			</div><!-- .comment-footer -->
		</div><!-- .comment-main-div -->
		<?php
	}
}
