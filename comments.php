<?php
/**
 * The template for displaying comments
 *
 * @package Kitchenary
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-16">
	<?php if ( have_comments() ) : ?>
		<div class="bg-white rounded-xl shadow-md p-8">
			<h2 class="text-2xl font-bold text-gray-800 mb-8">
				<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					printf(
						/* translators: %s: Post title. */
						esc_html__( 'One comment on &ldquo;%s&rdquo;', 'kitchenary' ),
						'<span>' . esc_html( get_the_title() ) . '</span>'
					);
				} else {
					printf(
						/* translators: 1: Number of comments, 2: Post title. */
						esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'kitchenary' ) ),
						number_format_i18n( $comments_number ),
						'<span>' . esc_html( get_the_title() ) . '</span>'
					);
				}
				?>
			</h2>

			<ol class="comment-list space-y-8">
				<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 60,
						'callback'    => 'kitchenary_comment_callback',
					)
				);
				?>
			</ol>

			<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				?>
				<nav class="comment-navigation flex justify-between items-center mt-8 pt-8 border-t border-gray-200">
					<div class="nav-previous">
						<?php previous_comments_link( '<i class="fas fa-arrow-left mr-2"></i>' . esc_html__( 'Older Comments', 'kitchenary' ) ); ?>
					</div>
					<div class="nav-next">
						<?php next_comments_link( esc_html__( 'Newer Comments', 'kitchenary' ) . '<i class="fas fa-arrow-right ml-2"></i>' ); ?>
					</div>
				</nav>
			<?php endif; ?>

			<?php
			// If comments are closed and there are comments, let's leave a little note.
			if ( ! comments_open() ) :
				?>
				<p class="no-comments text-gray-600 mt-8"><?php esc_html_e( 'Comments are closed.', 'kitchenary' ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'          => esc_html__( 'Leave a Comment', 'kitchenary' ),
			'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title text-2xl font-bold text-gray-800 mb-6">',
			'title_reply_after'    => '</h3>',
			'class_submit'         => 'bg-amber-600 hover:bg-amber-700 text-white font-medium py-2 px-6 rounded-lg transition',
			'comment_field'        => '<div class="comment-form-comment mb-6">
				<label for="comment" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__( 'Comment', 'kitchenary' ) . '</label>
				<textarea id="comment" name="comment" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" rows="6" required></textarea>
			</div>',
			'comment_notes_before' => '<p class="comment-notes text-sm text-gray-600 mb-6">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'kitchenary' ) . '</p>',
			'fields'               => array(
				'author' => '<div class="comment-form-author mb-6">
					<label for="author" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__( 'Name', 'kitchenary' ) . ' <span class="required">*</span></label>
					<input id="author" name="author" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" required />
				</div>',
				'email'  => '<div class="comment-form-email mb-6">
					<label for="email" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__( 'Email', 'kitchenary' ) . ' <span class="required">*</span></label>
					<input id="email" name="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" required />
				</div>',
				'url'    => '<div class="comment-form-url mb-6">
					<label for="url" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__( 'Website', 'kitchenary' ) . '</label>
					<input id="url" name="url" type="url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500" />
				</div>',
			),
		)
	);
	?>
</div>

<?php
/**
 * Custom comment callback function
 *
 * @param WP_Comment $comment The comment object.
 * @param array      $args    An array of arguments.
 * @param int        $depth   Depth of the comment.
 */
function kitchenary_comment_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment' ); ?>>
		<article class="comment-body">
			<div class="flex gap-4">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 60, '', '', array( 'class' => 'rounded-full' ) ); ?>
				</div>

				<div class="comment-content">
					<div class="comment-metadata mb-2">
						<cite class="fn font-medium text-gray-800"><?php comment_author_link(); ?></cite>
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="text-sm text-gray-500 ml-2">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
								printf(
									/* translators: 1: Comment date, 2: Comment time. */
									esc_html__( '%1$s at %2$s', 'kitchenary' ),
									get_comment_date(),
									get_comment_time()
								);
								?>
							</time>
						</a>
						<?php edit_comment_link( esc_html__( 'Edit', 'kitchenary' ), '<span class="edit-link text-sm text-gray-500 ml-2">', '</span>' ); ?>
					</div>

					<?php if ( '0' === $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation text-amber-600 text-sm"><?php esc_html_e( 'Your comment is awaiting moderation.', 'kitchenary' ); ?></p>
					<?php endif; ?>

					<div class="comment-text prose prose-sm max-w-none">
						<?php comment_text(); ?>
					</div>

					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="reply mt-2">',
								'after'     => '</div>',
								'class'     => 'text-sm text-amber-600 hover:text-amber-700 font-medium',
							)
						)
					);
					?>
				</div>
			</div>
		</article>
	<?php
} 