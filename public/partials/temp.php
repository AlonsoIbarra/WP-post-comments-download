<?php

$args = array(
	'post_type' => 'post',
	'p'         => $post_id,
);
$query = new WP_Query( $args );

while ( $query->have_posts() ) :
	$comments = get_comments(
		array(
			'post_id' => get_the_ID(),
			'order' => 'ASC',
		)
	);

	foreach ( $comments as $comment ) :
		?>
		<section id="comments" class="comments-area">
			<ol class="comment-list">
				<li id="comment-3" class="comment even thread-even depth-1 parent">
					<article id="div-comment-3" class="comment-body">
						<footer class="comment-meta">
							<div class="comment-author vcard">
								<b class="fn">
									<?php echo esc_attr( $comment->comment_author ); ?>
								</b>
								<span class="says">dice:</span>
							</div><!-- .comment-author -->
							<div class="comment-metadata">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
									/* translators: 1: Comment date, 2: Comment time. */
									// echo esc_html__( '%1$s at %2$s', 'elementor-pro' ), get_comment_date( '', $comment ), get_comment_time() );
									echo  get_comment_date( '', $comment );
									echo  get_comment_time();
									?>
								</time>
							</div><!-- .comment-metadata -->
						</footer><!-- .comment-meta -->
						<div class="comment-content">
							<p>
								<?php echo esc_attr( $comment->comment_content ); ?>
							</p>
						</div><!-- .comment-content -->
					</article><!-- .comment-body -->

				</li><!-- #comment-## -->
			</ol><!-- .comment-list -->
		</section>
		<?php
	endforeach;
endwhile;