<?php
/**
 * The template for displaying single recipe posts
 *
 * @package Kitchenary
 */

get_header();
?>

<main class="py-16 bg-gray-50">
	<div class="container mx-auto px-4">
		<div class="flex flex-col lg:flex-row gap-8">
			<!-- Main Content -->
			<div class="<?php echo is_active_sidebar('recipe-sidebar') ? 'lg:w-2/3' : 'lg:w-full max-w-4xl mx-auto'; ?>">
				<?php while (have_posts()) : the_post(); ?>
					<article class="bg-white rounded-xl shadow-md overflow-hidden">
						<!-- Featured Image -->
						<?php if (has_post_thumbnail()) : ?>
							<div class="relative">
								<?php the_post_thumbnail('full', ['class' => 'w-full h-[400px] object-cover']); ?>
								<!-- Category Badge -->
								<?php
								$categories = get_the_terms(get_the_ID(), 'recipe_category');
								if ($categories && !is_wp_error($categories)) :
									$category = $categories[0];
									?>
									<div class="absolute top-4 left-4">
										<span class="bg-amber-100 text-amber-800 text-sm font-medium px-3 py-1 rounded-full">
											<?php echo esc_html($category->name); ?>
										</span>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<div class="p-8">
							<!-- Recipe Header -->
							<div class="mb-8">
								<h1 class="text-4xl font-bold text-gray-800 mb-4"><?php the_title(); ?></h1>
								
								<!-- Recipe Rating -->
								<div class="flex items-center gap-2 mb-4">
									<div class="flex text-amber-500">
										<?php
										$rating = get_post_meta( get_the_ID(), 'recipe_rating', true );
										$rating = $rating ? $rating : 5; // Default to 5 stars if no rating.
										for ( $i = 1; $i <= 5; $i++ ) :
											?>
											<i class="fas fa-star <?php echo $i <= $rating ? 'text-amber-500' : 'text-gray-300'; ?>"></i>
										<?php endfor; ?>
									</div>
									<span class="text-sm text-gray-600">(<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_reviews', true ) ?: '0' ); ?> reviews)</span>
								</div>

								<!-- Recipe Meta -->
								<div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
									<span class="flex items-center">
										<i class="far fa-clock mr-2"></i>
										<?php echo get_the_date(); ?>
									</span>
									<span class="flex items-center">
										<i class="far fa-user mr-2"></i>
										<?php the_author(); ?>
									</span>
									<?php if (get_comments_number() > 0) : ?>
										<span class="flex items-center">
											<i class="far fa-comment mr-2"></i>
											<?php comments_number('No comments', '1 comment', '% comments'); ?>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<!-- Recipe Content -->
							<div class="entry-content prose prose-lg max-w-none mb-8">
								<?php the_content(); ?>
							</div>

							<!-- Recipe Tags -->
							<?php
							$tags = get_the_terms(get_the_ID(), 'recipe_tag');
							if ($tags && !is_wp_error($tags)) : ?>
								<div class="mb-8">
									<h3 class="text-lg font-semibold text-gray-800 mb-3">Tags</h3>
									<div class="flex flex-wrap gap-2">
										<?php foreach ($tags as $tag) : ?>
											<a href="<?php echo esc_url(get_term_link($tag)); ?>" 
											   class="bg-gray-100 text-gray-700 hover:bg-amber-100 hover:text-amber-800 px-3 py-1 rounded-full text-sm transition">
												<?php echo esc_html($tag->name); ?>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>

							<!-- Author Bio -->
							<div class="border-t border-gray-200 pt-8 mt-8">
								<div class="flex items-start gap-4">
									<div class="w-16 h-16 rounded-full overflow-hidden bg-amber-100 flex items-center justify-center">
										<?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'w-full h-full object-cover']); ?>
									</div>
									<div>
										<h3 class="text-lg font-semibold text-gray-800 mb-1"><?php the_author(); ?></h3>
										<p class="text-gray-600 mb-2"><?php the_author_meta('description'); ?></p>
										<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
										   class="text-amber-600 hover:text-amber-700 font-medium">
											View all recipes by <?php the_author(); ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</article>

					<?php get_template_part( 'template-parts/recipe-reviews' ); ?>

					<!-- Related Recipes -->
					<?php
					$categories = get_the_terms(get_the_ID(), 'recipe_category');
					if ($categories && !is_wp_error($categories)) :
						$category_ids = array();
						foreach ($categories as $category) {
							$category_ids[] = $category->term_id;
						}

						$related_args = array(
							'post_type'      => 'recipe',
							'posts_per_page' => 3,
							'post__not_in'   => array(get_the_ID()),
							'tax_query'      => array(
								array(
									'taxonomy' => 'recipe_category',
									'field'    => 'term_id',
									'terms'    => $category_ids,
								),
							),
						);

						$related_query = new WP_Query($related_args);

						if ($related_query->have_posts()) : ?>
							<div class="mt-16">
								<h2 class="text-2xl font-bold text-gray-800 mb-8">Related Recipes</h2>
								<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
									<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
										<article class="recipe-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition">
											<?php if (has_post_thumbnail()) : ?>
												<div class="overflow-hidden">
													<?php the_post_thumbnail('medium_large', ['class' => 'recipe-image w-full h-48 object-cover']); ?>
												</div>
											<?php endif; ?>
											<div class="p-4">
												<h3 class="text-lg font-bold mb-2">
													<a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-amber-600 transition">
														<?php the_title(); ?>
													</a>
												</h3>
												<p class="text-gray-600 text-sm mb-3">
													<?php echo wp_trim_words(get_the_excerpt(), 15); ?>
												</p>
												<a href="<?php the_permalink(); ?>" class="text-amber-600 hover:text-amber-700 text-sm font-medium">
													Read Recipe <i class="fas fa-arrow-right ml-1"></i>
												</a>
											</div>
										</article>
									<?php endwhile; ?>
								</div>
							</div>
						<?php
						endif;
						wp_reset_postdata();
					endif;
					?>

					<!-- Comments Section -->
					<?php
					if (comments_open() || get_comments_number()) :
						?>
						<div class="mt-16">
							<?php comments_template(); ?>
						</div>
						<?php
					endif;
					?>

				<?php endwhile; ?>
			</div>

			<!-- Sidebar -->
			<?php if (is_active_sidebar('recipe-sidebar')) : ?>
				<div class="lg:w-1/3">
					<div class="sticky top-8">
						<?php dynamic_sidebar('recipe-sidebar'); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php
get_footer(); 