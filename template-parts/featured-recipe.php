<?php
/**
 * Template part for displaying featured recipe.
 *
 * @package Kitchenary
 */

// Get featured recipe with optimized query.
$featured_recipe = new WP_Query(
	array(
		'post_type'              => 'recipe',
		'posts_per_page'         => 1,
	)
);

if ( $featured_recipe->have_posts() ) :
	while ( $featured_recipe->have_posts() ) :
		$featured_recipe->the_post();
		$current_post_id = get_the_ID();
		
		// Get all meta values in one query.
		$meta_values = array(
			'prep_time'    => get_post_meta( $current_post_id, 'recipe_prep_time', true ),
			'cook_time'    => get_post_meta( $current_post_id, 'recipe_cooking_time', true ),
			'servings'     => get_post_meta( $current_post_id, 'recipe_servings', true ),
			'calories'     => get_post_meta( $current_post_id, 'recipe_calories', true ),
		);
		?>
		<section class="py-16 bg-white fade-in">
			<div class="container mx-auto px-4">
				<div class="bg-amber-50 rounded-2xl overflow-hidden shadow-lg">
					<div class="md:flex">
						<div class="md:w-1/2">
							<?php
							if ( has_post_thumbnail() ) :
								?>
								<?php
								the_post_thumbnail(
									'full',
									array(
										'class'   => 'w-full h-full object-cover',
										'loading' => 'eager',
									)
								);
								?>
								<?php
							endif;
							?>
						</div>
						<div class="md:w-1/2 p-8 md:p-12">
							<div class="flex items-center mb-4">
								<span class="bg-amber-600 text-white text-xs font-medium px-2.5 py-0.5 rounded mr-2">Featured</span>
								<?php
								$categories = get_the_terms( $current_post_id, 'recipe_category' );
								if ( $categories && ! is_wp_error( $categories ) ) :
									foreach ( $categories as $category ) :
										?>
										<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
											<?php echo esc_html( $category->name ); ?>
										</span>
										<?php
										break; // Only show first category
									endforeach;
								endif;
								?>
							</div>

							<h2 class="text-3xl font-bold mb-4">
								<?php the_title(); ?>
							</h2>

							<div class="text-gray-600 mb-6">
								<?php the_excerpt(); ?>
							</div>

							<div class="grid grid-cols-2 gap-4 mb-8">
								<div>
									<p class="text-gray-500 text-sm">Prep Time</p>
									<p class="font-medium"><?php echo esc_html( $meta_values['prep_time'] ); ?></p>
								</div>
								<div>
									<p class="text-gray-500 text-sm">Cook Time</p>
									<p class="font-medium"><?php echo esc_html( $meta_values['cook_time'] ); ?></p>
								</div>
								<div>
									<p class="text-gray-500 text-sm">Servings</p>
									<p class="font-medium"><?php echo esc_html( $meta_values['servings'] ); ?></p>
								</div>
								<div>
									<p class="text-gray-500 text-sm">Calories</p>
									<p class="font-medium"><?php echo esc_html( $meta_values['calories'] ); ?>/serving</p>
								</div>
							</div>

							<a href="<?php the_permalink(); ?>" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-full font-medium transition w-full md:w-auto inline-block text-center">
								<?php esc_html_e( 'View Full Recipe', 'kitchenary' ); ?>
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
