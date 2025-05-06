<?php
/**
 * Template part for displaying latest blog posts
 *
 * @package Kitchenary
 */

// Get latest posts.
$latest_posts = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

if ( $latest_posts->have_posts() ) :
	?>
	<section class="py-12 bg-gray-50 fade-in">
		<div class="container mx-auto px-4">
			<div class="flex justify-between items-center mb-8">
				<h2 class="text-3xl font-bold"><?php esc_html_e( 'Latest from the Blog', 'kitchenary' ); ?></h2>
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="text-amber-600 hover:text-amber-700 font-medium transition">
					<?php esc_html_e( 'View All Posts', 'kitchenary' ); ?>
					<i class="fas fa-arrow-right ml-2"></i>
				</a>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php
				while ( $latest_posts->have_posts() ) :
					$latest_posts->the_post();
					?>
					<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
						<div class="relative">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="block">
									<div class="overflow-hidden">
										<?php
										the_post_thumbnail(
											'kitchenary-card',
											array(
												'class' => 'w-full h-64 object-cover transition duration-300 group-hover:scale-105',
											)
										);
										?>
									</div>
								</a>
							<?php endif; ?>
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
							<div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
								<span class="flex items-center">
									<i class="far fa-calendar mr-2"></i>
									<?php echo get_the_date(); ?>
								</span>
								<span class="flex items-center">
									<i class="far fa-user mr-2"></i>
									<?php the_author(); ?>
								</span>
							</div>

							<!-- Post Title -->
							<h3 class="text-xl font-bold mb-3 group-hover:text-amber-600 transition">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<!-- Post Excerpt -->
							<div class="text-gray-600 line-clamp-2 mb-4">
								<?php the_excerpt(); ?>
							</div>

							<!-- Read More Link -->
							<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium transition">
								<?php esc_html_e( 'Read More', 'kitchenary' ); ?>
								<i class="fas fa-arrow-right ml-2"></i>
							</a>
						</div>
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