<?php
/**
 * The template for displaying recipe archives
 *
 * @package Kitchenary
 */

get_header();
?>

<main id="primary" class="site-main">
	<header class="page-header py-12 bg-amber-50">
		<div class="container mx-auto px-4">
			<h1 class="page-title text-4xl font-bold text-center mb-4"><?php post_type_archive_title(); ?></h1>
			<?php
			$description = get_the_archive_description();
			if ( $description ) :
				?>
				<div class="archive-description text-center text-gray-600 max-w-2xl mx-auto">
					<?php echo wp_kses_post( $description ); ?>
				</div>
				<?php
			endif;
			?>
		</div>
	</header>

	<div class="container mx-auto px-4 py-12">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition' ); ?>>
						<?php
						if ( has_post_thumbnail() ) :
							?>
							<a href="<?php the_permalink(); ?>" class="block">
								<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-48 object-cover' ) ); ?>
							</a>
							<?php
						endif;
						?>
						<div class="p-6">
							<?php
							$categories = get_the_terms( get_the_ID(), 'recipe_category' );
							if ( $categories && ! is_wp_error( $categories ) ) :
								?>
								<div class="mb-2">
									<?php
									$category_links = array();
									foreach ( $categories as $category ) {
										$category_links[] = '<a href="' . esc_url( get_term_link( $category ) ) . '" class="text-amber-600 hover:text-amber-700 text-sm">' . esc_html( $category->name ) . '</a>';
									}
									echo implode( ', ', $category_links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									?>
								</div>
								<?php
							endif;
							?>
							<h2 class="entry-title text-xl font-bold mb-2">
								<a href="<?php the_permalink(); ?>" class="hover:text-amber-600 transition">
									<?php the_title(); ?>
								</a>
							</h2>
							<div class="entry-meta flex items-center gap-4 text-sm text-gray-600 mb-4">
								<div class="flex items-center gap-1">
									<i class="fas fa-clock"></i>
									<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_cooking_time', true ) ); ?>
								</div>
								<div class="flex items-center gap-1">
									<i class="fas fa-utensils"></i>
									<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_servings', true ) ); ?>
								</div>
							</div>
							<div class="entry-summary text-gray-600">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</article>
					<?php
				endwhile;

				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => __( 'Previous', 'kitchenary' ),
						'next_text' => __( 'Next', 'kitchenary' ),
					)
				);

			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>
</main>

<?php
get_footer(); 