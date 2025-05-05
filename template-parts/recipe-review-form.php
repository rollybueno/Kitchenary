<?php
/**
 * Template part for displaying recipe review form
 *
 * @package Kitchenary
 */

if ( ! is_user_logged_in() ) :
	?>
	<div class="bg-amber-50 rounded-xl p-6 text-center">
		<p class="mb-4"><?php esc_html_e( 'Please log in to leave a review.', 'kitchenary' ); ?></p>
		<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
			<?php esc_html_e( 'Log In', 'kitchenary' ); ?>
		</a>
	</div>
	<?php
	return;
endif;

$current_user = wp_get_current_user();
$has_reviewed = get_posts(
	array(
		'post_type'      => 'recipe_review',
		'posts_per_page' => 1,
		'meta_key'       => '_recipe_review_recipe_id',
		'meta_value'     => get_the_ID(),
		'author'         => $current_user->ID,
	)
);

if ( $has_reviewed ) :
	?>
	<div class="bg-amber-50 rounded-xl p-6 text-center">
		<p><?php esc_html_e( 'You have already reviewed this recipe.', 'kitchenary' ); ?></p>
	</div>
	<?php
	return;
endif;
?>

<form id="recipe-review-form" class="bg-white rounded-xl shadow-sm p-6" method="post">
	<?php wp_nonce_field( 'submit_recipe_review', 'recipe_review_nonce' ); ?>
	<input type="hidden" name="recipe_id" value="<?php echo esc_attr( get_the_ID() ); ?>">

	<div class="mb-4">
		<label for="review_title" class="block text-sm font-medium text-gray-700 mb-2">
			<?php esc_html_e( 'Title', 'kitchenary' ); ?>
		</label>
		<input type="text" name="review_title" id="review_title" required
			   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
	</div>

	<div class="mb-4">
		<label for="review_rating" class="block text-sm font-medium text-gray-700 mb-2">
			<?php esc_html_e( 'Rating', 'kitchenary' ); ?>
		</label>
		<div class="flex items-center gap-2">
			<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
				<label class="cursor-pointer">
					<input type="radio" name="review_rating" value="<?php echo esc_attr( $i ); ?>" required
						   class="hidden peer">
					<i class="fas fa-star text-2xl text-gray-300 peer-checked:text-amber-500 hover:text-amber-500 transition"></i>
				</label>
			<?php endfor; ?>
		</div>
	</div>

	<div class="mb-4">
		<label for="review_content" class="block text-sm font-medium text-gray-700 mb-2">
			<?php esc_html_e( 'Review', 'kitchenary' ); ?>
		</label>
		<textarea name="review_content" id="review_content" rows="4" required
				  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500"></textarea>
	</div>

	<button type="submit" class="w-full px-6 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
		<?php esc_html_e( 'Submit Review', 'kitchenary' ); ?>
	</button>
</form> 
