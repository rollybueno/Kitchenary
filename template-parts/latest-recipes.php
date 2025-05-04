<?php
/**
 * Template part for displaying latest recipes
 *
 * @package Kitchenary
 */

// Get latest recipes
$latest_recipes = new WP_Query(
	array(
		'post_type'      => 'recipe',
		'posts_per_page' => 3,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

if ( $latest_recipes->have_posts() ) :
	?>
	<section class="py-12 bg-white fade-in">
		<div class="container mx-auto px-4">
			<div class="flex justify-between items-center mb-8">
				<h2 class="text-3xl font-bold"><?php esc_html_e( 'Latest Recipes', 'kitchenary' ); ?></h2>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'recipe' ) ); ?>" class="text-amber-600 hover:text-amber-700 font-medium transition">
					<?php esc_html_e( 'View All Recipes', 'kitchenary' ); ?>
					<i class="fas fa-arrow-right ml-2"></i>
				</a>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php
				while ( $latest_recipes->have_posts() ) :
					$latest_recipes->the_post();
					?>
					<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
						<a href="<?php the_permalink(); ?>" class="block">
							<?php
							if ( has_post_thumbnail() ) :
								?>
								<div class="overflow-hidden">
									<?php
									the_post_thumbnail(
										'medium_large',
										array(
											'class' => 'w-full h-64 object-cover transition duration-300 group-hover:scale-105',
										)
									);
									?>
								</div>
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
								<h3 class="text-xl font-bold mb-2 group-hover:text-amber-600 transition">
									<?php the_title(); ?>
								</h3>
								<div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
									<div class="flex items-center gap-1">
										<i class="fas fa-clock"></i>
										<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_cooking_time', true ) ); ?>
									</div>
									<div class="flex items-center gap-1">
										<i class="fas fa-utensils"></i>
										<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_servings', true ) ); ?>
									</div>
								</div>
								<div class="text-gray-600 line-clamp-2">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</a>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<?php
endif; 