<?php
/**
 * Template part for displaying featured recipe
 *
 * @package Kitchenary
 */

// Get featured recipe with optimized query
$featured_recipe = new WP_Query(
	array(
		'post_type'              => 'recipe',
		'posts_per_page'         => 1,
	)
);

if ( $featured_recipe->have_posts() ) :
	while ( $featured_recipe->have_posts() ) :
		$featured_recipe->the_post();
		$post_id = get_the_ID();

		// Get all meta values in one query
		$meta_values = array(
			'rating'       => get_post_meta( $post_id, 'recipe_rating', true ),
			'reviews'      => get_post_meta( $post_id, 'recipe_reviews', true ),
			'cooking_time' => get_post_meta( $post_id, 'recipe_cooking_time', true ),
			'servings'     => get_post_meta( $post_id, 'recipe_servings', true ),
			'difficulty'   => get_post_meta( $post_id, 'recipe_difficulty', true ),
		);
		?>
		<section class="py-16 fade-in">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
					<div class="relative">
						<?php
						if ( has_post_thumbnail() ) :
							?>
							<div class="rounded-2xl overflow-hidden shadow-lg">
								<?php
								the_post_thumbnail(
									'full',
									array(
										'class'   => 'w-full h-auto',
										'loading' => 'eager', // Load image immediately
									)
								);
								?>
							</div>
							<div class="absolute -bottom-6 -right-6 bg-white rounded-xl shadow-lg p-4">
								<div class="flex items-center gap-2">
									<div class="flex text-amber-500">
										<?php
										$rating = $meta_values['rating'] ?: 5;
										for ( $i = 1; $i <= 5; $i++ ) :
											?>
											<i class="fas fa-star <?php echo $i <= $rating ? 'text-amber-500' : 'text-gray-300'; ?>"></i>
											<?php
										endfor;
										?>
									</div>
									<span class="text-sm text-gray-600">(<?php echo esc_html( $meta_values['reviews'] ? $meta_values['reviews'] : '0' ); ?> reviews)</span>
								</div>
							</div>
							<?php
						endif;
						?>
					</div>

					<div class="lg:pl-8">
						<?php
						$categories = get_the_terms( $post_id, 'recipe_category' );
						if ( $categories && ! is_wp_error( $categories ) ) :
							?>
							<div class="flex flex-wrap gap-2 mb-4">
								<?php
								foreach ( $categories as $category ) :
									?>
									<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="bg-white text-amber-600 hover:bg-amber-100 hover:text-amber-700 px-4 py-2 rounded-full text-sm font-medium transition">
										<?php echo esc_html( $category->name ); ?>
									</a>
									<?php
								endforeach;
								?>
							</div>
							<?php
						endif;
						?>

						<h2 class="text-4xl font-bold mb-4">
							<a href="<?php the_permalink(); ?>" class="hover:text-amber-600 transition">
								<?php the_title(); ?>
							</a>
						</h2>

						<div class="flex items-center gap-6 text-gray-600 mb-6">
							<div class="flex items-center gap-2">
								<i class="fas fa-clock"></i>
								<?php echo esc_html( $meta_values['cooking_time'] ); ?>
							</div>
							<div class="flex items-center gap-2">
								<i class="fas fa-utensils"></i>
								<?php echo esc_html( $meta_values['servings'] ); ?>
							</div>
							<div class="flex items-center gap-2">
								<i class="fas fa-fire"></i>
								<?php echo esc_html( $meta_values['difficulty'] ); ?>
							</div>
						</div>

						<div class="prose max-w-none mb-8">
							<?php the_excerpt(); ?>
						</div>

						<div class="flex flex-wrap gap-4">
							<a href="<?php the_permalink(); ?>" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-full font-medium transition">
								<?php esc_html_e( 'View Recipe', 'kitchenary' ); ?>
							</a>
							<a href="#" class="bg-white hover:bg-amber-100 text-amber-600 px-6 py-3 rounded-full font-medium transition">
								<i class="fas fa-bookmark mr-2"></i>
								<?php esc_html_e( 'Save Recipe', 'kitchenary' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	endwhile;
	wp_reset_postdata();
endif;
