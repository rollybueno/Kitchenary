<?php
/**
 * The template for displaying single recipe posts
 *
 * @package Kitchenary
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto px-4 py-12' ); ?>>
			<header class="entry-header mb-8">
				<?php
				if ( has_post_thumbnail() ) :
					?>
					<div class="mb-6 rounded-xl overflow-hidden">
						<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
					</div>
					<?php
				endif;
				?>
				<h1 class="entry-title text-4xl font-bold mb-4"><?php the_title(); ?></h1>
				<div class="entry-meta flex items-center gap-4 text-gray-600">
					<?php
					$categories = get_the_terms( get_the_ID(), 'recipe_category' );
					if ( $categories && ! is_wp_error( $categories ) ) :
						?>
						<div class="flex items-center gap-2">
							<i class="fas fa-tag"></i>
							<?php
							$category_links = array();
							foreach ( $categories as $category ) {
								$category_links[] = '<a href="' . esc_url( get_term_link( $category ) ) . '" class="hover:text-amber-600 transition">' . esc_html( $category->name ) . '</a>';
							}
							echo implode( ', ', $category_links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</div>
						<?php
					endif;
					?>
					<div class="flex items-center gap-2">
						<i class="fas fa-clock"></i>
						<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_cooking_time', true ) ); ?>
					</div>
					<div class="flex items-center gap-2">
						<i class="fas fa-utensils"></i>
						<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_servings', true ) ); ?>
					</div>
				</div>
			</header>

			<div class="entry-content prose max-w-none">
				<div class="mb-8">
					<h2 class="text-2xl font-bold mb-4"><?php esc_html_e( 'Description', 'kitchenary' ); ?></h2>
					<?php the_excerpt(); ?>
				</div>

				<div class="mb-8">
					<h2 class="text-2xl font-bold mb-4"><?php esc_html_e( 'Ingredients', 'kitchenary' ); ?></h2>
					<?php
					$ingredients = get_post_meta( get_the_ID(), 'recipe_ingredients', true );
					if ( $ingredients ) :
						?>
						<ul class="list-disc pl-6">
							<?php
							foreach ( $ingredients as $ingredient ) :
								?>
								<li><?php echo esc_html( $ingredient ); ?></li>
								<?php
							endforeach;
							?>
						</ul>
						<?php
					endif;
					?>
				</div>

				<div class="mb-8">
					<h2 class="text-2xl font-bold mb-4"><?php esc_html_e( 'Instructions', 'kitchenary' ); ?></h2>
					<?php
					$instructions = get_post_meta( get_the_ID(), 'recipe_instructions', true );
					if ( $instructions ) :
						?>
						<ol class="list-decimal pl-6">
							<?php
							foreach ( $instructions as $instruction ) :
								?>
								<li class="mb-2"><?php echo esc_html( $instruction ); ?></li>
								<?php
							endforeach;
							?>
						</ol>
						<?php
					endif;
					?>
				</div>

				<?php
				the_content();
				?>
			</div>

			<footer class="entry-footer mt-8 pt-8 border-t">
				<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'kitchenary' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer>
		</article>
		<?php
	endwhile;
	?>
</main>

<?php
get_footer(); 