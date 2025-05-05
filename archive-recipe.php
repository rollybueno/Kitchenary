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
					<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
						<div class="relative">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="block">
									<div class="overflow-hidden">
										<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-64 object-cover transition duration-300 group-hover:scale-105' ) ); ?>
									</div>
								</a>
							<?php endif; ?>
							<div class="absolute top-4 left-4">
								<?php
								$categories = get_the_terms( get_the_ID(), 'recipe_category' );
								if ( $categories && ! is_wp_error( $categories ) ) :
									?>
									<div class="flex flex-wrap gap-2">
										<?php foreach ( $categories as $category ) : ?>
											<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" 
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

							<!-- Recipe Title -->
							<h2 class="text-xl font-bold mb-2 group-hover:text-amber-600 transition">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

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

							<!-- Recipe Excerpt -->
							<div class="text-gray-600 line-clamp-2 mb-4">
								<?php the_excerpt(); ?>
							</div>

							<!-- Read More Link -->
							<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-medium transition">
								<?php esc_html_e( 'View Recipe', 'kitchenary' ); ?>
								<i class="fas fa-arrow-right ml-2"></i>
							</a>
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