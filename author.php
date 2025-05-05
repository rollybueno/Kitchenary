<?php
/**
 * The template for displaying author archive pages
 *
 * @package Kitchenary
 */

get_header();
?>

<main class="py-16 bg-gray-50">
	<div class="container mx-auto px-4">
		<div class="flex flex-col lg:flex-row gap-8">
			<!-- Main Content -->
			<div class="<?php echo is_active_sidebar( 'blog-sidebar' ) ? 'lg:w-2/3' : 'lg:w-full max-w-4xl mx-auto'; ?>">
				<!-- Author Header -->
				<div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
					<div class="p-8">
						<div class="flex flex-col md:flex-row items-center md:items-start gap-6">
							<div class="w-32 h-32 rounded-full overflow-hidden bg-amber-100 flex items-center justify-center">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 128, '', '', array( 'class' => 'w-full h-full object-cover' ) ); ?>
							</div>
							<div class="text-center md:text-left">
								<h1 class="text-3xl font-bold text-gray-800 mb-2"><?php the_author(); ?></h1>
								<?php if ( get_the_author_meta( 'description' ) ) : ?>
									<p class="text-gray-600 mb-4"><?php the_author_meta( 'description' ); ?></p>
								<?php endif; ?>
								<div class="flex flex-wrap justify-center md:justify-start gap-4 text-sm text-gray-600">
									<?php if ( get_the_author_meta( 'user_url' ) ) : ?>
										<a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>" 
										   class="flex items-center hover:text-amber-500 transition">
											<i class="fas fa-globe mr-2"></i>
											<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>
										</a>
									<?php endif; ?>
									<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
										<a href="<?php echo esc_url( get_the_author_meta( 'twitter' ) ); ?>" 
										   class="flex items-center hover:text-amber-500 transition">
											<i class="fab fa-twitter mr-2"></i>
											<?php echo esc_html( get_the_author_meta( 'twitter' ) ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Author Posts -->
				<?php if ( have_posts() ) : ?>
					<?php
					// Group posts by type
					$recipes = array();
					$regular_posts = array();
					
					while ( have_posts() ) {
						the_post();
						if ( get_post_type() === 'recipe' ) {
							$recipes[] = get_the_ID();
						} else {
							$regular_posts[] = get_the_ID();
						}
					}
					
					// Reset the post data
					wp_reset_postdata();
					
					// Display Recipes Section
					if ( !empty($recipes) ) : ?>
						<div class="mb-12">
							<h2 class="text-2xl font-bold text-gray-800 mb-6"><?php esc_html_e('Recipes', 'kitchenary'); ?></h2>
							<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
								<?php foreach ( $recipes as $recipe_id ) : 
									$post = get_post($recipe_id);
									setup_postdata($post);
								?>
									<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
										<div class="relative">
											<a href="<?php the_permalink(); ?>" class="block">
												<div class="overflow-hidden">
													<?php if ( has_post_thumbnail() ) : ?>
														<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-64 object-cover transition duration-300 group-hover:scale-105' ) ); ?>
													<?php else : ?>
														<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/dan-gold-4_jhDO54BYg-unsplash.jpg" 
															 alt="<?php esc_attr_e('Recipe Placeholder', 'kitchenary'); ?>"
															 class="w-full h-64 object-cover transition duration-300 group-hover:scale-105">
													<?php endif; ?>
												</div>
											</a>
											<div class="absolute top-4 left-4">
												<?php
												$categories = get_the_category();
												if ( $categories ) :
													?>
													<div class="flex flex-wrap gap-2">
														<?php foreach ( $categories as $category ) : ?>
															<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
															   class="bg-white/90 text-amber-600 hover:bg-white hover:text-amber-700 px-3 py-1 rounded-full text-sm font-medium transition">
																<?php echo esc_html( $category->name ); ?>
															</a>
														<?php endforeach; ?>
													</div>
												<?php endif; ?>
											</div>
										</div>

										<div class="p-6">
											<!-- Recipe Rating -->
											<div class="flex items-center gap-2 mb-3">
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
											<div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
												<div class="flex items-center gap-1">
													<i class="fas fa-clock"></i>
													<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_cooking_time', true ) ); ?>
												</div>
												<div class="flex items-center gap-1">
													<i class="fas fa-utensils"></i>
													<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_servings', true ) ); ?>
												</div>
												<div class="flex items-center gap-1">
													<i class="fas fa-fire"></i>
													<?php echo esc_html( get_post_meta( get_the_ID(), 'recipe_difficulty', true ) ); ?>
												</div>
											</div>

											<!-- Post Title -->
											<h2 class="text-xl font-bold mb-3 group-hover:text-amber-600 transition">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h2>

											<!-- Post Excerpt -->
											<div class="text-gray-600 line-clamp-2 mb-4">
												<?php the_excerpt(); ?>
											</div>

											<!-- Read More Link -->
											<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium transition">
												<?php esc_html_e('View Recipe', 'kitchenary'); ?>
												<i class="fas fa-arrow-right ml-2"></i>
											</a>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<!-- Display Regular Posts Section -->
					<?php if ( !empty($regular_posts) ) : ?>
						<div class="mb-12">
							<h2 class="text-2xl font-bold text-gray-800 mb-6"><?php esc_html_e('Blog Posts', 'kitchenary'); ?></h2>
							<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
								<?php foreach ( $regular_posts as $post_id ) : 
									$post = get_post($post_id);
									setup_postdata($post);
								?>
									<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
										<div class="relative">
											<a href="<?php the_permalink(); ?>" class="block">
												<div class="overflow-hidden">
													<?php if ( has_post_thumbnail() ) : ?>
														<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-64 object-cover transition duration-300 group-hover:scale-105' ) ); ?>
													<?php else : ?>
														<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/dan-gold-4_jhDO54BYg-unsplash.jpg" 
															 alt="<?php esc_attr_e('Blog Post Placeholder', 'kitchenary'); ?>"
															 class="w-full h-64 object-cover transition duration-300 group-hover:scale-105">
													<?php endif; ?>
												</div>
											</a>
											<div class="absolute top-4 left-4">
												<?php
												$categories = get_the_category();
												if ( $categories ) :
													?>
													<div class="flex flex-wrap gap-2">
														<?php foreach ( $categories as $category ) : ?>
															<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
															   class="bg-white/90 text-amber-600 hover:bg-white hover:text-amber-700 px-3 py-1 rounded-full text-sm font-medium transition">
																<?php echo esc_html( $category->name ); ?>
															</a>
														<?php endforeach; ?>
													</div>
												<?php endif; ?>
											</div>
										</div>

										<div class="p-6">
											<!-- Post Meta -->
											<div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
												<span class="flex items-center">
													<i class="far fa-clock mr-2"></i>
													<?php echo get_the_date(); ?>
												</span>
												<?php if ( get_comments_number() > 0 ) : ?>
													<span class="flex items-center">
														<i class="far fa-comment mr-2"></i>
														<?php comments_number( 'No comments', '1 comment', '% comments' ); ?>
													</span>
												<?php endif; ?>
											</div>

											<!-- Post Title -->
											<h2 class="text-xl font-bold mb-3 group-hover:text-amber-600 transition">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h2>

											<!-- Post Excerpt -->
											<div class="text-gray-600 line-clamp-2 mb-4">
												<?php the_excerpt(); ?>
											</div>

											<!-- Read More Link -->
											<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium transition">
												<?php esc_html_e('Read More', 'kitchenary'); ?>
												<i class="fas fa-arrow-right ml-2"></i>
											</a>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<!-- Pagination -->
					<div class="mt-12">
						<?php
						the_posts_pagination(
							array(
								'mid_size'           => 2,
								'prev_text'          => '<i class="fas fa-chevron-left"></i> Previous',
								'next_text'          => 'Next <i class="fas fa-chevron-right"></i>',
								'class'              => 'flex justify-center gap-2',
								'before_page_number' => '<span class="px-4 py-2 bg-white rounded-lg shadow-sm hover:bg-amber-50 transition">',
								'after_page_number'  => '</span>',
							)
						);
						?>
					</div>

				<?php else : ?>
					<div class="bg-white rounded-xl shadow-md p-8 text-center">
						<h2 class="text-2xl font-bold text-gray-800 mb-4">No Posts Found</h2>
						<p class="text-gray-600">This author hasn't published any posts yet.</p>
					</div>
				<?php endif; ?>
			</div>

			<!-- Sidebar -->
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
				<div class="lg:w-1/3">
					<div class="sticky top-8">
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php
get_footer();
