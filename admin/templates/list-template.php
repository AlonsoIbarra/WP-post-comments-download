<?php
/**
 * Provide a admin-facing view for the plugin.
 *
 * @link  https://https://fiesta.lezlynorman.com
 * @since 1.0.0
 *
 * @package includes
 */

?>
<div class="wrap">
	<h1> <?php echo esc_html( get_admin_page_title() ); ?></h1>
</div>

<?php if ( $result->have_posts() ) : ?>
	<div class="wrap">
		<h1>
			<strong>
				<?php echo esc_attr( __( 'Entries list', 'event-memories' ) ); ?>
			</strong>
		</h1>
	</div>
	<Table class="table">
		<thead>
			<tr>
				<th>
					<?php echo esc_attr( __( 'Entry ID', 'event-memories' ) ); ?>
				</th>
				<th>
					<?php echo esc_attr( __( 'Entry name', 'event-memories' ) ); ?>
				</th>
				<th>
					<?php echo esc_attr( __( 'Token', 'event-memories' ) ); ?>
				</th>
				<th>
					<?php echo esc_attr( __( 'Options', 'event-memories' ) ); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php while ( $result->have_posts() ) : ?>
				<?php $result->the_post(); ?>
				<?php
				$post_url = add_query_arg(
					array(
						'post'   => get_the_ID(),
						'action' => 'edit',
					),
					admin_url( 'post.php' )
				);
				?>

				<tr>
					<td>
						<?php echo esc_attr( get_the_ID() ); ?>
					</td>
					<td>
						<a href="<?php echo esc_url( $post_url ); ?>" target="_blank">
							<?php the_title(); ?>
						</a>
					</td>
					<td>
						<input type="hidden" id="em_btn_clipboard_value_<?php echo esc_attr( get_the_ID() ); ?>" value="<?php echo esc_attr( base64_encode( get_the_ID() ) ); ?>">
						<?php echo esc_attr( base64_encode( get_the_ID() ) ); ?>
					</td>
					<td>
						<button class="btn em_btn_clipboard_copy" data-id="<?php echo esc_attr( get_the_ID() ); ?>">
							<?php echo esc_attr( __( 'Copy', 'event-memories' ) ); ?>
						</button>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</Table>
<?php endif;
wp_reset_postdata(); ?>
