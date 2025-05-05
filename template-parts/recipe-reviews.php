<?php
/**
 * Template part for displaying recipe reviews
 *
 * @package Kitchenary
 */

$recipe_id = get_the_ID();
$reviews   = get_posts(
	array(
		'post_type'      => 'recipe_review',
		'posts_per_page' => -1,
		'meta_key'       => '_recipe_review_recipe_id',
		'meta_value'     => $recipe_id,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

if ( $reviews ) :
	?>
	<section class="recipe-reviews mt-12">
		<h2 class="text-2xl font-bold mb-6"><?php esc_html_e( 'Reviews', 'kitchenary' ); ?></h2>

		<div class="space-y-6">
			<?php
			foreach ( $reviews as $review ) :
				$rating        = get_post_meta( $review->ID, '_recipe_review_rating', true );
				$helpful_votes = get_post_meta( $review->ID, '_recipe_review_helpful_votes', true );
				$helpful_votes = $helpful_votes ? $helpful_votes : 0;
				?>
				<article class="bg-white rounded-xl shadow-sm p-6">
					<div class="flex items-start justify-between mb-4">
						<div>
							<h3 class="text-lg font-semibold mb-2"><?php echo esc_html( $review->post_title ); ?></h3>
							<div class="flex items-center gap-4 text-sm text-gray-600">
								<span class="flex items-center">
									<i class="far fa-user mr-2"></i>
									<?php echo esc_html( get_the_author_meta( 'display_name', $review->post_author ) ); ?>
								</span>
								<span class="flex items-center">
									<i class="far fa-calendar mr-2"></i>
									<?php echo get_the_date( '', $review->ID ); ?>
								</span>
							</div>
						</div>
						<div class="flex items-center">
							<div class="flex text-amber-500 mr-2">
								<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
									<i class="fas fa-star <?php echo $i <= $rating ? 'text-amber-500' : 'text-gray-300'; ?>"></i>
								<?php endfor; ?>
							</div>
						</div>
					</div>

					<div class="prose prose-sm max-w-none mb-4">
						<?php echo wp_kses_post( $review->post_content ); ?>
					</div>

					<div class="flex items-center justify-between text-sm text-gray-600">
						<button class="helpful-vote-btn flex items-center gap-2 hover:text-amber-600 transition" 
								data-review-id="<?php echo esc_attr( $review->ID ); ?>">
							<i class="far fa-thumbs-up"></i>
							<span><?php esc_html_e( 'Helpful', 'kitchenary' ); ?></span>
							<span class="helpful-count">(<?php echo esc_html( $helpful_votes ); ?>)</span>
						</button>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
endif;
